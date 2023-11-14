<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
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
        $types = Type::orderByDesc('id')->get();

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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Type $Type)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $Type)
    {
    }
}
