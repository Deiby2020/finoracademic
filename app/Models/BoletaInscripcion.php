<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoletaInscripcion extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'boletainscripciones';

    protected $fillable = ['fkid_inscripcion','fkid_maestro_oferta'];
	
}
