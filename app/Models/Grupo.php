<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'grupos';

    protected $fillable = ['descripcion','estado'];
	
}
