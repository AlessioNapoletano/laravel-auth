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
        'title' => ['required', 'string', 'min:2', 'max:200'],
        'content' => ['required', 'string', 'min:2'],
        'post_date' => ['required']
     ];

     /**
     * error messages in case of negative validation
     * messaggi d'errore in caso di validazione negativa
     */ 
     protected $messages = 
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
    public function create(Post $post)
    {
        return view('admin.posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $dataValidate = $request->validate($this->rules, $this->messages);
        
        $dataValidate['author'] = Auth::user()->name;
        $dataValidate['slug'] = Str::slug($dataValidate['title']);
        $newPost = new Post();
        $newPost->fill($dataValidate);
        $newPost->save();

        return redirect()->route('admin.posts.index')->with('message', "Il post $newPost->title è stato creato con successo")->with('message-class', 'success');
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
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $dataValidate = $request->validate($this->rules, $this->messages);
        $post->update($dataValidate);
        
        return redirect()->route('admin.posts.show', $post->id)->with('message', "'Record $post->title è stato modificato con successo")->with('message-class', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', "'Record $post->title è stato eliminato definitivamente dall'archivio")->with('message-class', 'danger');
    }

    public function forceDelete($id) {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('admin.posts.index')->with('message', "Record $post->title è stato eliminato definitivamente dall'archivio")->with('message-class', 'danger');
    }

    /**
     * trashed method for records deleted but not permanently
     * metodo trashed per record eliminati ma non definitivamente
     */
    public function trashed() {
        $postsTrashed = Post::onlyTrashed()->get();
        return view('admin.posts.trashed', compact('postsTrashed'));
    }

    /**
     * restore method to recover trashed records
     * Metodo restore per recuperare record trashed
     */
    public function restore($id) {
        Post::where('id', $id)->withTrashed()->restore();
        return redirect()->route('admin.posts.index')->with('message', "'Record è stato ripristinato con successo dal cestino")->with('message-class', 'primary');;
    }

    /**
     * restoreAll method to recover all trashed records
     * Metodo restoreAll per recuperare Tutti i record trashed
     */
    public function restoreAll() {
        Post::withTrashed()->restore();
        return redirect()->route('admin.posts.index')->with('message', 'Tutti i post sono stati ripristinati dal cestino')->with('message-class', 'success');;

    }
}
