<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gato extends Model
{
    protected $table = 'gatos';

    protected $fillable = ['nombre', 'edad', 'imagen', 'descripcion', 'user_id'];
}
