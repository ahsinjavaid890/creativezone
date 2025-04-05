<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Models\companies;
use App\Models\wp_dh_companies;
use App\Models\wp_dh_life_plans_benefits;
use App\Models\help_articles;
use App\Models\blogs;
use App\Models\Rule;
use App\Models\blogcategories;
use App\Models\company_info_pages;
use App\Models\wp_dh_insurance_plans_benefits;
use App\Models\wp_dh_insurance_plans;
use App\Models\wp_dh_life_plans;
use App\Models\wp_dh_products;
use App\Models\temproaryquotes;
use App\Models\sales_cards;
use App\Models\wp_dh_insurance_plans_features;
use App\Models\wp_dh_insurance_plans_pdfpolicy;
use App\Models\wp_dh_insurance_plans_deductibles;
use App\Models\product_categories;
use App\Models\plan_benifits_categories;
use App\Models\sale_change_requests;
use App\Models\sale_extend_requests;
use App\Models\sale_refund_requests;
use App\Models\sales;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use  Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
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
    public function addnewrole()
    {
        return view('admin.users.addnewrole');
    }
    public function edituser($id)
    {
        $data = User::find($id);
        return view('admin.users.edituser')->with(array('data' => $data));
    }
    public function addnewuser(Request $request)
    {
        $rule = new User();
        $rule->name = $request->name;
        $rule->email = $request->email;
        $rule->phone = $request->phone;
        $rule->role_id =  $request->rolls;
        $rule->password = Hash::make($request->password);
        $rule->type =  'admin';
        $rule->status =  'active'; 
        $rule->save();
        return redirect()->back()->with('message', 'User created successfully!');
    }
    public function updateuser(Request $request)
    {
        $rule = User::find($request->id);
        $rule->name = $request->name;
        $rule->email = $request->email;
        $rule->phone = $request->phone;
        $rule->role_id =  $request->rolls;
        // Only update the password if a new one is provided
            if ($request->password) {
                $rule->password = Hash::make($request->password);
            }
        $rule->type =  'admin';
        $rule->status =  $request->status;
        $rule->save();
        return redirect()->back()->with('message', 'User created successfully!');
    }
    public function deleteuser($id)
    {
        User::where('id' , $id)->delete();
        return redirect()->back()->with('message', 'User Deleted successfully!');
    }
    public function createrule(Request $request)
    {
        $rule = new Rule();
        $rule->name = $request->name;
        $rule->description = $request->description;
        $rule->is_default = $request->is_default ? true : false;
        $rule->permissions = json_encode($request->permissions);
        $rule->user_id = Auth::user()->id;
        $rule->save();
        return redirect()->back()->with('message', 'Rule created successfully!');
    }
    public function alluserroles()
    {
        $data = Rule::all();
        return view('admin.users.alluserroles')->with(array('data' => $data));
    }
    public function editrole($id)
    {
        $data = Rule::findOrFail($id);
        $permissions = json_decode($data->permissions, true);
        return view('admin.users.editrole')->with(array('data' => $data, 'permissions' => $permissions));
    }
    public function updaterule(Request $request)
    {
        $rule = Rule::find($request->id);
        $rule->name = $request->name;
        $rule->description = $request->description;
        $rule->is_default = $request->is_default ? true : false;
        $rule->permissions = json_encode($request->permissions);
        $rule->user_id = Auth::user()->id;
        $rule->save();
        return redirect()->back()->with('message', 'Rule created successfully!');
    }
    public function deleteuserrol($id)
    {
        Rule::where('id' , $id)->delete();
        User::where('role_id' ,  $id)->delete();
        return redirect()->back()->with('message', 'User Roll Deleted successfully!');
    }
    public function company()
    {
        $data = User::where('type' , 'company')->get();
        return view('admin.users.company')->with(array('data' => $data));
    }
    public function addcompany(Request $request)
    {
        $rule = new User();
        $rule->name = $request->name;
        $rule->email = $request->email;
        $rule->phone = $request->phone;
        $rule->password = Hash::make($request->password);
        $rule->type =  'company';
        $rule->status =  'active'; 
        $rule->save();
        return redirect()->back()->with('message', 'New Company created successfully!');
    }
    public function editcompany($id)
    {
        $data = User::find($id);
        return view('admin.users.editcompany')->with(array('data' => $data));
    }
    public function updatecompany(Request $request)
    {
        $rule = User::find($request->id);
        $rule->name = $request->name;
        $rule->email = $request->email;
        $rule->phone = $request->phone;
            if ($request->password) {
                $rule->password = Hash::make($request->password);
            }
        $rule->type =  'company';
        $rule->status =  $request->status;
        $rule->save();
        return redirect()->back()->with('message', 'Company Update successfully!');
    }
    public function deletecompany($id)
    {
        User::where('id' ,  $id)->delete();
        return redirect()->back()->with('message', 'Company Deleted successfully!');
    }
}
