<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Methods;
use App\Consists;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        //$posts = Post::all();
        //return Post::where('title', 'Post Two')->get();
        //$posts = DB::select ('SELECT * FROM posts');

        //$posts = Post::orderBy('title', 'desc')->take(1)->get();
       // $posts = Post::orderBy('title', 'desc')->get();

        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view ('posts.index')->with ('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['methods'] = Methods::orderBy('method', 'asc')->pluck('method', 'id');
        $data['consists'] = Consists::orderBy('consist', 'asc')->pluck('consist', 'id');
        return view('posts.create')->with('data',$data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate ($request , [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'consists' => 'required',
            'methods' => 'required'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')){
                //Get file name with  the extension
              $fileNameWithExt = $request->file('cover_image')->GetClientOriginalName(); 
              //Get just filename
              $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
              //Get just ext
              $extension = $request->file('cover_image')->getClientOriginalExtension();
             //Filename to store
              $fileNameToStore= $filename.'_'.time().'.'.$extension;
              //Upload image
              $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else{
            $fileNameToStore = 'noimage.jpg';
        }
       
        //Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->method_id = $request->input('methods');
        //$post->method()->associate(Methods::find($request->input('methods')));
        $post->consist_id =  $request->input('consists');
        $post->save();

        return redirect ('/posts')->with('success', 'Post Created');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find ($id);
        return view ('posts.show')->with ('post', $post);
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::find ($id);

        //Check for correct user
         if(auth()->user()->id !==$post->user_id){
            return redirect ('/posts')->with ('error', 'Unauthorized Page');
         }
        return view ('posts.edit')->with ('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate ($request , [
            'title' => 'required',
            'body' => 'required'
        ]);
       //Handle file upload
       if($request->hasFile('cover_image')){
        //Get file name with  the extension
      $fileNameWithExt = $request->file('cover_image')->GetClientOriginalName(); 
      //Get just filename
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      //Get just ext
      $extension = $request->file('cover_image')->getClientOriginalExtension();
     //Filename to store
      $fileNameToStore= $filename.'_'.time().'.'.$extension;
      //Upload image
      $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
} 
        //Create Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect ('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $post = Post::find($id);
        //Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect ('/posts')->with ('error', 'Unauthorized Page');
         }
         if($post->cover_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
         }
        $post->delete();
        return redirect ('/posts')->with('success', 'Post Removed');
    }
}
