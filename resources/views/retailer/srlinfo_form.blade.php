<x-retailer.header />
<div class="card p-5 m-5">
    <form id="personal_form" action="{{ route('retailer.srlformsubmit') }}" method="post">
        @csrf
        <h1 class="text-center my-3">Personal Information</h1>
        <input type="hidden" name="package_id" value="{{ session('package_id') }}">
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <input type="hidden" name="is_payment" value="0">
        <input type="hidden" name="dobFlag" value="1">
        <input type="hidden" name="is_cancel_order" value="0">
        <input type="hidden" name="is_download_report" value="0">

        <div class="row">
            <div class="col-md-4">
                <label for="" class="my-2">Title</label>
                <select class="form-control" name="title">
                    <option value="" disabled selected hidden>Select title</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Miss">Miss</option>
                    <option value="Ms.">Ms.</option>
                </select>
                @error("title")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="" class="my-2">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                @error("first_name")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="my-2" for="">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
                @error("last_name")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-4">
                <label class="my-2" for="">Gender</label>
                <select name="gender" class="form-control">
                    <option value="" selected hidden>Choose</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                @error("gender")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="my-2" for="">Date of birth</label>
                <input name="dob" class="form-control" type="date" value="{{ old('dob') }}">
                @error("dob")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="" class="my-2">Mobile No.</label>
                <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}">
                @error("mobile")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <label for="" class="my-2">Alternate Contact (optional)</label>
            <input type="text" name="alternate_mobile" class="form-control" placeholder="Alternate Contact"
                value="{{ old('alternate_mobile') }}">
            @error("alternate_mobile")
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <label for="Email" class="my-2">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                @error("email")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="" class="my-2">Booking Date</label>
                <input type="text" value="{{ session('timing') }} {{ date('Y-m-d H:i:s') }}" class="form-control"
                    name="booking_date" readonly>
                @error("booking_date")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="my-2" for="Pincode">Pincode</label>
                <input type="text" readonly value="{{ session('pincode') }}" name="pincode" class="form-control">
                @error("pincode")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mt-2">
            <label for="" class="my-2">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter the address"
                value="{{ old('address') }}">
            @error("address")
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="" class="my-2">Location</label>
                <input type="text" class="form-control" placeholder="Enter Location" name="location"
                    value="{{ old('location') }}">
                @error("location")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="" class="my-2">City</label>
                <input type="text" class="form-control" name="city" placeholder="Enter the city"
                    value="{{ old('city') }}">
                @error("city")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="" class="my-2">State</label>
                <input type="text" class="form-control" name="state" placeholder="Enter the state"
                    value="{{ old('state') }}">
                @error("state")
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-25 my-5">Submit</button>
    </form>
</div>

<x-retailer.footer />
<script>


    const form = document.querySelector("#personal_form");

    form.addEventListener("submit", function (e) 
    {

        e.preventDefault(); // Prevent default form submission


        // Example: Get form data
        const formData = new FormData(form);

        // If validation passes, submit the form
        form.submit();

        // OR use fetch for AJAX submission:
        fetch(form.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
        
    });


    // Check if page was refreshed
    if (performance.navigation.type == 1) {

        // Redirect to your desired route
        window.location.href = "{{ url('allpackages') }}";


    }



</script>