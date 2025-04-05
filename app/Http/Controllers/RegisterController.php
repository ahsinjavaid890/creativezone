<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\Cmf;
use App\Models\companies;
use App\Models\artist;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeEmail;
use DB;
use Mail;
use Auth;
class RegisterController extends Controller
{
    public function checkemail(Request $request)
    {
        $checkemail = User::where('email' , $request->email)->count();
        return $checkemail;
    }
    public function checkcompanyname($id)
    {
        $checkemail = companies::where('company_name' , $id)->count();
        return $checkemail;
    }
    public function checkdotnumber($id)
    {
        $checkemail = User::where('dot_number' , $id)->count();
        return $checkemail;
    }
    public function carrierregister(Request $request)
    {
        $carrier = new User();
        $carrier->name = $request->name;
        $carrier->email = $request->email;
        $carrier->type = 'carrier';
        $carrier->password = Hash::make($request->password);
        $carrier->dot_number = $request->dot_number;
        $carrier->trucks_in_fleet = $request->trucks_in_fleet;
        $carrier->how_many_drivers_in_next = $request->how_many_drivers_in_next;
        $carrier->redirect = $request->redirect;
        $carrier->approved_status = 0;
        $carrier->save();
        $carrier->sendEmailVerificationNotification();
        $company = new companies();
        $company->user_id = $carrier->id;
        $company->email = $request->email;
        $company->company_name = $request->company_name;
        $company->company_link = Cmf::shorten_url($request->company_name);
        $company->save();
        $subject = 'Welcome To '.env('APP_NAME').' Your Request Submited Successfully';
        Mail::send('email.userrequest', ['name' => $request->name], function($message) use($request , $subject){
            $message->to($request->email);
            $message->subject($subject);
        });
        Auth::login($carrier);
        return redirect()->route('verification.notice')->with('email', $request->email);
    }
    public function register(Request $request)
    {
        // Validation
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => 'User',
            'status' => 'active',
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);
        Mail::to($user->email)->send(new WelcomeEmail($user));
        // Redirect after registration
        return redirect()->route('home')->with('success', 'Registration successful');
    }
    public function artistsignup(Request $request)
    {
        $this->validate($request, [
            'prefix' => 'required|in:Mr.,Mrs.,Ms.',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:artists,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $artist = new artist();
        $artist->prefix = $request->prefix;
        $artist->fname = $request->fname;
        $artist->lname = $request->lname;
        $artist->email = $request->email;
        $artist->password = Hash::make($request->password); // Password Hashing
        $artist->status = 0;
        $artist->save();
        Auth::guard('artist')->login($artist); 
        // ✅ Redirect to artist-process
        return redirect()->route('artistprocess')->with('success', 'Registration successful! Redirecting...');
    }
    public function artistprocess()
    {
        if (!Auth::guard('artist')->check()) {
        return redirect(url('login'))->with('error', 'Please login to access the dashboard.');
        }
        return view('auth.artistprocess');
    }
    public function completesignup(Request $request)
    {
           // Validate Input Fields
        $this->validate($request,[
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:artists,email,' . Auth::guard('artist')->id(),
            'mobile' => 'required|numeric',
            'dob' => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'portfolio' => 'nullable|url',
            'emirates_id' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'prefered_way_communication' => 'nullable|string|in:Email,Phone,WhatsApp',
            'term_and_condition_acceptance' => 'required',
            'registration_payment' => 'nullable|numeric',
        ]);

        // Get the logged-in artist
        $update = Artist::find($request->id);

        if (!$update) {
            return redirect()->back()->with('error', 'Artist not found!');
        }

        // Update fields only if they are provided in the request
        $update->fname = $request->fname ?? $update->fname;
        $update->lname = $request->lname ?? $update->lname;
        $update->email = $request->email ?? $update->email;
        $update->mobile = $request->mobile ?? $update->mobile;
        $update->dob = $request->dob ?? $update->dob;
        $update->nationality = $request->nationality ?? $update->nationality;
        $update->location = $request->location ?? $update->location;
        $update->portfolio = $request->portfolio ?? $update->portfolio;
        $update->emirates_id = $request->emirates_id ?? $update->emirates_id;
        $update->category_id = $request->category_id ?? $update->category_id;
        $update->prefered_way_communication = $request->prefered_way_communication ?? $update->prefered_way_communication;
        $update->term_and_condition_acceptance = $request->term_and_condition_acceptance ?? $update->term_and_condition_acceptance;
        $update->registration_payment = $request->registration_payment ?? $update->registration_payment;

        // Handle multiple image uploads
        if ($request->hasFile('image')) {
            $images = [];
            foreach ($request->file('image') as $file) {
                $images[] = Cmf::sendimagetodirectory($file);
            }
            $update->image = json_encode($images); // Storing images as JSON array
        }

        $update->save();

        return redirect()->to(url('userdashboard'))->with('success', 'Signup completed successfully!');

    }
}
