<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\CategoryBlog;
use App\Models\PostComment;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use File;
use Illuminate\Database\QueryException;

class Admin_BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (!Gate::allows("view-post")) {
            abort(403);
        }
        $posts = Post::all();
        return view('admin.blog.list',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows("create-post")) {
            abort(403);
        }
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
        if (!Gate::allows("create-post")) {
            abort(403);
        }
        $imageName = '';
        if ($request->file('image')) {
            // $file = $request->file('featured_image');
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            //move file to folder
            $file->move(public_path('backend\images\blogs'), $imageName);
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
            $post->slug = $slug_blog;
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
            $post->slug = $slug_blog;
            $post->featured_image = $imageName;
            $post->save();

            $post_id = $post->id;
            // $tag = $data['tag_id'];
                $post_tag = new PostTag();
                $post_tag->postId = $post_id;
                $post_tag->tagId = $tag_id;
                $post_tag->save();
        }
        return redirect()->back()->with('message', 'Create Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows("update-post")) {
            abort(403);
        }
        $post = Post::where('id', $id)->first();
        $post_tag = PostTag::where('postId', $post->id)->get();
        $tag = session()->get('tags');
        if(isset($tag)){
           unset($tag);
        }
        foreach($post_tag as $key => $value){
            $tag[] = [
                'id' => $value->tagId,
                'tag_name' => $value->tag->tag_name
            ];
        }
        session()->put('tags', $tag);
        session()->save();
        return view('admin.blog.edit',[
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Blog $blog)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Post $blog)
    {
        if (!Gate::allows("update-post")) {
            abort(403);
        }
        // $postOld = Post::where('id', $blog->id)->first();
        // $id = $postOld->id;
        if ($request->file('image')) {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            //move file to folder
            //delete old pic
            if ($blog->featured_image != $imageName) {
                $oldFile = public_path('backend\images\blogs\\'.$blog->featured_image);
                File::delete($oldFile);
                $file->move(public_path('backend\images\blogs'), $imageName);
            }
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = $request->all();
        $blog_title = $data['blog_title'];
        $summary_blog = $data['summary_blog'];
        $slug_blog = $data['slug_blog'];
        $category_id = $data['category_id'];
        $blog_content = $data['blog_content'];
        $blog_meta_title = $data['blog_meta_title'];
        $user = Auth::user();
        $blog_tag = session()->get('tags');
        if($blog_tag != null){
            $post = Post::where('id', $blog->id)->update([
                'categoryId' => $category_id,
                'title' => $blog_title,
                'metaTitle' => $blog_meta_title,
                'summary' => $summary_blog,
                'content' => $blog_content,
                'slug' => $slug_blog,
                'featured_image' => $imageName,
                'updatedAt' => now()
            ]);

            PostTag::where('postId',$blog->id)->delete();
            foreach($blog_tag as $key => $tag){
                $post_tag = new PostTag();
                $post_tag->postId = $blog->id;
                $post_tag->tagId = $tag['id'];
                $post_tag->save();
            }
        }else{
            $post = Post::where('id', $blog->id)->update([
                'categoryId' => $category_id,
                'title' => $blog_title,
                'metaTitle' => $blog_meta_title,
                'summary' => $summary_blog,
                'content' => $blog_content,
                'slug' => $slug_blog,
                'featured_image' => $imageName,
                'updatedAt' => now()
            ]);
            PostTag::where('postId', $blog->id)->delete();
            $tag_id = $data['tags_id'];
                $post_tag = new PostTag();
                $post_tag->postId = $blog->id;
                $post_tag->tagId = $tag_id;
                $post_tag->save();
        }

        return redirect()->route('admin.blog.index')->with('message', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // SOFT DELETE
         if (!Gate::allows("delete-post")) {
            abort(403);
        } 
         try {
            $post = Post::where('id', $id)->first();
            $msg = 'Deleted Post - ID : '.$post->id.' Successfully - <a href="'. url('admin/blog/restore/'.$post->id.'') . '"> Undo Action</a>';
            $post->delete();
            request()->session()->put('success', $msg);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->back();
    }

    public function forceDelete($id)
    {
         // HARD DELETE 
         if (!Gate::allows("force_delete-post")) {
            abort(403);
        } 
         try {
            $post = Post::onlyTrashed()->find($id);
            $msg = 'Pernamently Deleted Post - ID : '.$post->id.' From Record';
            $post->forceDelete();
            request()->session()->put('success', $msg);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->back();
    }

    public function delete($id){
        PostTag::where('postId', $id)->delete();
        Post::where('id', $id)->delete();
        PostComment::where('postId', $id)->delete();

        return redirect()->back()->with('message', 'Delete Successfully');

    }
    public function published_blog($id){
        if (!Gate::allows("update-post")) {
            abort(403);
        } 
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        Post::where('id', $id)->update([
            'published' => 1,
            'publishedAt' => now(),
            'hidden' => 1
        ]);
        return redirect()->back()->with('message', 'Pusblished Successfully');
    }

    public function hidden($id){
        if (!Gate::allows("update-post")) {
            abort(403);
        } 
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        Post::where('id', $id)->update([
            'updatedAt' => now(),
            'hidden' => 0
        ]);
        return redirect()->back()->with('message', 'Unactive Successfully');
    }

    public function unhidden($id){
        if (!Gate::allows("update-post")) {
            abort(403);
        } 
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        Post::where('id', $id)->update([
            'updatedAt' => now(),
            'hidden' => 1
        ]);
        return redirect()->back()->with('message', 'Active Successfully');
    }

    public function showTrash()
    {
        if (!Gate::allows("restore-post")) {
            abort(403);
        } 
        $posts = Post::onlyTrashed()->get();
        return view('admin.blog.trash', [
            'posts' => $posts,
            ]);
    }

    public function restore($id)
    {
        if (!Gate::allows("restore-post")) {
            abort(403);
        } 
        Post::onlyTrashed()->where('id' , $id)->restore();
        $post = Post::find($id);
        $msg = 'Deleted Post Id : '.$post->id.' Successfully';
        request()->session()->put('success', $msg);
        return redirect()->back();
    }
}
