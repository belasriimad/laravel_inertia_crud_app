<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get the contacts list of the currently logged in user
     */
    public function index()
    {
        return Inertia::render('Home/Index')->with([
            'contacts' => auth()->user()->contacts()->paginate(10)
        ]);
    }
}
