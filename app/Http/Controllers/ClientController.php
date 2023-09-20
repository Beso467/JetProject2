<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\client;

class ClientController extends Controller
{
    public function create(){
        return view('create-clients');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:clients',
            'number' =>'required',
            'profile_picture_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture_path')) {
            $profilePicturePath = $request->file('profile_picture_path')->store('profile_pictures', 'public');
        }

        client::create([
            'name' => $request->input('name'),
            'number' => $request->input('number'),
            'profile_picture_path' => $profilePicturePath,

        ]);
        return redirect()->route('client.create')->with('success', 'Client Added!');
    }
    
    public function showClients()
    {
        $clients = Client::all();
        $clients = Client::paginate(8);
    
        return view('clients', compact('clients'));
    }

    public function searchClients(Request $request)
  {
    $search = $request->query('search');
    $clients = Client::where('name', 'like', '%' . $search . '%')
        ->orWhere('number', 'like', '%' . $search . '%');
    return view('clients', compact('clients'));
  }
   
}
