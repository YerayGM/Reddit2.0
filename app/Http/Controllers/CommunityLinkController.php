<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityLink; // Importamos el modelo
use App\Models\Channel; // Importamos el modelo Channel
use Illuminate\Support\Facades\Auth; // Para obtener el usuario autenticado
use App\Http\Requests\CommunityLinkForm; // Aquí importamos correctamente el FormRequest

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
    public function store(CommunityLinkForm $request)
    {
        // Obtener los datos validados del formulario
        $data = $request->validated();
        // Crear un nuevo enlace con los datos del formulario
        $link = new CommunityLink($data);
        // Asignar el ID del usuario autenticado
        $link->user_id = Auth::id();
        // Comprobar si el usuario es confiable y aprobar el enlace automáticamente
        if (Auth::user()->trusted) {
            $link->approved = true;
            $message = 'Your link has been automatically approved.';
            $messageType = 'success';
        } else {
            $link->approved = false;
            $message = 'Your link is pending approval.';
            $messageType = 'warning';
        }
        // Guardar el enlace en la base de datos
        $link->save();
        // Redirigir de vuelta con el mensaje flash
        return back()->with($messageType, $message);
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

