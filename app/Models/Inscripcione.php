<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcione extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'inscripciones';

    protected $fillable = ['fkid_gestion','fkid_estudiante'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estudiante()
    {
        return $this->hasOne('App\Models\Estudiante', 'id', 'fkid_estudiante');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function gestione()
    {
        return $this->hasOne('App\Models\Gestione', 'id', 'fkid_gestion');
    }
    
}
