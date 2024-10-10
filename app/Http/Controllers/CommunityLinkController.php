<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityLink; // Importamos el modelo
use App\Models\Channel; // Importamos el modelo Channel
use Illuminate\Support\Facades\Auth; // Para obtener el usuario autenticado

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = CommunityLink::latest()->paginate(10); // Ejemplo de paginación
        $channels = Channel::orderBy('title','asc')->get();

        return view('dashboard', compact('links', 'channels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $data = $request->validate([
    'title' => 'required|max:255',
    'link' => 'required|unique:community_links|url|max:255',
    ]);

    $link = new CommunityLink($data);
    // Si uso CommunityLink::create($data) tengo que declarar user_id y channel_id como $fillable
    $link->user_id = Auth::id();
    $link->channel_id = 1;
    $link->save();
    return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}

