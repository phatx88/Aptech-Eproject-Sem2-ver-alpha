<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryBlog;
use App\Models\Tag;
use Session;
use DB;

class Admin_CategoryBlogController extends Controller
{
    public function add_category_blog_by_input(Request $request){
        $data = $request->all();
        $cate_blog = CategoryBlog::where('category_bname', $data['categoryInputBlog'])->first();
        $output = '';
        if($cate_blog){
            $output .= 'New Category is duplicated';
        }else{
            $new_cate_blog = new CategoryBlog();
            $new_cate_blog->category_bname = $data['categoryInputBlog'];
            $new_cate_blog->save();
            $output .= 'Insert new Category Blog Successfully';
        }
        echo $output;
    }

    public function show_list_category_blog(Request $request){
        $cate_blog_list = CategoryBlog::all();
        $output = '';
        $output .= '<option value="">-- Select Category --</option>';
        foreach($cate_blog_list as $key => $cate){
            $output .= '
                <option value="'.$cate->id.'" >'.$cate->category_bname.'</option>
            ';
        }
        echo $output;
    }

    public function add_to_tag_blog_by_input(Request $request){
        $data = $request->all();
        $tag = Tag::where('tag_name', $data['tagInput'])->first();
        $output = '';
        if($tag){
            $output .= 'New Tag is duplicated';
        }else{
            $new_tag_blog = new Tag();
            $new_tag_blog->tag_name = $data['tagInput'];
            $new_tag_blog->save();
            $output .= 'Insert new Tag Successfully';
        }
        echo $output;
    }

    public function show_list_tag_blog(Request $request){
        $tag_list = Tag::all();
        $output = '';
        $output .= '<option value="">-- Select Tag --</option>';
        foreach($tag_list as $key => $tag){
            $output .= '
                <option value="'.$tag->id.'" >'.$tag->tag_name.'</option>
            ';
        }
        echo $output;
    }

    public function add_tag(Request $request){
        $data = $request->all();
        $tag = Tag::where('id', $data['id'])->first();
        $sesion_tags = session()->get('tags');
        $output = '';
        if($sesion_tags != null){
            $count = 0;
            foreach($sesion_tags as $key => $val){
                if($val['id'] == $tag->id){
                    $count++;
                }
            }
            if($count == 0){
                $sesion_tags[] = [
                    'id' => $tag->id,
                    'tag_name' => $tag->tag_name
                ];
                $output .= '<li class="list-group-item"># '.$tag->tag_name.'</li>';
            }
        }else{
            $sesion_tags[] = [
                'id' => $tag->id,
                'tag_name' => $tag->tag_name
            ];
            $output .= '<option class="list-group-item" value="'.$tag->id.'"  ># '.$tag->tag_name.'</option>';
        }
        session()->put('tags', $sesion_tags);
        session()->save();


        echo $output;
    }
}
