<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Docente;

class Docentes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nit, $nombre, $apellido_paterno, $apellido_materno, $profesion, $nacimiento, $telefono, $correo, $genero, $direccion, $estado;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.docentes.view', [
            'docentes' => Docente::latest()
						->orWhere('nit', 'LIKE', $keyWord)
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('apellido_paterno', 'LIKE', $keyWord)
						->orWhere('apellido_materno', 'LIKE', $keyWord)
						->orWhere('profesion', 'LIKE', $keyWord)
						->orWhere('nacimiento', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('correo', 'LIKE', $keyWord)
						->orWhere('genero', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
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
		$this->nit = null;
		$this->nombre = null;
		$this->apellido_paterno = null;
		$this->apellido_materno = null;
		$this->profesion = null;
		$this->nacimiento = null;
		$this->telefono = null;
		$this->correo = null;
		$this->genero = null;
		$this->direccion = null;
		$this->estado = null;
    }

    public function store()
    {
        $this->validate([
		'nit' => 'required',
		'nombre' => 'required',
		'apellido_paterno' => 'required',
		'apellido_materno' => 'required',
		'profesion' => 'required',
		'nacimiento' => 'required',
		'telefono' => 'required',
		'correo' => 'required',
		'genero' => 'required',
		'direccion' => 'required',
		'estado' => 'required',
        ]);

        Docente::create([ 
			'nit' => $this-> nit,
			'nombre' => $this-> nombre,
			'apellido_paterno' => $this-> apellido_paterno,
			'apellido_materno' => $this-> apellido_materno,
			'profesion' => $this-> profesion,
			'nacimiento' => $this-> nacimiento,
			'telefono' => $this-> telefono,
			'correo' => $this-> correo,
			'genero' => $this-> genero,
			'direccion' => $this-> direccion,
			'estado' => $this-> estado
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Docente Creado satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = Docente::findOrFail($id);

        $this->selected_id = $id; 
		$this->nit = $record-> nit;
		$this->nombre = $record-> nombre;
		$this->apellido_paterno = $record-> apellido_paterno;
		$this->apellido_materno = $record-> apellido_materno;
		$this->profesion = $record-> profesion;
		$this->nacimiento = $record-> nacimiento;
		$this->telefono = $record-> telefono;
		$this->correo = $record-> correo;
		$this->genero = $record-> genero;
		$this->direccion = $record-> direccion;
		$this->estado = $record-> estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nit' => 'required',
		'nombre' => 'required',
		'apellido_paterno' => 'required',
		'apellido_materno' => 'required',
		'profesion' => 'required',
		'nacimiento' => 'required',
		'telefono' => 'required',
		'correo' => 'required',
		'genero' => 'required',
		'direccion' => 'required',
		'estado' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Docente::find($this->selected_id);
            $record->update([ 
			'nit' => $this-> nit,
			'nombre' => $this-> nombre,
			'apellido_paterno' => $this-> apellido_paterno,
			'apellido_materno' => $this-> apellido_materno,
			'profesion' => $this-> profesion,
			'nacimiento' => $this-> nacimiento,
			'telefono' => $this-> telefono,
			'correo' => $this-> correo,
			'genero' => $this-> genero,
			'direccion' => $this-> direccion,
			'estado' => $this-> estado
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Docente Actualizado satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Docente::where('id', $id);
            $record->delete();
        }
    }
}
