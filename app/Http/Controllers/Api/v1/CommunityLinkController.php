<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\CommunityLink;
use Illuminate\Http\Request;

class CommunityLinkController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'channel_id' => 'required|exists:channels,id',
        ]);
    
        $communityLink = CommunityLink::create([
            'title' => $request->title,
            'url' => $request->url,
            'channel_id' => $request->channel_id,
            'user_id' => $request->user()->id, // Usuario autenticado
        ]);
    
        return response()->json([
            'message' => 'Link creado exitosamente',
            'data' => $communityLink,
        ], 201);
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $communityLink = CommunityLink::find($id);
    
        if (!$communityLink) {
            return response()->json(['message' => 'Link no encontrado'], 404);
        }
    
        return response()->json($communityLink, 200);
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $communityLink = CommunityLink::find($id);
    
        if (!$communityLink) {
            return response()->json(['message' => 'Link no encontrado'], 404);
        }
    
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'url' => 'sometimes|url',
            'channel_id' => 'sometimes|exists:channels,id',
        ]);
    
        $communityLink->update($validated);
    
        return response()->json([
            'message' => 'Link actualizado exitosamente',
            'data' => $communityLink,
        ], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $communityLink = CommunityLink::find($id);
    
        if (!$communityLink) {
            return response()->json(['message' => 'Link no encontrado'], 404);
        }
    
        $communityLink->delete();
    
        return response()->json(['message' => 'Link eliminado exitosamente'], 200);
    }
    
}
