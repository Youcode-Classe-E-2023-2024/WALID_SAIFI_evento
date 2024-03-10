<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class evenementController extends Controller
{
    public  function  index(){
        $categories = Category::all();
        return view('Organisateur.Ajouterevent', compact('categories'));
    }
    public function evenment(){
        return view('Organisateur.evenements');
    }


    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'nombre_tickets' => 'required|integer',
            'prix' => 'required|numeric',
            'category' => 'required|numeric', // Assurez-vous que la catégorie est requise et numérique
            'localisation' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $event = new Event();
        $event->title = $request->titre;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->available_seats = $request->nombre_tickets;
        $event->price = $request->prix;
        $event->location = $request->localisation;
        $event->category_id = $request->category; // Assurez-vous d'attribuer la valeur de la catégorie
        $event->user_id = Auth::id();

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events_images', 'public');
            $event->image = $imagePath;
        }

        $event->save();

        return redirect()->route('page.ajouter')->with('successEvenetAjouter', 'Événement créé avec succès.');
    }
    public function fetchEvents()
    {
        $events = Event::where('user_id', auth()->id())->get(); // Récupérer les événements de l'utilisateur actuellement connecté
        return view('Organisateur.evenements', compact('events'));
    }



}
