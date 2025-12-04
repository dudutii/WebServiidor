<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';

    protected $fillable = [
        'titulo',
        'slug',
        'data_publicacao',
        'resumo',
        'conteudo',
        'imagem',
        'destaque_home',
    ];

    // 👉 Isso faz o Laravel usar o campo "slug" nas URLs (noticias/{slug})
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
