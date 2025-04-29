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
use App\Models\upcoming_events;
use App\Models\event_applications;
use App\Models\invest_request;
use App\Models\testimonial;
use App\Models\artist;
use App\Models\plans;
use App\Models\contactuses;
use App\Models\Subscription;
use App\Models\photos;
use App\Notifications\NewContactNotification;
use App\Mail\GeneralEmail;
use App\Mail\MembershipMail;
use Stripe\Stripe;
use Stripe\PaymentIntent;
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
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripePlans = $stripe->plans->all(['limit' => 10]);
        $stripePriceIds = collect($stripePlans->data)->pluck('id')->toArray();
        $localPlans = plans::whereIn('stripe_price_id', $stripePriceIds)->get();
        $plan = $localPlans->map(function ($localPlan) use ($stripePlans) {
            $stripePlan = collect($stripePlans->data)->firstWhere('id', $localPlan->stripe_price_id);
            return [
                'local' => $localPlan,
                'stripe' => $stripePlan,
            ];
        });
        $events = events::where('status' , 'Published')->take(6)->get();
        return view('frontend.homepage.index')->with(array('events' => $events , 'plan' => $plan));
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
        $data = blogs::where('id' , $id)->first();
        return view('frontend.pages.blogdetails')->with(array('data' => $data));
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
            return redirect()->to(url('user/userdashboard'))->with('success', 'Login successful!');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }
    public function artistlogout()
    {
        Auth::guard('artist')->logout();
        return redirect()->route('login')->with('success', 'User has been logged out!');
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $insert = new contactuses();
        $insert->name = $request->name;
        $insert->email = $request->email;
        $insert->phone = $request->phone;
        $insert->subject = $request->subject;
        $insert->message = $request->message;
        $insert->save();

        // Admin ko notify karo
        $admin = User::first(); // ya multiple admin ko notify karna ho to loop me
        $admin->notify(new NewContactNotification($insert));
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
    public function upcomingevents()
    {
        $eventIds = upcoming_events::where('status', 1)->pluck('event_id');
        $events = events::where('status', 'Published')->whereIn('id', $eventIds)->paginate(10);
        return view('frontend.events.upcoming')->with(array('events' => $events));
    }
    public function eventsdetails($id)
    {
        $data = events::where('id' , $id)->first();
        return view('frontend.events.detail')->with(array('data' => $data));;
    }
    public function userdashboard()
    {
        if (!Auth::guard('artist')->check()) {
        return redirect(url('login'))->with('error', 'Please login to access the dashboard.');
        }

        return view('frontend.user.userdashboard');
    }
    public function getevents(Request $request)
    {
        $date = $request->input('date');
        $events = events::whereDate('start_date', $date)->get();
        return view('frontend.events.partials.eventcards', compact('events'));
    }
    public function applyevent(Request $request)
    {
        $add = new event_applications();
        $add->event_id = $request->event_id;
        $add->name = $request->name;
        $add->phone = $request->phone;
        $add->email = $request->email;
        $add->message = $request->message;
        $add->status = 2;
        $add->save();

        // Email send after saving
        $subject = 'New Event Application Submitted';
        $body = "New application received:\n\n"
            . "Name: {$add->name}\n"
            . "Phone: {$add->phone}\n"
            . "Email: {$add->email}\n"
            . "Message: {$add->message}";
        Mail::to($add->email)->send(new GeneralEmail(
            'Thank you for applying',
            "Dear {$add->name},\n\nThank you for applying for our event. We will get back to you soon.\n\n- CreativeZone Team"
        ));
        return redirect()->back()->with('message', 'Your application is under review');
    }
    public function investmentrequest()
    {
        return view('frontend.pages.investmentrequest');
    }
    public function investrequest(Request $request)
    {
        $add = new invest_request();
        $add->name = $request->name;
        $add->phone = $request->phone;
        $add->email = $request->email;
        $add->message = $request->message;
        $add->status = 2;
        $add->save();

        // Email send after saving
        $subject = 'New Investment Request Submitted';
        $body = "New application received:\n\n"
            . "Name: {$add->name}\n"
            . "Phone: {$add->phone}\n"
            . "Email: {$add->email}\n"
            . "Message: {$add->message}";
        Mail::to($add->email)->send(new GeneralEmail(
            'Thank you for Send Investment Request',
            "Dear {$add->name},\n\nThank you for Investment Request for our event. We will get back to you soon.\n\n- CreativeZone Team"
        ));
        return redirect()->back()->with('message', 'Your Investment Request is under review');
    }
    public function gallery()
    {
        $data = photos::where('status'  , 1)->get();
        return view('frontend.pages.gallery' , compact('data'));
    }
    public function membership()
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
        return view('frontend.membership.index', compact('data'));
    }
    public function buyplan($slug)
    {
        $plan = plans::where('slug',$slug)->first();
         session(['selected_plan_id' => $plan->id]);
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripePlan = null;
        try {
            $stripePlan = $stripe->plans->retrieve($plan->stripe_price_id, []);
        } catch (\Exception $e) {
            $stripePlan = null;
        }
        return view('frontend.membership.buyplan', compact('plan', 'stripePlan'));
    }
    public function buymembership(Request $request)
    {
        // Validate form input
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);

        $user = Auth::guard('artist')->user(); // or Auth::user() if using default authentication
        $plan = plans::findOrFail(session('selected_plan_id')); // Ensure selected plan exists in session
        
        // Check if the plan is available
        if (!$plan) {
            return redirect()->back()->with('error', 'No plan selected!');
        }

        // Store the user and plan information in session
        session()->put('user_id', $user->id);
        session()->put('plan_id', $plan->id);
        Stripe::setApiKey(env('STRIPE_SECRET'));
        // Start Stripe Checkout Session
        $checkoutSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'customer_email' => $data['email'],
            'line_items' => [[
                'price' => $plan->stripe_price_id, // Assuming `stripe_price_id` is available in Plan model
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => url('user/successpayment') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => url('user/cancelpayment'),
            'metadata' => [
                'user_id' => $user->id,
                'plan_id' => $plan->id,
            ],
        ]);
        session()->put('stripe_checkout_session_id', $checkoutSession->id);
        // Redirect to Stripe checkout
        return redirect()->to(url('user/checkoutpage'));
    }
    public function checkoutpage()
    {
        $planId = session('plan_id');
        $plan = plans::where('id', $planId)->first();

        if (!$plan) {
            // Handle error if plan not found
            return redirect()->route('plan.selection')->with('error', 'No plan selected.');
        }

        // Set Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a PaymentIntent to confirm the payment
        $paymentIntent = PaymentIntent::create([
            'amount' => $plan->price * 100, // Ensure the price is in the smallest currency unit (e.g., cents)
            'currency' => 'usd', // Update with the correct currency
        ]);

        $clientSecret = $paymentIntent->client_secret; // Get the client secret to send to the frontend

        // Retrieve the Stripe plan details
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripePlan = null;
        try {
            $stripePlan = $stripe->plans->retrieve($plan->stripe_price_id, []);
        } catch (\Exception $e) {
            $stripePlan = null;
        }

        // Return the view with the plan, stripe plan, and client secret
        return view('frontend.user.checkoutpage', compact('plan', 'stripePlan', 'clientSecret'));
    }

    public function successpayment(Request $request)
    {
         Stripe::setApiKey(env('STRIPE_SECRET'));
        // Retrieve the session data from Stripe
        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        
        // Fetch the user using the email from Stripe session
        $user = Artist::where('email', $session->customer_email)->first();
        
        // If the user doesn't exist, handle it gracefully
        if (!$user) {
            return redirect()->to(url('user/userdashboard'))->with('error', 'User not found!');
        }

        $planId = $session->metadata['plan_id'];

        // Fetch the plan using the plan_id stored in metadata
        $plan = plans::find($planId);

        // If the plan is not found, return an error
        if (!$plan) {
            return redirect()->to(url('user/userdashboard'))->with('error', 'Plan not found!');
        }

        // Save subscription record as pending
        Subscription::create([
            'user_id' => $user->id,
            'stripe_subscription_id' => $session->subscription,
            'plan_id' => $plan->id,
            'status' => 'pending', // Subscription is pending admin verification
        ]);

        // Send confirmation email to the user
        Mail::to($user->email)->send(new MembershipMail($user, $plan));

        // Redirect with success message
        return redirect()->to(url('user/successpayment'))->with('success', 'Payment successful! You will be activated after admin verification.');
    }
}