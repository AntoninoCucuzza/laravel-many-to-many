<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
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

        // $Technologies = Technology::orderByDesc('id')->paginate(10);

        return view('admin.technologies.index'/*,  compact('Technologies') */);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        //
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
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $Technology)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $Technology)
    {
        //
    }
}
