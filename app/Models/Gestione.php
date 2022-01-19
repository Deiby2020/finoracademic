<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestione extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'gestiones';

    protected $fillable = ['descripcion','fecha_ini','fecha_fin','estado'];
	
}
