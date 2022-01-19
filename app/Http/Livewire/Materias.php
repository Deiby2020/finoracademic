<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Materia;

class Materias extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $sigla, $descripcion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.materias.view', [
            'materias' => Materia::latest()
						->orWhere('sigla', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
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
		$this->sigla = null;
		$this->descripcion = null;
    }

    public function store()
    {
        $this->validate([
		'sigla' => 'required',
		'descripcion' => 'required',
        ]);

        Materia::create([ 
			'sigla' => $this-> sigla,
			'descripcion' => $this-> descripcion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Materia creada satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = Materia::findOrFail($id);

        $this->selected_id = $id; 
		$this->sigla = $record-> sigla;
		$this->descripcion = $record-> descripcion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'sigla' => 'required',
		'descripcion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Materia::find($this->selected_id);
            $record->update([ 
			'sigla' => $this-> sigla,
			'descripcion' => $this-> descripcion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Materia Actualizada satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Materia::where('id', $id);
            $record->delete();
        }
    }
}
