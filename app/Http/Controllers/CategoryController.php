<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuCategory = 'active';
        $results = Category::all();

        return view('pages.categories.index_categories', compact('results', 'menuCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuCategory = 'active';

        return view('pages.categories.form_category', compact('menuCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name_category' => $request->name
        ]);

        return redirect()->back()->with(['success' => 'Category save successfully!']);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $menuCategory = 'active';
        $edit = Category::find($category->id);
        return view('pages.categories.form_edit', compact('edit', 'menuCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $db = Category::find($category->id);

        $db->name_category = $request->name;

        $db->update();

        return redirect()->back()->with(['success' => 'Category update successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $db = Category::find($category->id);

        if($db){
            $db->delete();
            return redirect()->route('categories.index')->with(['success'=> 'Category success to delete']);
        }
        return redirect()->route('categories.index')->with(['failed'=> 'Category failed to delete']);
    }
}
