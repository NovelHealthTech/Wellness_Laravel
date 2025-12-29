<x-retailer.header />
<div class="container card my-5">
    <div id="bookingDetailsContainer">

        <form id="bookingFormredcliff" class="p-5" method="post"  action="{{ route('retailer.red_cliffe_order_placed') }}">
            
            @csrf

            <!-- Hidden Fields -->
            <input type="hidden" value="{{ $latitude }}" id="customer_latitude" name="customer_latitude">
            <input type="hidden" value="{{$longitude  }}" id="customer_longitude" name="customer_longitude">
            <input type="hidden" value="{{ $collection_slot_id }}" id="collection_slot_id" name="collection_slot_id">
          
           

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group mb-2">
                        <label for="booking_date" class="form-label">Booking Date</label>
                        <input type="date" class="form-control form-control-sm" id="booking_date" name="booking_date"
                            value="<?php echo date('Y-m-d'); ?>" required readonly>
                    </div>

                    <div class="form-group mb-2">
                        <label for="collection_date" class="form-label">Collection Date</label>
                        <input value="{{ $collection_date }}" type="date" class="form-control form-control-sm"
                            id="collection_date" name="collection_date" readonly>
                    </div>

                    <div class="form-group mb-2">
                        <label for="customer_age" class="form-label">Customer Age</label>
                        <input type="number" class="form-control form-control-sm" id="customer_age" name="customer_age">
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group mb-2">
                        <label for="customer_phonenumber" class="form-label">Customer Phone Number</label>
                        <input type="number" class="form-control form-control-sm" id="customer_phonenumber"
                            name="customer_phonenumber">
                    </div>

                    <div class="form-group mb-2">
                        <label for="customer_whatsappnumber" class="form-label">Customer WhatsApp Number</label>
                        <input type="number" class="form-control form-control-sm" id="customer_whatsappnumber"
                            name="customer_whatsappnumber">
                    </div>

                    <div class="form-group mb-2">
                        <label for="customer_gender" class="form-label">Customer Gender</label>
                        <select class="form-control form-control-sm" id="customer_gender" name="customer_gender">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="form-group mb-2">
                        <label for="customer_name" class="form-label">Customer Name</label>
                        <input type="text" class="form-control form-control-sm" id="customer_name" name="customer_name">
                    </div>


                    <div class="form-group mb-2">
                        <label for="user_pincode" class="form-label">Pincode</label>
                        <input value="{{ $pincode }}" type="text" class="form-control form-control-sm" id="user_pincode"
                            name="pincode" readonly>
                    </div>

                    <div class="form-group mb-2">
                        <label for="customer_landmark" class="form-label">Customer Landmark</label>
                        <input type="text" class="form-control form-control-sm" id="customer_landmark"
                            name="customer_landmark">
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="form-group mb-3">
                        <label for="customer_address" class="form-label">Customer Address</label>
                        <textarea class="form-control form-control-sm" id="customer_address" name="customer_address"
                            rows="3"></textarea>
                    </div>

                </div>
            </div>

            <div id="errorMessages" class="text-danger mb-2"></div>

            <button type="submit" class="btn btn-primary" id="submitBooking">
                Submit Booking
            </button>

        </form>
    </div>
</div>


<x-retailer.footer />
<script>
 document.getElementById("bookingFormredcliff").addEventListener("submit",function(e){


    

    e.preventDefault();

    e.target.submit();



 })



</script>