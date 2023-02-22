<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project as Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Str as Str;
use Illuminate\Support\Facades\DB;

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
        $projects = Project::paginate(15);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $dataValidate = $request->validate($this->rules, $this->messages);
        $project->update($dataValidate);
        
        return redirect()->route('admin.projects.show', $project->slug)->with('message', "'Record $project->title è stato modificato con successo")->with('message-class', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', "'Record $project->title è stato spostato nel cestino")->with('message-class', 'danger');
    }

     /**
     * forceDelete method for delete record permanenttly
     * Metodo forceDelete per eliminare definitivamente un record   
     */
    public function forceDelete(Project $project) {
        $project->forceDelete();

        return redirect()->route('admin.projects.index')->with('message', "Record $project->title è stato eliminato definitivamente dall'archivio")->with('message-class', 'danger');
    }

    /**
     * trashed method for records deleted but not permanently
     * metodo trashed per record eliminati ma non definitivamente
     */
    public function trashed() {
        $projectTrashed = Project::onlyTrashed()->get();
        return view('admin.projects.trashed', compact('projectTrashed'));
    }

    /**
     * restore method to recover trashed records
     * Metodo restore per recuperare record trashed
     */
    public function restore(Project $project) {
        $project->restore();
        return redirect()->route('admin.projects.index')->with('message', "'Record è stato ripristinato con successo dal cestino")->with('message-class', 'primary');;
    }

    /**
     * restoreAll method to recover all trashed records
     * Metodo restoreAll per recuperare Tutti i record trashed
     */
    public function restoreAll() {
        Project::withTrashed()->restore();
        return redirect()->route('admin.projects.index')->with('message', 'Tutti i post sono stati ripristinati dal cestino')->with('message-class', 'success');;

    }


}
