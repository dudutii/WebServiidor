<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TextoHome;
use App\Models\Noticia;

class HomeController extends Controller
{
    public function index()
    {
        // pega o registro único de textos da home
        $texto = TextoHome::first();

        // notícias em destaque (ou nada, se ainda não marcou nenhuma)
        $noticiasDestacadas = Noticia::where('destaque_home', 1)
            ->orderBy('data_publicacao', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('texto', 'noticiasDestacadas'));
    }

    public function edit()
    {
        // garante que sempre exista um texto_home
        $texto = TextoHome::firstOrCreate([], [
            'conteudo'       => '',
            'banner_legenda' => 'GSA',
            'banner_titulo'  => 'GSA',
            'banner_imagem'  => '/imagens/hero.jpg',
        ]);

        // pega até 3 notícias para editar (se não tiver, a tela fica sem cards)
        $noticias = Noticia::orderBy('data_publicacao', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('editar_home', compact('texto', 'noticias'));
    }

    public function update(Request $request)
    {
        // garante o registro único
        $texto = TextoHome::firstOrCreate([]);

        // atualiza campos do banner
        $texto->banner_legenda = $request->input('banner_legenda');
        $texto->banner_titulo  = $request->input('banner_titulo');
        $texto->conteudo       = $request->input('conteudo');

        // upload do banner
        if ($request->hasFile('banner_imagem')) {
            $path = $request->file('banner_imagem')->store('banners', 'public');
            $texto->banner_imagem = '/storage/' . $path;
        }

        $texto->save();

        /**
         * Atualizar notícias destacadas (3 cards de baixo)
         * Os campos vêm como noticia[ID][campo]
         */
        if ($request->has('noticia')) {
            foreach ($request->noticia as $id => $dados) {
                $noticia = Noticia::find($id);
                if (! $noticia) continue;

                $noticia->titulo = $dados['titulo'] ?? $noticia->titulo;
                $noticia->resumo = $dados['resumo'] ?? $noticia->resumo;
                $noticia->data_publicacao = $dados['data'] ?? $noticia->data_publicacao;

                // checkbox de destaque
                $noticia->destaque_home = !empty($dados['destaque']);

                // upload de imagem da notícia
                if (isset($dados['imagem']) && $dados['imagem']) {
                    $path = $dados['imagem']->store('noticias', 'public');
                    $noticia->imagem = '/storage/' . $path;
                }

                $noticia->save();
            }
        }

        return redirect()->route('home.edit')
            ->with('success', 'Home atualizada com sucesso!');
    }
}
