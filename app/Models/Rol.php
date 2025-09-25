<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_rol');
    }
}
