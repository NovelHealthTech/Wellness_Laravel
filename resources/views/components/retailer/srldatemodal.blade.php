<div class="modal fade" id="srldatemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Pincode</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('retailer.srldate.post') }}" method="post">
                
                @csrf

                <div class="modal-body">
                    <input type="hidden" name="pincode" class="form-control" id="hiddenpincode" value=""> 
                    <input type="date" name="date" class="form-control w-50" placeholder="enter the pincode" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary button_color book_data_slots">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
