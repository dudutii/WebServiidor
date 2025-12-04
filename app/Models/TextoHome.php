<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextoHome extends Model
{
    protected $table = 'textos_home';
    public $timestamps = false;
    protected $fillable = ['conteudo'];
}
