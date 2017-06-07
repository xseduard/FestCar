<?php  

namespace App\Traits;

use Jenssegers\Date\Date;

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
}