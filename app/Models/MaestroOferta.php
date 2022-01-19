<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaestroOferta extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'maestro_ofertas';

    protected $fillable = ['cupo','fkid_materia','fkid_docente','fkid_grupo','fkid_horario','fkid_modulo','fkid_aula'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function aula()
    {
        return $this->hasOne('App\Models\Aula', 'id', 'fkid_aula');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function docente()
    {
        return $this->hasOne('App\Models\Docente', 'id', 'fkid_docente');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function grupo()
    {
        return $this->hasOne('App\Models\Grupo', 'id', 'fkid_grupo');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function horario()
    {
        return $this->hasOne('App\Models\Horario', 'id', 'fkid_horario');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function materia()
    {
        return $this->hasOne('App\Models\Materia', 'id', 'fkid_materia');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function modulo()
    {
        return $this->hasOne('App\Models\Modulo', 'id', 'fkid_modulo');
    }
    
}
