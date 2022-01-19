<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'cuentas';

    protected $fillable = ['nro_cuenta','descripcion','fecha_apertura','saldo','tipo_moneda','fkid_cliente', 'observaciones'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'fkid_cliente');
    }
    
}
