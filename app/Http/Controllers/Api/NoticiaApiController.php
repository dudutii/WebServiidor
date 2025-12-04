<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaApiController extends Controller
{
    // GET /api/noticias
    public function index()
    {
        $noticias = Noticia::orderBy('data_publicacao', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($noticias);
    }

    // GET /api/noticias/{id}
    public function show(Noticia $noticia)
    {
        return response()->json($noticia);
    }

    // POST /api/noticias
    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo'          => 'required|string|max:255',
            'resumo'          => 'nullable|string',
            'conteudo'        => 'required|string',
            'data_publicacao' => 'nullable|date',
            'imagem'          => 'nullable|string',
            'destaque_home'   => 'nullable|boolean',
        ]);

        $noticia = Noticia::create($dados);

        return response()->json($noticia, 201); // 201 = created
    }

    // PUT/PATCH /api/noticias/{id}
    public function update(Request $request, Noticia $noticia)
    {
        $dados = $request->validate([
            'titulo'          => 'sometimes|required|string|max:255',
            'resumo'          => 'nullable|string',
            'conteudo'        => 'sometimes|required|string',
            'data_publicacao' => 'nullable|date',
            'imagem'          => 'nullable|string',
            'destaque_home'   => 'nullable|boolean',
        ]);

        $noticia->update($dados);

        return response()->json($noticia);
    }

    // DELETE /api/noticias/{id}
    public function destroy(Noticia $noticia)
    {
        $noticia->delete();

        return response()->json(null, 204); // 204 = sem conteúdo
    }
}
