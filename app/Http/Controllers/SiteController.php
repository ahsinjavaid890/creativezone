<?php

namespace App\Http\Controllers;

use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\blogs;
use App\Models\blogcategories;
use App\Models\models;
use App\Models\gallary_images;
use App\Models\categories;
use App\Models\answerquestions;
use App\Models\meta_tags;
use App\Models\slider_images;
use App\Models\frequesntlyaskquest_categorie;
use App\Models\frequesntlyaskquestions;
use App\Models\videocategory;
use App\Models\video;
use App\Models\events;
use App\Models\testimonial;
use App\Models\artist;
use App\Models\contactus;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Redirect;
use Session;
use Validator;
use Storage;
use Input;
use DateTime;
use Http;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        
        return view('frontend.homepage.index');
    }
    public function videos()
    {
        $data = video::get();
        return view('frontend.pages.videos')->with(array('data' => $data));
    }
    public function blogs()
    {
        $data = blogs::where('status' , 1)->get();
        return view('frontend.pages.blogs')->with(array('data' => $data));
    }
    public function faq()
    {
        return view('frontend.pages.faq');
    }
    public function techsupport()
    {
        return view('frontend.pages.techsupport');
    }
    public function techsupportsubmit(Request $request)
    {
        $name = $request->firstname . ' ' . $request->lastname;
        $add = new techsupport;
        $add->name = $name;
        $add->email = $request->email;
        $add->phone = $request->phone;
        $add->text = $request->text;
        $add->save();
        return view('frontend.pages.techmeet');
    }
    public function techsupportsubmittwo(Request $request)
    {
        $add = techsupport::find($request->id);
        $add->username = $request->username;
        $add->password = Hash::make($request->password);
        $add->save();
        return view('frontend.pages.techpay');

    }
    public function termsofuse()
    {
        return view('frontend.pages.termsofuse');
    }
    public function privacypolicies()
    {
      
        return view('frontend.pages.privacypolicies');
    }
    public function ratingreview(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'ratting' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);
        $addreview = new productreviews;
        $addreview->product_id = $request->product_id;
        $addreview->name = $request->name;
        $addreview->email = $request->email;
        $addreview->ratting = $request->ratting;
        $addreview->review = $request->review;
        $addreview->save();
        return redirect()->back()->with('message' , 'Review and Ratting Adding succesfully');
    }
    public function blogdetail($id)
    {
        
        return view('frontend.pages.blogdetails');
    }
    public function blogbycategory($id)
    {
        $category = blogcategories::where('url', $id)->where('website', 'lifeadvice')->first();
        $data = DB::table('blogs')->where('category_id', $category->id)->where('website', 'lifeadvice')->paginate(9);
        return view('frontend.companypages.blogsbycategory')->with(array('data' => $data, 'category' => $category));
    }
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        } else {
            return view('auth.login');
        }
    }
    private function validator(Request $request)
    {
        $rules = [
            'email'    => 'required|email|exists:users|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];
        $request->validate($rules, $messages);
    }
    public function userlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $this->validator($request);
        $user = User::where('email', $credentials['email'])->first();
        if ($user && $user->type == 'admin') {
            Auth::logout();
            $adminurl = url('admin/login');
            return redirect()->back()->withErrors(['warning' => 'For Admin Access You need to Visit this URL '.$adminurl.' ']);
        }
        if (auth()->attempt($credentials, $request->filled('remember'))) {
            if (Auth::user()->type == 'User') {
                if($request->redirectback)
                {
                    if($request->redirectback == 'cart')
                    {
                        return redirect()->intended('cart');
                    }
                }else{
                    return redirect()->intended('user/dashboard');
                }
            } else {
                Auth::logout();
                $adminurl = url('admin/login');
                return redirect()->back()->withErrors(['warning' => 'For Admin Access You need to Visit this URL '.$adminurl.' ']);
            }
        } else {
            Auth::logout();
            return back()->withErrors(['warning' => 'Invalid credentials or no access for this user.']);
        }
    }

    public function artistlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('artist')->attempt($credentials)) {
            return redirect()->to(url('userdashboard'))->with('success', 'Login successful!');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }
    public function aboutus()
    {
        return view('frontend.pages.about');
    }
    public function contactus()
    {
        return view('frontend.pages.contact');
    }
    public function contacts(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $insert = new contactus();
        $insert->fname = $request->fname;
        $insert->lname = $request->lname;
        $insert->email = $request->email;
        $insert->phone = $request->phone;
        $insert->save();
        $notificationUrl = 'admin/contact/messages';
        notifications::create([
            'icon' => 'business_messages',
            'notification_name' => 'Contact Message query',
            'url' => $notificationUrl,
            'is_read' => false,
        ]);
        return view('frontend.pages.contact_shortly');
    }
    public function privacypolicy()
    {
        return view('frontend.companypages.privacypolicy');
    }
    public function termsandcondition()
    {
        return view('frontend.pages.termandcondition');
    }
    public function signup()
    {
        return view('frontend.companypages.signup');
    }
    public function newsletter(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email|max:255,',
        ]);
        $email = DB::table('news_letters')->where('email', '=', $request->email)->first();
        if ($email == null) {
            $data  = new NewsLetter();
            $data->email = $request->email;
            $data->save();
            return back()->with('message', 'Email saved succesfully');
        }
        return back()->with('error', 'Email Already Exist');
    }
    public function viewLetters()
    {
        $users = DB::table('news_letters')->select('id', 'email')->get();
        return view('admin/contact/newsletter', compact('users'));
    }
    public function changeprofilepassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Your current password does not match.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'Password updated successfully!');
    }
    public function allevents()
    {
        $events = events::where('status' , 'Published')->paginate(10);
        return view('frontend.events.index')->with(array('events' => $events));
    }
    public function eventsdetails($id)
    {
        return view('frontend.events.detail');
    }
    public function userdashboard()
    {
        if (!Auth::guard('artist')->check()) {
        return redirect(url('login'))->with('error', 'Please login to access the dashboard.');
        }

        return view('frontend.user.userdashboard');
    }
    public function investmentrequest()
    {
        return view('frontend.events.invesment-request');
    }
}