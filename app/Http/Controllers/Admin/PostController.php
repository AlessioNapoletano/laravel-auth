<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post as Post;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Str as Str;


class PostController extends Controller
{

    /**
     * Validation Rule
     * Regole di validazione
     */

     protected $rules = 
     [
        'title' => ['required', 'string', 'min:2', 'max:200', 'unique:title'],
        'content' => ['required', 'string', 'min:2'],
        'post_date' => ['required']
     ];

     /**
     * error messages in case of negative validation
     * messaggi d'errore in caso di validazione negativa
     */ 
     protected $message = 
     [
        'title.required' => 'E\' necessario inserire un titolo',
        'title.min' => 'Il titolo deve contenere almeno 2 caratteri',
        'title.max' => 'Il titolo può contenere al massimo 200 caratteri',
        'title.unique' => 'Crea un titolo con nome diverso, in quanto nell\' archivio esiste già questo titolo',

        'content.required' => 'E\' necessario inserire un contenuto',
        'content.min' => 'Il contenuto deve contenere almeno 2 caratteri',

        'post_date.required' => 'E\' necessario inserire la data di creazione del post'
     ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required|unique:posts',
                'post_date' => 'required',
                'content' => 'required',
            ],
            [

            ]
        );

        $data['author'] = Auth::user()->name;
        $data['slug'] = Str::slug($data['title']);
        $newPost = new Post();
        $newPost->fill($data);
        $newPost->save();

        return redirect()->route('admin.posts.index')->with('message', 'Il post è stato creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
