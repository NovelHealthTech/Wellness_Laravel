<x-admin.header />
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Add Zone Manager
            </h3>
        </div>

        <div class="card p-5">
            <form action="{{ route('admin.role.store') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <label class="my-2">Role Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter role name">
                        @error("name")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary my-2">
                    Submit
                </button>
            </form>
        </div>
    </div>
    <x-admin.footer />