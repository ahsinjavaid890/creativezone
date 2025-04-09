<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Models\blogs;
use App\Models\categories;
use App\Models\artist;
use App\Models\events;
use App\Models\event_social;
use App\Models\event_tags;
use App\Models\blogcategories;
use App\Models\notifications;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use  Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard/index');
    }
    public function allusers()
    {
        $data = User::all();
        return view('admin.users.allusers')->with(array('data' => $data));
    }
    public function viewuser($id)
    {
        $data = User::find($id);
        return view('admin.users.viewuser')->with(array('data' => $data));
    }
    public function messages()
    {
        $data = DB::table('contactuses')->orderby('created_at', 'desc')->paginate(10);
        return view('admin/contact/messages')->with(array('data' => $data));
    }
    public function viewmessage($id)
    {
        $data = DB::table('contactuses')->where('id', $id)->first();
        return view('admin/contact/viewmessage')->with(array('data' => $data));
    }
    public function deletemessage($id)
    {
        DB::table('contactuses')->where('id', $id)->delete();
        return redirect()->back()->with('message', 'Message Deleted Successfully');
    }
    public function profile()
    {
        return view('admin/profile/index');
    }

    public function updateusers(Request $request)
    {
        $update = User::find($request->id);
        $update->name = $request->name;
        if ($request->insurancedocument) {

            $update->insurancedocument = Cmf::sendimagetodirectory($request->insurancedocument);
        }
        $update->email = $request->email;
        $update->phone = $request->phone;
        $update->about_me = $request->about_me;
        if ($request->password) {

            $update->password = Hash::make($request->password);
        }
        $update->address = $request->address;
        $update->province = $request->province;
        $update->city = $request->city;
        $update->country = $request->country;
        $update->postal = $request->postal;
        $update->status = $request->status;
        $update->save();
        return redirect()->back()->with('message', 'Agent Updated Successfully');
    }
    public function addnewusers(Request $request)
    {
        $update = new User;
        $update->website = $request->website;
        $update->name = $request->name;
        $update->email = $request->email;
        $update->phone = $request->phone;
        $update->about_me = $request->about_me;
        if ($request->password) {

            $update->password = Hash::make($request->password);
        }
        $update->address = $request->address;
        $update->province = $request->province;
        $update->city = $request->city;
        $update->country = $request->country;
        $update->postal = $request->postal;
        $update->status = 'active';
        $update->type = 'agent';
        $update->save();
        return redirect()->back()->with('message', 'Agent Added Successfully');
    }
    public function updateuserprofile(Request $request)
    {
        $update = User::find(Auth::user()->id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->phonenumber = $request->phonenumber;
        $update->about_me = $request->about;
        if ($request->profileimage) {
            $update->profileimage = Cmf::sendimagetodirectory($request->profileimage);
        }
        $update->save();
        return redirect()->back()->with('message', 'Your Profile Updated Successfully');
    }
    public function updateusersecurity(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required',
        ]);
        if ($request->newpassword == $request->password_confirmed) {
            $hashedPassword = Auth::user()->password;
            if (\Hash::check($request->oldpassword, $hashedPassword)) {
                if (!\Hash::check($request->newpassword, $hashedPassword)) {
                    $users = User::find(Auth::user()->id);
                    $users->password = bcrypt($request->newpassword);
                    User::where('id', Auth::user()->id)->update(array('password' =>  $users->password));
                    session()->flash('message', 'password updated successfully');
                    return redirect()->back();
                } else {
                    session()->flash('errorsecurity', 'New password can not be the old password!');
                    return redirect()->back();
                }
            } else {
                session()->flash('errorsecurity', 'Old password Doesnt matched ');
                return redirect()->back();
            }
        } else {
            session()->flash('errorsecurity', 'Repeat password Doesnt matched With New Password');
            return redirect()->back();
        }
    }
    public function websitesettings()
    {
        return view('admin.website.settings');
    }
    public function allcategories()
    {
        $data = DB::table('categories')->get();
        return view('admin.categories.allcategories')->with(array('data' => $data));
    }
    public function addnewcategory(Request $request)
    {
        $add =  new categories();
        $add->icon = Cmf::sendimagetodirectory($request->icon);
        $add->name = $request->name;
        $add->status = $request->status;
        $add->save();
        return redirect()->back()->with('message' , 'Category Added Successfully');
    }
    public function updatecategory(Request $request)
    {
        $add = categories::find($request->id);
        
        if ($request->hasFile('icon')) {
            $add->icon = Cmf::sendimagetodirectory($request->file('icon'));
        }

        $add->name = $request->name;
        $add->status = $request->status;
        $add->save();

        return redirect()->back()->with('message', 'Category Updated Successfully');
    }

    public function deletecategory($id)
    {
        DB::table('categories')->where('id' , $id)->delete();
        return redirect()->back()->with('message' , 'Category Deleted Successfully');
    }
    public function alltags()
    {
        $data = event_tags::get();
        return view('admin.categories.alltags')->with(array('data' => $data));
    }
    public function addnewtag(Request $request)
    {
        $add =  new event_tags();
        $add->name = $request->name;
        $add->status = $request->status;
        $add->save();
        return redirect()->back()->with('message' , 'Tag Added Successfully');
    }
    public function updatetag(Request $request)
    {
        $add = event_tags::find($request->id);
        $add->name = $request->name;
        $add->status = $request->status;
        $add->save();

        return redirect()->back()->with('message', 'Tag Updated Successfully');
    }
    public function deletetag($id)
    {
        event_tags::where('id' , $id)->delete();
        return redirect()->back()->with('message' , 'Tag Deleted Successfully');
    }
    public function pendingartist()
    {
        $data = artist::where('status' , '0')->get();
        return view('admin.artist.pendingartist')->with(array('data' => $data));
    }
    public function approvedartist()
    {
        $data = artist::where('status' , '1')->get();
        return view('admin.artist.approvedartist')->with(array('data' => $data));
    }
    public function rejectartist()
    {
        $data = artist::where('status' , '2')->get();
        return view('admin.artist.rejectartist')->with(array('data' => $data));
    }
    public function newjob()
    {
        return view('admin.jobs.newjobs');
    }
    // public function addnewjob(Request $request)
    // {

    // }
    public function ongoingjob()
    {
        return view('admin.jobs.ongoingjob');
    }
    public function completejobs()
    {
        return view('admin.jobs.completejobs');
    }
    public function editartist($id)
    {
        $data = artist::where('id' , $id)->first();
        return view('admin.artist.editartist')->with(array('data' => $data));
    }
    public function changeartiststatus($id)
    {
        $updateincategory  = artist::findOrFail($id);
        if($updateincategory->status == '0')
        {
            $updateincategory->status = '1';
        }else{
            $updateincategory->status = '0';
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Status Updated Successfully'); 
    }
    public function deleteartist($id)
    {
        artist::where('id' , $id)->delete();
        return redirect()->back()->with('message' , 'Artist Deleted Successfully');
    }
    public function allevents()
    {
        $data = events::get();
        return view('admin.events.allevents')->with(array('data' => $data));
    }
    public function createnewevent()
    {
        return view('admin.events.addevent');
    }
    public function addevent(Request $request)
    {
        // Save the event
        $add = new events();
        $add->name = $request->name;
        $add->category_id = $request->category_id;
        $add->image = Cmf::sendimagetodirectory($request->file('image')) ?? null; // Ensure it returns a string
        $add->location_type = $request->location_type;

        if ($request->location_type == 'Virtual') {
            $add->address = $request->address;
        } else {
            $add->location_name = $request->location_name;
            $add->location_address = $request->location_address;
        }

        $add->start_date = $request->start_date;
        $add->start_time = $request->start_time;
        $add->end_date = $request->end_date;
        $add->end_time = $request->end_time;
        // $add->time_zone = $request->time_zone;
        $add->description = $request->description;
        $add->video = Cmf::sendimagetodirectory($request->file('video')) ?? null; // Ensure it's a string
        $add->website_url = is_array($request->website_url) ? implode(',', $request->website_url) : $request->website_url;
        $add->facebook_url = is_array($request->facebook_url) ? implode(',', $request->facebook_url) : $request->facebook_url;
        $add->instagram_url = is_array($request->instagram_url) ? implode(',', $request->instagram_url) : $request->instagram_url;
        $add->youtube_url = is_array($request->youtube_url) ? implode(',', $request->youtube_url) : $request->youtube_url;
        $add->tags = is_array($request->tags) ? implode(',', $request->tags) : $request->tags;
        $add->status = 'Published';
        $add->save();

        return redirect()->back()->with('message', 'Event successfully added.');

    }
}
