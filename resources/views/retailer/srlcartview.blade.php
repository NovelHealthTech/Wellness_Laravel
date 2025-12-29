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
            max-height: 200px;
        }
    </style>
</head>
@if(session('status') === 'failure')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: @json(session('message')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545'
            });
        });
    </script>
@endif

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
                    @if($srlcartitems->isNotEmpty())
                        <div class="srl-cart-list">
                            @foreach($srlcartitems as $item)
                                <div class="srl-cart-card" id="cart-item-{{ $item->id }}">
                                    <div class="cart-card-body">
                                        <div class="cart-info">
                                            <h6>{{ $item->package->packagename ?? 'Package Name' }}</h6>
                                            <p class="package-price">₹{{ number_format($item->package->price, 0) }}</p>
                                            <p class="package-meta">Vendor: {{ $item->vendor->name ?? 'N/A' }}</p>
                                        </div>
                                        <button class="cart-delete-btn" onclick="removeFromCart({{ $item->id }})"
                                            title="Remove">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center my-4">Your cart is empty</p>
                    @endif
                </div>
            </div>

            <!-- Right Column: Enter Pincode -->
            <div class="col-lg-4">
                <div class="pincode-card d-flex flex-column justify-content-center h-100">
                    <h6 class="mb-3 fw-semibold">Check Delivery Availability</h6>
                    <form action="{{ route('retailer.srlpincode.post') }}" class="mb-3">
                        <label for="pincode" class="form-label">Enter Pincode</label>
                        <input type="text" name="pincode" id="pincode" class="form-control" placeholder="123456">
                        <button class="btn btn-primary mt-2 w-100">Check</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function removeFromCart(id) {
            const el = document.getElementById('cart-item-' + id);
            if (el) el.remove();
        }
    </script>
</body>

</html>