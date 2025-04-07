<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Hash;
use App\Models\frequesntlyaskquestion;
use App\Models\pages;
use App\Models\frequesntlyaskquest_categorie;
use Mail;
use Auth;
class CmsController extends Controller
{
    public function faqcategories()
    {
        $data = frequesntlyaskquest_categorie::all();
        return view('admin.faq.categories')->with(array('data'=>$data));
    }
    public function addnewfaqcategory(Request $request)
    {
        $add = new frequesntlyaskquest_categorie();
        $add->name = $request->name;
        $add->status = 'Published';
        $add->save();
        return redirect()->back()->with('message', 'Category Added Successfully');
    }
    public function updatfaqcategory(Request $request)
    {
        $add = frequesntlyaskquest_categorie::find($request->id);
        $add->name = $request->name;
        if($request->icon)
        {
            $add->icon = Cmf::sendimagetodirectory($request->icon);
        }
        $add->status = $request->status;
        $add->save();
        return redirect()->back()->with('message', 'Category Updated Successfully');
    }
    public function deletefaqcategory($id)
    {
        frequesntlyaskquestion::where('category_id' , $id)->delete();
        frequesntlyaskquest_categorie::where('id' , $id)->delete();
        return redirect()->back()->with('warning', 'Category Deleted Successfully');
    }

    public function allfaq()
    {
        $data = frequesntlyaskquestion::orderby('category_id' , 'desc')->paginate(15);
        $categories = frequesntlyaskquest_categorie::all();
        return view('admin.faq.allfaq')->with(array('data'=>$data,'categories'=>$categories));
    }
    public function addnewfaq(Request $request)
    {
        $add = new frequesntlyaskquestion();
        $add->category_id = $request->category_id;
        $add->question = $request->question;
        $add->answer = $request->answer;
        $add->status = 1;
        $add->save();
        return redirect()->back()->with('message', 'FAQ Added Successfully');
    }
    public function updatfaq(Request $request)
    {
        $add = frequesntlyaskquestion::find($request->id);
        $add->category_id = $request->category_id;
        $add->question = $request->question;
        $add->answer = $request->answer;
        $add->save();
        return redirect()->back()->with('message', 'FAQ Updated Successfully');
    }
    public function deletefaq($id)
    {
        frequesntlyaskquestion::where('id' , $id)->delete();
        return redirect()->back()->with('warning', 'FAQ Deleted Successfully');
    }
    public function saveorder(Request $request)
    {
        $add = frequesntlyaskquestion::find($request->id);
        $add->order = $request->value;
        $add->save();
    }
}
