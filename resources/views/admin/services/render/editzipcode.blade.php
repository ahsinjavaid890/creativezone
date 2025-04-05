<div class="row" id="zip_code">
    <div class="col-md-12">
        <label>Select File for Update Zip Codes</label>
        <input type="file" class="form-control form-group mb-3" name="zipcode">

        @php
            $zipcodes = DB::table('provider_zipcodes')->where('provider_id' , $provider->id)->count();
        @endphp

        @if($zipcodes > 0)
        There are {{ $zipcodes }} Zipcodes. For Download {{ $provider->name }} Existing Zipcode in Excel <a class="mt-5" href="{{ url('admin/services/downloadzipcode', $provider->id) }}">Click Here</a>
        @else
        <span class="text-danger">There is no any Zipcode Added. For Download Zipcode Template <a download="" href="{{ url('public/images/zipcode_template.xlsx') }}">Click Here</a> </span> 
        @endif
    </div>
</div>