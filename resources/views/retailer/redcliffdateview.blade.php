<x-retailer.header />
<style>
    body {
        background: #f8f9fa;

    }

    .date-picker-wrapper {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        max-width: 900px;
        margin: 0 auto;
    }

    .date-scroll-container {
        position: relative;
        overflow: hidden;
    }

    .scroll-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        background: white;
        border: 1px solid #e0e0e0;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .scroll-btn:hover {
        background: #f8f9fa;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .scroll-btn-left {
        left: -12px;
    }

    .scroll-btn-right {
        right: -12px;
    }

    .dates-container {
        display: flex;
        gap: 1rem;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding: 0.5rem 0;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .dates-container::-webkit-scrollbar {
        display: none;
    }

    .date-card {
        min-width: 120px;
        flex-shrink: 0;
        background: #f8f9fa;
        border: 2px solid transparent;
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }

    .date-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .date-card.selected {
        background: linear-gradient(135deg, #4a9ff5 0%, #3b8ed9 100%);
        border-color: #4a9ff5;
        box-shadow: 0 4px 16px rgba(74, 159, 245, 0.3);
    }

    .date-card.selected .date-number,
    .date-card.selected .day-name {
        color: white !important;
    }

    .date-card.selected .availability-badge {
        background: rgba(255, 255, 255, 0.25);
        color: white;
    }

    .date-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 0.25rem;
    }

    .day-name {
        font-size: 0.875rem;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .availability-badge {
        display: none;
    }

    .badge-available {
        background: #d1f4e0;
        color: #0f5132;
    }

    .badge-closed {
        background: #f8d7da;
        color: #842029;
    }

    .badge-limited {
        background: #fff3cd;
        color: #997404;
    }

    .please-note {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #cfe2ff;
        color: #084298;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        margin-top: 1rem;
    }

    .please-note i {
        font-size: 1.25rem;
    }

    .month-label {
        font-size: 0.75rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 0.25rem;
    }


    /* for the slots */
    .slot-legend {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 12px;
        font-size: 14px;
        font-weight: 500;
        margin: 30px 10px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .dot.green {
        background: #28a745;
    }

    .dot.yellow {
        background: #ffc107;
    }

    .dot.red {
        background: #dc3545;
    }

    #slotContainer {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 10px;
    }

    .slot-box {
        height: 30px;
        font-size: 12px;
        background: #fff;
        text-align: center;
        cursor: pointer;
        border-radius: 6px;
        font-weight: 500;
        user-select: none;
        border: 2px solid #ccc;
    }

    .slot-box.green {
        border-color: #28a745;
        color: #28a745;
    }

    .slot-box.yellow {
        border-color: #ffc107;
        color: #856404;
    }

    .slot-box.red {
        border-color: #dc3545;
        color: #dc3545;
        cursor: not-allowed;
        background: #f8f9fa;
    }

    .slot-box.active {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    /* Professional Modal Styles */
    .custom-modal {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    }

    .custom-modal .modal-header {
        background: #f0f7ff;
        color: #2c5282;
        border-radius: 16px 16px 0 0;
        padding: 20px 24px;
        border-bottom: 2px solid #e3f2fd;
    }

    .custom-modal .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
        color: #2c5282;
    }

    .custom-modal .modal-body {
        padding: 24px;
        max-height: 500px;
        overflow-y: auto;
    }

    .custom-modal .modal-footer {
        border-top: 1px solid #e3f2fd;
        padding: 16px 24px;
        background-color: #fafcff;
        border-radius: 0 0 16px 16px;
    }

    /* Time Slot Styles */
    .time-slot-box {
        border: 2px solid #e3f2fd !important;
        border-radius: 8px;
        padding: 12px 8px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
        color: #2c5282;
    }

    .time-slot-box:hover {
        border-color: #4a90e2 !important;
        background: #f0f7ff !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(74, 159, 245, 0.15);
    }

    .btn-check:checked+.time-slot-box {
        background: #4a90e2 !important;
        border-color: #4a90e2 !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(74, 159, 245, 0.3);
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

{{-- for the time slots --}}




</head>

<body>
    <div class="container">
        <div class="date-picker-wrapper">
            <div class="date-scroll-container">
                <div class="scroll-btn scroll-btn-left" onclick="scrollDates(-1)">
                    <i class="bi bi-chevron-left"></i>
                </div>

                <div class="dates-container" id="datesContainer">
                    <!-- Dates will be dynamically generated here -->
                </div>

                <div class="scroll-btn scroll-btn-right" onclick="scrollDates(1)">
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>

            <div class="please-note">
                <i class="bi bi-info-circle-fill"></i>
                <span>Select your preferred date from available slots</span>
            </div>
        </div>
    </div>


    {{-- this is the modal for the timeslots --}}
    <div class="custom-modal card container my-5" id="timeSlotsModal" style="display: none;width:50%;"
        aria-labelledby="timeSlotsModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg p-3">
            <div class="modal-content">

                <div class="modal-header my-5">
                    <h5 class="modal-title" id="timeSlotsModalLabel">
                        <i class="bi bi-clock-fill me-2" style="color: #4a90e2;"></i>Available Time Slots
                    </h5>


                </div>

                <div class="modal-body" id="timeSlotsModalBody">
                    <form id="redclifftimeslotform" action="{{ route('retailer.redclifftimeslotsubmit') }}"
                        method="post">

                        <input type="hidden" name="latitude" id="redclifflatitude">
                        <input type="hidden" name="longitude" id="redclifflongitude">
                        <input type="hidden" name="redcliffdate" id="redcliffdate">
                        <input type="hidden" name="redcliffpincode" id="redcliffpincode">
                        @csrf
                        <!-- Time slots will be displayed here with radio buttons -->
                        <div id="timeSlotForm">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mx-3"
                                onclick="document.getElementById('timeSlotsModal').style.display='none';">
                                Close
                            </button>

                            <button type="submit" class="btn btn-primary" id="confirmSlot">
                                Confirm Slot
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedDateIndex = null;

        function generateDates() {
            const container = document.getElementById('datesContainer');
            const today = new Date();
            const dates = [];

            // Generate 30 days starting from today
            for (let i = 0; i < 30; i++) {

                const date = new Date(today);
                date.setDate(today.getDate() + i);
                dates.push(date);

            }

            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday',
                'Thursday', 'Friday', 'Saturday'];

            let html = '';

            dates.forEach((date, index) => {

                const dayNum = date.getDate();
                const dayName = days[date.getDay()];
                const monthName = months[date.getMonth()];

                // Today's date should be selected by default


                html += `
                    <div class="date-card ${index === 1 ? 'selected' : ''}" onclick="selectDate(${index})" data-index="${index}">
                        <div class="month-label">${dayNum} ${monthName}</div>
                        <div class="day-name">${dayName}</div>
                    </div>
                    `;
            });

            container.innerHTML = html;
        }
        // Initialize
        generateDates();


        function selectDate(index) {
            // Remove selected class from all cards
            document.querySelectorAll('.date-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Add selected class to clicked card
            const selectedCard = document.querySelector(`[data-index="${index}"]`);
            selectedCard.classList.add('selected');
            selectedDateIndex = index;

            // Scroll selected card into view
            selectedCard.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }

        function scrollDates(direction) {
            const container = document.getElementById('datesContainer');
            const scrollAmount = 300;
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }


        //this is for the date slots

        async function getredcliffdateslot() {

            const allDates = document.querySelectorAll(".date-card");

            const selectedCard = Array.from(allDates).find(card =>
                card.classList.contains("selected")
            );

            if (selectedCard) {

                const label = selectedCard.querySelector(".month-label").innerText.trim(); // "19 Dec"
                const year = new Date().getFullYear();

                const formattedDate = new Date(`${label} ${year}`)
                    .toISOString()
                    .split('T')[0];

                const latitude = @json($latitude);
                const longitude = @json($longitude);
                const pincode = @json($pincode);

                // ✅ SET DATE VALUE BEFORE SHOWING MODAL
                const dateinput = document.querySelector("#redcliffdate");
                if (dateinput) {
                    dateinput.value = formattedDate;
                    console.log("Date set to:", formattedDate);
                }

                const lattituteinput = document.querySelector("#redclifflatitude");
                if (lattituteinput) lattituteinput.value = latitude;

                const longitudeinput = document.querySelector("#redclifflongitude");
                if (longitudeinput) longitudeinput.value = longitude;

                const pincodeinput = document.querySelector("#redcliffpincode");
                if (pincodeinput) pincodeinput.value = pincode;

                // Show loader in timeSlotForm div
                document.querySelector("#timeSlotForm").innerHTML = `
            <div class="loader-container">
                <div class="spinner-border spinner-border-custom" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="loader-text">Loading available time slots...</p>
            </div>
        `;

                // Open the time slots modal
                $("#timeSlotsModal").css("display", "block");

                const storeDateUrl = "{{ route('retailer.redcliffdate.post') }}";

                try {
                    const res = await fetch(storeDateUrl, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            date: formattedDate,
                            latitude: latitude,
                            longitude: longitude,
                        })
                    });

                    const data = await res.json();
                    console.log(data);
                    var message = data.message;
                    const timeSlots = data.results;

                    if (timeSlots && timeSlots.length > 0) {
                        var timeSlotsHtml = "<ul class='d-flex flex-wrap gap-3'>";
                        timeSlots.forEach(function (slot, index) {
                            timeSlotsHtml += `
                    <div class="col-6 col-md-3 ">
                        <input 
                            type="radio" 
                            class="btn-check" 
                            name="timeSlot" 
                            id="slot${index}" 
                            value="${slot.id}" 
                            autocomplete="off">
                        <label 
                            class="btn btn-outline-primary w-100 time-slot-box" 
                            for="slot${index}">
                            ${slot.format_12_hrs.start_time} - ${slot.format_12_hrs.end_time}
                        </label>
                    </div>
                    `;
                        });

                        $("#timeSlotForm").html(`<p>${message}</p>${timeSlotsHtml}`);
                    } else {
                        $("#timeSlotForm").html(`
                    <div class="empty-state">
                        <i class="bi bi-calendar-x"></i>
                        <p>No time slots available for the selected date.</p>
                    </div>
                `);
                    }

                } catch (error) {
                    alert(error.message);
                    $("#timeSlotForm").html(`
                <div class="empty-state">
                    <i class="bi bi-exclamation-triangle text-danger"></i>
                    <p class="text-danger">An error occurred while fetching time slots.</p>
                    <p class="text-muted">${error.message}</p>
                </div>
            `);
                }
            }
        }

        window.addEventListener('DOMContentLoaded', function () {
            // Wait a bit for generateDates() to complete
            setTimeout(function () {
                // Select the first date automatically
                selectDate(1);
                // Then call the function to load slots
                getredcliffdateslot();
            }, 100);
        });




        //this is for clicking on the card
        document.addEventListener("click", function (e) {
            const card = e.target.closest(".date-card");

            if (card) {
                console.log("card clicked");

                const label = card.querySelector(".month-label").innerText.trim();
                const year = new Date().getFullYear();

                const formattedDate = new Date(`${label} ${year}`)
                    .toISOString()
                    .split('T')[0];

                console.log("Formatted date:", formattedDate);

                // ✅ SET DATE IMMEDIATELY
                const dateinput = document.querySelector("#redcliffdate");
                if (dateinput) {
                    dateinput.value = formattedDate;
                    console.log("Date input value set to:", dateinput.value);
                }

                getredcliffdateslot();
            }
        });



        document.getElementById("redclifftimeslotform").addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent default form submission
            console.log("form submitted");

            const selectedSlot = document.querySelector("input[name='timeSlot']:checked");

            if (!selectedSlot) {
                alert("Please select a time slot");
                return; // Stop here if not selected
            }

            // If validation passes, manually submit the form
            e.target.submit(); // OR this.submit();
        });







    </script>



    <x-retailer.footer />