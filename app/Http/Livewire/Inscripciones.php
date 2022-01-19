<?php

namespace App\Http\Livewire;

use App\Models\BoletaInscripcion;
use App\Models\Estudiante;
use App\Models\Gestione;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscripcione;
use App\Models\MaestroOferta;
use Illuminate\Http\Request;

class Inscripciones extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $fkid_gestion, $fkid_estudiante;
    public $selectedID = [];
    public $checkSelected = [];
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        $gestion    = Gestione::all();
        $estudiante = Estudiante::all();
        $maestrooferta = MaestroOferta::
        select('m.sigla','gr.descripcion','m.descripcion as materia','doc.apellido_paterno','doc.apellido_materno','doc.nombre',
        'h.hora_entrada','h.hora_salida','mod.descripcion as modulo','au.descripcion as aula','cupo','maestro_ofertas.id')
        ->join('grupos as gr','maestro_ofertas.fkid_grupo','=','gr.id')
        ->join('docentes as doc','maestro_ofertas.fkid_docente','=','doc.id')
        ->join('materias as m','maestro_ofertas.fkid_materia','=','m.id')
        ->join('horarios as h','maestro_ofertas.fkid_grupo','=','h.id')
        ->join('modulos as mod','maestro_ofertas.fkid_grupo','=','mod.id')
        ->join('aulas as au','maestro_ofertas.fkid_grupo','=','au.id')
        ->orderBy('maestro_ofertas.id')
        ->get();

        return view('livewire.inscripciones.view', [
            'inscripciones' => Inscripcione::latest()
						->orWhere('fkid_gestion', 'LIKE', $keyWord)
						->orWhere('fkid_estudiante', 'LIKE', $keyWord)
						->paginate(10),
            'arrayGestion'      => $gestion,
            'arrayEstudiante'   => $estudiante,
            'arraayMaestroOferta' => $maestrooferta,
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->fkid_gestion = null;
		$this->fkid_estudiante = null;
        $this->selectedID = [];
        $this->checkSelected = [];
    }

    public function store( Request $request )
    {
        $this->validate([
		'fkid_gestion' => 'required',
		'fkid_estudiante' => 'required',
        ]);

        $inscripcion = Inscripcione::create([ 
			'fkid_gestion' => $this-> fkid_gestion,
			'fkid_estudiante' => $this-> fkid_estudiante
        ]);

        for ($index=0; $index < sizeof( $this->selectedID ); $index++) { 
            $id = $this->selectedID[$index];
            $check = $this->checkSelected[$index];
            if ( $check == "true" ) {
                $boletainscripcion = new BoletaInscripcion();
                $boletainscripcion->fkid_inscripcion = $inscripcion->id;
                $boletainscripcion->fkid_maestro_oferta = $id;
                $boletainscripcion->save();
            }
        }
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Se ha inscrito satisfactoramente.');
    }

    public function edit($id)
    {
        $record = Inscripcione::findOrFail($id);

        $this->selected_id = $id; 
		$this->fkid_gestion = $record-> fkid_gestion;
		$this->fkid_estudiante = $record-> fkid_estudiante;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'fkid_gestion' => 'required',
		'fkid_estudiante' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Inscripcione::find($this->selected_id);
            $record->update([ 
			'fkid_gestion' => $this-> fkid_gestion,
			'fkid_estudiante' => $this-> fkid_estudiante
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Se ha adicionado o retirado satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Inscripcione::where('id', $id);
            $record->delete();
        }
    }
}
