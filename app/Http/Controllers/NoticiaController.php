<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoticiaController extends Controller
{
    /**
     * Lista de notícias.
     */
    public function index()
    {
        $noticias = Noticia::orderBy('data_publicacao', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('noticias.index', compact('noticias'));
    }

    /**
     * Formulário de criação.
     */
    public function create()
    {
        return view('noticias.create');
    }

    /**
     * Salva nova notícia e redireciona para a página dela.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo'          => 'required|string|max:255',
            'resumo'          => 'nullable|string',
            'conteudo'        => 'required|string',
            'data_publicacao' => 'nullable|date',
            'imagem'          => 'nullable|image|max:4096',
            'destaque_home'   => 'nullable|boolean',
        ]);

        // Checkbox
        $dados['destaque_home'] = $request->boolean('destaque_home');

        // Upload da imagem
        if ($request->hasFile('imagem')) {
            $arquivo = $request->file('imagem')->store('noticias', 'public');
            $dados['imagem'] = '/storage/' . $arquivo;
        }

        // Slug único
        $dados['slug'] = $this->gerarSlugUnico($dados['titulo']);

        // Cria e captura a notícia criada
        $noticia = Noticia::create($dados);

        // 👉 Redireciona para a página da própria notícia
        return redirect()
            ->route('noticias.show', $noticia)
            ->with('sucesso', 'Notícia criada com sucesso!');
    }

    /**
     * Página da notícia (foto + texto completo).
     */
    public function show(Noticia $noticia)
    {
        return view('noticias.show', compact('noticia'));
    }

    /**
     * Formulário de edição.
     */
    public function edit(Noticia $noticia)
    {
        return view('noticias.edit', compact('noticia'));
    }

    /**
     * Atualiza notícia.
     */
    public function update(Request $request, Noticia $noticia)
    {
        $dados = $request->validate([
            'titulo'          => 'required|string|max:255',
            'resumo'          => 'nullable|string',
            'conteudo'        => 'required|string',
            'data_publicacao' => 'nullable|date',
            'imagem'          => 'nullable|image|max:4096',
            'destaque_home'   => 'nullable|boolean',
        ]);

        $dados['destaque_home'] = $request->boolean('destaque_home');

        // Novo slug se mudou o título
        if ($dados['titulo'] !== $noticia->titulo) {
            $dados['slug'] = $this->gerarSlugUnico($dados['titulo'], $noticia->id);
        }

        if ($request->hasFile('imagem')) {
            $arquivo = $request->file('imagem')->store('noticias', 'public');
            $dados['imagem'] = '/storage/' . $arquivo;
        }

        $noticia->update($dados);

        return redirect()
            ->route('noticias.show', $noticia)
            ->with('sucesso', 'Notícia atualizada com sucesso!');
    }

    /**
     * Exclui notícia.
     */
    public function destroy(Noticia $noticia)
    {
        $noticia->delete();

        return redirect()
            ->route('noticias.index')
            ->with('sucesso', 'Notícia excluída com sucesso!');
    }

    /**
     * Gera slug único baseado no título.
     */
    private function gerarSlugUnico(string $titulo, int $ignoreId = null): string
    {
        $slug = Str::slug($titulo);
        $base = $slug;
        $n = 1;

        while (true) {
            $query = Noticia::where('slug', $slug);

            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }

            if (! $query->exists()) {
                return $slug;
            }

            $slug = $base . '-' . $n;
            $n++;
        }
    }
}
