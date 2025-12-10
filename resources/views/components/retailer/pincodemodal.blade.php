<div class="modal fade" id="picodemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Pincode</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('retailer.srlpincode.post') }}" method="post">
                 @csrf
                <div class="modal-body">
                    <input type="text" name="pincode" class="form-control w-50" placeholder="enter the pincode" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary button_color book">book</button>
                </div>
            </form>

        </div>
    </div>
</div>