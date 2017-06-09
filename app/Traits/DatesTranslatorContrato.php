<?php  

namespace App\Traits;

use Jenssegers\Date\Date;

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
	
}