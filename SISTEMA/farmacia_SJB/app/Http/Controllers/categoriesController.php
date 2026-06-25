<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class categoriesController extends Controller
{
   public function index()
{
    $categories = \App\Models\Category::all();

    return view('categories.index', compact('categories'));
}

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}