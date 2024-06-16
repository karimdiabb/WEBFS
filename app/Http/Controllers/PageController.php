<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.create-edit');
    }

    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'De titel is verplicht.',
            'slug.required' => 'De URL slug is verplicht.',
            'slug.unique' => 'De URL slug moet uniek zijn.',
            'content.required' => 'De inhoud is verplicht.'
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug|max:255',
            'content' => 'required',
        ], $messages);

        Page::create($request->all());
        return response()->json(['message' => 'Pagina succesvol aangemaakt.']);
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('pages.create-edit', compact('page'));
    }



    public function update(Request $request, $id)
    {
        $messages = [
            'title.required' => 'De titel is verplicht.',
            'slug.required' => 'De URL slug is verplicht.',
            'slug.unique' => 'De URL slug moet uniek zijn.',
            'content.required' => 'De inhoud is verplicht.'
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug,' . $id . '|max:255',
            'content' => 'required',
        ], $messages);

        $page = Page::findOrFail($id);
        $page->update($request->all());
        return response()->json(['message' => 'Pagina succesvol bijgewerkt.']);
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Pagina succesvol verwijderd.');
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('pages.show', compact('page'));
    }
}
