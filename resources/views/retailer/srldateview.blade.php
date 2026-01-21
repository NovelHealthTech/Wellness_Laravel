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
    .date-card.selected .day-name,
    .date-card.selected .month-label {
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
        height: 40px;
        font-size: 12px;
        background: #fff;
        text-align: center;
        cursor: pointer;
        border-radius: 6px;
        font-weight: 500;
        user-select: none;
        border: 2px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .slot-box.green {
        border-color: #28a745;
        color: #28a745;
    }

    .slot-box.green:hover {
        background: #d4edda;
    }

    .slot-box.yellow {
        border-color: #ffc107;
        color: #856404;
    }

    .slot-box.yellow:hover {
        background: #fff3cd;
    }

    .slot-box.red {
        border-color: #dc3545;
        color: #dc3545;
        cursor: not-allowed;
        background: #f8f9fa;
        opacity: 0.6;
    }

    .slot-box.active {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }
</style>
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
    <div class="card container my-5 p-5 w-100">

        <div id="slotLegend" class="slot-legend text-center"></div>
        <form id="srldateslot" action="{{ route('retailer.srlslotsubmit.post') }}" method="post">
            @csrf
            <input type="hidden" name="slot_time" id="slot_time">
            <input type="hidden" name="hiddenpincode" id="hiddenpincode">
            <input type="hidden" name="hiddenpackagecode" id="hiddenpackagecode">

            <div id="slotContainer"></div>
            <button type="submit" class="btn btn-primary my-3 w-25 slot_conformation">
                Confirm
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedDateIndex = 0;

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
                const isSelected = index === 0 ? 'selected' : '';

                html += `
                    <div class="date-card ${isSelected}" onclick="selectDate(${index})" data-index="${index}">
                        <div class="month-label">${dayNum} ${monthName}</div>
                        <div class="day-name">${dayName}</div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        function selectDate(index) {
            // Remove selected class from all cards
            document.querySelectorAll('.date-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Add selected class to clicked card
            const selectedCard = document.querySelector(`[data-index="${index}"]`);
            if (selectedCard) {
                selectedCard.classList.add('selected');
                selectedDateIndex = index;

                // Scroll selected card into view
                selectedCard.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });

                // Fetch slots for the selected date
                getsrlslotsdate();
            }
        }

        function scrollDates(direction) {
            const container = document.getElementById('datesContainer');
            const scrollAmount = 300;
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }

        async function getsrlslotsdate() {
            const allDates = document.querySelectorAll(".date-card");
            const selectedCard = Array.from(allDates).find(card =>
                card.classList.contains("selected")
            );

            if (!selectedCard) {
                console.error("No date selected");
                return;
            }

            const label = selectedCard.querySelector(".month-label").innerText.trim();
            const year = new Date().getFullYear();
            const formattedDate = new Date(`${label} ${year}`).toISOString().split('T')[0];

            const pincode = @json($pincode);
            document.querySelector("#hiddenpincode").value = pincode;

            const storeDateUrl = "{{ route('retailer.srldate.post') }}";

            try {
                const res = await fetch(storeDateUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        pincode: pincode,
                        date: formattedDate
                        
                    })
                });

                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }

                const data = await res.json();
                const slotContainer = document.getElementById('slotContainer');
                const slotLegend = document.getElementById('slotLegend');

                // Clear on every success
                slotContainer.innerHTML = '';
                slotLegend.innerHTML = `
                    <div class="legend-item">
                        <span class="dot green"></span> Slots available
                    </div>
                    <div class="legend-item">
                        <span class="dot yellow"></span> Limited slots
                    </div>
                    <div class="legend-item">
                        <span class="dot red"></span> Slots not available
                    </div>
                `;

                if (!data.slots || data.slots.length === 0) {
                    slotContainer.innerHTML = '<p class="text-center text-muted">No slots available for this date</p>';
                    return;
                }

                data.slots.forEach(slot => {
                    const div = document.createElement('div');
                    div.classList.add('slot-box');
                    div.textContent = slot.SLOTS;

                    const availability = slot.AVAIBILITY.toLowerCase();
                    div.classList.add(availability);

                    // Red slots are not clickable
                    if (availability === 'red') {
                        slotContainer.appendChild(div);
                        return;
                    }

                    // Green & Yellow slots are clickable
                    div.addEventListener('click', () => {
                        document.querySelectorAll('.slot-box').forEach(el => el.classList.remove('active'));
                        div.classList.add('active');
                        document.querySelector("#slot_time").value = slot.SLOTS;
                        console.log('Selected Slot:', slot.SLOTS);
                    });

                    slotContainer.appendChild(div);
                });

            } catch (error) {
                console.error("Error fetching slots:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load slots. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        }

        // Initialize
        generateDates();
        getsrlslotsdate();

        // Handle keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft' && selectedDateIndex > 0) {
                selectDate(selectedDateIndex - 1);
            } else if (e.key === 'ArrowRight' && selectedDateIndex < 29) {
                selectDate(selectedDateIndex + 1);
            }
        });

        // Form submission validation
        const form = document.getElementById('srldateslot');
        form.addEventListener('submit', function (e) {
            const allslots = document.querySelectorAll('.slot-box');
            const hasActive = Array.from(allslots).some(el => el.classList.contains('active'));

            if (!hasActive) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Select a Time Slot',
                    text: 'Please select at least one time slot before continuing',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Form will submit naturally
        });
    </script>

   

    

    <x-retailer.footer />