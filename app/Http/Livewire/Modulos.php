<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modulo;

class Modulos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $estado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.modulos.view', [
            'modulos' => Modulo::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
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
		$this->estado = null;
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
		'estado' => 'required',
        ]);

        Modulo::create([ 
			'descripcion' => $this-> descripcion,
			'estado' => $this-> estado
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Módulo Creado satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = Modulo::findOrFail($id);

        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		$this->estado = $record-> estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'estado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Modulo::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Módulo Actualizado satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Modulo::where('id', $id);
            $record->delete();
        }
    }
}
