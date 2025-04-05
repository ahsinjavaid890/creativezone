<?php

namespace App\Http\Controllers;
use App\Helpers\Cmf;
use App\Helpers\helpers;
use Illuminate\Http\Request;
use App\Models\companies;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Mail;
use Redirect;
use Session;
use Auth;
class ApiController extends Controller
{
    public function getplanbyzipcode($zipcode)
    {
        $providerIds = DB::table('provider_zipcodes')->where('zipcode', $zipcode)->pluck('provider_id');
        if ($providerIds->isEmpty()) {
            return response()->json(['message' => 'No providers found for the given zipcode'], 404);
        }
        $providers = DB::table('providers')
            ->whereIn('id', $providerIds)
            ->select('id', 'name', 'provider_url', 'phone', 'email')
            ->where('status', 1)
            ->get()
            ->keyBy('id'); 
        $plans = DB::table('plans')
            ->where('status', 1)
            ->whereIn('provider', $providerIds)
            ->select('slogan','plandetail','plantype', 'originalprice', 'planname', 'price', 'beforeprice', 'planimage', 'bannerimage', 'isdisplaycallbtn', 'callbutton', 'slogan', 'specialpromotion', 'status', 'provider')
            ->get();
        $plansWithProviders = $plans->map(function ($plan) use ($providers) {
            $plan->provider = $providers->get($plan->provider);
            $plan->planimage = url('public/images/' . $plan->planimage);
            $plan->bannerimage = url('public/images/' . $plan->bannerimage);
            return $plan;
        });
        return response()->json($plansWithProviders);
    }
    public function getproviderbyzipcode($zipcode)
    {
        $providerIds = DB::table('provider_zipcodes')
            ->where('zipcode', $zipcode)
            ->pluck('provider_id');
        if ($providerIds->isEmpty()) {
            return response()->json(['message' => 'No providers found for the given zipcode'], 404);
        }
        $providers = DB::table('providers')
            ->whereIn('id', $providerIds)
            ->where('status', 1)
            ->select('id', 'name', 'provider_url', 'phone', 'email')
            ->get();
        return response()->json($providers);
    }    
    public function getprovider($zipcode)
    {
        $providerIds = DB::table('provider_zipcodes')
            ->where('zipcode', $zipcode)
            ->pluck('provider_id');
        
        if ($providerIds->isEmpty()) {
            return response()->json(['message' => 'No providers found for the given zipcode'], 404);
        }

        $providers = DB::table('providers')
            ->whereIn('id', $providerIds)
            ->where('status', 1)
            ->select('id', 'name', 'provider_url', 'phone', 'email', 'logo', 'termandconditon', 'description')
            ->get();
            
                
        foreach ($providers as $provider) {
            $provider->reviews = DB::table('providers_reviews')
                ->where('provider_id', $provider->id)
                ->where('status', 1)
                ->select('clintname', 'reviewfrom', 'review', 'ratting', 'status')
                ->get();

            $attributes = DB::table('provider_attributes')
                ->where('provider_id', $provider->id)
                ->select('attribute_id', 'value')
                ->get();
            
            $attributeIds = $attributes->pluck('attribute_id');

            $cheapestPlanPrice = DB::table('plans')
                ->where('status', 1)
                ->where('provider', $provider->id)
                ->min('price');

            $provider->plans = $cheapestPlanPrice;

            $provider->attributes = DB::table('atributes')
                ->whereIn('id', $attributeIds)
                ->where('status', 1)
                ->select('id', 'type', 'name', 'status')
                ->get()
                ->map(function ($attribute) use ($attributes) {
                    $attribute->value = $attributes->firstWhere('attribute_id', $attribute->id)->value;
                    return $attribute;
                });

            $provider->logo = url('public/images/' . $provider->logo);

        }

        return response()->json($providers);
    }

}