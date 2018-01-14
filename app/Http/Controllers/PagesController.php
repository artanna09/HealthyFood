<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consists;
use App\Methods;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Laravel!';
        return view ('pages.index', compact ('title'));
    }

    public function about(){
        $title = 'About Us';
        return view ('pages.about', compact ('title'));
    }
    public function consists(){
        $consists = Consists::paginate(10);
        return view ('consists.index')->with ('consists', $consists);    
    }

    public function methods(){
        $methods = Methods::paginate(10);
        return view ('methods.index')->with ('methods', $methods);    
    }
    public function services(){
        $data = array (
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view ('pages.services')->with($data);
        }
}
