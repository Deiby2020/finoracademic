<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Horario;

class Horarios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $hora_entrada, $hora_salida, $dia, $estado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.horarios.view', [
            'horarios' => Horario::latest()
						->orWhere('hora_entrada', 'LIKE', $keyWord)
						->orWhere('hora_salida', 'LIKE', $keyWord)
						->orWhere('dia', 'LIKE', $keyWord)
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
		$this->hora_entrada = null;
		$this->hora_salida = null;
		$this->dia = null;
		$this->estado = null;
    }

    public function store()
    {
        $this->validate([
		'hora_entrada' => 'required',
		'hora_salida' => 'required',
		'dia' => 'required',
		'estado' => 'required',
        ]);

        Horario::create([ 
			'hora_entrada' => $this-> hora_entrada,
			'hora_salida' => $this-> hora_salida,
			'dia' => $this-> dia,
			'estado' => $this-> estado
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Horario Creado satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = Horario::findOrFail($id);

        $this->selected_id = $id; 
		$this->hora_entrada = $record-> hora_entrada;
		$this->hora_salida = $record-> hora_salida;
		$this->dia = $record-> dia;
		$this->estado = $record-> estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'hora_entrada' => 'required',
		'hora_salida' => 'required',
		'dia' => 'required',
		'estado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Horario::find($this->selected_id);
            $record->update([ 
			'hora_entrada' => $this-> hora_entrada,
			'hora_salida' => $this-> hora_salida,
			'dia' => $this-> dia,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Horario Actualizado satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Horario::where('id', $id);
            $record->delete();
        }
    }
}
