<x-admin.header />
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Add Coupon
            </h3>
        </div>

        <div class="card">
            <form class="p-5" method="post" action="{{ route('admin.coupon.store') }}">
                @csrf
                <div class="row my-3">
                    <div class="col-md-6">
                        <input value="{{ old('name') }}" class="form-control" type="name" name="name" type="text"
                            placeholder="Enter coupon name">
                        <div class="my-2">
                            @error("name")
                                <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <select class="form-control" name="status">
                            <option value="" hidden selected>Select Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                        <!-- #region -->
                        <div class="my-2">
                            @error("status")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <button class="btn btn-primary">Submit</button>

            </form>
        </div>

        <div class="card mt-3 p-5">
            <table id="coupontable" class="table table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<x-admin.footer />

<script>
    $("#coupontable").DataTable({
        processing: true,
        severSide: true,
        ajax: '{{ route('admin.coupon.fetchcoupons') }}',
        scrollX: true,
        responsive:true,
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false }, // Serial Number
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'created_at', name: 'created_at', orderable: false, searchable: false },
            { data: 'updated_at', name: 'updated_at', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    })



</script>