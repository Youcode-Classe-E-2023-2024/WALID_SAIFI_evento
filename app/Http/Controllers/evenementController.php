<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class evenementController extends Controller
{
    public  function  index(){
        return view('Organisateur.Ajouterevent');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'nombre_tickets' => 'required|integer',
            'prix' => 'required|numeric',
            'localisation' => 'required|string', // Ajoutez une validation pour la localisation
            'image' => 'nullable|image|max:2048',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->available_seats = $request->nombre_tickets;
        $event->price = $request->prix;
        $event->location = $request->localisation; // Associez la localisation
        $event->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events_images', 'public');
            $event->image = $imagePath;
        }

        $event->save();

        return redirect()->route('page.ajouter')->with('successEvenetAjouter', 'Événement créé avec succès.');
    }

}
