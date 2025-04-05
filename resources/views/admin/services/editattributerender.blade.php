<div class="modal-content">
    <div class="modal-header">
        <div class="row">
            <div class="col-md-12">
                <h5 class="modal-title" id="exampleModalLabel">Update Attribute: {{ $data->name }}</h5>
            </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/updatattribute') }}">
        @csrf
        <input type="hidden" value="{{ $data->id }}" name="id">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Select Type</label>
                        <select class="form-control" name="type" id="attributeupdateType">
                            <option>Select Type</option>
                            <option @if($data->type == 'Text') selected @endif value="Text">Text</option>
                            <option @if($data->type == 'Radio') selected @endif value="Radio">Single Choice</option>
                            <option @if($data->type == 'Checkbox') selected @endif value="Checkbox">Multiple Choice</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Name</label>
                        <input value="{{ $data->name }}" type="text" class="form-control" name="name">
                    </div>
                </div>
            </div>
            <div id="containrs">
                @if($data->type != 'Text')
                @foreach(explode(',', $data->value) as $key=>$values)
                <div class="row row-to-clons">
                    <div class="col-md-11">
                        <div class="form-group">
                            <label class="form-label">Value {{ $key+1 }}</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="value[]" value="{{ $values }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <span onclick="removeRow(this)" class="material-icons" style="cursor: pointer;">remove_circle</span>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <div class="modal-footer justify-content-between ">
            <button type="button" class="btn btn-success font-weight-bold addbtn" onclick="addRow()">Add Row</button>
            <div class="save-button">
                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
            </div>
        </div>

    </form>
</div>

<script>
    function removeRow(element) {
        var row = element.closest('.row-to-clons');
        row.remove();
    }
    function addRow() {
        var newRow = document.createElement('div');
        newRow.className = 'row row-to-clons';
        newRow.innerHTML = `
            <div class="col-md-11">
                <div class="form-group">
                    <label class="form-label">Value</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="value[]" value="">
                    </div>
                </div>
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <span onclick="removeRow(this)" class="material-icons" style="cursor: pointer;">remove_circle</span>
            </div>
        `;
        document.getElementById('containrs').appendChild(newRow);
    }
    $(document).ready(function() {
        function updateButtons(type) {
            if (type === 'Text') {
                $('#containrs').hide();
                $('.addbtn').hide();
                $('.save-button').show();
            } else {
                $('#containrs').show();
                $('.addbtn').show();
                $('.save-button').show();
            }
        }
        updateButtons($('#attributeupdateType').val());
        $('#attributeupdateType').change(function() {
            updateButtons($(this).val());
        });
    });
</script>