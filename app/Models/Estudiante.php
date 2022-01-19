<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'estudiantes';

    protected $fillable = ['ci','nombre','apellido_paterno','apellido_materno','nacimiento','telefono','correo','genero','ciudad','direccion','estado', 'fkid_usuario'];
	
}
