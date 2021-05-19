<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

class Admin_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows("view-product")) {
            abort(403);
        }
        $categories = Category::get();
        return view('admin.category.list',[
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows("create-product")) {
            abort(403);
        }      
        $request->validate([
            'name' => 'required|unique:category|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->action([Admin_CategoryController::class,'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('admin.category.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (!Gate::allows("update-product")) {
            abort(403);
        }      
        $request->validate([
            'name' => 'required|unique:category|max:255',
        ]);

        $category->name = $request->name;
        $category->save();
        return redirect()->action([Admin_CategoryController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (!Gate::allows("delete-product")) {
            abort(403);
        }

        try {
            $category->forceDelete();
            request()->session()->put('success', "Deleted Category : {$category->id} - {$category->name} Successfully");
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->back();
    }
}
