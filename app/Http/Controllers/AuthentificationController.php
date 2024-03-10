<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class AuthentificationController extends Controller
{


    public function pageregister()
    {
        return view('register');
    }

    public function pagelogin()
    {
        return view('login');
    }

    public function registerSave(Request $request)
    {

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'type_compte' => 'required|string|in:organisateur,client',
        ]);


        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->Roles = $request->type_compte;


        if (User::count() === 0) {
            $user->Roles = 'admin';
        }

        $user->save();


        return redirect()->route('loginAction')->with('success', 'Votre compte a été créé avec succès. Veuillez vous connecter.');
    }


    public function loginAction()
    {

        $formFields = request()->validate([
            "email" => 'required|email',
            "password" => 'required'
        ]);
        // dd($formFields);

        if (auth()->attempt($formFields)) {
            request()->session()->regenerate();

            $user = auth()->user();

            if ($user->Roles === 'organisateur') {
                return redirect()->route('org.dashbord');
            } elseif ($user->Roles === 'client') {
                return redirect()->route('home');
            } elseif ($user->Roles === 'admin') {
                return redirect()->route('admin.dashbord');
            }
        }

        return redirect()->route('login')->with('error', 'Identifiants incorrects. Veuillez réessayer.');
    }


    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public  function  index(){
        $user = User::all();
        return view('affiche_user',['user' => $user]);
    }


    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
