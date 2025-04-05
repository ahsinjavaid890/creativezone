<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Ask Question</label>
            <input type="text" class="form-control" name="question" value="{{ $data->question }}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Select Type</label>
            <select onchange="selecttype(this.value)" class="form-control" id="question_type" name="question_type">
                <option selected="" value="">Choose Question Type</option>
                <option @if($data->question_type == 'checkbox') selected @endif value="checkbox">Single Choice</option>
                <option @if($data->question_type == 'radio') selected @endif value="radio">Multiple Choice</option>
                <option @if($data->question_type == 'text') selected @endif value="text">Text</option>
                <option @if($data->question_type == 'date') selected @endif value="date">Date</option>
            </select>
        </div>
    </div>
    @if($data->question_type != 'text' && $data->question_type != 'date')
    <div class="answer-container col-md-12">
        @php
            $answer = DB::table('service_question_answers')->where('question_id', $data->id)->get();
        @endphp
        @foreach($answer as $r)
        <div class="row row-to-clone">
            <div class="col-md-10">
                <div class="form-group">
                    <label class="form-label">Answer {{ $loop->iteration }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $r->answer }}" name="answer[]">
                    </div>
                </div>
            </div>
            <div class="col-md-2 pt-2">
                <span onclick="removeanswer({{ $r->id }})" class="material-icons remove-circle" style="cursor: pointer;">remove_circle</span>
                @if ($loop->last)
                    <span class="material-icons add-circle pl-5" style="cursor: pointer;">add_circle</span>
                @endif
            </div>
        </div>
        @endforeach
        <div class="row row-to-clone">
            <div class="col-md-10">
                <div class="form-group">
                    <label class="form-label">Answer</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="" name="answer[]">
                    </div>
                </div>
            </div>
            <div class="col-md-2 pt-2">
                <span class="material-icons add-circle pl-5" style="cursor: pointer;">add_circle</span>
            </div>
        </div>
    </div>
    @endif
</div>
<script type="text/javascript">
function selecttype(id) {
    var questionid = '{{ $data->id }}';
    $.ajax({
        url: "{{ url('admin/services/selecttypeinquestion') }}",
        type: "GET",
        data: { 
            id: id,
            questionid: questionid
        },
        success: function (data) {
            $('.questioncard').html(data);
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}
function removeanswer(id) {
    
}
</script>