<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
