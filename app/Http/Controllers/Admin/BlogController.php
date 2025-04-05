<?php

namespace App\Http\Controllers\Admin;
use App\Models\blogs;
use App\Models\blogcategories;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Auth;
use DB;
class BlogController extends Controller
{
    public function blogcategories()
    {
        $data = DB::table('blogcategories')->where('website', env('APP_NAME'))->get();
        return view('admin.blogs.categories')->with(array('data' => $data));
    }
    public function deleteblogcategory($id)
    {
        blogs::where('category_id', $id)->delete();
        blogcategories::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Blog Category Deleted Successfully');
    }
    public function allblogs()
    {
        $data = DB::table('blogs')->get();
        $categories = blogcategories::where('website', 'jiowireless')->get();
        return view('admin.blogs.addblog')->with(array('data' => $data, 'categories' => $categories));
    }
    public function addnewblogcategory(Request $request)
    {
        $saveblog = new blogcategories;
        $saveblog->name = $request->name;
        $saveblog->status = 1;
        $saveblog->url = Cmf::shorten_url($request->name);
        $saveblog->website = env('APP_NAME');
        $saveblog->save();
        return redirect()->back()->with('message', 'Blog Category Successfully Inserted');
    }
    public function updatblogcategory(Request $request)
    {
        $saveblog = blogcategories::find($request->id);
        $saveblog->name = $request->name;
        $saveblog->status = $request->status;
        $saveblog->url = Cmf::shorten_url($request->name);
        $saveblog->website = env('APP_NAME');
        $saveblog->save();
        return redirect()->back()->with('message', 'Blog Category Updated Successfully');
    }
    public function createblog(Request $request)
    {
        $add = new blogs();
        $add->website = env('APP_NAME');
        $add->category_id = $request->category_id;
        $add->title = $request->title;
        $add->url = Cmf::shorten_url($request->title);
        $add->content = $request->content;
        $add->image = Cmf::sendimagetodirectory($request->image);
        $add->save();
        return redirect()->back()->with('message', 'Blog Added Successfully');
    }
    public function updateblog(Request $request)
    {
        $add = blogs::find($request->id);
        $add->category_id = $request->category_id;
        $add->title = $request->title;
        $add->url = Cmf::shorten_url($request->title);
        $add->content = $request->content;
        if ($request->image) {
            $add->image = Cmf::sendimagetodirectory($request->image);
        }
        $add->save();
        return redirect()->back()->with('message', 'Blog Updated Successfully');
    }
    public function deleteblog($id)
    {
        blogs::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Blog Deleted Successfully');
    }
}
