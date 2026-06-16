<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::orderBy('name')->get();

        return view('sites.index', compact('sites'));
    }

    public function create()
    {
        return view('sites.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        Site::create($data);

        return redirect()
            ->route('sites.index')
            ->with('success', 'Site ajouté avec succès.');
    }

    public function show(Site $site)
    {
        $site->load('users');

        return view('sites.show', compact('site'));
    }

    public function edit(Site $site)
    {
        return view('sites.edit', compact('site'));
    }

    public function update(Request $request, Site $site)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $site->update($data);

        return redirect()
            ->route('sites.index')
            ->with('success', 'Site modifié avec succès.');
    }

    public function destroy(Site $site)
    {
        $site->delete();

        return redirect()
            ->route('sites.index')
            ->with('success', 'Site supprimé avec succès.');
    }
}
