<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'clientes';

    protected $fillable = ['ci','nombre','apellido_paterno','apellido_materno','genero','estado_civil','telefono','correo','ciudad','direccion'];
	
}
