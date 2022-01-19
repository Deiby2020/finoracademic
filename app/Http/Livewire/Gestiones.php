<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Gestione;

class Gestiones extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $fecha_ini, $fecha_fin, $estado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.gestiones.view', [
            'gestiones' => Gestione::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('fecha_ini', 'LIKE', $keyWord)
						->orWhere('fecha_fin', 'LIKE', $keyWord)
						->orWhere('estado', 'LIKE', $keyWord)
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
		$this->descripcion = null;
		$this->fecha_ini = null;
		$this->fecha_fin = null;
		$this->estado = null;
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
		'fecha_ini' => 'required',
		'fecha_fin' => 'required',
		'estado' => 'required',
        ]);

        Gestione::create([ 
			'descripcion' => $this-> descripcion,
			'fecha_ini' => $this-> fecha_ini,
			'fecha_fin' => $this-> fecha_fin,
			'estado' => $this-> estado
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Gestión Creada satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = Gestione::findOrFail($id);

        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		$this->fecha_ini = $record-> fecha_ini;
		$this->fecha_fin = $record-> fecha_fin;
		$this->estado = $record-> estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'fecha_ini' => 'required',
		'fecha_fin' => 'required',
		'estado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Gestione::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'fecha_ini' => $this-> fecha_ini,
			'fecha_fin' => $this-> fecha_fin,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Gestión Actualizada satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Gestione::where('id', $id);
            $record->delete();
        }
    }
}
