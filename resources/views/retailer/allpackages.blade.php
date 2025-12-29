<x-retailer.header />

{{-- ===========================
THEME: White background & white tabs
=========================== --}}
<style>
    :root {
        --bg: #ffffff;
        --surface: #ffffff;
        --border: #e6e6e6;
        --muted: #6b7280;
        /* gray-500 */
        --primary: #2563eb;
        /* blue-600 */
        --primary-hover: #1d4ed8;
        /* blue-700 */
        --danger: #dc2626;
        /* red-600 */
        --success: #16a34a;
        /* green-600 */
        --accent: #f3f4f6;
        /* gray-100 */
        --shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        --radius: 12px;
    }

    body {
        background: var(--bg);
        color: #111;
    }

    .page-header {
        background: var(--surface);
        border-bottom: 1px solid var(--border);
        padding: 24px 0;
    }

    .page-header .btn.btn-primary {
        background: var(--primary);
        border: none;
    }

    .page-header .btn.btn-primary:hover {
        background: var(--primary-hover);
    }

    .page-header h1 {
        margin: 12px 0 4px;
        font-weight: 700;
    }

    .page-header p {
        color: var(--muted);
        margin: 0;
    }

    /* Tabs: white cards with shadow */
    .labs-tabs-section {
        padding: 24px 0 40px;
        background: var(--bg);
    }

    .nav-tabs {
        display: flex;
        gap: 20px !important;
        border-bottom: none;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .nav-tabs .nav-link {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 999px;
        padding: 10px 16px;
        color: #111;
        font-weight: 600;
        box-shadow: var(--shadow);
        transition: transform .15s ease, box-shadow .15s ease, background-color .2s ease, color .2s ease;
    }

    .nav-tabs .nav-link i {
        margin-right: 8px;
        color: var(--primary);
    }

    .nav-tabs .nav-link:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .08);
        text-decoration: none;
    }

    .nav-tabs .nav-link.active {
        background: #f9fafb;
        /* very light gray on active */
        border-color: var(--primary);
        color: #0f172a;
        /* slate-900 */
    }

    /* Cards */
    .test-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 18px;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .lab-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        background: #f9fafb;
        border: 1px solid var(--border);
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        color: #334155;
        /* slate-700 */
    }

    .badge-redcliff {
        color: #b91c1c;
        border-color: #fca5a5;
    }

    .badge-srl {
        color: #0e7490;
        border-color: #99f6e4;
    }

    .badge-tata1mg {
        color: #1d4ed8;
        border-color: #bfdbfe;
    }

    .test-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .icon-redcliff {
        background: linear-gradient(135deg, #ef4444, #f97316);
    }

    .icon-srl {
        background: linear-gradient(135deg, #06b6d4, #0ea5e9);
    }

    .icon-tata1mg {
        background: linear-gradient(135deg, #2563eb, #7c3aed);
    }

    .test-card h5 {
        margin: 6px 0;
        font-weight: 700;
    }

    .test-features {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .test-features li {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 4px 0;
        color: #374151;
        /* gray-700 */
    }

    .test-features i {
        color: var(--success);
    }



    .test-price .current-price {
        font-weight: 500;
        color: #111827;
        /* gray-900 */
    }

    .test-price .old-price {
        text-decoration: line-through;
        color: var(--muted);
        margin-left: 6px;
    }

    .discount-badge {
        background: #fef3c7;
        color: #9a3412;
        border: 1px solid #fde68a;
        padding: 2px 8px;
        border-radius: 999px;
        font-size: 12px;
        margin-left: 6px;
        font-weight: 700;
    }

    .parameters-count {
        color: #334155;
        font-weight: 600;
    }

    /* Buttons */
    .btn-primary,
    .btn-success,
    .btn-danger,
    .add-to-cart-btn,
    .view-details-btn {
        border-radius: 10px;
        font-weight: 700;
        box-shadow: var(--shadow);
        transition: transform .15s ease, box-shadow .15s ease, background-color .2s ease;
    }

    .btn-success {
        background-color: var(--success);
        border: none;
    }

    .btn-success:hover {
        background-color: #15803d;
        transform: translateY(-1px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .08);
    }

    .btn-danger {
        background-color: var(--danger);
        border: none;
    }

    .btn-danger:hover {
        background-color: #b91c1c;
        transform: translateY(-1px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .08);
    }

    .add-to-cart-btn {
        background-color: #ff6b6b;
        color: white;
        border: none;
        padding: 10px 14px;
    }

    .add-to-cart-btn:hover {
        background-color: #ff4c4c;
        transform: translateY(-1px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .08);
    }

    .view-details-btn {
        background: #111827;
        /* near-black */
        color: #fff;
        border: none;
        padding: 10px 14px;
    }

    .view-details-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .08);
    }

    .d-flex.gap-2 {
        gap: .5rem !important;
    }

    .justify-content-center {
        justify-content: center !important;
    }

    /* Read more */
    .more {
        display: none;
    }

    .read-more-btn {
        color: var(--primary);
        cursor: pointer;
        font-weight: 700;
        margin-left: 5px;
        text-decoration: none;
    }

    .read-more-btn:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    .hiding {
        opacity: .5;
        transition: opacity .3s ease;
    }

    /* Slot buttons */
    .slot-btn {
        padding: 8px 12px;
        border-radius: 8px;
        border: 2px solid gray;
        /* default border */
        background-color: white;
        cursor: pointer;
        margin: 4px;
        font-weight: bold;
        font-size: 12px !important;
        transition: transform .12s ease, box-shadow .12s ease, border-color .2s ease, background-color .2s ease;
        box-shadow: var(--shadow);
    }

    .slot-btn:hover:not(.red):not(:disabled) {
        transform: translateY(-1px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .08);
    }

    .slot-btn.green {
        border-color: green;
    }

    .slot-btn.yellow {
        border-color: orange;
    }

    .slot-btn.red {
        border-color: red;
        cursor: not-allowed;
        opacity: .7;
    }

    .slot-btn.selected {
        background: green;
        color: white;
        border-color: green;
    }

    /* Slot indicators (if used elsewhere) */
    .slot-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 5px;
        margin-left: 10px;
        vertical-align: middle;
    }

    .slot-indicator.green {
        background-color: green;
    }

    .slot-indicator.yellow {
        background-color: yellow;
    }

    .slot-indicator.red {
        background-color: red;
    }

    .package_name {
        font-weight: normal !important;
        color:
    }

    .button_color {
        color: #2563eb !important;
    }
</style>

<div class="page-header card">
    <div class="container d-flex align-items-center justify-content-between flex-wrap">
        <a class="text-decoration-none" href="{{ route('retailer.retailerhomepage') }}" class="list-style-none"
            aria-label="Back to Home">
            <i class="bi bi-arrow-left"></i>
            Back to Home
        </a>
        <div class="mt-3 mt-md-0">  
            <h1 class="h3 mb-1">Health Test Packages</h1>
            <p>Choose from top laboratories for accurate and reliable results</p>
        </div>
    </div>
</div>

{{-- Labs Tabs Section --}}
<section class="labs-tabs-section" aria-labelledby="labTabs">
    <div class="container">

        {{-- Tabs Navigation --}}
        <ul class="nav nav-tabs" id="labTabs" role="tablist">
            @foreach ($vendors as $vendor)
                @if ($vendor->id == 12)
                    <li class="nav-item">
                        <button class="nav-link " id="redcliff-tab" data-bs-toggle="tab" data-bs-target="#redcliff"
                            type="button">
                            <i class="bi bi-heart-pulse-fill"></i> Redcliff Labs
                        </button>
                    </li>
                @elseif ($vendor->id == 11)
                    <li class="nav-item">
                        <button class="nav-link active" id="srl-tab" data-bs-toggle="tab" data-bs-target="#srl" type="button">
                            <i class="bi bi-hospital-fill"></i> SRL Diagnostics
                        </button>
                    </li>
                @elseif ($vendor->id == 13)
                    <li class="nav-item">
                        <button class="nav-link" id="tata1mg-tab" data-bs-toggle="tab" data-bs-target="#tata1mg" type="button">
                            <i class="bi bi-capsule-pill"></i> Tata 1mg
                        </button>
                    </li>
                @endif
            @endforeach
        </ul>

        {{-- Tab Content --}}
        <div class="tab-content" id="labTabContent">

            {{-- ================= REDCLIFF ================= --}}
            <div class="tab-pane fade " id="redcliff" role="tabpanel">
                <div class="row g-4">
                    @foreach ($allpackages->where('vendor_id', 12) as $package)
                        <div class="col-lg-4 col-md-6">
                            <div class="test-card redcliff">
                                <span class="lab-badge badge-redcliff">Redcliff Labs</span>

                                <div class="test-icon icon-redcliff">
                                    <i class="bi bi-clipboard-pulse text-white"></i>
                                </div>

                                <h5 class="package_name">{{ $package->packagename }}</h5>
                                <p class="labnote">{{ $package->note }}</p>

                                @php
                                    $desc = json_decode($package->description, true);
                                    $tests = array_slice($desc['tests'] ?? [], 0, 3);
                                @endphp

                                <ul class="test-features">
                                    @foreach ($tests as $test)
                                        <li><i class="bi bi-check-circle-fill"></i> {{ $test }}</li>
                                    @endforeach
                                </ul>

                                

                                <div class="test-meta card shadow-sm border-0 p-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="current-price">₹ {{ number_format($package->price) }}</div>
                                       
                                    @if(!empty($redcliffpackageIds) &&  in_array($package->id,$redcliffpackageIds))

                                            <button class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                                <i class="bi bi-trash px-3 py-1"></i>
                                            </button>

                                   @else

                                     <button data-url="{{ route('retailer.redcliffcart') }}" data-package-id="{{ $package->id }}"
                                                data-vendor-id="{{ $package->vendor_id }}" class="btn btn-sm border border-primary px-4 button_color redclifcart">
                                            +ADD
                                        </button>

                                   @endif
                                        
                                        
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ================= SRL ================= --}}
            <div class="tab-pane fade show active" id="srl" role="tabpanel">
                <div class="row g-4">
                    @foreach ($allpackages->where('vendor_id', 11) as $package)
                        <div class="col-lg-4 col-md-6">
                            <div class="test-card redcliff">
                                <span class="lab-badge badge-redcliff">SRL Labs</span>
                                <div class="test-icon icon-redcliff">
                                    <i class="bi bi-clipboard-pulse text-white"></i>
                                </div>
                                <h5 class="package_name">{{ $package->packagename }}</h5>
                                <p class="labnote">{{ $package->note }}</p>

                                @php
                                    $desc = json_decode($package->description, true);
                                    $tests = array_slice($desc['tests'] ?? [], 0, 3);
                                @endphp

                                <ul class="test-features">
                                    @foreach ($tests as $test)
                                        <li><i class="bi bi-check-circle-fill"></i> {{ $test }}</li>
                                    @endforeach
                                </ul>

                                <div class="test-meta card shadow-sm border-0 p-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="current-price">₹ {{ number_format($package->price) }}</div>

                                        @if (!empty($srlpackageIds) && in_array($package->id, $srlpackageIds))

                                            <button class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                                <i class="bi bi-trash px-3 py-1"></i>
                                            </button>

                                        @else
                                        
                                            <button class="btn btn-sm border border-primary px-4 button_color srlcart"
                                                data-url="{{ route('retailer.srl_cart') }}" data-package-id="{{ $package->id }}"
                                                data-vendor-id="{{ $package->vendor_id }}">
                                                + ADD
                                            </button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ================= TATA 1MG ================= --}}
            <div class="tab-pane fade" id="tata1mg" role="tabpanel">
                {{-- your static cards remain SAME --}}
            </div>

        </div>
    </div>

    {{-- Modals --}}
    <x-retailer.srlpincodemodal />
    <x-retailer.srldatemodal />
    <x-retailer.srldateslotsmodal />
    <x-retailer.redcliffpincodemodal />
    <x-retailer.srlcart :srlcartitems="$srlcartitems" />

    <x-retailer.recliffcart :redcliffcartitems="$redcliffcartitems" />

</section>

<x-retailer.footer />

{{-- ===========================
JS: Polished event handling
=========================== --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Graceful "Read More" truncation on lab notes
        document.querySelectorAll(".labnote").forEach(note => {
            const limit = 100; // initial characters
            const fullText = note.innerText.trim();

            if (fullText.length > limit) {
                const visibleText = fullText.slice(0, limit);
                const hiddenText = fullText.slice(limit);

                note.innerHTML = `${visibleText}<span class="dots">...</span><span class="more">${hiddenText}</span>`;

                const btn = document.createElement("a");
                btn.className = "read-more-btn";
                btn.href = "javascript:void(0)";
                btn.setAttribute("role", "button");
                btn.setAttribute("aria-expanded", "false");
                btn.textContent = "Read More";

                note.after(btn);

                const more = note.querySelector(".more");
                const dots = note.querySelector(".dots");

                btn.addEventListener("click", (e) => {
                    e.preventDefault();
                    const isHidden = more.style.display === "none" || more.style.display === "";

                    if (isHidden) {
                        dots.classList.add('hiding');
                        setTimeout(() => {
                            dots.style.display = "none";
                            dots.classList.remove('hiding');
                            more.style.display = "inline";
                            btn.textContent = "Read Less";
                            btn.setAttribute("aria-expanded", "true");
                        }, 300);
                    } else {

                        more.classList.add('hiding');
                        setTimeout(() => {
                            more.style.display = "none";
                            more.classList.remove('hiding');
                            dots.style.display = "inline";
                            btn.textContent = "Read More";
                            btn.setAttribute("aria-expanded", "false");
                        }, 300);
                    }
                });
            }
        });
    });

    // Delegated clicks
    document.addEventListener("click", async function (e) {
        // SRL Buy Now
        if (e.target.classList.contains("buy_now_srl")) {
            e.preventDefault();
            const packageId = e.target.getAttribute("package_id");
            const hiddenPackageInput = document.getElementById("selected_package");
            if (hiddenPackageInput) hiddenPackageInput.value = packageId;
            $("#srlpincodemodal").modal("show");
            return;
        }

        // SRL Book (pincode check)
        if (e.target.classList.contains("book")) {
            e.preventDefault();
            const form = e.target.closest('form');
            if (!form) return;

            if (!form.checkValidity()) {
                form.classList.add("was-validated");
                return;
            }

            const formdata = new FormData(form);
            const url = form.action;

            try {
                const res = await fetch(url, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']")?.getAttribute("content") || ""
                    },
                    body: formdata,
                });

                const data = await res.json();

                if (data?.api_response?.RSP_CODE == 100 && data?.api_response?.RSP_MSG == "TRUE") {
                    $(".modal").modal("hide");
                    const hiddenPincodeInput = document.getElementById("hiddenpincode");
                    if (hiddenPincodeInput) hiddenPincodeInput.value = data.pincode;

                    setTimeout(() => {
                        $("#srldatemodal").modal("show");
                    }, 400);
                } else {
                    Swal.fire({
                        title: "Oops!",
                        text: "Our service is not available in your area yet. Coming Soon...!!!",
                        icon: "error",
                        confirmButtonText: "Okay",
                        confirmButtonColor: "#d33"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(".modal").modal("hide");
                        }
                    });
                }
            } catch (error) {
                console.error(error);
                alert(error.message);
            }

            return;
        }

        // SRL Book Date Slots
        if (e.target.classList.contains("book_data_slots")) {
            e.preventDefault();
            const form = e.target.closest('form');
            if (!form) return;

            if (!form.checkValidity()) {
                form.classList.add("was-validated");
                return;
            }

            const formdata = new FormData(form);
            const url = form.action;

            try {
                const res = await fetch(url, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")?.getAttribute('content') || ""
                    },
                    body: formdata,
                });

                const data = await res.json();

                if (data?.RSP_CODE == 200) {
                    $(".modal").modal("hide");
                    $('#srldateslotsmodal').modal("show");

                    const slotContainer = document.getElementById("slots_container");
                    const hiddenInput = document.getElementById("selected_slot");
                    if (!slotContainer || !hiddenInput) return;

                    slotContainer.innerHTML = "";

                    (data.RSP_MSG || []).forEach(slot => {
                        const button = document.createElement("button");
                        button.type = "button";
                        button.classList.add("slot-btn");

                        const avail = (slot.AVAIBILITY || "").toLowerCase();
                        if (avail === "green") {
                            button.classList.add("green");
                            button.disabled = false;
                        } else if (avail === "yellow") {
                            button.classList.add("yellow");
                            button.disabled = false;
                        } else if (avail === "red") {
                            button.classList.add("red");
                            button.disabled = true;
                        } else {
                            button.disabled = true;
                        }

                        button.textContent = slot.SLOTS;

                        button.addEventListener("click", () => {
                            if (button.disabled) return;

                            slotContainer.querySelectorAll(".slot-btn.selected")
                                .forEach(b => b.classList.remove("selected"));

                            button.classList.add("selected");
                            hiddenInput.value = slot.SLOTS;

                            const pincodeValue = document.querySelector("input[name='pincode']")?.value || "";
                            const hiddenPinInput = document.getElementById("selected_pincode");
                            if (hiddenPinInput) hiddenPinInput.value = pincodeValue;
                        });

                        slotContainer.appendChild(button);
                    });
                }
            } catch (error) {
                console.error(error);
                alert(error.message);
            }

            return;
        }

        // Redcliff Buy Now → open pincode modal
        if (e.target.classList.contains('buy_now_redcliff')) {
            e.preventDefault();
            $("#redcliffpincodemodal").modal("show");

            const form = e.target.closest('form');
            if (form && !form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }
            return;
        }

        // Redcliff book (submit pincode)
        if (e.target.classList.contains("redclifcart")) {


            const btn = e.target.closest(".redclifcart");

            try 
            {

                const url = btn.dataset.url;
                const package_id = btn.dataset.packageId;
                const vendor_id = btn.dataset.vendorId; 

                if (!url) {

                    console.error("URL missing");
                    return;
                }

                const res = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector("meta[name='csrf-token']")
                            .getAttribute("content")
                    },
                    body: JSON.stringify({
                        package_id,
                        vendor_id
                    })
                });

                const data=await res.json();

                if(data.status=="success")
                {

                    console.log(data.redcliffcart);

                    const count=data.redcliffcart.length;
            
                    const cart = document.querySelector(".redcliff_cart");
                    const redlciffcartbadge=document.querySelector(".cart_badge_redcliff");
                    redlciffcartbadge.innerText=count;

                    cart.classList.remove("display_none");
                    successalert(data);

                }

            } catch (error) {

                alert(error.message);

            }

        }

        if (e.target.closest(".srlcart")) {

            const btn = e.target.closest(".srlcart");

            try {
                const url = btn.dataset.url;
                const package_id = btn.dataset.packageId;
                const vendor_id = btn.dataset.vendorId;

                if (!url) {
                    console.error("URL missing");
                    return;
                }

                const res = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector("meta[name='csrf-token']")
                            .getAttribute("content")
                    },
                    body: JSON.stringify({
                        package_id,
                        vendor_id
                    })
                });

                const data = await res.json();

                if (data.status == "success") {

                    console.log(data.srlcart.length);

                    let count = Object.keys(data.srlcart).length;

                    console.log(count);

                    if (count > 0) {

                        const cart = document.querySelector(".srl_cart");
                        cart.classList.remove("display_none");
                        const cart_count = document.querySelector(".cart_badge_srl");
                        cart_count.innerText = count;

                    }


                    $srl_cart = document.querySelector(".srl_cart");
                    $srl_cart.classList.remove('display_none');
                    successalert(data);
                }

            } catch (error) {
                alert(error.message);
            }
        }


    });







</script>