<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\photocategories;
use App\Models\photos;
use Mail;
use Auth;
use DB;


class PhotoController extends Controller
{
    public function photocategories()
    {
        $data = DB::table('photocategories')->get();
        return view('admin.photo.categorie')->with(array('data' => $data));
    }
    public function addnewphotocategory(Request $request)
    {
        $saveblog = new photocategories;
        $saveblog->name = $request->name;
        $saveblog->categorie_description = $request->categorie_description;
        $saveblog->status = 1;
        $saveblog->save();
        return redirect()->back()->with('message', 'Photo Category Successfully Inserted');
    }
    public function updatphotocategory(Request $request)
    {
        $saveblog = photocategories::find($request->id);
        $saveblog->name = $request->name;
        $saveblog->categorie_description = $request->categorie_description;
        $saveblog->status = $request->status;
        $saveblog->save();
        return redirect()->back()->with('message', 'Photo Category Updated Successfully');
    }
    public function deletephotocategory($id)
    {
        photos::where('category_id', $id)->delete();
        photocategories::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Photo Category Deleted Successfully');
    }
    public function allphotos()
    {
        $data = photos::paginate(10); // Pagination
        $categories = photocategories::paginate(10); // Pagination
        return view('admin.photo.allphotos', compact('data', 'categories'));
    }
    public function addnewphoto(Request $request)
    {
        $add = new photos();
        $add->category_id = $request->category_id;
        $add->name = $request->name;
        $add->description = $request->description;
        $add->photo = Cmf::sendimagetodirectory($request->photo);
        $add->status = 1;
        $add->save();
        return redirect()->back()->with('message', 'Photo Added Successfully');
    }
    public function updatphoto(Request $request)
    {
        $add = photos::find($request->id);
        $add->category_id = $request->category_id;
        $add->name = $request->name;
        $add->description = $request->description;
        if ($request->photo) {
            $add->photo = Cmf::sendimagetodirectory($request->photo);
        }
        $add->save();
        return redirect()->back()->with('message', 'Photo Updated Successfully');
    }
    public function deletephoto($id)
    {
        photos::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Photo Deleted Successfully');
    }
}
