<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Price</th>
            <th class="text-center">Status</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $r)
            <tr>
                <td>
                    {{ $r->name }}
                </td>
                <td>
                    ${{ $r->price }}
                </td>
                <td class="text-center pr-0">
                    @if($r->status == 1)
                    <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changesimstatus') }}/{{ $r->id }}")'>
                    <span class="label label-lg label-success label-inline">Enable</span>
                    </a>
                    @endif
                    @if($r->status == 2)
                    <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changesimstatus') }}/{{ $r->id }}")'>
                    <span class="label label-lg label-danger label-inline">Disable</span>
                    </a>
                    @endif
                </td>
                <td class="text-center pr-0">
                   <a href="javascript:void(0)" data-toggle="modal" data-target="#editaccesoriestype{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" >
                         <span class="material-symbols-outlined">edit</span>
                   </a>
                   <a href="javascript::void(0)" onclick='confirmDelete("{{ url('admin/ecommerce/deletesimcard') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                      <span class="material-symbols-outlined">delete</span>
                   </a>
                </td>
            </tr>
            <div class="modal fade" id="editaccesoriestype{{ $r->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Accessories Type</h5>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <form  enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/updatesimcard') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $r->id }}">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Enter Name</label>
                                            <input type="text" name="name" value="{{ $r->name }}" class="form-control" placeholder="Enter name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Enter Price</label>
                                            <input type="text" name="price" value="{{ $r->price }}" class="form-control" placeholder="Enter price">
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
        @endforeach
       
    </tbody>
</table>
{!! $data->links('admin.pagination') !!}