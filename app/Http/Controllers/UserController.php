<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showRequestAdminForm()
{
    
    if (auth()->check() && auth()->user()->is_admin) {
        
        return redirect()->route('dashboard')->with('error', 'You are already an admin.');
    } else {
        return view('request-administration');
        
    }
}

}
