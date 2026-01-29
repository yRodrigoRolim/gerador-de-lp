<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    // LISTAR
    public function index(Request $request)
    {

        $query = LandingPage::latest();

        if ($request->filled('search')) {
            $query->where('nome', 'like', '%' . $request->search . '%');
        }

        $landingPages = $query->paginate(9)->withQueryString();


        if ($request->ajax()) {
            return view('landing-pages.partials.items', compact('landingPages'))->render();
        }

        return view('landing-pages.create', compact('landingPages'));
    }

    // FORM DE CRIAÇÃO
    public function create()
    {
        $landingPages = LandingPage::all();
        return view('landing-pages.create', compact('landingPages'));
    }

    // SALVAR
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'responsavel' => 'nullable|string|max:255',
            'gtag' => 'nullable|string|max:255',
            'formulario' => 'nullable|string|max:255',
        ]);

        $validated['conteudo'] = [];

        LandingPage::create($validated);



        return redirect()
            ->route('landing-pages.index')
            ->with('success', 'Landing page criada com sucesso!');
    }

    // VISUALIZAR
    public function show(LandingPage $landingPage)
    {
        return view('landing-pages.show', compact('landingPage'));
    }

    // FORM DE EDIÇÃO
    public function edit(Request $request, LandingPage $landingPage)
    {
        $query = LandingPage::latest();

        if ($request->filled('search')) {
            $query->where('nome', 'like', '%' . $request->search . '%');
        }

        $landingPages = $query->paginate(9)->withQueryString();


        if ($request->ajax()) {
            return view('landing-pages.partials.items', compact('landingPages'))->render();
        }

        return view(
            'landing-pages.edit',
            compact('landingPage', 'landingPages')
        );
    }


    // ATUALIZAR
    public function update(Request $request, LandingPage $landingPage)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'responsavel' => 'nullable|string|max:255',
            'gtag' => 'nullable|string|max:255',
            'formulario' => 'nullable|string|max:255',
        ]);

        $landingPage->update($validated);

        return redirect()
            ->route('landing-pages.index')
            ->with('success', 'Landing page atualizada com sucesso!');
    }

    // DELETAR
    public function destroy(LandingPage $landingPage)
    {
        $landingPage->delete();

        return redirect()
            ->route('landing-pages.index')
            ->with('success', 'Landing page removida com sucesso!');
    }

    public function preview($id)
    {
        $page = LandingPage::findOrFail($id);
        return view('lp', compact('page'));
    }

    public function updateConteudo(Request $request, $id)
    {
        $request->validate([
            'conteudo' => 'required|array'
        ]);

        LandingPage::where('id', $id)->update([
            'conteudo' => $request->conteudo
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
