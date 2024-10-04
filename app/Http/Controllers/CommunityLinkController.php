<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityLink; // Importamos el modelo
use Illuminate\Support\Facades\Auth; // Para obtener el usuario autenticado

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = CommunityLink::latest()->paginate(10); // Ejemplo de paginación
        return view('dashboard', compact('links'));
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
        // Validamos los datos del formulario
        $data = $request->validate([
            'title' => 'required|max:255',
            'link' => 'required|unique:community_links|url|max:255',
        ]);

        // Añadimos user_id y channel_id al request
        $data['user_id'] = Auth::id(); // Obtenemos el user_id del usuario autenticado
        $data['channel_id'] = 1; // Hardcodeamos el channel_id por ahora

        // Creamos el link en la base de datos
        CommunityLink::create($data);

        // Redirigimos de vuelta con un mensaje de éxito
        return back()->with('success', 'Link added successfully!');
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

