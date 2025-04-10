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
    public function appearance()
    {   
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        return view('admin.website.settings',compact("settings"));
    }
    public function topnavbar()
    {
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        $links = topbar_links::all();
        return view('admin.website.topnavbar',compact("settings" ,"links"));
    }
    public function generalsettings()
    {
        $settings = Settings::where('smallname' , env('APP_NAME'))->first();
        return view('admin.website.generalsettings',compact("settings"));
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
}
