<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Technologies = Technology::orderByDesc('id')->paginate(10);

        return view('admin.technologies.index',  compact('Technologies'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create',);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->name, '-');

        $Technology = Technology::create($val_data);

        return to_route('admin.technologies.index')->with('message', 'Technologies creato con successo!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Technology $Technology)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $Technology)
    {
        return view('admin.technologies.edit', compact('Technology'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $Technology)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->name, '-');

        $Technology->update($val_data);

        return to_route('admin.technologies.index', $Technology)->with('message', 'technology aggiornato!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $Technology)
    {

        $projects = Project::withTrashed();

        foreach ($projects as $project) {
            if ($project->technologies) {
                $project->technologies()->detach($Technology->id);
            }
        }

        $Technology->delete();

        return to_route('admin.technologies.index')->with('message', 'technology eliminato!');
    }
}
