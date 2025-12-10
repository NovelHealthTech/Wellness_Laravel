<x-admin.header />
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Add <packagefsd></packagefsd>
            </h3>
        </div>

        <div class="card p-5">
            <table id="packagetable" class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Package Name</th>
                        <th>Price</th>
                        <th>status</th>
                        <th>Vedor Name</th>
                        <th>image</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th>action</th>


                    </tr>
                </thead>

            </table>

        </div>
    </div>
</div>

<x-admin.footer />
<script>
    $("#packagetable").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        scrollX: true,
        ajax: '{{ route("admin.package.fetchpackages") }}',
        "columnDefs": [{
            "targets": 0, // first column for serial number
            "render": function (data, type, row, meta) {
                return meta.row + 1; // shows 1,2,3,4,...
            }
        }],
        columns: [
            { data: "id", name: "id" },
            { data: "packagename", name: "name" },
            { data: "price", name: "price" },
            { data: "status", name: "status" },
            { data: "vendor_name", name: "vendor_id", orderable: false, searchable: false },
            { data: "image", name: "image", orderable: false, searchable: false },
            { data: "created_at", name: "created_at" },
            { data: "updated_at", name: "updated_at" },
            { data: "action", name: "action", orderable: false, searchable: false },

        ]
    });


</script>