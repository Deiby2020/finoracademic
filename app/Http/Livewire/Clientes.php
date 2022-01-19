<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cliente;

class Clientes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $ci, $nombre, $apellido_paterno, $apellido_materno, $genero, $estado_civil, $telefono, $correo, $ciudad, $direccion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.clientes.view', [
            'clientes' => Cliente::latest()
						->orWhere('ci', $keyWord)
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('apellido_paterno', 'LIKE', $keyWord)
						->orWhere('apellido_materno', 'LIKE', $keyWord)
						->orWhere('genero', $keyWord)
						->orWhere('estado_civil', $keyWord)
						->orWhere('telefono', $keyWord)
						->orWhere('correo', $keyWord)
						->orWhere('ciudad', $keyWord)
						->orWhere('direccion', $keyWord)
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
		$this->ci = null;
		$this->nombre = null;
		$this->apellido_paterno = null;
		$this->apellido_materno = null;
		$this->genero = null;
		$this->estado_civil = null;
		$this->telefono = null;
		$this->correo = null;
		$this->ciudad = null;
		$this->direccion = null;
    }

    public function store()
    {
        $this->validate([
		'ci' => 'required',
		'nombre' => 'required',
		'apellido_paterno' => 'required',
		'apellido_materno' => 'required',
		'genero' => 'required',
		'estado_civil' => 'required',
		'telefono' => 'required',
		'correo' => 'required',
		'ciudad' => 'required',
		'direccion' => 'required',
        ]);

        Cliente::create([ 
			'ci' => $this-> ci,
			'nombre' => $this-> nombre,
			'apellido_paterno' => $this-> apellido_paterno,
			'apellido_materno' => $this-> apellido_materno,
			'genero' => $this-> genero,
			'estado_civil' => $this-> estado_civil,
			'telefono' => $this-> telefono,
			'correo' => $this-> correo,
			'ciudad' => $this-> ciudad,
			'direccion' => $this-> direccion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Cliente Creado Satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = Cliente::findOrFail($id);

        $this->selected_id = $id; 
		$this->ci = $record-> ci;
		$this->nombre = $record-> nombre;
		$this->apellido_paterno = $record-> apellido_paterno;
		$this->apellido_materno = $record-> apellido_materno;
		$this->genero = $record-> genero;
		$this->estado_civil = $record-> estado_civil;
		$this->telefono = $record-> telefono;
		$this->correo = $record-> correo;
		$this->ciudad = $record-> ciudad;
		$this->direccion = $record-> direccion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'ci' => 'required',
		'nombre' => 'required',
		'apellido_paterno' => 'required',
		'apellido_materno' => 'required',
		'genero' => 'required',
		'estado_civil' => 'required',
		'telefono' => 'required',
		'correo' => 'required',
		'ciudad' => 'required',
		'direccion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Cliente::find($this->selected_id);
            $record->update([ 
			'ci' => $this-> ci,
			'nombre' => $this-> nombre,
			'apellido_paterno' => $this-> apellido_paterno,
			'apellido_materno' => $this-> apellido_materno,
			'genero' => $this-> genero,
			'estado_civil' => $this-> estado_civil,
			'telefono' => $this-> telefono,
			'correo' => $this-> correo,
			'ciudad' => $this-> ciudad,
			'direccion' => $this-> direccion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Cliente Actualizado Satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Cliente::where('id', $id);
            $record->delete();
        }
    }
}
