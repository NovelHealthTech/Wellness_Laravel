<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <title>Your Cart</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Header */
        .cart-header {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #0d6efd;
        }

        .cart-header h5 {
            color: #fff;
        }

        /* Cart Items */
        .srl-cart-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            max-height: 600px;
            overflow-y: auto;
            padding-right: 4px;
        }

        .srl-cart-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 16px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .srl-cart-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .cart-card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cart-info h6 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .package-price {
            font-size: 15px;
            font-weight: 500;
            color: #0d6efd;
            margin: 2px 0;
        }

        .package-meta {
            font-size: 13px;
            color: #6c757d;
            margin: 0;
        }

        .cart-delete-btn {
            background: transparent;
            border: none;
            font-size: 20px;
            color: #dc3545;
            cursor: pointer;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .cart-delete-btn:hover {
            color: #a71d2a;
            transform: scale(1.2);
        }

        /* Pincode box */
        .pincode-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Error message styling */
        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
            font-weight: 500;
        }

        /* Professional Modal Styles */
        .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: #f0f7ff;
            color: #212529;
            border-radius: 16px 16px 0 0;
            padding: 20px 24px;
            border-bottom: 2px solid #e3f2fd;
        }

        .modal-header .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
            color: #2c5282;
        }

        .modal-header .modal-title i {
            color: #4a90e2;
        }

        .modal-header .btn-close {
            opacity: 0.6;
        }

        .modal-header .btn-close:hover {
            opacity: 1;
        }

        .modal-body {
            padding: 24px;
            max-height: 500px;
            overflow-y: auto;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 16px 24px;
            background-color: #f8f9fa;
            border-radius: 0 0 16px 16px;
        }

        /* Location Card Styles */
        .location-card {
            background: white;
            border: 2px solid #e3f2fd;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .location-card:hover {
            border-color: #bbdefb;
            box-shadow: 0 4px 12px rgba(100, 181, 246, 0.15);
            transform: translateY(-2px);
            background: #fafcff;
        }

        .location-card .location-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: #2c5282;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .location-card .location-name i {
            color: #4a90e2;
        }

        .location-card .location-address {
            color: #64748b;
            font-size: 0.9rem;
            margin: 0;
            line-height: 1.5;
        }

        .location-card .select-btn {
            margin-top: 12px;
            width: 100%;
            font-weight: 500;
            background-color: #4a90e2;
            border-color: #4a90e2;
        }

        .location-card .select-btn:hover {
            background-color: #357abd;
            border-color: #357abd;
        }

        /* Loader Styles */
        .loader-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .spinner-border-custom {
            width: 3rem;
            height: 3rem;
            border-width: 0.3em;
            color: #4a90e2;
        }

        .loader-text {
            margin-top: 16px;
            color: #64748b;
            font-size: 0.95rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-state i {
            font-size: 3rem;
            color: #bbdefb;
            margin-bottom: 16px;
        }

        .empty-state p {
            color: #64748b;
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- Sticky Header -->
    <div class="cart-header d-flex align-items-center px-3 py-3">
        <a href="{{ route('retailer.allpackages') }}" class="btn btn-light btn-sm me-3">
            <i class="bi bi-arrow-left"></i>
        </a>

        <h5 class="mb-0 fw-semibold">Your Cart</h5>
    </div>

    <!-- Cart Container: 2-column layout -->
    <div class="container my-4">
        <div class="row g-4">
            <!-- Left Column: Cart Items -->
            <div class="col-lg-8">
                <div class="card p-4 shadow-sm">
                    <h5 class="mb-3">Cart Items</h5>

                    @foreach ($redcliffcartitems as $item)
                        <div class="srl-cart-list card my-2">
                            <!-- Sample Cart Item 1 -->
                            <div class="srl-cart-card" id="cart-item-1">
                                <div class="cart-card-body">
                                    <div class="cart-info">
                                        <h6>{{ $item->redcliffpackagename->packagename }}</h6>
                                        <p class="package-price">{{ $item->nht_price }}</p>
                                        <p class="package-meta">Vendor: Redcliff</p>
                                    </div>
                                    <button class="cart-delete-btn" onclick="removeFromCart(1)" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="succesmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <i class="bi bi-geo-alt-fill me-2"></i>Select Your Location
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div id="succesmodalbody" class="modal-body">
                            <!-- Loader will be shown here initially -->
                            <div class="loader-container">
                                <div class="spinner-border spinner-border-custom" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="loader-text">Searching for locations...</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i>Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Enter Pincode -->
            <div class="col-lg-4">
                <div class="pincode-card">
                    <h6 class="mb-3 fw-semibold">Book your tests</h6>

                    <form action="#" method="POST" onsubmit="handleSubmit(event)">

                        <div class="mb-3 form-group">
                            <label for="locality" class="form-label">Locality</label>
                            <input type="text" name="locality" id="houseNo" class="form-control input-field"
                                placeholder="Enter locality" required>
                            <span class="error"></span>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" id="city" class="form-control input-field"
                                placeholder="Enter city" required>
                            <span class="error"></span>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" name="pincode" id="pincode" class="form-control input-field"
                                placeholder="Enter pincode" pattern="[0-9]{6}" maxlength="6" required>
                            <span class="error"></span>
                        </div>

                        <button id="redcliffsubmit" type="submit" class="btn btn-primary w-100">Check</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
   <x-retailer.footer/>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function removeFromCart(id) {
            const el = document.getElementById('cart-item-' + id);
            if (el) {
                el.style.transition = 'opacity 0.3s ease';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 300);
            }
        }
    </script>

    <script>
        document.getElementById("redcliffsubmit").addEventListener("click", async function (e) {
            e.preventDefault();

            let hasError = false;

            // Select all input fields
            const inputs = document.querySelectorAll(".input-field");

            inputs.forEach((data) => {
                // Clear previous error
                const parent = data.closest(".form-group");
                if (parent) {
                    const errorDiv = parent.querySelector(".error");
                    if (errorDiv) {
                        errorDiv.innerText = "";
                    }
                }

                // Validation
                if (data.value.trim() === "") {
                    hasError = true;

                    const inputdiv = data.closest(".form-group");
                    if (inputdiv) {
                        const errordiv = inputdiv.querySelector(".error");
                        if (errordiv) {
                            errordiv.innerText = "Please fill the required details";
                        }
                    }
                }
            });

            // Stop API call if validation failed
            if (hasError) {
                
                return;
            }

            

            try {
                console.log("fsdfsdfsdfds");
                const houseNo = document.getElementById("houseNo").value.trim();
                const city = document.getElementById("city").value.trim();
                const pincode = document.getElementById("pincode").value.trim();


                $("#succesmodalbody").html(`
                    <div class="loader-container">
                        <div class="spinner-border spinner-border-custom" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="loader-text">Searching for locations...</p>
                    </div>
                `);
                $("#succesmodal").modal("show");

                const placeQuery = encodeURIComponent(`${houseNo} ${city}`);

                const apiUrl = `https://api.redcliffelabs.com/api/partner/v2/get-partner-location-2-eloc/?place_query=${placeQuery}`;

                const response = await fetch(apiUrl, {
                    method: "GET",
                    headers: {
                        "key": "pW2woxd83m29ihJUlIRM9oxKnylbPt4a",
                        "Accept": "application/json"
                    }
                });
                  console.log("fsdfsdfsdfds");

                const result = await response.json();

                $("#succesmodalbody").empty();

                if (result.status === "Success" && result.data.length > 0) {


                    result.data.forEach(location => {
                        $("#succesmodalbody").append(`
                            <div class="location-card">
                                <div class="location-name">
                                    <i class="bi bi-pin-map-fill"></i>
                                    ${location.placeName}
                                </div>
                                <p class="location-address">
                                    <i class="bi bi-geo-alt me-1"></i>${location.placeAddress}
                                </p>
                                <a href="/select-location/${location.eloc}?pincode=${pincode}"
                                   class="btn btn-dark select-btn">
                                    <i class="bi bi-check-circle me-1"></i>Select This Location
                                </a>
                            </div>
                        `);
                    });
                } else 
                {

             

                    $("#succesmodalbody").html(`
                        <div class="empty-state">
                            <i class="bi bi-search"></i>
                            <p>No locations found.</p>
                        </div>
                    `);
                }

            } catch (error) {
               
                $("#succesmodalbody").html(`
                    <div class="empty-state">
                        <i class="bi bi-exclamation-triangle text-danger"></i>
                        <p class="text-danger">Something went wrong</p>
                    </div>
                `);
            }
        });
    </script>

</body>

</html>