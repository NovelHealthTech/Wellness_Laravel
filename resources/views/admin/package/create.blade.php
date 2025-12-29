<x-admin.header />

<style>
    #imagePreviewContainer {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .img-thumbnail {
        border: 2px solid #dee2e6;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .img-thumbnail:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transform: scale(1.02);
    }

    select.is-invalid {
        border-color: #dc3545 !important;
    }

    select.is-valid {
        border-color: #28a745 !important;
    }

    .invalid-feedback {
        display: none;
        font-size: 80%;
        color: #dc3545;
    }

    .was-validated select:invalid~.invalid-feedback,
    select.is-invalid~.invalid-feedback,
    .was-validated input:invalid~.invalid-feedback,
    input.is-invalid~.invalid-feedback {
        display: block;
    }

    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
    }

    .vendor-price-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        margin-top: 20px;
    }

    .vendor-price-section h5 {
        font-weight: 600;
        margin-bottom: 15px;
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Add Package
            </h3>
        </div>

        <div class="card p-5">

            <form id="packageform" action="{{ route('admin.package.store') }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf

                {{-- BASIC DETAILS --}}
                <div class="row">
                    <div class="col-md-6">
                        <label class="my-2">Package Name</label>
                        <input type="text" name="packagename" class="form-control" required>
                        <div class="invalid-feedback">Please enter package name.</div>
                    </div>

                    {{-- <div class="col-md-6">
                        <label class="my-2">Package Code</label>
                        <input type="text" name="package_code" class="form-control" required>
                        <div class="invalid-feedback">Please enter package code.</div>
                    </div> --}}
                </div>

                {{-- DISCOUNT --}}
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="my-2">Discount</label>
                        <input type="number" name="discount" class="form-control" step="0.01">
                    </div>

                    <div class="col-md-6">
                        <label class="my-2">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                        <div class="invalid-feedback">Please select status.</div>
                    </div>
                </div>

               

                {{-- IMAGE PREVIEW --}}
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div id="imagePreviewContainer" style="display:none;">
                            <img id="imagePreview" class="img-thumbnail" style="max-width:300px;">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeImage()">✕</button>
                        </div>
                    </div>
                </div>


                {{-- package codes --}}

                <div class="vendor-price-section">
                    <h5>package codes</h5>
                    <div class="row">
                        @foreach ($vendors as $vendor)
                            <div class="col-md-4 mb-3">
                                <label>{{ $vendor->name }} code</label>
                                <input type="text" name="package_codes[{{ $vendor->id }}]" class="form-control"
                                    step="0.01">
                            </div>
                        @endforeach
                    </div>
                </div>



                {{-- VENDOR PRICES (NO VALIDATION) --}}
                <div class="vendor-price-section">
                    <h5>Individual Vendor Prices</h5>
                    <div class="row">
                        @foreach ($vendors as $vendor)
                            <div class="col-md-4 mb-3">
                                <label>{{ $vendor->name }} Price</label>
                                <input type="number" name="vendor_price[{{ $vendor->id }}]" class="form-control"
                                    step="0.01">
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- NHT PRICES (NO VALIDATION) --}}
                <div class="vendor-price-section">
                    <h5>Individual NHT Prices</h5>
                    <div class="row">
                        @foreach ($vendors as $vendor)
                            <div class="col-md-4 mb-3">
                                <label>{{ $vendor->name }} NHT Price</label>
                                <input type="number" name="nht_price[{{ $vendor->id }}]" class="form-control" step="0.01">
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- DESCRIPTION --}}
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control" required>
                        <div class="invalid-feedback">Please enter description.</div>
                    </div>

                    <div class="col-md-6">
                        <label>Type</label>
                        <input type="text" name="type" class="form-control">
                    </div>
                </div>

                {{-- NOTE --}}
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>Note</label>
                        <input type="text" name="note" class="form-control">
                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" id="submitBtn" class="btn btn-gradient-primary">
                            Save Package
                        </button>
                        <button type="button" class="btn btn-light" onclick="history.back()">Cancel</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    const form = document.getElementById('packageform');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Saving...';
        form.submit();
    });

    function previewImage(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = () => {
            document.getElementById('imagePreview').src = reader.result;
            document.getElementById('imagePreviewContainer').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    function removeImage() {
        document.getElementById('imageInput').value = '';
        document.getElementById('imagePreviewContainer').style.display = 'none';
    }
</script>

<x-admin.footer />