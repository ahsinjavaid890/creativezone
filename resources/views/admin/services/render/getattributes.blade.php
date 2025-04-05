@if(isset($provider_id))
    @foreach($data as $r)
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ $r->name }}</label>
                @if($r->type == 'Text')
                    @php
                        $provider_attributes = DB::table('provider_attributes')->where('provider_id' , $provider_id)->where('attribute_id' , $r->id)->first();
                    @endphp
                    <input type="text" @if($provider_attributes) value="{{ $provider_attributes->value }}" @endif class="form-control" name="attributes[{{ $r->id }}][]">
                @endif
                @if($r->type == 'Radio')
                    @php
                        $provider_attributes = DB::table('provider_attributes')->where('provider_id', $provider_id)->where('attribute_id', $r->id)->first();
                    @endphp
                    <select class="selecttwo" name="attributes[{{ $r->id }}][]"> 
                        @foreach(explode(',' , $r->value) as $v)
                            <option value="{{ $v }}"
                                @if($provider_attributes)
                                    @foreach(explode(',' , $provider_attributes->value) as $av)
                                        @if($av == $v) selected @endif
                                    @endforeach
                                @endif
                            >{{ $v }}</option>
                        @endforeach
                    </select>
                    <script type="text/javascript">
                        $('.selecttwo').select2();
                    </script>
                @endif
                @if($r->type == 'Checkbox')
                    @php
                        $provider_attributes = DB::table('provider_attributes')->where('provider_id', $provider_id)->where('attribute_id', $r->id)->first();
                    @endphp
                    <select multiple class="selecttwo" name="attributes[{{ $r->id }}][]"> 
                        @foreach(explode(',' , $r->value) as $v)
                            <option value="{{ $v }}"
                                @if($provider_attributes)
                                    @foreach(explode(',' , $provider_attributes->value) as $av)
                                        @if($av == $v) selected @endif
                                    @endforeach
                                @endif
                            >{{ $v }}</option>
                        @endforeach
                    </select>
                    <script type="text/javascript">
                        $('.selecttwo').select2();
                    </script>
                @endif
            </div>
        </div>
    @endforeach
@else
    @if(isset($plan_id))
        @if($plan_id == 'addplan')
            @foreach($data as $r)
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ $r->name }}</label>
                        @if($r->type == 'Text')
                            @php
                                $plan_attributes = DB::table('plan_attributes')->where('plan_id' , $plan_id)->where('attribute_id' , $r->id)->first();
                            @endphp
                            <input type="text" @if($plan_attributes) value="{{ $plan_attributes->value }}" @endif class="form-control" name="attributes[{{ $r->id }}][]">
                        @endif
                        @if($r->type == 'Radio')
                            @php
                                $plan_attributes = DB::table('plan_attributes')->where('plan_id', $plan_id)->where('attribute_id', $r->id)->first();
                            @endphp
                            <select class="selecttwo" name="attributes[{{ $r->id }}][]"> 
                                @foreach(explode(',' , $r->value) as $v)
                                    <option value="{{ $v }}"
                                        @if($plan_attributes)
                                            @foreach(explode(',' , $plan_attributes->value) as $av)
                                                @if($av == $v) selected @endif
                                            @endforeach
                                        @endif
                                    >{{ $v }}</option>
                                @endforeach
                            </select>
                            <script type="text/javascript">
                                $('.selecttwo').select2();
                            </script>
                        @endif
                        @if($r->type == 'Checkbox')
                            @php
                                $plan_attributes = DB::table('plan_attributes')->where('plan_id', $plan_id)->where('attribute_id', $r->id)->first();
                            @endphp
                            <select multiple class="selecttwo" name="attributes[{{ $r->id }}][]"> 
                                @foreach(explode(',' , $r->value) as $v)
                                    <option value="{{ $v }}"
                                        @if($plan_attributes)
                                            @foreach(explode(',' , $plan_attributes->value) as $av)
                                                @if($av == $v) selected @endif
                                            @endforeach
                                        @endif
                                    >{{ $v }}</option>
                                @endforeach
                            </select>
                            <script type="text/javascript">
                                $('.selecttwo').select2();
                            </script>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
        
        @if(isset($lines->name) && $lines->name == 'Mobile')
            <div class="col-md-12" id="lines-section">
                <div class="form-group">
                    <label class="lable-control">Plan Type text</label>
                    <input type="text" placeholder="" name="plan_type_text" class="form-control">
                </div>
            </div>
            @for($i = 1; $i < 6; $i++)
                <div class="col-md-12" id="line-inputs">
                    <div class="form-group">
                        <label class="lable-control">Line Price {{ $i }}</label>
                        <input placeholder="Line Price {{ $i }}" name="line_price_{{ $i }}" class="form-control">
                    </div>
                </div>
            @endfor
        @endif
    @else
        @foreach($data as $r)
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ $r->name }}</label>
                    @if($r->type == 'Text')
                        <input type="text" class="form-control" name="attributes[{{ $r->id }}][]">
                    @endif
                    @if($r->type == 'Radio')
                        <select class="selecttwo" name="attributes[{{ $r->id }}][]"> 
                            @foreach(explode(',' , $r->value) as $v)
                                <option value="{{ $v }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <script type="text/javascript">
                            $('.selecttwo').select2();
                        </script>
                    @endif
                    @if($r->type == 'Checkbox')
                        <select multiple class="selecttwo" name="attributes[{{ $r->id }}][]"> 
                            @foreach(explode(',' , $r->value) as $v)
                                <option value="{{ $v }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <script type="text/javascript">
                            $('.selecttwo').select2();
                        </script>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@endif
