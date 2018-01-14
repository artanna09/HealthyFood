<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Methods;

class MethodsController extends Controller
{
    public function index()
    {
        $methods = Methods::paginate(10);
        return view ('methods.index')->with ('methods', $methods);    
    }

    public function find($id)
    {
        $posts = DB::table('posts')->where('method_id', '=', $id)->paginate(10);
        return view('methods.methods')->with('posts', $posts);
    }
}
