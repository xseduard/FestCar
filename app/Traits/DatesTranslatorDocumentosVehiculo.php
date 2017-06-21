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
}