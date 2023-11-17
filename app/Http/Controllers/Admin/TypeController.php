<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderByDesc('id')->paginate(10);

        return view('admin.types.index', compact('types'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create',);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->name, '-');

        $Type = Type::create($val_data);

        return to_route('admin.types.index')->with('message', 'type creato con successo!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Type $Type)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $Type)
    {
        return view('admin.types.edit', compact('Type'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $Type)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->name, '-');

        $Type->update($val_data);

        return to_route('admin.types.index', $Type)->with('message', 'type aggiornato!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $Type)
    {
        $projects = Project::withTrashed()->has('type')->get();
        foreach ($projects as $project) {
            if ($project->type->id == $Type->id) {
                $project->type()->dissociate();
                $project->save();
            }
        }

        $Type->delete();

        return to_route('admin.types.index')->with('message', 'type eliminato!');
    }
}
