<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public  function  index(){
             $categories = Category::all();
           return view('Admin.Category' , compact('categories'));
    }
    public function  ajouter(){
        return view('Admin.ajouterCat');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.unique' => 'La catégorie existe déjà.',
        ]);

        return redirect()->route('afficheCat')->with('successAjouter', 'Catégorie créée avec succès.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('Admin.editCat', compact('category'));
    }

    // Méthode pour supprimer une catégorie
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('afficheCat')->with('success', 'Catégorie supprimée avec succès.');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('afficheCat')->with('successUpdate', 'Catégorie mise à jour avec succès.');
    }



}
