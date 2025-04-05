<?php

namespace App\Http\Controllers\admin;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use App\Models\email_template;
use App\Models\email_templates;
use Illuminate\Http\Request;
use App\Models\site_settings as Settings;
use App\Models\site_settings;
use App\Models\sitelinks;
use App\Models\email_setting;
use App\Models\commissions;
use App\Models\plan;
use App\Models\services;
use App\Models\shipping_companies;
use App\Models\providers;
use App\Models\smtp_lists;
use App\Models\topbar_links;
use App\Models\sitelink_cat;
use Illuminate\Support\Facades\DB;
use Artisan;

class SettingsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function topnavbar()
    {
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        $links = topbar_links::all();
        return view('admin.website.topnavbar',compact("settings" ,"links"));
    }
    public function appearance()
    {   
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        return view('admin.website.settings',compact("settings"));
    }
    public function generalsettings()
    {
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        return view('admin.website.generalsettings',compact("settings"));
    }

    public function plancarddesign()
    {
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        return view('admin.website.plancarddesign',compact("settings"));
    }
    public function clearcache()
    {
        return view('admin.website.clearcache');
    }
    public function cacheclear()
    {
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('storage:link');
        return redirect()->back()->with('message', 'Cache Cleard Successfully');
    }
    public function serverinfo()
    {
        return view('admin.website.serverinfo');
    }
    public function emailsettings()
    {   
        $smtplist = smtp_lists::get();
        return view('admin.website.emailsettings',compact("smtplist"));
    }
    public function createsmtptemplate()
    {
        return view('admin.website.createsmtptemplate');
    }
    public function updatesmtptemplate($id)
    {
        $data = smtp_lists::where('id' , $id)->first();
        return view('admin.website.updatesmtptemplate')->with(array('data' => $data));
    }
    public function addsmtptemplate(Request $request)
    {
        $add = new smtp_lists;
        $add->from_name = $request->from_name;
        $add->from_email = $request->from_email;
        $add->smtp_email = $request->smtp_email;
        $add->smtp_password = $request->smtp_password;
        $add->save();
        return redirect()->back()->with('message', 'SMTP Template Add Successfully');
    }
    public function editsmpttemplate(Request $request)
    {
        $add = smtp_lists::find($request->id);
        $add->from_name = $request->from_name;
        $add->from_email = $request->from_email;
        $add->smtp_email = $request->smtp_email;
        $add->smtp_password = $request->smtp_password;
        $add->save();
        return redirect()->back()->with('message', 'SMTP Template Update Successfully');
    }
    public function deletesmtptemplate($id)
    {
        smtp_lists::where('id' , $id)->delete();
        return redirect()->back()->with('message', 'SMTP Template Delete Successfully');
    }
    public function emailsettingsupdate(Request $request)
    {   
        $update = array('order_template_customer' => $request->order_template_customer,'community_notes' => $request->community_notes,'order_template_company' => $request->order_template_company );
        DB::table('email_settings')->where('id' , 1)->update($update);
        return redirect()->back()->with('message', 'Email Template Settings Add Successfully');
    }
    
    public function userpanelsettings()
    {   
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        return view('admin.website.userpanelsetting',compact("settings"));
    }
    
    public function userpanelsettingupdate(Request $request)
    {   
        $settings = site_settings::where('smallname' , Cmf::getwebsite()->smallname)->first();
        $upadate = Settings::find($settings->id);
        $upadate->userpanel_temp = $request->userpanel_temp;
        $upadate->buynow_form = $request->buynow_form;
        $upadate->save();
        return redirect()->back()->with('message', 'User Panel Settings Updated Successfully');
    }

    public function settingsupdate(Request $request)
    {
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        $upadate = Settings::find($settings->id);
        $upadate->site_name = $request->website_name;
        $upadate->site_phonenumber = $request->site_phonenumber;
        $upadate->site_address = $request->site_address;
        $upadate->site_email = $request->site_email;
        $upadate->footer_description = $request->footer_description;
        $upadate->save();
        return redirect()->back()->with('message', 'Settings Updated Successfully');
    }
    public function topnavbarupdate(Request $request)
    {
        // Update settings for top_navbar
        $settings = Settings::where('smallname', env('APP_NAME'))->first();
        $update = Settings::find($settings->id);
        $update->top_navbar = $request->top_navbar;
        $update->save();
        DB::table('topbar_links')->wherenotnull('tittle')->delete();
        $titles = $request->title;
        $links = $request->link; 
        foreach ($titles as $index => $title) {
            $link = $links[$index];
            if (!empty($title) && !empty($link)) {
                topbar_links::create([
                    'tittle' => $title,
                    'link' => $link,
                ]);
            }
        }
        return redirect()->back()->with('message', 'Settings and Links Updated Successfully');
    }

    public function updatelinks(Request $request)
    {
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        $upadate = Settings::find($settings->id);
        $upadate->facebook_link = $request->facebook_link;
        $upadate->insta_link = $request->insta_link;
        $upadate->twitter_link = $request->twitter_link;
        $upadate->save();
        return redirect()->back()->with('message', 'Social Links Updated Successfully');
    }

    public function updatelogos(Request $request)
    {
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        $upadate = Settings::find($settings->id);
        if($request->header_logo)
        {
            $upadate->header_logo = Cmf::sendimagetodirectory($request->header_logo);
        }
        if($request->footer_logo)
        {
            $upadate->footer_logo = Cmf::sendimagetodirectory($request->footer_logo);
        }
        if($request->favicon)
        {
            $upadate->favicon = Cmf::sendimagetodirectory($request->favicon);
        }
        $upadate->save();
        return redirect()->back()->with('message', 'Logos Updated Successfully');
    }
    public function sitelinks()
    {
        $data = sitelinks::orderBy('order')->get();
        return view('admin.website.sitelinks')->with(array('data' => $data));
    }
    public function createlinks(Request $request)
    {
        $maxOrder = sitelinks::max('order');
        $order = $maxOrder ? $maxOrder + 1 : 1;
        $add = new sitelinks;
        $add->name = $request->name;
        $add->url = Cmf::shorten_url($request->url);
        $add->headerlink = $request->headerlink;
        $add->order = $order;
        $add->category = $request->category;
        $add->status = 1;
        $add->save();
        return redirect()->back()->with('message', 'Website Links Add Successfully');
    }
    public function updateweblinks(Request $request)
    {
        $upadate = sitelinks::find($request->id);
        $upadate->name = $request->name;
        $upadate->url = Cmf::shorten_url($request->url);
        $upadate->headerlink = $request->headerlink;
        $upadate->category = $request->category;
        $upadate->status = 1;
        $upadate->save();
        return redirect()->back()->with('message', 'Website Links Add Successfully');
    }
    public function changelinkstatus($id)
    {
        $updateincategory  = sitelinks::find($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Website Links Status Updated Successfully'); 
    }
    public function deletelinks($id)
    {
        sitelinks::where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Website Links Deleted Successfully'); 

    }
     public function updatelinkorder(Request $request)
    {
        $order = $request->input('order');
        $position = 1; // Start with position 1

        foreach ($order as $id) {
            // Update the order in the database
            DB::table('sitelinks')
                ->where('id', $id)
                ->update(['order' => $position]);

            $position++;
        }
        return response()->json(['success' => true]);
    }
    public function sitelinkcat()
    {
        $data = sitelink_cat::orderby('id')->get();
        return view('admin.website.sitelinkcat')->with(array('data' => $data));
    }
    public function createlinkscat(Request $request)
    {
        $add = new sitelink_cat;
        $add->name = $request->name;
        $add->save();
        return redirect()->back()->with('message', 'Website Links Cat Add Successfully');
    }
    public function updateweblinkscat(Request $request)
    {
        $add = sitelink_cat::findOrFail($request->id);
        $add->name = $request->name;
        $add->save();
        return redirect()->back()->with('message', 'Website Links Cat Add Successfully');
    }
    public function deletelinkscat($id)
    {
        sitelink_cat::where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Website Links Category Deleted Successfully'); 
    }
    public function commission(Request $request)
    {
        $perPage = request()->input('per_page', 50);
        $perPage = is_numeric($perPage) ? (int) $perPage : 50;
        $perPage = $perPage > 0 ? $perPage : 50;
        $query = commissions::whereHas('service', function ($query) {
            $query->where('trashstatus', 0);
        })
        ->join('plans', 'commissions.plan', '=', 'plans.id')
        ->join('providers', 'commissions.provider', '=', 'providers.id')
        ->join('services as parent_services', 'commissions.parentservice', '=', 'parent_services.id')
        ->leftJoin('countries', 'commissions.country', '=', 'countries.code')
        ->select(
            'commissions.*', 
            'plans.planname', 
            'providers.name as provider_name', 
            'parent_services.name as parent_service_name', 
            'countries.name as country_name'
        );
        if ($request->has('name') && !empty($request->name)) {
            $query->where('plans.planname', 'like', '%' . $request->name . '%');
        }
        if ($request->has('provider') && !empty($request->provider)) {
            $query->where('commissions.provider', $request->provider);
        }
        if ($request->has('parentservice') && !empty($request->parentservice)) {
            $query->where('commissions.parentservice', $request->parentservice);
        }
        if ($request->has('service') && !empty($request->service)) {
            $query->whereRaw("FIND_IN_SET(?, commissions.service)", [$request->service]);
        }
        if ($request->has('services') && !empty($request->services)) {
            $serviceIds = explode(',', $request->services);
            foreach ($serviceIds as $serviceId) {
                $query->whereRaw("FIND_IN_SET(?, commissions.service)", [$serviceId]);
            }
        }
        if ($request->has('country') && !empty($request->country)) {
            $query->where('commissions.country', $request->country);
        }
        if ($request->has('status') && !empty($request->status)) {
            $query->where('commissions.status', $request->status);
        }
        $data = $query->orderby('commissions.id', 'desc')->paginate($perPage);
        if ($request->ajax()) {
            $tableData = view('admin.website.render.commissione_table', compact('data'))->render();
            $paginationLinks = $data->links('admin.pagination')->render();

            return response()->json([
                'tableData' => $tableData,
                'paginationLinks' => $paginationLinks
            ]);
        }
        return view('admin.website.commissions', compact('data'));
    }
    public function changecommissionstatus($id)
    {
        $updateincategory  = commissions::find($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Commission Status Updated Successfully'); 
    }
    public function editcommission($id)
    {
        $data =commissions::where('id' , $id)->first();
        return view('admin.website.editcomssion');
    }
    public function addcommissionmodel($id)
    {
        $id = $id;
        return $html = view('admin.website.render.addcommissionmodel', compact('id'))->render();
    }
    public function getservice($id)
    {

        $data = services::where('parent_id' , $id)->get();
        echo '<option value="">Select Child Services</option>';
        foreach ($data as $r) {
            echo '<option value="'.$r->id.'" >'.$r->name.'</option>';
        }
    }
    public function getprovider(Request $request)
    {
        $services = $request->input('services', []);
        $providerIds = DB::table('provider_child_services')
            ->whereIn('service_id', $services)
            ->pluck('provider_id'); 
        $providers = DB::table('providers')
            ->whereIn('id', $providerIds)
            ->get();
        $html = '<option value="">Select Providers</option>';
        foreach ($providers as $provider) {
            $html .= '<option value="'.$provider->id.'">'.$provider->name.'</option>';
        }
        return $html;
    }
    public function getplan($id)
    {

        $data = plan::where('provider' , $id)->get();
        echo '<option value="">Select Plans</option>';
        foreach ($data as $r) {
            echo '<option value="'.$r->id.'" >'.$r->planname.'</option>';
        }
    }
    public function getplanprice($id)
    {
        $plan = plan::find($id);
        if ($plan) {
            return response()->json(['price' => $plan->price]);
        } else {
            return response()->json(['error' => 'Plan Price not found'], 404);
        }
    }
    public function createcommission(Request $request)
    {
        $add = new commissions;
        $add->country = $request->country;
        $add->parentservice = $request->parentservice;
        $add->service = is_array($request->service) ? implode(',', $request->service) : $request->service;
        $add->provider = $request->provider;
        $add->plan = $request->planname;
        $add->amount = $request->amount;
        $add->status = 1;
        $add->save();
        return redirect()->back()->with('message', 'Commission Created Successfully');
    }
    public function updatecomssion(Request $request)
    {
        $add = commissions::find($request->id);
        $add->amount = $request->amount;
        $add->save();
        return redirect()->back()->with('message', 'Commission Updated Successfully');
    }
    public function deletecommission($id)
    {
        commissions::where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Commission Deleted Successfully');
    }
    public function filtercommission(Request $request)
    {
        $country = $request->input('country');
        $parentservice = $request->input('parentservice');
        $childservice = $request->input('childservice');
        $selectprovider = $request->input('selectprovider');
        $selectplans = $request->input('selectplans');

        // Check if a record exists with all the selected values
        $filter = DB::table('commissions')
            ->where('country', $country)
            ->where('parentservice', $parentservice)
            ->where('service', $childservice)
            ->where('provider', $selectprovider)
            ->where('plan', $selectplans)
            ->first(['amount' , 'id']);

        if ($filter) {
            return response()->json([
                'exists' => true,
                'amount' => $filter->amount,
                'comission_id' => $filter->id,
            ]);
        } else {
            return response()->json([
                'exists' => false,
                'amount' => null,
                'comission_id' => null,
            ]);
        }
    }
    public function shippingcompanies(Request $request)
    {
        $perPage = request()->input('per_page', 50);
        $perPage = is_numeric($perPage) ? (int) $perPage : 50;
        $perPage = $perPage > 0 ? $perPage : 50;
        $query = shipping_companies::query();
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        $data = $query->orderby('id', 'desc')->paginate($perPage);
        if ($request->ajax()) {
            $tableData = view('admin.website.render.shipping_table', compact('data'))->render();
            $paginationLinks = $data->links('admin.pagination')->render();

            return response()->json([
                'tableData' => $tableData,
                'paginationLinks' => $paginationLinks
            ]);
        }
        return view('admin.website.shippingcompanies', compact('data'));
    }
    public function addcompanyname(Request $request)
    {
        $add = new shipping_companies();
        $add->name = $request->name;
        $add->status = 1;
        $add->save();
        return redirect()->back()->with('message', 'Company Added Successfully');
    }
    public function changecompanytatus($id)
    {
        $updateincategory  = shipping_companies::find($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Company Status Updated Successfully'); 
    }
}
