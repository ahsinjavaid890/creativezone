<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $company)
            <tr>
                <td class="text-center">{{ $company->name }}</td>
                <td class="text-center ">
                    @if($company->status == 1)
                    <a href="javascript::void(0)"  onclick='confirmstatus("{{ url('admin/website/settings/changecompanytatus') }}/{{ $company->id }}")'>
                        <span class="label label-lg label-success label-inline">Enable</span>
                    </a>
                    @endif
                    @if($company->status == 2)
                    <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/website/settings/changecompanytatus') }}/{{ $company->id }}")'>
                        <span class="label label-lg label-danger label-inline">Disable</span>
                    </a>
                    @endif
                </td>
                <td class="text-center">
                   <a href="javascript:void(0)" data-toggle="modal" data-target="#updateshipping{{ $company->id }}"  class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                      <span class="material-symbols-outlined">edit</span>
                   </a>
                   <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/website/settings/deletecommission') }}/{{ $company->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                      <span class="material-symbols-outlined">delete</span>
                   </a>
                </td>
                
            <div class="modal fade" id="#updateshipping{{ $company->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Shipping Company</h5>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <form  enctype="multipart/form-data" method="POST" action="{{ url('admin/website/settings/updatecompanyname') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Enter Company Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Company Name" value="{{ $company->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </tr>
        @endforeach
    </tbody>
</table>

{!! $data->links('admin.pagination') !!}