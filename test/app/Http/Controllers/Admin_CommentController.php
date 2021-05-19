<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

class Admin_CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (!Gate::allows("view-product")) {
            abort(403);
        }
        $comments = Comment::where('product_id', $id)->get();
        return view('admin.comment.list',[
            'comments' =>$comments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Comment $comment)
    {
        if (!Gate::allows("delete-product")) {
            abort(403);
        }
        try{
            $msg = 'Delete ID:'. $comment->id. ' comment successfully';
            $comment->delete();
            request()->session()->put('success', $msg);
        }catch(QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.comment.index");
    }

    public function delete(Request $request,Comment $comment, $id){
        if (!Gate::allows("delete-product")) {
            abort(403);
        }
        try{
            $msg = 'Delete ID:'. $comment->id. ' comment successfully';
            Comment::where('id', $id)->delete();
            request()->session()->put('success', $msg);
        }catch(QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->back();

    }
}
