@push("styles")
<style>
.panindia {
    background-image: url("{{ asset('images/website/about/indiamap.png') }}");
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    width: 100%;
    min-height: 100vh;
    display: flex;
    flex-direction: column; /* stack elements vertically */
    justify-content: center; /* vertically center the content */
    align-items: center; /* horizontally center the content */
    gap: 2rem; /* space between text and button */
    padding: 0; /* remove extra padding */
    box-sizing: border-box;
    padding: 20% 0;
}

.pan_india_div {
    background: rgba(4, 43, 72, 0.4); /* semi-transparent overlay */
    text-align: center;
    padding: 20px 40px; /* make it bigger and centered */
    border-radius: 10px; /* optional: rounded edges */
}

.pan_india_div h3 {
    color: white;
    margin: 0;
    font-size: 2rem; /* larger text */
}

.panindia .btn {
    background-color: #243665;
    color: white;
    border: none;
    padding: 12px 30px;
    font-size: 1rem;
    border-radius: 5px;
}
</style>
@endpush

<div class="panindia">
    <div class="pan_india_div">
        <h3>PAN INDIA COVERAGE</h3>
    </div>

    {{-- <button class="btn">
        Join Our Team
    </button> --}}
</div>
