<?php  

namespace App\Traits;

use Carbon\Carbon;

trait VigenteTrait
{
	public function getVigenteAttribute()
    {       
        if ($this->fecha_vigencia_inicio <=  Carbon::now() && $this->fecha_vigencia_final >= Carbon::now()) {
            return true;
        } else {
            return false;
        }
    }
}