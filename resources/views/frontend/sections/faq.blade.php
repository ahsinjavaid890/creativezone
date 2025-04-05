<div class="freque_asked_section pb-60">
   <div class="container">
       <div class="row">
           <div class="heading_sp pb-40">
               <h3 class="text-center">Any Questions Before Selling Your Device?</h3>
               <p class="text-center">You have questions - we have answers. Here are some of the most common questions customers ask before selling their <br> devices. If you can't find the answer to your question below, just reach out to our friendly support team.</p>
           </div>

           <div class="cardfg_acco">

               <div class=" accordion" id="accordionExample">
                    @foreach($faq as $r)
                   <div class="accordion-item">
                       <h2 class="accordion-header" id="heading{{ $r->id }}">
                           <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $r->id }}" aria-expanded="false" aria-controls="collapse{{ $r->id }}">
                               {{ $r->question }}
                           </button>
                       </h2>
                       <div id="collapse{{ $r->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $r->id }}" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                               {!! $r->answer !!}
                           </div>
                       </div>
                   </div>
                   @endforeach
               </div>
           </div>
       </div>
   </div>
</div>