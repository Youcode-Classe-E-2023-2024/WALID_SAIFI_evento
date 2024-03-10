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

        return redirect()->route('evenements.fetch')->with('successEvenetAjouter', 'Événement créé avec succès.');
    }
    public function fetchEvents()
    {
        $events = Event::where('user_id', auth()->id())->get(); // Récupérer les événements de l'utilisateur actuellement connecté
        return view('Organisateur.evenements', compact('events'));
    }
    public function edit($id)
    {
        $event = Event::findOrFail($id); // Récupérer l'événement par son ID
        return view('Organisateur.editEvent', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'nombre_tickets' => 'required|integer',
            'prix' => 'required|numeric',
            'localisation' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ], [
            'titre.required' => 'Le titre de l\'événement est requis.',
            'description.required' => 'La description de l\'événement est requise.',
            'date.required' => 'La date de l\'événement est requise.',
            'nombre_tickets.required' => 'Le nombre de tickets disponibles est requis.',
            'prix.required' => 'Le prix du ticket est requis.',
            'localisation.required' => 'La localisation de l\'événement est requise.',
            'image.image' => 'Le fichier doit être une image.',
            'image.max' => 'La taille maximale de l\'image est de 2048 kilo-octets.',
        ]);
       dd($request);

        $event = Event::findOrFail($id);

        $event->title = $request->titre;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->available_seats = $request->nombre_tickets;
        $event->price = $request->prix;
        $event->location = $request->localisation;


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events_images', 'public');
            $event->image = $imagePath;
        }

        $event->save();

        return redirect()->route('evenements.fetch')->with('successEvenetAjouter', 'Événement mis à jour avec succès.');
    }


    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('evenements.fetch')->with('successEventDelete', 'Événement supprimé avec succès.');
    }


    public function indexHome()
    {
        $events = Event::all();
        return view('home', compact('events'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query'); // Récupère le terme de recherche depuis le formulaire

        // Effectuez la recherche dans votre modèle approprié
        $results = Event::where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        // Retournez les résultats de la recherche à une vue appropriée
        return view('search.results', [
            'results' => $results,
            'query' => $query, // Passer la valeur de $query à la vue
        ]);
    }






}
