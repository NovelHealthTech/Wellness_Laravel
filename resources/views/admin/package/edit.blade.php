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

    /* Custom validation styles for select elements */
    select.is-invalid {
        border: 1px solid #dc3545 !important;
        border-color: #dc3545 !important;
    }

    select.is-invalid:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }

    select.is-valid {
        border-color: #28a745 !important;
    }

    select.is-valid:focus {
        border-color: #28a745 !important;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
    }

    /* Force validation styles on form submission */
    .was-validated select:invalid {
        border: 1px solid #dc3545 !important;
        border-color: #dc3545 !important;
    }

    .was-validated select:valid {
        border-color: #28a745 !important;
    }

    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 80%;
        color: #dc3545;
    }

    .was-validated select:invalid~.invalid-feedback,
    select.is-invalid~.invalid-feedback {
        display: block;
    }

    .was-validated input:invalid~.invalid-feedback,
    input.is-invalid~.invalid-feedback {
        display: block;
    }

    /* Loading spinner */
    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
        border-width: 0.2em;
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
            <form id="packageform" action="{{ route('admin.package.update') }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @method("PUT")
                @csrf
                <div class="row">

                    <div class="col-md-12">
                        <label class="my-2" for="packagename">Package Name</label>

                        <input type="text" value="{{ $package->packagename }}" name="packagename" class="form-control"
                            placeholder="Enter package name" required>
                        <div class="invalid-feedback">
                            Please enter package name.
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="price" class="my-2">Package Price</label>
                        <input type="number" value="{{ $package->price }}" name="price" class="form-control"
                            placeholder="Enter package price" required>
                        <div class="invalid-feedback">
                            Please enter package price.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="discount" class="my-2">Discount</label>
                        <input type="number" value="{{ $package->discount }}" class="form-control" name="discount"
                            placeholder="Enter the Discount amount" required>
                        <div class="invalid-feedback">
                            Please enter discount amount.
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="image" class="my-2">Package Image</label>
                        <input type="file" name="image" id="imageInput" class="form-control" accept="image/*"
                            onchange="previewImage(event)" required>
                        <small class="text-muted">Accepted formats: JPG, PNG, GIF (Max size: 2MB)</small>
                        <div class="invalid-feedback">
                            Please select a package image.
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div id="imagePreviewContainer">
                            <label class="mb-2"><strong>Image Preview:</strong></label>
                            <div class="position-relative d-inline-block">
                                <img src="{{ Storage::url($package->image) }}" id="imagePreview" src="" alt="Preview"
                                    class="img-thumbnail"
                                    style="max-width: 300px; max-height: 300px; object-fit: cover;">
                                <button type="button" class="btn btn-danger btn-sm position-absolute"
                                    style="top: 10px; right: 10px;" onclick="removeImage()">
                                    <i class="mdi mdi-close"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="my-2" for="package_code">Package code</label>
                        <input type="text" value={{ $package->package_code }} name="package_code" class="form-control"
                            placeholder="Enter package code" required>
                        <div class="invalid-feedback">
                            Please enter package code.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="my-2">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="" selected disabled>Select Status</option>
                            <option value="1" {{ $package->status == 1 ? 'selected' : "" }}>Active</option>
                            <option value="2" {{ $package->status == 0 ? 'selected' : '' }}>In-Active</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a status.
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="vendor_id" class="my-2">Vendor</label>
                        <select name="vendor_id" class="form-control" required>
                            <option value="" selected disabled>Select Vendor</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ $vendor->id == $package->vendor_id ? 'selected' : '' }}>
                                    {{ $vendor->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a vendor.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="my-2">Description</label>
                        <input type="text" value="{{ $package->description }}" class="form-control" name="description" placeholder="Enter the description"
                            required>
                        <div class="invalid-feedback">
                            Please enter description.
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="my-2" for="note">Note</label>
                        <input type="text" value="{{ $package->note }}" class="form-control" name="note" placeholder="Enter the note" required>
                        <div class="invalid-feedback">
                            Please enter the note.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="my-2" for="type">Type</label>
                        <input value="{{ $package->type }}"   type="text" name="type" class="form-control" placeholder="Enter the type" required>
                        <div class="invalid-feedback">
                            Please enter the type.
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" id="submitBtn" class="btn btn-gradient-primary me-2">
                            <i class="mdi mdi-content-save me-1"></i> Save Package
                        </button>
                        <button type="button" class="btn btn-light" onclick="window.history.back()">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("packageform");
        const submitBtn = document.getElementById("submitBtn");

        // Real-time validation on blur for all inputs
        form.querySelectorAll('input[required]').forEach(input => {
            // Validate on blur (when user leaves the field)
            input.addEventListener('blur', function () {
                validateInput(this);
            });

            // Clear validation on focus
            input.addEventListener('focus', function () {
                this.classList.remove('is-invalid', 'is-valid');
            });

            // Validate on input (as user types)
            input.addEventListener('input', function () {
                if (form.classList.contains('was-validated') || this.classList.contains('is-invalid')) {
                    validateInput(this);
                }
            });
        });

        // Real-time validation on change for all selects
        form.querySelectorAll('select[required]').forEach(select => {
            // Validate on change
            select.addEventListener('change', function () {
                validateSelect(this);
            });

            // Clear validation on focus
            select.addEventListener('focus', function () {
                this.classList.remove('is-invalid', 'is-valid');
            });

            // Validate on blur
            select.addEventListener('blur', function () {
                validateSelect(this);
            });
        });

        // Function to validate input fields
        function validateInput(input) {
            if (input.type === 'file') {
                if (!input.files.length) {
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                    return false;
                } else {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    return true;
                }
            } else {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                    return false;
                } else {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    return true;
                }
            }
        }

        // Function to validate select fields
        function validateSelect(select) {
            if (!select.value || select.value === "") {
                select.classList.add('is-invalid');
                select.classList.remove('is-valid');
                return false;
            } else {
                select.classList.remove('is-invalid');
                select.classList.add('is-valid');
                return true;
            }
        }

        // Form submission handler
        form.addEventListener("submit", async function (e) {
            e.preventDefault();
            e.stopPropagation();

            let isValid = true;
            let firstInvalidField = null;

            // Validate all select elements
            form.querySelectorAll('select[required]').forEach(select => {
                if (!validateSelect(select)) {
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = select;
                    }
                }
            });

            // Validate all input elements
            form.querySelectorAll('input[required]').forEach(input => {
                if (!validateInput(input)) {
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = input;
                    }
                }
            });

            form.classList.add("was-validated");

            // Scroll to first invalid field and focus it
            if (!isValid && firstInvalidField) {
                firstInvalidField.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                // Focus the field after scrolling
                setTimeout(() => {
                    firstInvalidField.focus();
                }, 500);

                return; // Stop form submission
            }

            // If all fields are valid, submit the form
            if (isValid && form.checkValidity()) {
                try {
                    // Disable submit button
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Saving...';

                    // Create FormData object
                    const formData = new FormData(form);

                    // Get CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Send the form data
                    const response = await fetch(form.action, {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok) {
                        showAlertsuccess(data);

                        // Delay redirect so user can see the alert
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1500); // 1500ms = 1.5 seconds

                        // Reset form and hide preview immediately if needed
                        form.reset();
                        document.getElementById('imagePreviewContainer').style.display = 'none';
                        form.classList.remove('was-validated');


                    } else {
                        // Handle validation errors
                        if (data.errors) {
                            let errorMessage = 'Please fix the following errors:\n';
                            Object.keys(data.errors).forEach(key => {
                                errorMessage += `- ${data.errors[key].join(', ')}\n`;
                            });
                            alert(errorMessage);
                        } else {
                            alert(data.message || 'An error occurred while saving the package.');
                        }
                    }

                } catch (error) {
                    alert('Error: ' + error.message);
                } finally {
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="mdi mdi-content-save me-1"></i> Save Package';
                }
            }
        });
    });
</script>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('imagePreviewContainer');
        const preview = document.getElementById('imagePreview');
        const imageInput = document.getElementById('imageInput');

        if (file) {
            // Check file size (2MB limit)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size should not exceed 2MB');
                event.target.value = '';
                imageInput.classList.add('is-invalid');
                return;
            }

            // Check file type
            if (!file.type.match('image.*')) {
                alert('Please select a valid image file');
                event.target.value = '';
                imageInput.classList.add('is-invalid');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
                imageInput.classList.remove('is-invalid');
                imageInput.classList.add('is-valid');
            };
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const preview = document.getElementById('imagePreview');

        imageInput.value = '';
        preview.src = '';
        previewContainer.style.display = 'none';
        imageInput.classList.remove('is-valid');

        // Check if form was already validated
        const form = document.getElementById('packageform');
        if (form.classList.contains('was-validated')) {
            imageInput.classList.add('is-invalid');
        }
    }
</script>

<x-admin.footer />