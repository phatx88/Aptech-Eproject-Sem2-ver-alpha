<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\CategoryBlog;
use DB;
use Illuminate\Support\Facades\Auth;
class Admin_BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sesion_tags = session()->get('tags');
        if($sesion_tags){
            session()->forget('tags');
        }
        return view('admin.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $imageName = $file->getClientOriginalName();

            //move file to folder
            $file->move(public_path('backend\images\blogs'), $imageName);
        }else {
            $imageName = 'product-image-placeholder.jpg';
        }
        $data = $request->all();
        $blog_title = $data['blog_title'];
        $summary_blog = $data['summary_blog'];
        $slug_blog = $data['slug_blog'];
        $category_id = $data['category_id'];
        $tag_id = $data['tags_id'];
        $blog_content = $data['blog_content'];
        $blog_meta_title = $data['blog_meta_title'];
        $user = Auth::user();
        $blog_tag = session()->get('tags');
        if($blog_tag != null){
            $post = new Post();
            $post->authorId = Auth::user()->id;
            $post->categoryId = $category_id;
            $post->title = $blog_title;
            $post->metaTitle = $blog_meta_title;
            $post->summary = $summary_blog;
            $post->content = $blog_content;
            $post->featured_image = $imageName;
            $post->save();

            $post_id = $post->id;
            foreach($blog_tag as $key => $tag){
                $post_tag = new PostTag();
                $post_tag->postId = $post_id;
                $post_tag->tagId = $tag['id'];
                $post_tag->save();
            }
        }else{
            $post = new Post();
            $post->authorId = Auth::user()->id;
            $post->categoryId = $category_id;
            $post->title = $blog_title;
            $post->metaTitle = $blog_meta_title;
            $post->summary = $summary_blog;
            $post->content = $blog_content;
            $post->featured_image = $imageName;
            $post->save();

            $post_id = $post->id;
            // $tag = $data['tag_id'];
                $post_tag = new PostTag();
                $post_tag->postId = $post_id;
                $post_tag->tagId = $tag_id;
                $post_tag->save();
        }
        return redirect()->back()->with('message', 'success');
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
    public function destroy($id)
    {
        //
    }
}
