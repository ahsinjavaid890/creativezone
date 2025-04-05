<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\testimonial;
use App\Models\testimonial_cat;
use App\Models\video;
use Mail;
use Auth;
use DB;

class TestmonialController extends Controller
{
    public function alltestimonials()
    {
        $data = testimonial::paginate(10);
        return view('admin.testimonials.alltestimonials', compact('data'));
    }
    public function addnewtestimonials(Request $request)
    {
        $add = new testimonial();
        $add->name = $request->name;
        $add->occupation = $request->occupation;
        $add->testimonial = $request->testimonial;
        $add->status = 1;
        $add->image = Cmf::sendimagetodirectory($request->image);
        $add->save();
        return redirect()->back()->with('message', 'Testimonial Added Successfully');
    }
    public function updattestimonial(Request $request)
    {
        $add = testimonial::find($request->id);
        $add->name = $request->name;
        $add->occupation = $request->occupation;
        $add->testimonial = $request->testimonial;
        if ($request->image) {
            $add->image = Cmf::sendimagetodirectory($request->image);
        }
        $add->save();
        return redirect()->back()->with('message', 'Testimonial Updated Successfully');
    }
    public function deletetestimonial($id)
    {
        testimonial::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Testimonial Deleted Successfully');
    }
    public function changetestimonialstatus($id)
    {
        $updateincategory  = testimonial::findOrFail($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Status Updated Successfully'); 
    }
}
