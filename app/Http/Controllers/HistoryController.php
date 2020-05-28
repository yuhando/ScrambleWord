<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {        
        $this->middleware('auth');   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $histories = History::where('user_id', $user->id)->orderByDesc('created_at')->paginate(25);

        return view('history')->with('histories', $histories);
    }
}
