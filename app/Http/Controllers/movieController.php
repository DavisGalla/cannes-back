<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class movieController extends Controller
{
        public function index() {
            return Movie::all();
        }
        
        public function show($id){
        $movie = Movie::findOrFail($id);
        return response()->json($movie);
    }

}
