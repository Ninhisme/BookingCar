<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorController extends Controller
{
    public function AuthorDashboard(){
        return view('author.index');
    }

    public function AuthorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AuthorProfile()
    {
        $id = Auth::user()->id;
        $authorData = User::find($id); 
        return view('author.author_profile_view', compact('authorData') );
    }
}