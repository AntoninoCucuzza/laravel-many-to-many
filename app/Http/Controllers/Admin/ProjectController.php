<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(10);

        $trashedProjects = Project::onlyTrashed()->get();

        return view('admin.projects.index', compact('projects', 'trashedProjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->title, '-');

        $val_data['project_link'] = $request->project_link;

        $val_data['github_link'] = $request->github_link;


        if ($request->has('thumb')) {
            $path = Storage::put('project_thumb', $request->thumb);

            $val_data['thumb'] = $path;
        }
        $project =  Project::create($val_data);
        $project->technologies()->attach($request->technologies);
        return to_route('admin.projects.index')->with('message', 'Progetto creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->title, '-');

        $val_data['project_link'] = $request->project_link;

        $val_data['github_link'] = $request->github_link;


        if ($request->has('thumb')) {

            if ($project->thumb) {
                Storage::delete($project->thumb);
            }
            $newThumb = $request->thumb;
            $path = Storage::put('project_thumb', $newThumb);
            $data['thumb'] = $path;
        }

        $project->update($val_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($val_data['technologies']);
        }

        return to_route('admin.projects.show', $project)->with('message', 'Progetto aggiornato!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if ($project->thumb) {
            Storage::delete($project->thumb);
        }

        $project->delete();

        return to_route('admin.projects.index')->with('message', 'Progetto cestinato!');
    }

    public function trashed()
    {
        $trashedProjects = Project::onlyTrashed()->get();

        return view('admin.projects.trashed', compact('trashedProjects'));
    }

    public function restore($id)
    {
        $restoredProject = Project::withTrashed()->find($id);
        $restoredProject->restore();

        /*      if ($restoredProject->count() == 0) {
            return redirect()->route('admin.projects.index')->with('message', 'Progetto ripristinato!');
        } */
        return redirect()->route('admin.trashed')->with('message', 'Progetto ripristinato!');
    }


    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->find($id);

        if ($project->technologies) {
            $project->technologies()->detach();
        }

        $project->forceDelete();

        return redirect()->route('admin.trashed')->with('message', 'Progetto eliminato definitivamente!');
    }
}
