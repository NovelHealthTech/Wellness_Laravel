<x-retailer.header />
<style>
    .more {
        display: none;
    }

    .read-more-btn {
        color: blue;
        cursor: pointer;
        font-weight: bold;
        margin-left: 5px;
    }
</style>

<style>
    /* Add some custom styles */
    .add-to-cart-btn {
        background-color: #ff6b6b;
        /* soft red */
        color: white;
        border: none;
        transition: background-color 0.3s, transform 0.2s;
    }

    .add-to-cart-btn:hover {
        background-color: #ff4c4c;
        transform: scale(1.05);
    }

    .view-details-btn {
        transition: transform 0.2s;
    }

    .view-details-btn:hover {
        transform: scale(1.05);
    }
</style>

<style>
    .slot-btn {
        padding: 8px 12px;
        border-radius: 4px;
        border: 2px solid gray;
        /* default border */
        background-color: white;
        cursor: pointer;
        margin: 4px;
        font-weight: bold;
        font-size: 12px !important;
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
    }

    .slot-btn.selected {
        background: green;
        color: white;
    }
</style>

<style>
    .slot-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        /* makes it a circle */
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
</style>


<div class="page-header">
    <div class="container">
        <a href="#" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Home
        </a>
        <h1>Health Test Packages</h1>
        <p>Choose from top laboratories for accurate and reliable results</p>
    </div>
</div>

<!-- Labs Tabs Section -->
<section class="labs-tabs-section">
    <div class="container">
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="labTabs" role="tablist">
            @foreach ($vendors as $vendor)

                @if($vendor->id == "11")

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="redcliff-tab" data-bs-toggle="tab" data-bs-target="#redcliff"
                            type="button" role="tab">
                            <i class="bi bi-heart-pulse-fill"></i>Redcliff Labs
                        </button>
                    </li>
                @endif

                @if($vendor->id == "12")
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="srl-tab" data-bs-toggle="tab" data-bs-target="#srl" type="button"
                            role="tab">
                            <i class="bi bi-hospital-fill"></i>SRL Diagnostics
                        </button>
                    </li>
                @endif


                @if($vendor->id == "13")
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tata1mg-tab" data-bs-toggle="tab" data-bs-target="#tata1mg" type="button"
                            role="tab">
                            <i class="bi bi-capsule-pill"></i>Tata 1mg
                        </button>
                    </li>
                @endif

            @endforeach

        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="labTabContent">

            @foreach ($allpackages as $package)

                @if ($package->vendor_id == "11")
                    <!-- Redcliff Labs Tab -->
                    <div class="tab-pane fade show active" id="redcliff" role="tabpanel">
                        <div class="row g-4">
                            <!-- Test Card 1 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="test-card redcliff">
                                    <span class="lab-badge badge-redcliff">Redcliff Labs</span>
                                    <div class="test-icon icon-redcliff">
                                        <i class="bi bi-clipboard-pulse text-white"></i>
                                    </div>
                                    <h5>{{ $package->packagename }}</h5>
                                    <p class="labnote">{{ $package->note }}</p>

                                    @php
                                        $array_description = json_decode($package->description, true);

                                        $threeTests = array_slice($array_description["tests"], 0, 3);
                                    @endphp

                                    <ul class="test-features">
                                        @foreach ($threeTests as $test)
                                            <li><i class="bi bi-check-circle-fill"></i> <?= $test ?></li>
                                        @endforeach
                                    </ul>

                                    <div class="test-meta">

                                        <div class="test-price">
                                            <span class="current-price text-center">
                                                Book Now - ₹ {{ number_format($package->price, 0) }}
                                            </span>

                                            {{-- <span class="old-price">₹600</span>
                                            <span class="discount-badge">50% OFF</span> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-contet-center">
                                        <button class="btn btn-danger view-details-btn">
                                            View Details
                                        </button>
                                        <button class="btn btn-success ">
                                            <i class="bi bi-cart-plus me-2"></i>buy now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                @if($package->vendor_id == "12")
                    <!-- SRL Diagnostics Tab -->
                    <div class="tab-pane fade" id="srl" role="tabpanel">
                        <div class="row g-4">
                            <!-- Test Card 1 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="test-card srl">
                                    <span class="lab-badge badge-srl">SRL</span>
                                    <div class="test-icon icon-srl">
                                        <i class="bi bi-clipboard-pulse text-white"></i>
                                    </div>
                                    <h5>{{ $package->packagename }}</h5>

                                    @php
                                        $array_description = json_decode($package->description, true);

                                        $threeTests = array_slice($array_description["tests"], 0, 3);
                                    @endphp

                                    <ul class="test-features">
                                        @foreach ($threeTests as $test)
                                            <li><i class="bi bi-check-circle-fill"></i> <?= $test ?></li>
                                        @endforeach
                                    </ul>

                                    <div class="test-meta">
                                        <div class="test-price">
                                            <span class="current-price text-center">
                                                Book Now - ₹ {{ number_format($package->price, 0) }}
                                            </span>

                                            {{-- <span class="old-price">₹600</span>
                                            <span class="discount-badge">50% OFF</span> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-contet-center">
                                        <button class="btn btn-danger view-details-btn">
                                            View Details
                                        </button>
                                        <button package_id="{{ $package->id }}" class="btn btn-success buy_now_srl">
                                            <i class="bi bi-cart-plus me-2"></i>buy now
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($package->vendor_id == "13")
                    <!-- Tata 1mg Tab -->
                    <div class="tab-pane fade" id="tata1mg" role="tabpanel">
                        <div class="row g-4">
                            <!-- Test Card 1 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="test-card tata1mg">
                                    <span class="lab-badge badge-tata1mg">Tata 1mg</span>
                                    <div class="test-icon icon-tata1mg">
                                        <i class="bi bi-clipboard-pulse text-white"></i>
                                    </div>
                                    <h5>Complete Blood Count (CBC)</h5>
                                    <p>Detailed blood test with 25 key parameters for comprehensive health assessment</p>
                                    <ul class="test-features">
                                        <li><i class="bi bi-check-circle-fill"></i>Hemoglobin</li>
                                        <li><i class="bi bi-check-circle-fill"></i>Blood Cells Count</li>
                                        <li><i class="bi bi-check-circle-fill"></i>Differential Count</li>
                                    </ul>
                                    <div class="test-meta">
                                        <span class="parameters-count"><i class="bi bi-clipboard-data me-2"></i>25
                                            Parameters</span>
                                        <div class="test-price">
                                            <span class="current-price">₹280</span>
                                            <span class="old-price">₹550</span>
                                            <span class="discount-badge">49% OFF</span>
                                        </div>
                                    </div>
                                    <button class="add-to-cart-btn">
                                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </div>
                            </div>

                            <!-- Test Card 2 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="test-card tata1mg">
                                    <span class="lab-badge badge-tata1mg">Tata 1mg</span>
                                    <div class="test-icon icon-tata1mg">
                                        <i class="bi bi-brightness-high text-white"></i>
                                    </div>
                                    <h5>Vitamin D Test</h5>
                                    <p>Measure vitamin D levels for bone health and immunity assessment</p>
                                    <ul class="test-features">
                                        <li><i class="bi bi-check-circle-fill"></i>Vitamin D2 & D3</li>
                                        <li><i class="bi bi-check-circle-fill"></i>Total Vitamin D</li>
                                        <li><i class="bi bi-check-circle-fill"></i>Deficiency Check</li>
                                    </ul>
                                    <div class="test-meta">
                                        <span class="parameters-count"><i class="bi bi-clipboard-data me-2"></i>1
                                            Parameter</span>
                                        <div class="test-price">
                                            <span class="current-price">₹600</span>
                                            <span class="old-price">₹1,200</span>
                                            <span class="discount-badge">50% OFF</span>
                                        </div>
                                    </div>
                                    <button class="add-to-cart-btn">
                                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </div>
                            </div>

                            <!-- Test Card 3 -->
                            <div class="col-lg-4 col-md-6">
                                <div class="test-card tata1mg">
                                    <span class="lab-badge badge-tata1mg">Tata 1mg</span>
                                    <div class="test-icon icon-tata1mg">
                                        <i class="bi bi-water text-white"></i>
                                    </div>
                                    <h5>Kidney Function Test (KFT)</h5>
                                    <p>Complete kidney health assessment including creatinine and urea levels</p>
                                    <ul class="test-features">
                                        <li><i class="bi bi-check-circle-fill"></i>Creatinine</li>
                                        <li><i class="bi bi-check-circle-fill"></i>Blood Urea Nitrogen</li>
                                        <li><i class="bi bi-check-circle-fill"></i>Uric Acid</li>
                                    </ul>
                                    <div class="test-meta">
                                        <span class="parameters-count"><i class="bi bi-clipboard-data me-2"></i>10
                                            Parameters</span>
                                        <div class="test-price">
                                            <span class="current-price">₹380</span>
                                            <span class="old-price">₹750</span>
                                            <span class="discount-badge">49% OFF</span>
                                        </div>
                                    </div>
                                    <button class="add-to-cart-btn">
                                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <x-retailer.srlpincodemodal />
    <x-retailer.srldatemodal />
    <x-retailer.srldateslotsmodal />
</section>


<x-retailer.footer />
<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll(".labnote").forEach(note => {
            const limit = 100; // number of characters to show initially
            const fullText = note.innerText;

            if (fullText.length > limit) {

                const visibleText = fullText.slice(0, limit);
                const hiddenText = fullText.slice(limit);

                // Set truncated text with hidden part
                note.innerHTML = visibleText + '<span class="dots">...</span><span class="more">' + hiddenText + '</span>';

                // Create read more button dynamically
                const btn = document.createElement("a");
                btn.className = "read-more-btn";
                btn.href = "javascript:void(0)";
                btn.textContent = "Read More";

                note.after(btn);

                const more = note.querySelector(".more");
                const dots = note.querySelector(".dots");

                // Add toggle functionality
                btn.addEventListener("click", (e) => {

                    e.preventDefault();

                    // Check if more text is currently hidden (display is "none" or empty)
                    if (more.style.display === "none" || more.style.display === "") {
                        // Fade out dots
                        dots.classList.add('hiding');
                        setTimeout(() => {
                            dots.style.display = "none";
                            dots.classList.remove('hiding');
                            // Show more text with animation
                            more.style.display = "inline";
                        }, 300);
                        btn.textContent = "Read Less";
                    } else {
                        // Hide more text with animation
                        more.classList.add('hiding');
                        setTimeout(() => {

                            more.style.display = "none";
                            more.classList.remove('hiding');
                            // Show dots with fade in
                            dots.style.display = "inline";
                        }, 300);

                        btn.textContent = "Read More";
                    }
                });
            }
        });
    });

    document.addEventListener("click", async function (e) {

        if (e.target.classList.contains("buy_now_srl")) {

            const package_id = e.target.getAttribute("package_id");
            const hiddenpackgeinput = document.getElementById("selected_package");
            hiddenpackgeinput.value = package_id;

            e.preventDefault();
            $("#srlpincodemodal").modal("show");
        
        }
        if (e.target.classList.contains("book")) {

            e.preventDefault();
            const form = e.target.closest('form');
            const formdata = new FormData(form); // 'new' should be lowercase
            const url = form.action;

            try {
                const res = await fetch(url, {
                    method: "POST", // Uppercase is conventional
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute("content"),

                    },
                    body: formdata,
                });

                const data = await res.json();
                if (data.api_response.RSP_CODE == 100 && data.api_response.RSP_MSG == "TRUE") {

                    // Close all open modals
                    $(".modal").modal("hide");
                    const hiddenpincodeinput = document.getElementById("hiddenpincode");

                    hiddenpincodeinput.value = data.pincode;

                    // Wait a little to ensure previous modals are closed
                    setTimeout(function () {
                        $("#srldatemodal").modal("show");
                    }, 400);
                }
                else {
                    Swal.fire({
                        title: "Oops!",
                        text: "Our service is not available in your area yet. Coming Soon...!!!",
                        icon: "error",
                        confirmButtonText: "Okay",
                        confirmButtonColor: "#d33"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Close all open modals
                            $(".modal").modal("hide");
                        }
                    });
                }

            } catch (error) {
                alert(error.message);
            }
        }



        if (e.target.classList.contains("book_data_slots")) {
            e.preventDefault();
            try {

                const form = e.target.closest('form');

                const formdata = new FormData(form);

                const url = form.action;



                const res = await fetch(url, {

                    method: "POST",

                    headers: {

                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute('content'),
                    },
                    body: formdata,

                });


                const data = await res.json();
                console.log(data);
                if (data.RSP_CODE == 200) {

                    $(".modal").modal("hide");

                    $('#srldateslotsmodal').modal("show");
                    // Example: `data` is the response from AJAX with RSP_MSG array
                    const slotContainer = document.getElementById("slots_container");
                    const hiddenInput = document.getElementById("selected_slot");

                    // Clear previous slots
                    slotContainer.innerHTML = "";

                    // Loop through all slots
                    data.RSP_MSG.forEach(slot => {
                        const button = document.createElement("button");
                        button.type = "button";
                        button.classList.add("slot-btn");

                        // Set color based on availability
                        switch (slot.AVAIBILITY.toLowerCase()) {
                            case "green":
                                button.classList.add("green");
                                button.disabled = false;
                                break;
                            case "yellow":
                                button.classList.add("yellow");
                                button.disabled = false;
                                break;
                            case "red":
                                button.classList.add("red");
                                button.disabled = true; // not clickable
                                break;
                            default:
                                button.disabled = true;
                        }

                        button.textContent = slot.SLOTS;

                        // Click event
                        button.addEventListener("click", () => {
                            if (button.disabled) return;

                            // Remove previously selected
                            slotContainer.querySelectorAll(".slot-btn.selected").forEach(b => b.classList.remove("selected"));

                            // Add selected class
                            button.classList.add("selected");

                            // Set hidden input value
                            hiddenInput.value = slot.SLOTS;


                            const pincodevalue = document.querySelector("input[name='pincode']").value;
                            const hidddenpininput = document.getElementById("selected_pincode");
                            hidddenpininput.value = pincodevalue;



                        });

                        slotContainer.appendChild(button);
                    });



                }

            } catch (error) {

                alert(error.message);

            }




        }

    })


</script>