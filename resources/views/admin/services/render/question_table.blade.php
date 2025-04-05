@foreach($data as $r)
 <tr  data-id="{{ $r->id }}">
    @php
        $services = DB::table('services')->where('id' , $r->service_id)->first()
    @endphp
     @if (!Request::is('admin/services/allquestions'))
     <td class="text-center"> <a href="{{ url('admin/services/editservice') }}/{{ $service->id }}">{{ $service->name }}</a> </td>
     @else
     <td class="text-center"> <a href="{{ url('admin/services/editservice') }}/{{ $services->id }}">{{ $services->name }}</a> </td>
     @endif
     <td style="width: 200px;" class="text-center">
         <a href="{{ url('admin/services/editquestion') }}/{{ $r->id }}">{{ $r->question }}</a>
     </td>
     <td class="text-center">{{ $r->question_type }}</td>
     @php
     $ans = DB::table('service_question_answers')->where('question_id' , $r->id)->get();
     @endphp
     <td style="width: 200px;" class="text-center">
         @foreach($ans as $s)
         {{ $s->answer }}@if(!$loop->last), @endif
         @endforeach
     </td>
     <td class="text-center pr-0">
         <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/services/changequestionstatus') }}/{{ $r->id }}")'>
             @if($r->status == 1)
             <span class="label label-lg label-success label-inline">Enable</span>
             @endif
             @if($r->status == 2)
             <span class="label label-lg label-danger label-inline">Disable</span>
             @endif
             @if($r->status == 3)
             <span class="label label-lg label-light-warning label-inline">Draft</span>
             @endif
         </a>
     </td>
     <td class="text-center pr-0">
        <a href="{{ url('admin/services/editquestion') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
           <span class="material-symbols-outlined">edit</span>
        </a>
        <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/services/deletequestion') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
           <span class="material-symbols-outlined">delete</span>
        </a>
     </td>
 </tr>
 @endforeach