<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Aula;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Auth;

class Aulas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $estado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        $auth = Auth::user();
        $estudiante = Estudiante::where('fkid_usuario','=',$auth->id)->first();
        return view('livewire.aulas.view', [
            'aulas' => Aula::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('estado', 'LIKE', $keyWord)
						->paginate(10),
                        'estudiante' => $estudiante
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

        Aula::create([ 
			'descripcion' => $this-> descripcion,
			'estado' => $this-> estado
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Aula Creada satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = Aula::findOrFail($id);

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
			$record = Aula::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Aula Actualizada satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Aula::where('id', $id);
            $record->delete();
        }
    }
}
