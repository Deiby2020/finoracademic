<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estudiante;
use App\Models\User;

class Estudiantes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $ci, $nombre, $apellido_paterno, $apellido_materno, $nacimiento, $telefono, $correo, $genero, $ciudad, $direccion, $estado, $password;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.estudiantes.view', [
            'estudiantes' => Estudiante::latest()
						->orWhere('ci', 'LIKE', $keyWord)
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('apellido_paterno', 'LIKE', $keyWord)
						->orWhere('apellido_materno', 'LIKE', $keyWord)
						->orWhere('nacimiento', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('correo', 'LIKE', $keyWord)
						->orWhere('genero', 'LIKE', $keyWord)
						->orWhere('ciudad', 'LIKE', $keyWord)
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
		$this->ci = null;
		$this->nombre = null;
		$this->apellido_paterno = null;
		$this->apellido_materno = null;
		$this->nacimiento = null;
		$this->telefono = null;
		$this->correo = null;
		$this->genero = null;
		$this->ciudad = null;
		$this->direccion = null;
		$this->estado = null;
		$this->password = null;
    }

    public function store()
    {
        $this->validate([
		'ci' => 'required',
		'nombre' => 'required',
		'apellido_paterno' => 'required',
		'apellido_materno' => 'required',
		'nacimiento' => 'required',
		'telefono' => 'required',
		'correo' => 'required',
		'genero' => 'required',
		'ciudad' => 'required',
		'direccion' => 'required',
		'estado' => 'required',
		'password' => 'required',
        ]);
		$user = User::create([
			'name'  => $this-> nombre,
			'email' => $this-> correo,
			'password' => bcrypt($this-> password)
		]);

        $estudiante = Estudiante::create([ 
			'ci' => $this-> ci,
			'nombre' => $this-> nombre,
			'apellido_paterno' => $this-> apellido_paterno,
			'apellido_materno' => $this-> apellido_materno,
			'nacimiento' => $this-> nacimiento,
			'telefono' => $this-> telefono,
			'correo' => $this-> correo,
			'genero' => $this-> genero,
			'ciudad' => $this-> ciudad,
			'direccion' => $this-> direccion,
			'estado' => $this-> estado,
			'fkid_usuario' => $user->id,
        ] );
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Estudiante Creado satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = Estudiante::findOrFail($id);

        $this->selected_id = $id; 
		$this->ci = $record-> ci;
		$this->nombre = $record-> nombre;
		$this->apellido_paterno = $record-> apellido_paterno;
		$this->apellido_materno = $record-> apellido_materno;
		$this->nacimiento = $record-> nacimiento;
		$this->telefono = $record-> telefono;
		$this->correo = $record-> correo;
		$this->genero = $record-> genero;
		$this->ciudad = $record-> ciudad;
		$this->direccion = $record-> direccion;
		$this->estado = $record-> estado;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'ci' => 'required',
		'nombre' => 'required',
		'apellido_paterno' => 'required',
		'apellido_materno' => 'required',
		'nacimiento' => 'required',
		'telefono' => 'required',
		'correo' => 'required',
		'genero' => 'required',
		'ciudad' => 'required',
		'direccion' => 'required',
		'estado' => 'required',
		'password' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Estudiante::find($this->selected_id);
			$usuario = User::find($record->fkid_usuario);
			$fkidusuario = $usuario == null ? 0 : $usuario->id;
			if ($usuario == null){
				$user = User::create([
					'name'  => $this-> nombre,
					'email' => $this-> correo,
					'password' => bcrypt($this-> password)
				]);
				$fkidusuario = $user->id;
			}else{
				$user = User::find($record->fkid_usuario);
				$user->update([ 
					'name'  => $this-> nombre,
					'email' => $this-> correo,
					'password' => bcrypt($this-> password)
					]);
			}
            $record->update([ 
			'ci' => $this-> ci,
			'nombre' => $this-> nombre,
			'apellido_paterno' => $this-> apellido_paterno,
			'apellido_materno' => $this-> apellido_materno,
			'nacimiento' => $this-> nacimiento,
			'telefono' => $this-> telefono,
			'correo' => $this-> correo,
			'genero' => $this-> genero,
			'ciudad' => $this-> ciudad,
			'direccion' => $this-> direccion,
			'estado' => $this-> estado,
			'fkid_usuario' => $fkidusuario,
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Estudiante actualizado satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Estudiante::where('id', $id);
            $record->delete();
        }
    }
}
