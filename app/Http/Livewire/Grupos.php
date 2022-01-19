<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Grupo;

class Grupos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $estado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.grupos.view', [
            'grupos' => Grupo::latest()
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

        Grupo::create([ 
			'descripcion' => $this-> descripcion,
			'estado' => $this-> estado
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Grupo Creado satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = Grupo::findOrFail($id);

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
			$record = Grupo::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Grupo Actualizado satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Grupo::where('id', $id);
            $record->delete();
        }
    }
}
