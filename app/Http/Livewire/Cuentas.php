<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cuenta;

class Cuentas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nro_cuenta, $descripcion, $fecha_apertura, $saldo, $tipo_moneda, $observaciones, $fkid_cliente;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.cuentas.view', [
            'cuentas' => Cuenta::latest()
						->orWhere('nro_cuenta', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('fecha_apertura', 'LIKE', $keyWord)
						->orWhere('saldo', 'LIKE', $keyWord)
						->orWhere('tipo_moneda', 'LIKE', $keyWord)
						->orWhere('fkid_cliente', 'LIKE', $keyWord)
						->orWhere('observaciones', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->nro_cuenta = null;
		$this->descripcion = null;
		$this->fecha_apertura = null;
		$this->saldo = null;
		$this->tipo_moneda = null;
		$this->fkid_cliente = null;
		$this->observaciones = null;
    }

    public function store()
    {
        $this->validate([
		'nro_cuenta' => 'required',
		'descripcion' => 'required',
		'fecha_apertura' => 'required',
		'saldo' => 'required',
		'tipo_moneda' => 'required',
		'fkid_cliente' => 'required',
		'observaciones' => 'required',
        ]);

        Cuenta::create([ 
			'nro_cuenta' => $this-> nro_cuenta,
			'descripcion' => $this-> descripcion,
			'fecha_apertura' => $this-> fecha_apertura,
			'saldo' => $this-> saldo,
			'tipo_moneda' => $this-> tipo_moneda,
			'observaciones' => $this-> observaciones,
			'fkid_cliente' => $this-> fkid_cliente
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Cuenta Successfully created.');
    }

    public function edit($id)
    {
        $record = Cuenta::findOrFail($id);

        $this->selected_id = $id; 
		$this->nro_cuenta = $record-> nro_cuenta;
		$this->descripcion = $record-> descripcion;
		$this->fecha_apertura = $record-> fecha_apertura;
		$this->saldo = $record-> saldo;
		$this->tipo_moneda = $record-> tipo_moneda;
		$this->fkid_cliente = $record-> fkid_cliente;
		$this->observaciones = $record-> observaciones;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nro_cuenta' => 'required',
		'descripcion' => 'required',
		'fecha_apertura' => 'required',
		'saldo' => 'required',
		'tipo_moneda' => 'required',
		'fkid_cliente' => 'required',
		'observaciones' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Cuenta::find($this->selected_id);
            $record->update([ 
			'nro_cuenta' => $this-> nro_cuenta,
			'descripcion' => $this-> descripcion,
			'fecha_apertura' => $this-> fecha_apertura,
			'saldo' => $this-> saldo,
			'tipo_moneda' => $this-> tipo_moneda,
			'observaciones' => $this-> observaciones,
			'fkid_cliente' => $this-> fkid_cliente
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Cuenta Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Cuenta::where('id', $id);
            $record->delete();
        }
    }
}
