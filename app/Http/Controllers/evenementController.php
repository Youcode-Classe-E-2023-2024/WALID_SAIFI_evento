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
        $events = Event::paginate(6);
        $categories = Category::all();

        return view('home', compact('events', 'categories'));
    }
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event', compact('event'));
    }




    public function search(Request $request)
    {
        $events = [];
        $query = $request->input('query');
        $category = $request->input('category');


        $results = Event::query();

        if ($category) {
            $results->where('category_id', $category);
        }


        if ($query) {
            $results->where('title', 'like', '%' . $query . '%');
        }


        $events = $results->get();


        return view('home', [
            'events' => $events,
            'query' => $query,
            'categories' => Category::all(),
        ]);
    }

    public function categoriesEvents()
    {
        $categories = Category::select('id', 'name', DB::raw('COUNT(events.id) as event_count'))
            ->leftJoin('events', 'categories.id', '=', 'events.category_id')
            ->groupBy('categories.id')
            ->orderBy('categories.id')
            ->get();

        return response()->json($categories);
    }










}
