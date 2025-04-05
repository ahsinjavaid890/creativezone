<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Helpers\Cmf;
use App\Models\providers;
use App\Models\services;
use App\Models\ServiceRelation;
use App\Models\service_questions;
use App\Models\service_question_answers;
use App\Models\atribute;
use App\Models\provider_attributes;
use App\Models\commissions;
use App\Models\plan_attributes;
use App\Models\provider_child_services;
use App\Models\plan;
use App\Models\answerquestions;
use App\Models\order;
use App\Models\provider_states;
use App\Models\providerfaq;
use App\Models\providersReviews;
use App\Models\states;
use App\Models\providerlocation;
use App\Models\provider_zipcodes;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BuyProductsExport;
use App\Imports\BuyProductsImport;
use App\Imports\ZipcodesImport;
use App\Exports\ZipCodesExport;
use App\Imports\UpdateZipcodesImport;
use Illuminate\Http\Request;
use App\Imports\ProvidersImport;
use App\Exports\ProvidersExport;
use App\Imports\PlansImport;
use App\Exports\PlansExport;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ServicesController extends Controller
{
    public function parentservices(Request $request)
    {
        $perPage = request()->input('per_page', 25);
        $perPage = is_numeric($perPage) ? (int) $perPage : 25;
        $perPage = $perPage > 0 ? $perPage : 25;
        $query = services::query();
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        $data = $query->withoutTrashedParents()->wherenull('parent_id')->orderby('created_at', 'DESC')->paginate($perPage);
        if ($request->ajax()) {
            $tableData = view('admin.services.render.parentservice_table', compact('data'))->render();
            $paginationLinks = $data->links('admin.pagination')->render();
            return response()->json([
                'tableData' => $tableData,
                'paginationLinks' => $paginationLinks
            ]);
        }

        return view('admin.services.parentservice', compact('data'));
    }
    public function allservices(Request $request)
    { 
        $perPage = request()->input('per_page', 50);
        $perPage = is_numeric($perPage) ? (int) $perPage : 50;
        $perPage = $perPage > 0 ? $perPage : 50;
        $query = services::query();
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('filter_parent_services') && !empty($request->filter_parent_services)) {
            $query->where('parent_id',$request->filter_parent_services);
        }
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        $data = $query->withoutTrashedParents()->wherenotnull('parent_id')->orderby('created_at', 'DESC')->paginate($perPage);

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            $tableData = view('admin.services.render.service_table', compact('data'))->render();
            $paginationLinks = $data->links('admin.pagination')->render();
            return response()->json([
                'tableData' => $tableData,
                'paginationLinks' => $paginationLinks
            ]);
        }
        return view('admin.services.allservices', compact('data'));
    }
    public function createnewservice()
    {
        return view('admin.services.createnewservice');
    }
    public function createservicecat()
    {
        return view('admin.services.createservicecat');
    }
    public function editservicecat($id)
    {
        $data = services::find($id);
        return view('admin.services.editservicecat')->with(array('data'=>$data));
    }
    public function addservice(Request $request)
    {
        if(services::where('name' , $request->name)->where('parent_id' , $request->parent_id)->count() == 1)
        {
            return redirect()->back()->with('warning', 'This Name of Service is Already Created');
        }
        $newservice = new services();
        $newservice->name = $request->name;
        $newservice->url = Cmf::shorten_url($request->name);
        $newservice->description = $request->description;
        if($request->icon)
        {
            $newservice->icon = Cmf::sendimagetodirectory($request->icon);
        }
        if ($request->parent_id) {
            $newservice->parent_id = $request->parent_id;
        }
        $newservice->status = 1;
        $newservice->save();
        

        return redirect()->back()->with('message', 'Service Added Successfully');
    }
    public function changestatus($id)
    {
        $updateincategory  = services::find($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Status Updated Successfully'); 
    }
    public function changeproviderstatus($id)
    {
        $updateincategory  = providers::find($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Status Updated Successfully'); 
    }
    
    public function changedfeatures($id)
    {
        $updateincategory  = providers::find($id);
        if($updateincategory->featured == 1)
        {
            $updateincategory->featured = 2;
        }else{
            $updateincategory->featured = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Feature Updated Successfully'); 
    }
    
    public function changeplanstatus($id)
    {
        $updateincategory  = plan::find($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Status Updated Successfully'); 
    }
    public function changeshowonhomepage($id)
    {
        $updateincategory = plan::find($id);
        if ($updateincategory->show_on_home_page == 'No') {
            $updateincategory->show_on_home_page = 'Yes';
        } else {
            $updateincategory->show_on_home_page = 'No';
        }

        $updateincategory->save();
        return redirect()->back()->with('message', 'Home page Status Updated Successfully');
        
    }
    public function changesproviderpage($id)
    {
        $updateincategory = plan::find($id);
        if ($updateincategory->showthisonprovider == 'No') {
            $updateincategory->showthisonprovider = 'Yes';
        } else{
            $updateincategory->showthisonprovider = 'No';
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Provider page status updated successfully');
    }
    public function editservice($id)
    {
        $data = services::find($id);
        $attributes = atribute::orderBY('order_column')->where('service_id', $id)->paginate(10);
        $relation = ServiceRelation::where('service_id', $id)->get();
        return view('admin.services.editservice')->with(array('data' => $data,'relation' => $relation,'attributes' => $attributes));
    }
    public function updateservice(Request $request)
    {
        $newservice = services::find($request->id);
        $newservice->name = $request->name;
        $newservice->url = Cmf::shorten_url($request->name);
        $newservice->description = $request->description;
        if($request->icon)
        {
            $newservice->icon = Cmf::sendimagetodirectory($request->icon);
        }
        if ($request->parent_id) {
            $newservice->parent_id = $request->parent_id;
        }
        $newservice->save();
        ServiceRelation::where('service_id', $request->id)->delete();
        if ($request->other_services_id) {
            foreach ($request->other_services_id as $service_id) {
                if ($service_id) {
                    $serviceRelation = new ServiceRelation();
                    $serviceRelation->service_id = $newservice->id;
                    $serviceRelation->related_service_id = $service_id;
                    $serviceRelation->save();
                }
            }
        }
        return redirect()->back()->with('message', 'Service Updated Successfully');
    }
    public function deleteservice($id)
    {
        try {
            services::where('id', $id)->delete();
            return redirect()->back()->with('message', 'Service moved to trash.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                $errorMessage = $e->getMessage();
                preg_match('/`[^`]+`\.`([^`]+)`/', $errorMessage, $matches);
                $tableName = isset($matches[1]) ? $matches[1] : 'related records';
                return redirect()->back()->with('warning', "Cannot delete this Service because related records exist in the {$tableName} table. Please delete them first.");
            }
            throw $e;
        }
    }
    public function providers(Request $request)
    {
        $perPage = request()->input('per_page', 50);
        $perPage = is_numeric($perPage) ? (int) $perPage : 50;
        $perPage = $perPage > 0 ? $perPage : 50;

        $query = providers::whereHas('service', function ($query) {
            $query->where('trashstatus', 0);
        });
        if (request()->has('service') && !empty(request('service'))) {
            $query->where('service', $request->service);
        }
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('filter_child_services') && !empty($request->filter_child_services)) {
            $childServices = $request->input('filter_child_services');
            $query->whereExists(function ($query) use ($childServices) {
                $query->select(DB::raw(1))
                      ->from('provider_child_services')
                      ->whereRaw('provider_child_services.provider_id = providers.id')
                      ->where('provider_child_services.service_id', $childServices);
            });
        }
        if ($request->has('country') && !empty($request->country)) {
            $query->where('country', $request->country);
        }
        if ($request->has('featured') && !empty($request->featured)) {
            $query->where('featured', $request->featured);
        }
        if ($request->has('featured') && !empty($request->status)) {
            $query->where('featured', $request->status);
        }
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        $data = $query->orderby('id', 'desc')->paginate($perPage);
        if ($request->ajax()) {
            $tableData = view('admin.services.render.providers_table', compact('data'))->render();
            $paginationLinks = $data->links('admin.pagination')->render();

            return response()->json([
                'tableData' => $tableData,
                'paginationLinks' => $paginationLinks
            ]);
        }
        return view('admin.services.providers', compact('data'));
    }
    public function addprovider()
    {
        return view('admin.services.addprovider');
    }
    public function createprovider(Request $request)
    {
        $add = new providers();
        $add->website = $request->website;
        $add->name = $request->name;
        $add->text_color = $request->text_color;
        $add->provider_url = $request->provider_url;
        $add->phone = $request->phone;
        $add->email = $request->email;
        $add->customerservice = $request->customerservice;
        $add->sales = $request->sales;
        $add->techsupport = $request->techsupport;
        if($request->logo)
        {
            $add->logo = Cmf::sendimagetodirectory($request->logo);
        }
        if($request->banner)
        {
            $add->banner = Cmf::sendimagetodirectory($request->banner);
        }
        $add->url = $request->url;
        $add->country = $request->country;
        $add->address = $request->address;
        $add->city = $request->city;
        $add->zipcode = $request->zipcode;
        $add->state = $request->state;
        $add->description = $request->description;
        $add->service = $request->service;
        $add->whatwelike = $request->whatwelike;
        $add->pricebreakdown = $request->pricebreakdown;
        $add->provider_page_status = $request->provider_page_status;
        $add->show_order_form = $request->show_order_form;
        $add->userrating = $request->userrating;
        $add->userratingqty = $request->userratingqty;
        $add->logo_home_page_plan = $request->logo_home_page_plan;
        $add->logo_provider_page_plan = $request->logo_provider_page_plan;
        $add->termandconditon = $request->termandconditon;
        $add->ordernote = $request->ordernote;
        $add->status = $request->status;
        $add->availability_type = $request->availability_type;
        $add->show_logo_on_slider = $request->show_logo_on_slider;
        $add->link_logo_to = $request->link_logo_to;
        $add->show_on_home_banner = $request->show_on_home_banner;
        $add->zipcode_search_box = $request->zipcode_search_box;
        $add->featured = 1;
        $add->save();
        foreach ($request->childservice as $r) {
            $addprovider_child_services = new provider_child_services();
            $addprovider_child_services->provider_id = $add->id;
            $addprovider_child_services->service_id = $r;
            $addprovider_child_services->save();
        }
        if ($request->availability_type) {
            $availabilityType = $request->availability_type;
            if ($availabilityType === 'zip_code' && $request->hasFile('zipcode')) {
                $file = $request->file('zipcode');
                $import = new ZipcodesImport();
                $import->setProviderId($add->id);
                Excel::import($import, $file);
            }
            if ($availabilityType === 'state_city' && $request->input('select_state')) {
                $states = $request->input('select_state');
                $city = $request->input('city');
                    provider_states::create([
                        'provider_id' => $add->id,
                        'state' => implode(',' , $states),
                        'city' => implode(',' , $city),
                    ]);
            }
            if ($availabilityType === 'by_location' && $request->input('location')) {
                $by_location = $request->input('by_location');

                foreach ($by_location as $location) {
                    providerlocation::create([
                        'provider_id' => $add->id,
                        'by_location' => $location,
                    ]);
                }
            }
        }
        $attributes = $request->input('attributes');
        if ($attributes) {
            foreach ($attributes as $attributeId => $value) {
                if (is_array($value)) {
                    $value = implode(',', $value);
                }
                provider_attributes::create([
                    'provider_id' => $add->id,
                    'attribute_id' => $attributeId,
                    'value' => $value,
                ]);
            }
        }
        if ($request->input('submit_type') === 'exit') {
            return redirect('admin/services/providers');
        }elseif($request->input('submit_type') === 'addmore'){
            return redirect()->back()->with('message', 'Provider Added Successfully');
        }
    }
    public function editprovider($id)
    {
        $provider = Providers::with('attributes')->findOrFail($id);
        $availability_type = $provider->availability_type;
        $states = DB::table('states')->get();
        return view('admin.services.editprovider', [
            'provider' => $provider,
            'availability_type' => $availability_type,
            'states' => $states,
            'provider_states' => provider_states::where('provider_id', $id)->pluck('state')->toArray()
        ]);
    }
    public function updateprovider(Request $request)
    {
        $provider = providers::findOrFail($request->id);
        $provider->update([
            'website' => $request->website,
            'name' => $request->name,
            'text_color' => $request->text_color,
            'provider_url' => $request->provider_url,
            'phone' => $request->phone,
            'country' => $request->country,
            'address' => $request->address,
            'city' => $request->cityprovider,
            'zipcode' => $request->zipcode,
            'state' => $request->state,
            'email' => $request->email,
            'customerservice' => $request->customerservice,
            'sales' => $request->sales,
            'techsupport' => $request->techsupport,
            'logo' => $request->hasFile('logo') ? Cmf::sendimagetodirectory($request->file('logo')) : $provider->logo,
            'banner' => $request->hasFile('banner') ? Cmf::sendimagetodirectory($request->file('banner')) : $provider->banner,
            'url' => $request->url,
            'description' => $request->description,
            'service' => $request->service,
            'whatwelike' => $request->whatwelike,
            'ordernote' => $request->ordernote,
            'termandconditon' => $request->termandconditon,
            'status' => $request->status,
            'availability_type' => $request->availability_type,
            'show_logo_on_slider' => $request->show_logo_on_slider,
            'link_logo_to' => $request->link_logo_to,
            'show_on_home_banner' => $request->show_on_home_banner,
            'zipcode_search_box' => $request->zipcode_search_box,
        ]);
        $existingServices = provider_child_services::where('provider_id', $request->id)->pluck('service_id')->toArray();
        $newServices = $request->input('childservice', []);
        $servicesToRemove = array_diff($existingServices, $newServices);
        $servicesToAdd = array_diff($newServices, $existingServices);
        if (!empty($servicesToRemove)) {
            provider_child_services::where('provider_id', $request->id)->whereIn('service_id', $servicesToRemove)->delete();
        }
        foreach ($servicesToAdd as $serviceId) {
            $addprovider_child_services = new provider_child_services();
            $addprovider_child_services->provider_id = $request->id;
            $addprovider_child_services->service_id = $serviceId;
            $addprovider_child_services->save();
        }
        if ($request->availability_type) {
            $availabilityType = $request->availability_type;
            if ($availabilityType === 'zip_code' && $request->hasFile('zipcode')) {
                $file = $request->file('zipcode');
                $import = new UpdateZipcodesImport();
                $import->setProviderId($provider->id);
                Excel::import($import, $file);
            }
            if ($availabilityType === 'state_city' && $request->input('select_state')) {
                provider_states::where('provider_id', $provider->id)->delete();
                $states = $request->input('select_state');
                $city = $request->input('city');
                provider_states::updateOrCreate([
                    'provider_id' => $provider->id,
                    'state' => implode(',' , $states),
                    'city' => implode(',' , $city),
                ]);
            }
            if ($availabilityType === 'by_location' && $request->input('by_location')) {
                providerlocation::updateOrCreate(
                    ['provider_id' => $provider->id],
                    ['by_location' => $request->input('by_location')]
                );
            }
        }
        $attributes = $request->input('attributes', []);
        provider_attributes::where('provider_id', $provider->id)
            ->whereNotIn('attribute_id', array_keys(array_filter($attributes, fn($value) => !is_null($value))))
            ->delete();
        foreach ($attributes as $attributeId => $value) {
            if (!is_null($value)) {
                $value = is_array($value) ? implode(',', $value) : $value;
                provider_attributes::updateOrCreate(
                    ['provider_id' => $provider->id, 'attribute_id' => $attributeId],
                    ['value' => $value]
                );
            }
        }
        if ($request->input('submit_type') === 'exit') {
            return redirect('admin/services/providers');
        }elseif($request->input('submit_type') === 'addmore'){
            return redirect()->back()->with('message', 'Provider Updated Successfully');
        }

    }
    public function deleteprovider($id)
    {
        providers::where('id', $id)->delete();
        providerfaq::where('provider_id', $id)->delete();
        provider_attributes::where('provider_id', $id)->delete();
        providersReviews::where('provider_id', $id)->delete();
        plan::where('provider', $id)->delete();
        provider_states::where('provider_id', $id)->delete();
        return redirect()->back()->with('message', 'Provider Deleted Successfully');
    }
    public function allplans(Request $request)
    {
        $perPage = request()->input('per_page', 50);
        $perPage = is_numeric($perPage) ? (int) $perPage : 50;
        $perPage = $perPage > 0 ? $perPage : 50;
        $query = plan::whereHas('service', function ($query) {
            $query->where('trashstatus', 0);
        });
        // if ($request->has('name') && !empty($request->name)) {
        //     $query->where('planname', 'like', '%' . $request->name . '%');
        // }
        if ($request->has('parentservice') && !empty($request->parentservice)) {
            $query->whereHas('service', function ($query) use ($request) {
                $query->where('parentservice', $request->parentservice);
            });
        }
        if ($request->has('providerservice') && !empty($request->providerservice)) {
            $query->whereRaw("FIND_IN_SET(?, providerservice)", [$request->providerservice]);
        }
        if ($request->has('provider') && !empty($request->provider)) {
            $query->whereRaw("FIND_IN_SET(?, provider)", [$request->provider]);
        }
        if (request()->has('show_on_home_page') && !empty(request('show_on_home_page'))) {
            $query->where('show_on_home_page', request('show_on_home_page'));
        }
        if (request()->has('showthisonprovider') && !empty(request('showthisonprovider'))) {
            $query->where('showthisonprovider', request('showthisonprovider'));
        }
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        $data = $query->orderby('id', 'desc')->paginate($perPage);
        if ($request->ajax()) {
            $tableData = view('admin.services.render.plans_table', compact('data'))->render();
            $paginationLinks = $data->links('admin.pagination')->render();

            return response()->json([
                'tableData' => $tableData,
                'paginationLinks' => $paginationLinks
            ]);
        }
        return view('admin.services.allplans', compact('data'));
    }
    public function addplan()
    {
        $latestdata = plan::orderBy('created_at', 'desc')->first();
        return view('admin.services.addplan')->with(array('latestdata' => $latestdata));
    }
    public function createplan(Request $request)
    {
        $existingPlan = Plan::where('planname', $request->planname)->first();
        if ($existingPlan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Plan name already exists!'
            ]);
        }
        if($request->submit_type == 'preview')
        {
            $preview = $request;
            $data = Plan::where('provider', $request->provider)->get();
            return $html = view('admin.services.render.providerplan', compact('data','preview'))->render();
        }else{
            $add = new plan;
            $add->planname = $request->planname;
            $add->provider = $request->provider;
            $add->parentservice = $request->parentservice;
            $add->childservice = is_array($request->childservice) ? implode(',', $request->childservice) : $request->childservice;
            $add->providerservice = is_array($request->providerservice) ? implode(',', $request->providerservice) : $request->providerservice;
            $add->plantype = is_array($request->plantype) ? implode(',', $request->plantype) : $request->plantype;
            $add->originalprice = $request->originalprice;
            $add->price = $request->price;
            $add->beforeprice = $request->beforeprice;
            $add->afterprice = $request->afterprice;
            $add->showthisonprovider = $request->showthisonprovider;
            if ($request->planimage) {
                $add->planimage = Cmf::sendimagetodirectory($request->planimage);
            }
            if ($request->bannerimage) {
                $add->bannerimage = Cmf::sendimagetodirectory($request->bannerimage);
            }
            $add->isdisplaycallbtn = $request->isdisplaycallbtn;
            $add->callbutton = $request->callbutton;
            $add->providerphone = $request->providerphone;
            $add->slogan = $request->slogan;
            $add->specialpromotion = $request->specialpromotion;
            $add->bestsellertext = $request->bestsellertext;
            $add->isdisplaybuybtn = $request->isdisplaybuybtn;
            $add->buybuttontext = $request->buybuttontext;
            $add->buttontype = $request->buttontype;
            $add->ispopular = $request->ispopular;
            $add->populartext = $request->populartext;
            $add->plandetail = $request->plandetail;
            $add->plan_type_text = $request->plan_type_text;
            $add->line_price_1 = $request->line_price_1;
            $add->line_price_2 = $request->line_price_2;
            $add->line_price_3 = $request->line_price_3;
            $add->line_price_4 = $request->line_price_4;
            $add->line_price_5 = $request->line_price_5;
            $add->status = $request->status;
            $add->save();
            $attributes = $request->input('attributes');
            if ($attributes) {
                foreach ($attributes as $attributeId => $value) {
                    if (is_array($value)) {
                        $value = implode(',', $value);
                    }
                    plan_attributes::create([
                        'plan_id' => $add->id,
                        'attribute_id' => $attributeId,
                        'value' => $value,
                    ]);
                }
            }
            if($request->plancommission)
            {
                $newcommission = new commissions();
                $newcommission->country = DB::table('providers')->where('id' , $request->provider)->first()->country;
                $newcommission->parentservice = $request->parentservice;
                $newcommission->service = is_array($request->providerservice) ? implode(',', $request->providerservice) : $request->providerservice;
                $newcommission->provider = $request->provider;
                $newcommission->plan = $add->id;
                $newcommission->amount = $request->plancommission;
                $newcommission->save();
            }
        }
    }
    public function getproviderplan($id)
    {
        $provider = Providers::where('id', $id)->first();
        if (!$provider) {
            return response()->json([
                'html' => "<h2 class='text-center'>Provider not found.</h2>",
                'provider' => null,
                'services' => []
            ]);
        }
        $data = Plan::where('provider', $id)->get();
        if ($data->isNotEmpty()) {
            $html = view('admin.services.render.providerplan', compact('data'))->render();
        } else {
            $html = "<h2 class='text-center mt-4'>There Is No Plan Against " . $provider->name . "</h2>";
        }
        // Fetch provider services
        $providerServices = provider_child_services::where('provider_id', $id)->get();
        $services = [];
        foreach ($providerServices as $r) {
            $service = DB::table('services')->where('id', $r->service_id)->first();
            if ($service) {
                $services[] = ['id' => $service->id, 'name' => $service->name];
            }
        }
        return response()->json([
            'html' => $html,
            'provider' => $provider,
            'services' => $services
        ]);
    }
    public function editplan($id)
    {
        $data = plan::findOrFail($id);
        return view('admin.services.editplan')->with(array('data' => $data));

    }
    public function updateplan(Request $request)
    {
        $update = plan::find($request->id);
        $update->planname = $request->planname;
        $update->provider = $request->provider;
        $update->parentservice = $request->parentservice;
        $update->childservice = is_array($request->childservice) ? implode(',' , $request->childservice) : $request->childservice;
        $update->providerservice = is_array($request->providerservice) ? implode(',', $request->providerservice) : $request->providerservice;
        $update->plantype = is_array($request->plantype) ? implode(',', $request->plantype) : $request->plantype;
        $update->originalprice = $request->originalprice;
        $update->price = $request->price;
        $update->beforeprice = $request->beforeprice;
        $update->afterprice = $request->afterprice;
        $update->showthisonprovider = $request->showthisonprovider;
        if ($request->planimage) {
            $update->planimage = Cmf::sendimagetodirectory($request->planimage);
        }
        if ($request->bannerimage) {
            $update->bannerimage = Cmf::sendimagetodirectory($request->bannerimage);
        }
        $update->isdisplaycallbtn = $request->isdisplaycallbtn;
        $update->callbutton = $request->callbutton;
        $update->providerphone = $request->providerphone;
        $update->slogan = $request->slogan;
        $update->specialpromotion = $request->specialpromotion;
        $update->bestsellertext = $request->bestsellertext;
        $update->isdisplaybuybtn = $request->isdisplaybuybtn;
        $update->buybuttontext = $request->buybuttontext;
        $update->buttontype = $request->buttontype;
        $update->ispopular = $request->ispopular;
        $update->populartext = $request->populartext;
        $update->plandetail = $request->plandetail;
        $update->show_on_home_page = $request->show_on_home_page;
        $update->plan_type_text = $request->plan_type_text;
        $update->line_price_1 = $request->line_price_1;
        $update->line_price_2 = $request->line_price_2;
        $update->line_price_3 = $request->line_price_3;
        $update->line_price_4 = $request->line_price_4;
        $update->line_price_5 = $request->line_price_5;
        $update->status = $request->status;
        $attributes = $request->input('attributes');
        if ($attributes) {
            foreach ($attributes as $attributeId => $value) {
                if (is_array($value)) {
                    $value = implode(',', $value);
                }
                $providerAttribute = plan_attributes::updateOrCreate(
                    ['plan_id' => $update->id, 'attribute_id' => $attributeId],
                    ['value' => $value]
                );
            }
        }
        $update->save();

        if($request->plancommission)
        {
            $check = commissions::where('plan' , $update->id)->first();
            if($check)
            {
                $updatecommission = commissions::find($check->id);
                $updatecommission->amount = $request->plancommission;
                $updatecommission->save();
            }else{
                $newcommission = new commissions();
                $newcommission->country = DB::table('providers')->where('id' , $request->provider)->first()->country;
                $newcommission->parentservice = $request->parentservice;
                $newcommission->service = is_array($request->providerservice) ? implode(',', $request->providerservice) : $request->providerservice;
                $newcommission->provider = $request->provider;
                $newcommission->plan = $update->id;
                $newcommission->amount = $request->plancommission;
                $newcommission->save();
            }
        }
        return redirect()->back()->with('message', 'Plan Update Successfully');
    }

    public function deleteplan($id)
    {
        plan_attributes::where('plan_id' , $id)->delete();
        plan::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Plan Deleted Successfully');
    }
    public function getplanchildservices($id)
    {
        $data = services::where('parent_id', $id)->get();
        $selectedServiceId = '';
        $internetService = $data->firstWhere('name', 'Internet');
        if ($internetService) {
            $selectedServiceId = $internetService->id;
        }
        echo '<option value="">Select Child Services</option>';
        foreach ($data as $r) {
            $selected = ($r->id == $selectedServiceId) ? 'selected' : '';
            echo '<option value="'.$r->id.'" '.$selected.'>'.$r->name.'</option>';
        }
    }
    public function getprovider(Request $request)
    {
        $services = $request->input('services');

        // Ensure $services is an array
        if (is_array($services)) {
            // Fetch providers based on services with a join
            $providers = DB::table('provider_child_services')
                ->join('providers', 'provider_child_services.provider_id', '=', 'providers.id')
                ->whereIn('provider_child_services.service_id', $services)
                ->select('providers.id', 'providers.name') // Select the needed fields
                ->distinct() // Ensure unique results
                ->get();
        } else {
            $providers = collect(); // Return an empty collection
        }

        // Generate HTML for options
        echo '<option value="">Select Providers</option>';
        foreach ($providers as $provider) {
            echo '<option value="' . $provider->id . '">' .$provider->name. '</option>';
        }
    }
    public function getproviderdetail($id)
    {
        $zip = provider_zipcodes::where('provider_id' , $id)->get();
        $data = providers::where('id' , $zip->id)->pluck('description')->get();
        return response()->json($data);
    }
    public function getattributes(Request $request)
    {
        $ids = (array) $request->input('service_id');
        $data = atribute::whereIn('service_id', $ids)->get();
            $lines = DB::table('services')->whereIn('id', $ids)->where('name', 'Mobile')->first();
        
        if(isset($request->provider_id))
        {
            $provider_id = $request->provider_id;
            $html = view('admin.services.render.getattributes', compact('data','provider_id' , 'lines'))->render();
        }else{
            if(isset($request->plan_id))
            {
                $plan_id = $request->plan_id;
                $html = view('admin.services.render.getattributes', compact('data','plan_id' , 'lines'))->render();
            }else{
                $html = view('admin.services.render.getattributes', compact('data' , 'lines'))->render();
            }
        }
        return $html;
    }
    public function getchildeattributes($id)
    {
        $idsArray = explode(',', $id);
        $attributes = atribute::whereIn('service_id', $idsArray)->get();
        return response()->json($attributes);
    }
    public function downloadzipcode($id)
    {
        return Excel::download(new ZipCodesExport($id), "provider_{$id}_zipcodes.xlsx");
    }
    public function importprovider(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new ProvidersImport, $request->file('file'));

        return back()->with('success', 'Providers imported successfully.');
    }
    public function exportprovider()
    {
        return Excel::download(new ProvidersExport, 'providers.xlsx');
    }
    public function importplans(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new PlansImport, $request->file('file'));

        return redirect()->back()->with('success', 'Plans imported successfully.');
    }
    public function planexport() 
    {
        return Excel::download(new PlansExport, 'plans.xlsx');
    }
    public function allquestion(Request $request, $id)
    {
        $perPage = $request->input('per_page', 50);
        $perPage = is_numeric($perPage) ? (int) $perPage : 50;
        $perPage = $perPage > 0 ? $perPage : 50;
        $service = services::findOrFail($id);
        $query = service_questions::where('service_id', $id)
            ->whereHas('service', function ($query) {
                $query->where('trashstatus', 0);
            });
        if ($request->filled('question')) {
            $query->where('question', 'like', '%' . $request->question . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $data = $query->orderBy('order_column')->paginate($perPage);
        if ($request->ajax()) {
            $tableData = view('admin.services.render.question_table', compact('data', 'service'))->render();
            $paginationLinks = $data->links('admin.pagination')->render();

            return response()->json([
                'tableData' => $tableData,
                'paginationLinks' => $paginationLinks
            ]);
        }
        return view('admin.services.allquestion', compact('data', 'service'));
    }
    public function allquestions(Request $request)
    {
        $perPage = $request->input('per_page', 50);
        $perPage = is_numeric($perPage) ? (int) $perPage : 50;
        $perPage = $perPage > 0 ? $perPage : 50;

        // Sabhi questions
        $query = service_questions::whereHas('service', function ($query) {
            $query->where('trashstatus', 0);
        });

        if ($request->filled('question')) {
            $query->where('question', 'like', '%' . $request->question . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('order_column')->paginate($perPage);

        if ($request->ajax()) {
            $tableData = view('admin.services.render.question_table', compact('data'))->render();
            $paginationLinks = $data->links('admin.pagination')->render();

            return response()->json([
                'tableData' => $tableData,
                'paginationLinks' => $paginationLinks
            ]);
        }

        return view('admin.services.allquestion', compact('data'));
    }
    public function askquestion()
    {
        return view('admin.services.askquestion');
    }
    public function addquestionanswer(Request $request)
    {
        $maxOrder = service_questions::max('order_column');
        $order = $maxOrder ? $maxOrder + 1 : 1;

        $add = new service_questions();
        $add->service_id = $request->service_id;
        $add->question = $request->question;
        $add->question_type = $request->question_type;
        $add->status = 1;
        $add->order_column = $order;
        $add->save(); 
        if ($request->answer) {
            foreach ($request->answer as $ans) {
                if ($ans) {
                    $addans = new service_question_answers();
                    $addans->question_id = $add->id;
                    $addans->answer = $ans;
                    $addans->save();
                }
            }
        }
        if ($request->input('submit_type') === 'exit') {
            return redirect('admin/services/allquestion/' . $add->service_id);
        } elseif ($request->input('submit_type') === 'addmore') {
            return redirect()->back()->with('message', 'Service Question Added Successfully');
        }
    }
    public function changequestionstatus($id)
    {
        $updateincategory  = service_questions::find($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Status Updated Successfully'); 
    }
    public function editquestion($id)
    {
    $data = service_questions::find($id);
    
    if (!$data) {
        return redirect()->back()->withErrors('Question not found.');
    }

    $service = services::find($data->service_id);
    
    $answer = service_question_answers::where('question_id', $data->id)->get();

    return view('admin.services.editquestion', compact('data', 'answer', 'service'));
    }
    public function updatequestionanswer(Request $request)
    {
        $update = service_questions::find($request->id);
        $update->service_id = $request->service_id;
        $update->question = $request->question;
        $update->question_type = $request->question_type;
        $update->status = 1;
        $update->save();
        service_question_answers::where('question_id', $request->id)->delete();
        if ($request->answer) {
            foreach ($request->answer as $ans) {
                if ($ans) {
                    $addans = new service_question_answers();
                    $addans->question_id = $update->id;
                    $addans->answer = $ans;
                    $addans->save();
                }
            }
        }
        if ($request->input('submit_type') === 'exit') {
            return redirect('admin/services/allquestion/' . $update->service_id);
        } elseif ($request->input('submit_type') === 'addmore') {
            return redirect()->back()->with('message', 'Service Question Updated Successfully');
        }
    }
    public function deletequestion($id)
    {
        answerquestions::where('question_id' , $id)->delete();
        service_question_answers::where('question_id' , $id)->delete();
        service_questions::where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Service Question Deleted Successfully');
    }
    public function allattribute(Request $request)
    {
        $perPage = $request->input('per_page', 50);
        $perPage = is_numeric($perPage) ? (int) $perPage : 50;
        $perPage = $perPage > 0 ? $perPage : 50;
        $query = atribute::whereHas('service', function ($query) {
            $query->where('trashstatus', 0);
        });
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $data = $query->orderBy('order_column')->paginate($perPage);
        if ($request->ajax()) {
            $tableData = view('admin.services.render.attributes_table', compact('data'))->render();
            $paginationLinks = $data->links('admin.pagination')->render();

            return response()->json([
                'tableData' => $tableData,
                'paginationLinks' => $paginationLinks
            ]);
        }
        return view('admin.services.allattribute', compact('data'));
    }
    public function saveattibutes(Request $request)
    {

        $maxOrder = atribute::max('order_column');
        $order = $maxOrder ? $maxOrder + 1 : 1;

        $add = new atribute;
        $add->type = $request->type;
        $add->name = $request->name;
        $add->value = implode(',' , $request->value);
        $add->status = 1;
        $add->service_id = $request->service_id;
        $add->order_column = $order;
        $add->save();
        return redirect()->back()->with('message', 'Attributes Add Successfully');
    }
    public function updatattribute(Request $request)
    {
        $update = atribute::find($request->id);
        if($request->type == 'Text') {
        $update->type = $request->type;
        $update->name = $request->name;
        $update->value = ' ';
        }else{
        $update->type = $request->type;
        $update->name = $request->name;
        $update->value = implode(',' , $request->value);
        $update->status = 1;
        }
        $update->save();
        return redirect()->back()->with('message', 'Attributes Update Successfully');
    }
    public function editattribute(Request $request)
    {
        $data = atribute::find($request->id);
        $html = view('admin.services.editattributerender', compact('data'))->render();
        return $html;
    }
    public function deleteattribute($id)
    {
        atribute::where('id' , $id)->delete();
        return redirect()->back()->with('message' , 'Attribute Deleted Successfully');
    }
    public function changeattributestatus($id)
    {
        $updateincategory  = atribute::find($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Attributes Status Updated Successfully'); 
    }
    public function providerfaq($id)
    {
        $faq =  providerfaq::where('provider_id' , $id)->paginate(10);
        $data = providers::where('id' , $id)->first();
        return view('admin.services.providerfaq')->with(array('data' => $data,'faq' => $faq));
    }
    public function createproviderfaq(Request $request)
    {
        $add = new Providerfaq;
        $add->provider_id = $request->provider_id;
        $add->question = $request->question;
        $add->answer = $request->answer;
        $add->status = 1;
        $add->save();
        return redirect()->back()->with('message' , 'Provider FAQ Add Successfully');
    }
    public function changeproviderfaqstatus($id)
    {
        $updateincategory  = Providerfaq::find($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Status Updated Successfully'); 
    }
    public function updateproviderfaq(Request $request)
    {
        $update = Providerfaq::find($request->id);
        $update->provider_id = $request->provider_id;
        $update->question = $request->question;
        $update->answer = $request->answer;
        $update->save();
        return redirect()->back()->with('message' , 'Provider FAQ Update Successfully');
    }
    public function deleteproviderfaq($id)
    {
        Providerfaq::where('id' , $id)->delete();
        return redirect()->back()->with('message' , 'Provider FAQ Deleted Successfully');
    }
    public function providerreview($id)
    {
        $data = providers::where('id' , $id)->first();
        $review = providersReviews::where('provider_id' , $id)->paginate(10);
        return view('admin.services.providerreview')->with(array('data' => $data,'review' => $review));
    }
    public function changeproviderreviewstatus($id)
    {
        $updateincategory  = providersReviews::find($id);
        if($updateincategory->status == 1)
        {
            $updateincategory->status = 2;
        }else{
            $updateincategory->status = 1;
        }
        $updateincategory->save();
        return redirect()->back()->with('message', 'Status Updated Successfully'); 
    }
    public function createproviderreview(Request $request)
    {
        $add = new providersReviews;
        $add->provider_id = $request->provider_id;
        $add->clintname = $request->clintname;
        $add->reviewfrom = $request->reviewfrom;
        $add->review = $request->review;
        $add->ratting = $request->ratting;
        $add->status = 1;
        $add->save();
        return redirect()->back()->with('message' , 'Provider Review Add Successfully');
    }
    public function updateproviderreview(Request $request)
    {
        $update = providersReviews::find($request->id);
        $update->provider_id = $request->provider_id;
        $update->clintname = $request->clintname;
        $update->reviewfrom = $request->reviewfrom;
        $update->review = $request->review;
        $update->ratting = $request->ratting;
        $update->save();
        return redirect()->back()->with('message' , 'Provider Review Update Successfully');
    }
    public function deleteproviderreview($id)
    {
        providersReviews::where('id' , $id)->delete();
        return redirect()->back()->with('message' , 'Provider Review Deleted Successfully');
    }
    public function updateOrder(Request $request)
    {
        $order = $request->input('order');
        $position = 1;

        foreach ($order as $id) {
            DB::table('atributes')
                ->where('id', $id)
                ->update(['order_column' => $position]);

            $position++;
        }
        return response()->json(['success' => true]);
    }
    public function updatequestionorder(Request $request)
    {
        $order = $request->input('order');
        $position = 1;

        foreach ($order as $id) {
            DB::table('service_questions')
                ->where('id', $id)
                ->update(['order_column' => $position]);

            $position++;
        }
        return response()->json(['success' => true]);
    }

    public function getchildeservice($id)
    {
        $provider = provider_child_services::where('provider_id', $id)->get();
        echo '<option value="">Provider Services Offered</option>';
        foreach ($provider as $r) {
            $service = DB::table('services')->where('id', $r->service_id)->first();
            if ($service) {
                echo '<option value="' . $service->id . '" data-service-name="' . $service->name .'">' . $service->name . '</option>';
            }
        }
    }
    public function getallprovider($id)
    {
        $data = providers::get();
        echo '<option value="">Select Providers</option>
        <option value="all">All Providers</option>';
        foreach ($data as $r) {
            echo '<option value="'.$r->id.'">'.$r->name.'</option>';
        }
    }
     public function getcity(Request $request)
    {
        $stateCodes = $request->states;

        $cities = states::whereIn('code', $stateCodes)
                        ->groupBy('city')
                        ->get();

        $options = '<option value="">Select City</option>';
        foreach ($cities as $city) {
            $options .= '<option value="' . $city->city . '">' . $city->city . '</option>';
        }

        echo $options;
    }
    public function getavailability(Request $request)
    {
        $type = $request->get('availability_type');
        $html = '';

        if ($type == 'zip_code') {
            $html = view('admin.services.render.zip_code')->render(); 
        } elseif ($type == 'state_city') {
            $html = view('admin.services.render.state_city')->render(); 
        } elseif ($type == 'by_location') {
            $html = view('admin.services.render.by_location')->render();
        } else {
            return response()->json(['error' => 'Invalid type selected'], 400);
        }

        return response()->json(['html' => $html]);
    }
    public function editavailability(Request $request)
    {
        $type = $request->get('availability_type');
        $provider = providers::find($request->provider_id);
        $html = '';

        if (!$provider) {
            return response()->json(['error' => 'Provider not found'], 404);
        }
        if ($type == 'zip_code') {
        $html = view('admin.services.render.editzipcode', compact('provider'))->render();
        } elseif ($type == 'state_city') {
            // Pass additional data if needed
            $states = DB::table('provider_states')->where('provider_id', $provider->id)->first();
            $selectedStates = $states ? explode(',', $states->state) : [];
            $selectedCities = $states ? explode(',', $states->city) : [];
            $html = view('admin.services.render.editstate_city', compact('provider', 'selectedStates', 'selectedCities'))->render();
        } elseif ($type == 'by_location') {
            $locationData = DB::table('providerlocations')->where('provider_id', $provider->id)->first();
            $html = view('admin.services.render.editby_location', compact('provider', 'locationData'))->render();
        } else {
            return response()->json(['error' => 'Invalid type selected'], 400);
        }

        return response()->json(['html' => $html]);
    }
    public function addanswer(Request $request)
    {
        $newAnswer = DB::table('service_question_answers')->insert([
            'answer' => '', // Default empty value
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if ($newAnswer) {
            return redirect()->back()->with('message' , 'Row added successfully');
        } else {
            return redirect()->back()->with('message' , 'Failed to add row');
        }
    }
}