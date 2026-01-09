<x-retailer.header />
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #ffffff;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', sans-serif;
        color: #1a1a1a;
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
    }

    .clean-card {
        background: #ffffff;
        border: 1px solid #e0e7ff;
        border-radius: 8px;
        padding: 32px;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(99, 102, 241, 0.05);
    }

    .clean-card:hover {
        border-color: #c7d2fe;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.1);
    }

    .status-line {
        display: inline-block;
        padding: 6px 12px;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border: 1px solid #7dd3fc;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .status-text {
        font-size: 12px;
        font-weight: 500;
        color: #0369a1;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .package-title {
        font-size: 32px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .package-description {
        font-size: 16px;
        color: #666666;
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .package-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-top: 24px;
        border-top: 2px solid #e0e7ff;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .meta-label {
        font-size: 11px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .meta-value {
        font-size: 14px;
        color: #6366f1;
        font-weight: 600;
    }

    .meta-divider {
        width: 1px;
        height: 30px;
        background: #e0e7ff;
    }

    .card-header-minimal {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid #e0e7ff;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }

    .test-count {
        font-size: 13px;
        color: #6366f1;
        padding: 4px 12px;
        background: #f0f9ff;
        border: 1px solid #bfdbfe;
        border-radius: 4px;
        font-weight: 500;
    }

    .tests-grid {
        display: grid;
        gap: 12px;
        margin-bottom: 20px;
    }

    .test-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f5f5f5;
        transition: all 0.2s ease;
    }

    .test-row:hover {
        background: linear-gradient(135deg, #f0f9ff 0%, #fefce8 100%);
        margin: 0 -16px;
        padding: 12px 16px;
        border-left: 3px solid #6366f1;
    }

    .test-row:last-child {
        border-bottom: none;
    }

    .test-bullet {
        color: #6366f1;
        font-size: 20px;
        line-height: 1;
        margin-top: 2px;
    }

    .test-name {
        font-size: 15px;
        color: #1a1a1a;
        flex: 1;
    }

    .view-more-link {
        width: 100%;
        background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
        border: 1px solid #bfdbfe;
        color: #6366f1;
        padding: 12px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .view-more-link:hover {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-color: #93c5fd;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.15);
    }

    .link-arrow {
        font-size: 14px;
        transition: transform 0.2s ease;
    }

    .package-detail-text {
        font-size: 15px;
        color: #666666;
        line-height: 1.7;
    }

    .purchase-card {
        position: sticky;
        top: 20px;
    }

    .purchase-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .purchase-subtitle {
        font-size: 14px;
        color: #666666;
        margin-bottom: 24px;
    }

    .vendors-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 24px;
    }

    .vendor-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        border: 2px solid #e0e7ff;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #ffffff;
        text-decoration: none;
    }

    .vendor-option:hover {
        border-color: #6366f1;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
        transform: translateY(-2px);
    }

    .vendor-info {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
    }

    .vendor-initial {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: 2px solid #e0e7ff;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
        color: #ffffff;
        flex-shrink: 0;
    }

    .vendor-details {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .vendor-name {
        font-size: 14px;
        font-weight: 500;
        color: #1e293b;
    }

    .vendor-rating {
        font-size: 12px;
        color: #64748b;
    }

    .vendor-price-section {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .price-amount {
        font-size: 20px;
        font-weight: 600;
        color: #6366f1;
    }

    .trust-info {
        padding-top: 20px;
        border-top: 2px solid #e0e7ff;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .trust-item {
        font-size: 13px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .trust-item span {
        font-weight: 600;
        color: #10b981;
    }

    @media(max-width: 991px) {
        .sticky-top {
            position: static !important;
        }

        .package-title {

            font-size: 28px;
        }

        .package-meta {
            gap: 12px;
        }

        .meta-divider {
            display: none;
        }
    }

    @media(max-width: 576px) {
        .clean-card {
            padding: 24px 20px;
        }

        .package-title {
            font-size: 24px;
        }

        .vendor-option {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .vendor-price-section {
            width: 100%;
            justify-content: space-between;
        }
    }
</style>
@php
    $description = json_decode($package->description);
    $tests = $description->tests ?? [];
@endphp



<div class="container my-5">
    <div class="row g-4">

        <!-- Left Column: Package Info -->
        <div class="col-lg-8">

            <!-- Package Header -->
            <div class="clean-card package-header mb-4">
                <div class="status-line">
                    <span class="status-text">Active Package</span>
                </div>
                <h1 class="package-title">{{ $package->packagename }}</h1>
                <p class="package-description">
                    {{ $package->short_description ?? 'Comprehensive health screening tests' }}
                </p>
            </div>

            <!-- Package Tests -->
            <div class="clean-card mb-4">
                <div class="card-header-minimal">
                    <h5 class="section-title">Tests Included</h5>
                    <span class="test-count">{{ count($tests) }} tests</span>
                </div>

                <div class="tests-grid" id="test-list-{{ $package->id }}">
                    @foreach($tests as $index => $test)
                        <div class="test-row {{ $index >= 8 ? 'd-none extra-test-' . $package->id : '' }}">
                            <span class="test-bullet">•</span>
                            <span class="test-name">{{ $test }}</span>
                        </div>
                    @endforeach
                </div>

                @if(count($tests) > 8)
                    <button class="view-more-link" onclick="toggleTests({{ $package->id }}, this)">
                        <span class="link-text">View all tests</span>
                        <span class="link-arrow">↓</span>
                    </button>
                @endif
            </div>

            <!-- Full Description -->
            @if(!empty($package->full_description))
                <div class="clean-card">
                    <h5 class="section-title mb-3">About This Package</h5>
                    <p class="package-detail-text">{{ $package->full_description }}</p>
                </div>
            @endif
        </div>

        <!-- Right Column: Vendor / Purchase Card -->
        <div class="col-lg-4">
            <div class="clean-card purchase-card sticky-top">
                <h5 class="purchase-title">Select Lab Partner</h5>
                <p class="purchase-subtitle">Compare prices from verified laboratories</p>

                <div class="vendors-list">
                    @if(isset($data['srl']))


                        <a href="" class="vendor-option vendor_cart">
                            <div class="vendor-info">
                                <div class="vendor-initial">S</div>
                                <div class="vendor-details">
                                    <span class="vendor-name">SRL Diagnostics</span>
                                </div>
                            </div>
                            <div class="vendor-price-section">
                                <span class="price-amount">₹{{ $data['srl']['price'] }}</span>
                            </div>
                        </a>
                    @endif

                    @if(isset($data['redcliff']))
                     


                          <a  href="{{ route('retailer.redcliffcart') }}" data-package_id={{ $package->id}}
                            data-vendor_id={{ $data["redcliff"]["vendor_id"] }}  class="vendor-option vendor_cart">
                            <div class="vendor-info">
                                <div class="vendor-initial">R</div>
                                <div class="vendor-details">
                                    <span class="vendor-name">Redcliffe Labs</span>
                                </div>
                            </div>

                         @if (in_array($package->id,$recliffcartpackages_ids))
                           <i class="bi bi-trash"></i>
                         @else

                           <div class="delete_icon d-none" data-package_id={{ $package->id }} data-vendor_id="{{ $data["redcliff"]["vendor_id"] }}">
                                <i class="bi bi-trash"></i>
                           </div>

                            <div class="vendor-price-section">
                                <span class="price-amount">₹{{ $data['redcliff']['price'] }}</span>
                            </div>
                        @endif
                        </a>
                             
                      
                       
                    @endif

                    @if(isset($data['tata1mg']))
                        <a  href="" class="vendor-option vendor_cart">
                            <div class="vendor-info">
                                <div class="vendor-initial">T</div>
                                <div class="vendor-details">
                                    <span class="vendor-name">Tata 1mg Labs</span>
                                </div>
                            </div>
                            <div class="vendor-price-section">
                                <span class="price-amount">₹{{ $data['tata1mg']['price'] }}</span>
                            </div>
                        </a>
                    @endif
                </div>

                <div class="trust-info">
                    <div class="trust-item">
                        <span>✓</span> Secure Payment
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</div>


  
     

     <x-retailer.recliffcart :redcliffcartitems="$redcliffitems" />
    
 


<script>
    function toggleTests(packageId, el) {

        const extraTests = document.querySelectorAll('.extra-test-' + packageId);
        const isHidden = extraTests[0].classList.contains('d-none');
        const text = el.querySelector('.link-text');
        const arrow = el.querySelector('.link-arrow');

        extraTests.forEach(item => item.classList.toggle('d-none'));
        text.innerText = isHidden ? 'View less' : 'View all tests';
        arrow.innerText = isHidden ? '↑' : '↓';
    }



document.addEventListener('DOMContentLoaded', function () {

    // Listen for clicks on vendor cart buttons
    document.addEventListener('click', async function (e) {
        const vendorCart = e.target.closest('.vendor_cart'); // Get the clicked vendor cart element

        if (!vendorCart) return; // Exit if not clicking on a vendor_cart

        e.preventDefault(); // Prevent default link behavior

        const action = vendorCart.href; // URL to POST to
        const package_id = vendorCart.dataset.package_id; // Get package ID
        const vendor_id = vendorCart.dataset.vendor_id; // Get vendor ID

        try {
            const res = await fetch(action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ package_id, vendor_id })
            });

            const data = await res.json();

            if (res.ok && data.status === "success") {
                console.log("Redcliff Cart Data:", data.redcliffcart);

               vendorCart.querySelector(".delete_icon").classList.remove("d-none");

               vendorCart.querySelector(".vendor-price-section").classList.add("d-none");


                // Update Redcliff cart badge
                const count = data.redcliffcart.length;
                const cart = document.querySelector(".redcliff_cart");
               
                if (cart) cart.classList.remove("display_none");
                
                 const badge = document.querySelector(".cart_badge_redcliff");

                if (badge) badge.innerText = count;
                // Optional: show a success alert
                if (typeof successalert === 'function') {
                    successalert(data);
                }
            } else {
                console.error('Error updating cart:', data);
            }

        } catch (err) {
            console.error('Fetch error:', err);
        }
    });

});



</script>

<x-retailer.footer />