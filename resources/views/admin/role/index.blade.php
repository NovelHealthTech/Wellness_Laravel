<x-admin.header />
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Add Role
            </h3>
        </div>

        <div class="card p-5">
            <a href="{{ route('admin.role.create') }}" class="btn btn-primary w-25 admin_button">Add Role</a>
        </div>

        <div class="my-3">
            <table id="exampletable" class="table table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
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
    $(document).ready(function () {
        $('#exampletable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.role.fetchroles') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });


    document.addEventListener("click", async function (e) {
        if (e.target.classList.contains('deleteRole')) {
            e.preventDefault();

            const href = e.target.getAttribute('href');

            // Show confirmation popup
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel'
            });

            // Only proceed if confirmed
            if (result.isConfirmed) {
                try {
                    const res = await fetch(href, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                    });

                    const data = await res.json();

                    if (data.status == "success") {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });

                        $('#exampletable').DataTable().ajax.reload();
                    }

                } catch (error) {
                    alert(error.message);
                }
            }
        }
    });


</script>