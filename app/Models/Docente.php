<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'docentes';

    protected $fillable = ['nit','nombre','apellido_paterno','apellido_materno','profesion','nacimiento','telefono','correo','genero','direccion','estado'];
	
}
