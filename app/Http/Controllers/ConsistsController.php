<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Consists;

class ConsistsController extends Controller
{
    public function index()
    {
        $consists = Consists::paginate(10);
        return view ('consists.index')->with ('consists', $consists);    
    }

    public function find($id)
    {
        $posts = DB::table('posts')->where('consist_id', '=', $id)->paginate(10);
        return view('consists.consists')->with('posts', $posts);
    }
}
