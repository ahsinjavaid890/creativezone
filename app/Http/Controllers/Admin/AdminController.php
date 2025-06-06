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
use App\Models\upcoming_events;
use App\Models\event_applications;
use App\Models\invest_request;
use App\Models\plans;
use App\Mail\GeneralEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use  Illuminate\Support\Facades\Redirect;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;

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
        $add->time_zone = $request->time_zone;
        $add->description = $request->description;
        if ($request->video){
        $add->video = Cmf::sendimagetodirectory($request->file('video')) ?? null; // Ensure it's a string
        }
        $add->website_url = is_array($request->website_url) ? implode(',', $request->website_url) : $request->website_url;
        $add->facebook_url = is_array($request->facebook_url) ? implode(',', $request->facebook_url) : $request->facebook_url;
        $add->instagram_url = is_array($request->instagram_url) ? implode(',', $request->instagram_url) : $request->instagram_url;
        $add->youtube_url = is_array($request->youtube_url) ? implode(',', $request->youtube_url) : $request->youtube_url;
        $add->tags = is_array($request->tags) ? implode(',', $request->tags) : $request->tags;
        $add->status = 'Published';
        $add->save();

        return redirect()->back()->with('message', 'Event successfully added.');

    }
    public function upcomingevents()
    {
        $upcoming = upcoming_events::pluck('event_id')->toArray();
        $data = events::whereIn('id', $upcoming)->get();
        return view('admin.events.upcoming', compact('data', 'upcoming'));
    }

    public function addupcomingevents(Request $request)
    {
        // Get all selected event IDs from the form
        $selectedEventIds = $request->input('events_id', []); // Will return [] if nothing selected

        // Get all current event IDs from the DB
        $existingEventIds = upcoming_events::pluck('event_id')->toArray();

        // Find event IDs to delete (unselected)
        $toDelete = array_diff($existingEventIds, $selectedEventIds);

        // Find event IDs to insert (newly selected)
        $toInsert = array_diff($selectedEventIds, $existingEventIds);

        // Delete unselected ones
        if (!empty($toDelete)) {
            upcoming_events::whereIn('event_id', $toDelete)->delete();
        }

        // Insert new ones
        foreach ($toInsert as $eventId) {
            if ($eventId) {
                $event = new upcoming_events();
                $event->event_id = $eventId;
                $event->status = 1;
                $event->save();
            }
        }

        return redirect()->back()->with('message', 'Upcoming events updated successfully.');
    }
    public function eventapplications()
    {
        $data = event_applications::get();
        return view('admin.events.eventapplications')->with(array('data' => $data));
    }
    public function changeapplicationstatus($id)
    {
        $updateincategory  = event_applications::findOrFail($id);
        if($updateincategory->status == '2')
        {
            $updateincategory->status = '1';
        }else{
            $updateincategory->status = '2';
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Status Updated Successfully'); 
    }
    public function rejecteventapplication($id)
    {
        $updateincategory  = event_applications::findOrFail($id);
        $updateincategory->status = 3;
        $updateincategory->save();
        $subject = 'Event Application Rejected';
        $body = "New application received:\n\n"
            . "Name: {$updateincategory->name}\n"
            . "Phone: {$updateincategory->phone}\n"
            . "Email: {$updateincategory->email}\n"
            . "Message: {$updateincategory->message}";
        Mail::to($updateincategory->email)->send(new GeneralEmail(
            'Thank you for Event Application',
            "Dear {$updateincategory->name},\n\nThank you for your Send Event Application for our event.\n\nAfter careful consideration, we regret to inform you that your application has not been approved at this time. We appreciate your interest and hope to collaborate with you in the future.\n\n- CreativeZone Team"
        ));
        return redirect()->back()->with('message', 'Event Application Rejected Successfully'); 
    }
    public function Investmentrequests()
    {
        $data = invest_request::get();
        return view('admin.events.investmentrequests')->with(array('data' => $data));
    }
    public function changerequeststatus($id)
    {
        $updateincategory  = invest_request::findOrFail($id);
        if($updateincategory->status == '2')
        {
            $updateincategory->status = '1';
        }else{
            $updateincategory->status = '2';
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Status Updated Successfully'); 
    }
    public function rejectinvestrequest($id)
    {
        $updateincategory  = invest_request::findOrFail($id);
        $updateincategory->status = 3;
        $updateincategory->save();
         // Email send after saving
        $subject = 'Investment Request Rejected';
        $body = "New application received:\n\n"
            . "Name: {$updateincategory->name}\n"
            . "Phone: {$updateincategory->phone}\n"
            . "Email: {$updateincategory->email}\n"
            . "Message: {$updateincategory->message}";
        Mail::to($updateincategory->email)->send(new GeneralEmail(
            'Thank you for Send Investment Request',
            "Dear {$updateincategory->name},\n\nThank you for your investment request for our event.\n\nAfter careful consideration, we regret to inform you that your request has not been approved at this time. We appreciate your interest and hope to collaborate with you in the future.\n\n- CreativeZone Team"
        ));
        return redirect()->back()->with('message', 'Event Investment Request Rejected Successfully'); 
    }
    public function allplans()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripePlans = $stripe->plans->all(['limit' => 10]);
        $stripePriceIds = collect($stripePlans->data)->pluck('id')->toArray();
        $localPlans = plans::whereIn('stripe_price_id', $stripePriceIds)->get();
        $data = $localPlans->map(function ($localPlan) use ($stripePlans) {
            $stripePlan = collect($stripePlans->data)->firstWhere('id', $localPlan->stripe_price_id);
            return [
                'local' => $localPlan,
                'stripe' => $stripePlan,
            ];
        });
        return view('admin.plans.allplans', compact('data'));
    }
    public function createnewplan()
    {
        return view('admin.plans.addplan');
    }
    public function addplan(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $plan = $stripe->plans->create([
          'amount' => $request->price * 100,
          'currency' => 'usd',
          'interval' => $request->billing_cycle,
          'product' => $product->id,
        ]);
        $localPlan = new plans();
        $localPlan->name = $request->name;
        $localPlan->slug = $request->slug;
        $localPlan->price = $request->price;
        $localPlan->billing_cycle = $request->billing_cycle;
        $localPlan->features = implode(',', $request->features);
        $localPlan->trial_days = $request->trial_days;
        $localPlan->currency = $plan->currency;
        $localPlan->max_event_listings = $request->max_event_listings;
        $localPlan->priority_support = $request->priority_support;
        $localPlan->description = $request->description;
        $localPlan->stripe_product_id = $product->id;
        $localPlan->stripe_price_id = $plan->id;
        $localPlan->is_active = 1;
        $localPlan->save();
        return redirect()->back()->with('message', 'Plan added successfully and synced with Stripe!');
    }
    public function editplan($id)
    {
        $plan = plans::findOrFail($id);
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripePlan = null;
        try {
            $stripePlan = $stripe->plans->retrieve($plan->stripe_price_id, []);
        } catch (\Exception $e) {
            $stripePlan = null;
        }
        return view('admin.plans.editplan', compact('plan', 'stripePlan'));
    }
    public function updateplan(Request $request)
    {
        $plan = plans::findOrFail($request->id);
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $newStripePrice = $stripe->plans->create([
          'amount' => $request->price * 100,
          'currency' => 'usd',
          'interval' => $request->billing_cycle,
          'product' => $plan->stripe_product_id,
        ]);
        $plan->name = $request->name;
        $plan->slug = $request->slug;
        $plan->price = $request->price;
        $plan->billing_cycle = $request->billing_cycle;
        $plan->features = implode(',', $request->features);
        $plan->trial_days = $request->trial_days;
        $plan->currency = $plan->currency;
        $plan->max_event_listings = $request->max_event_listings;
        $plan->priority_support = $request->priority_support;
        $plan->description = $request->description;
        $plan->stripe_price_id = $newStripePrice->id;
        $plan->save();
        return redirect()->back()->with('message', 'Stripe product updated and new price created successfully.');
    }
    public function deleteplan($id)
    {
        $plan = plans::findOrFail($id);
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $prices = $stripe->plans->all([
            'product' => $plan->stripe_product_id,
        ]);
        foreach ($prices->data as $price) {
            $stripe->plans->delete($price->id); 
        }
        $stripe->products->delete($plan->stripe_product_id);
        $plan->delete();
        return redirect()->back()->with('message', 'Plan deleted successfully from both Stripe and local database.');
    }

}
