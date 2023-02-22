<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project as Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Str as Str;

class ProjectController extends Controller
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

        'post_date.required' => 'E\' necessario inserire la data di creazione del progetto'
     ];

    /**
     * index method for return view index page
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('admin.projects.create', compact('project'));
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
        $newProject = new Project();
        $newProject->fill($dataValidate);
        $newProject->save();

        return redirect()->route('admin.projects.index')->with('message', "Il post $newProject->title è stato creato con successo")->with('message-class', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }
}
