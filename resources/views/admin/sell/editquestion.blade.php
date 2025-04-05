@extends('admin.layouts.main-layout')
@section('title','Update Question')
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update Question
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Sell Management
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/sell/questions') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Questions
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update Question : <b class="text-danger">{{ $question->question_text }}</b>
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            @include('alerts.index')
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Update Question : <b class="text-danger">{{ $question->question_text }}</b></span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/sell/updatequestion') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $question->id }}">
                                <input type="hidden" name="trash_status" value="active">
                                <input type="hidden" name="status" value="1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select Category<span class="text-danger">*</span></label>
                                            <select onchange="selectcategory(this.value)" class="form-control"  name="category_id">
                                                <option value="">Select Category</option>
                                                @foreach(DB::table('categories')->where('category_type' , 'sell')->where('status' , 1)->get() as $r)
                                                <option @if($question->category_id == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select Modal<span class="text-danger">*</span></label>
                                            <select class="form-control" id="model_id"  name="model_id">
                                                <option value="">Select Modal</option>
                                                @foreach(DB::table('models')->where('category_id' , $question->category_id)->where('status' , 1)->get() as $r)
                                                <option @if($question->model_id == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="question_text" class="form-label">Question</label>
                                             <input type="text" class="form-control" id="question_text" name="question_text" value="{{ $question->question_text }}" >
                                        </div>
                                    </div>
                                </div>
                                <div id="options">
                                    @foreach($question->options as $option)
                                    <div class="card p-5 mb-3 option">
                                        <div class="row">
                                            <input type="hidden" name="options[{{ $option->id }}][id]" value="{{ $option->id }}">
                                            <div class="col-md-6">
                                                <label for="option_text" class="form-label">Option</label>
                                                <input type="text" class="form-control" name="options[{{ $option->id }}][option_text]" value="{{ $option->option_text }}" >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="number" class="form-control" name="options[{{ $option->id }}][price]" step="0.01" value="{{ $option->price }}" >
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <span class="material-symbols-outlined close-icon" style="cursor: pointer;">close</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" id="addOption" class="btn btn-secondary mb-3">Add Option</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    function selectcategory(id) {
        $.ajax({
            type: 'GET',
            url: '{{ url("admin/ecommerce/selectcategory") }}/' + id,
            success: function (data) {
                $('#model_id').html(data)
            }
        });
    }

    let optionCount = {{ $question->options->count() }};

    document.getElementById('addOption').addEventListener('click', () => {
        const optionsDiv = document.getElementById('options');
        const newOption = document.createElement('div');
        newOption.classList.add('card', 'p-5', 'mb-3', 'option');
        newOption.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label for="option_text" class="form-label">Option</label>
                    <input type="text" class="form-control" name="options[new_${optionCount}][option_text]" >
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" name="options[new_${optionCount}][price]" step="0.01" >
                </div>
                <div class="col-md-12 text-right">
                    <span class="material-symbols-outlined close-icon" style="cursor: pointer;">close</span>
                </div>
            </div>
        `;
        optionsDiv.appendChild(newOption);
        optionCount++;

        newOption.querySelector('.close-icon').addEventListener('click', () => {
            newOption.remove();
        });
    });

    document.addEventListener('click', (event) => {
        if (event.target && event.target.classList.contains('close-icon')) {
            event.target.closest('.option').remove();
        }
    });
</script>
@endsection