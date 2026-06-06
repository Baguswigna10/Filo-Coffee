<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('pages.member');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:20',
            'birth_date'    => 'required|date',
            'address'       => 'required|string',
        ]);

        // Logic for saving member data would go here
        // For now, we'll just simulate success
        
        return back()->with('success', 'Selamat! Pendaftaran member Anda berhasil. Kartu member digital Anda akan segera diproses.');
    }
}
