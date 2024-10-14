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
        $links = CommunityLink::where('approved', 1)->paginate(25);
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
        // Validar los datos del formulario
        $data = $request->validate([
            'title' => 'required|max:255',
            'link' => 'required|unique:community_links|url|max:255',
            'channel_id' => 'required|exists:channels,id' // Asegurar que el canal existe
        ]);
    
        // Crear un nuevo enlace
        $link = new CommunityLink($data);
        
        // Asignar el ID del usuario autenticado
        $link->user_id = Auth::id();
        
        // Comprobar si el usuario es confiable y aprobar el enlace automáticamente
        $link->approved = Auth::user()->trusted ?? false;
    
        // Guardar el enlace
        $link->save();
    
        // Redirigir de vuelta con un mensaje de éxito
        return back()->with('message', 'Link submitted successfully.');
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

