<?php  

namespace App\Traits;

use Jenssegers\Date\Date;
use Carbon\Carbon;

trait DatesTranslatorContrato
{
	public function getFechaInicioAttribute($fecha_inicio)
	{
		return new Date($fecha_inicio);
	}
	public function getFechaFinalAttribute($fecha_final)
	{
		return new Date($fecha_final);
	}

	public function getVigenteAttribute()
    {       
        if ($this->fecha_inicio <=  Carbon::now() && $this->fecha_final >= Carbon::now()) {
            return true;
        } else {
            return false;
        }
    }
    public function getDiasActualDiferenciaAttribute()
    {       
        if ($this->fecha_inicio <=  Carbon::now() && $this->fecha_final >= Carbon::now()) {
            //return Carbon::now()->diffInDays($this->fecha_final);
            return $this->fecha_inicio->diffInDays(Carbon::now());
        } elseif ($this->fecha_inicio >  Carbon::now() && $this->fecha_final > Carbon::now()) {
            return 0;
        } elseif ($this->fecha_inicio <  Carbon::now() && $this->fecha_final < Carbon::now()) {        	
            return $this->fecha_inicio->diffInDays($this->fecha_final);
        }
    }
    public function getDiasDiferenciaAttribute()
    {       
        return $this->fecha_inicio->diffInDays($this->fecha_final);        
    }


    /**
     * Query Scope
     */

    public function scopeSestado($query, $estado)
    {
        if (!empty($estado)) {
            switch ($estado) {
                case 'vigente':
                    return $query->where('fecha_inicio', '<=',  Carbon::now() )
                                 ->where('fecha_final', '>=',  Carbon::now() )
                                 ->where('aprobado', true);
                    break;
                case 'finalizado':
                   return $query->where('fecha_inicio', '<',  Carbon::now() )
                                 ->where('fecha_final', '<',  Carbon::now() );
                    break;
                case 'no_iniciado':
                    return $query->where('fecha_inicio', '>',  Carbon::now() )
                                 ->where('fecha_final', '>',  Carbon::now() );
                    break;
                case 'pendiente_aprobacion':
                    return $query->where('aprobado', false);
                    break;
                default:
                    return $query;
                    break;
            }
        }  
    }

	
}