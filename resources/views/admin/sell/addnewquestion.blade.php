@extends('admin.layouts.main-layout')
@section('title','Add Question')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Add Question
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Add Question
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            @include('alerts.index')
            <div class="row">
                <div class="col-md-8  mx-auto">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap"> 
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Add Question</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/sell/createquestion') }}" method="POST">
                                @csrf
                                <input type="hidden" name="trash_status" value="active">
                                <input type="hidden" name="status" value="1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select Category<span class="text-danger">*</span></label>
                                            <select onchange="selectcategory(this.value)" class="form-control" required name="category_id">
                                                <option value="">Select Category</option>
                                                @foreach(DB::table('categories')->where('category_type' , 'sell')->where('status' , 1)->get() as $r)
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select Modal<span class="text-danger">*</span></label>
                                            <select class="form-control" id="model_id" required name="model_id">
                                                <option value="">Select Modal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Question<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="question_text" name="question_text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        
                                    </div>
                                </div>
                                <div id="options">
                                    <div class="card p-5 mb-3 option">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="option_text" class="form-label">Option</label>
                                                <input type="text" class="form-control" name="options[0][option_text]" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="number" class="form-control" name="options[0][price]" step="0.01" required>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <span class="material-symbols-outlined close-icon" style="cursor: pointer;">close</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="addOption" class="btn btn-secondary mb-3">Add Option</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

@endsection

@section('script')
<script type="text/javascript">
    function selectcategory(id) {
        $.ajax({
            type:'GET',
            url: '{{ url("admin/ecommerce/selectcategory") }}/'+id,
            success: function(data){
                $('#model_id').html(data)
            }
        });
    }
    let optionCount = 1;
    document.getElementById('addOption').addEventListener('click', () => {
        const optionsDiv = document.getElementById('options');
        const newOption = document.createElement('div');
        newOption.classList.add('card', 'p-5', 'mb-3', 'option');
        newOption.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label for="option_text" class="form-label">Option</label>
                    <input type="text" class="form-control" name="options[${optionCount}][option_text]" required>
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" name="options[${optionCount}][price]" step="0.01" required>
                </div>
                <div class="col-md-12 text-right">
                    <span class="material-symbols-outlined close-icon" style="cursor: pointer;">close</span>
                </div>
            </div>
        `;
        optionsDiv.appendChild(newOption);
        optionCount++;

        // Add event listener to the close icon
        newOption.querySelector('.close-icon').addEventListener('click', () => {
            newOption.remove();
        });
    });

    // Add event listener to the initial close icon
    document.querySelector('.close-icon').addEventListener('click', (event) => {
        event.target.closest('.option').remove();
    });
</script>
@endsection