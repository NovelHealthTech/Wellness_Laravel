<x-admin.header />
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Edit Coupon
            </h3>
        </div>

        <div class="card">
            <form class="p-5" method="post" action="{{ route('admin.coupon.update',$coupon->id) }}">
                @method("put")
                @csrf
                <div class="row my-3">
                    <div class="col-md-6">
                        <input value="{{ $coupon->name }}" class="form-control" type="name" name="name" type="text" placeholder="Enter coupon name">
                        <div class="my-2">
                            @error("name")
                                <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-6">
                        <select class="form-control" name="status">
                            <option   value="" hidden selected>Select Status</option>
                            <option {{ $coupon->status==1?"selected":"" }} value="1">Active</option>
                            <option {{ $coupon->status==2?"selected":"" }} value="2">Inactive</option>
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
    </div>
</div>

<x-admin.footer />
