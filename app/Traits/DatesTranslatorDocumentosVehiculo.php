<?php  

namespace App\Traits;

use Jenssegers\Date\Date;
use Carbon\Carbon;

trait DatesTranslatorDocumentosVehiculo
{
	public function getCreatedAtAttribute($created_at)
	{
		return new Date($created_at);
	}
	public function getUpdatedAtAttribute($updated_at)
	{
		return new Date($updated_at);
	}
	public function getDeletedAtAttribute($deleted_at)
	{
		return new Date($deleted_at);
	}
	public function getFechaExpedicionAttribute($fecha_expedicion)
	{
		return new Date($fecha_expedicion);
	}
	public function getFechaVigenciaInicioAttribute($fecha_vigencia_inicio)
	{
		return new Date($fecha_vigencia_inicio);
	}
	public function getFechaVigenciaFinalAttribute($fecha_vigencia_final)
	{
		return new Date($fecha_vigencia_final);
	}

	public function getDiasActualDiferenciaAttribute()
    {       
        if ($this->fecha_vigencia_inicio <=  Carbon::now() && $this->fecha_vigencia_final >= Carbon::now()) {
            //return Carbon::now()->diffInDays($this->fecha_vigencia_final);
            return $this->fecha_vigencia_inicio->diffInDays(Carbon::now());
        } elseif ($this->fecha_vigencia_inicio >  Carbon::now() && $this->fecha_vigencia_final > Carbon::now()) {
            return 0;
        } elseif ($this->fecha_vigencia_inicio <  Carbon::now() && $this->fecha_vigencia_final < Carbon::now()) {
        	return $this->fecha_vigencia_inicio->diffInDays($this->fecha_vigencia_final);
        }
    }
    public function getDiasDiferenciaAttribute()
    {       
        return $this->fecha_vigencia_inicio->diffInDays($this->fecha_vigencia_final);        
    }

    /**
     * Query Scopes
     */

    public function scopeSvehiculoplaca($query, $placa)
    {
        $placa = trim($placa);
        if (!empty($placa)) {
        	return $query->WhereHas('vehiculo', function($q) use ($placa) { $q->Splaca($placa); });
        }
    }

    public function scopeSestado($query, $estado)
    {
        if (!empty($estado)) {
            switch ($estado) {
                case 'vigente':
                    return $query->where('fecha_vigencia_inicio', '<=',  Carbon::now() )
                                 ->where('fecha_vigencia_final', '>=',  Carbon::now() );
                    break;
                case 'no_vigente':
                	return $query->Where(function ($q) {
				                $q->where('fecha_vigencia_inicio', '<',  Carbon::now() )
                                  ->where('fecha_vigencia_final', '<',  Carbon::now() );
				            })->orWhere(function ($q) {
				                $q->where('fecha_vigencia_inicio', '>',  Carbon::now() )
                                  ->where('fecha_vigencia_final', '>',  Carbon::now() );
				            });
                   
                    break;

                default:
                    return $query;
                    break;
            }
        }  
    }




}