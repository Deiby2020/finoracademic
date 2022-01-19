<?php

namespace App\Http\Livewire;

use App\Models\Aula;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Horario;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MaestroOferta;
use App\Models\Materia;
use App\Models\Modulo;

class MaestroOfertas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $cupo, $fkid_materia, $fkid_docente, $fkid_grupo, $fkid_horario, $fkid_modulo, $fkid_aula;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';

		$materia = Materia::all();
		$docente = Docente::all();
		$grupo   = Grupo::all();
		$horario = Horario::all();
		$modulo  = Modulo::all();
		$aula    = Aula::all();

        return view('livewire.maestroOfertas.view', [
            'maestroOfertas' => MaestroOferta::latest()
						->orWhere('cupo', 'LIKE', $keyWord)
						->orWhere('fkid_materia', 'LIKE', $keyWord)
						->orWhere('fkid_docente', 'LIKE', $keyWord)
						->orWhere('fkid_grupo', 'LIKE', $keyWord)
						->orWhere('fkid_horario', 'LIKE', $keyWord)
						->orWhere('fkid_modulo', 'LIKE', $keyWord)
						->orWhere('fkid_aula', 'LIKE', $keyWord)
						->paginate(10),
			'arrayMateria' => $materia,
			'arrayDocente' => $docente,
			'arrayGrupo'   => $grupo,
			'arrayHorario' => $horario,
			'arrayModulo'  => $modulo,
			'arrayAula'    => $aula,
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->cupo = null;
		$this->fkid_materia = null;
		$this->fkid_docente = null;
		$this->fkid_grupo = null;
		$this->fkid_horario = null;
		$this->fkid_modulo = null;
		$this->fkid_aula = null;
    }

    public function store()
    {
        $this->validate([
		'cupo' => 'required',
		'fkid_materia' => 'required',
		'fkid_docente' => 'required',
		'fkid_grupo' => 'required',
		'fkid_horario' => 'required',
		'fkid_modulo' => 'required',
		'fkid_aula' => 'required',
        ]);

        MaestroOferta::create([ 
			'cupo' => $this-> cupo,
			'fkid_materia' => $this-> fkid_materia,
			'fkid_docente' => $this-> fkid_docente,
			'fkid_grupo' => $this-> fkid_grupo,
			'fkid_horario' => $this-> fkid_horario,
			'fkid_modulo' => $this-> fkid_modulo,
			'fkid_aula' => $this-> fkid_aula
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Oferta de materia creada satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = MaestroOferta::findOrFail($id);

        $this->selected_id = $id; 
		$this->cupo = $record-> cupo;
		$this->fkid_materia = $record-> fkid_materia;
		$this->fkid_docente = $record-> fkid_docente;
		$this->fkid_grupo = $record-> fkid_grupo;
		$this->fkid_horario = $record-> fkid_horario;
		$this->fkid_modulo = $record-> fkid_modulo;
		$this->fkid_aula = $record-> fkid_aula;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'cupo' => 'required',
		'fkid_materia' => 'required',
		'fkid_docente' => 'required',
		'fkid_grupo' => 'required',
		'fkid_horario' => 'required',
		'fkid_modulo' => 'required',
		'fkid_aula' => 'required',
        ]);

        if ($this->selected_id) {
			$record = MaestroOferta::find($this->selected_id);
            $record->update([ 
			'cupo' => $this-> cupo,
			'fkid_materia' => $this-> fkid_materia,
			'fkid_docente' => $this-> fkid_docente,
			'fkid_grupo' => $this-> fkid_grupo,
			'fkid_horario' => $this-> fkid_horario,
			'fkid_modulo' => $this-> fkid_modulo,
			'fkid_aula' => $this-> fkid_aula
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Oferta de materia Actualizada');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = MaestroOferta::where('id', $id);
            $record->delete();
        }
    }
}
