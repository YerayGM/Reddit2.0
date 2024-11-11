<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommunityLinkForm;
use App\Queries\CommunityLinkQuery;
use App\Models\CommunityLink;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = new CommunityLinkQuery();
        $channels = Channel::all(); // Obtener todos los canales
    
        // Obtener el ID del canal de la solicitud
        $channelId = request()->input('channel');
    
        if (request()->exists('popular') && $channelId) {
            $links = $query->getMostPopularByChannel(Channel::findOrFail($channelId));
        } elseif (request()->exists('popular')) {
            $links = $query->getMostPopular();
        } else {
            $links = $query->getAll();
        }
    
        return view('dashboard', compact('links', 'channels')); // Pasar ambas variables a la vista
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
    // app/Http/Controllers/CommunityLinkController.php
    public function store(CommunityLinkForm $request)
    {
        $data = $request->validated();

        $link = new CommunityLink($data);
        $link->user_id = Auth::id();

        // Verificar si el link ya ha sido enviado
        if ($link->hasAlreadyBeenSubmitted()) {
            return back();
        }

        // Aprobar automáticamente si el usuario es de confianza
        if (Auth::user()->isTrusted()) {
            $link->approved = true;
            $message = 'Your link has been automatically approved.';
            $messageType = 'success';
        } else {
            $link->approved = false;
            $message = 'Your link is pending approval.';
            $messageType = 'warning';
        }

        

        $link->save();
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

    /**
     * Display the user's links.
     */
    public function myLinks()
    {
        $links = Auth::user()->communityLinks()->paginate(10);
        return view('mylinks', compact('links'));
    }
}
