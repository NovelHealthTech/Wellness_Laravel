<div class="modal fade" id="redcliffpincodemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Book your test</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('redcliff.redcliffpincode.post') }}" method="post" novalidate>
                @csrf
                <div class="modal-body">

                    <input type="text" name="pincode" class="form-control w-50" placeholder="enter the pincode"
                        required>
                    <div class="invalid-feedback">
                        please enter the pincode
                    </div>

                    <input type="text" name="locality" placeholder="Entrt the locality">
                    <div class="invalid-feedback"></div>

                    <input type="text" name="pincode" placeholder="Enter the pincode">
                    <div class="invalid-feedback">
                        
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary button_color redcliff_book">book</button>
                </div>
            </form>

        </div>
    </div>
</div>