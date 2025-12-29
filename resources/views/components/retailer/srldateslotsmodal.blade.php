<div class="modal fade" id="srldateslotsmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Pincode</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="srlavailale_timings" class="modal-body">
                <form id="slotForm" action="{{ route('retailer.srlslotsubmit.post') }}" method="post">
                    @csrf
                    <input type="hidden" name="selected_slot" id="selected_slot" value="">
                   
                    @error("selected_slot")
                        <span class="text-danger">Please select a slot</span>
                    @enderror
                    
                    <input type="hidden" name="selected_pincode" id="selected_pincode" value="">
                    <input type="hidden" name="selected_package" id="selected_package">

                    <div id="slot-legend" style="margin-bottom: 10px;">
                        <span class="slot-indicator green"></span> Available
                        <span class="slot-indicator yellow"></span> Less slots available
                        <span class="slot-indicator red"></span> Not available
                    </div>

                    <div id="slots_container" style="margin-top: 10px;"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary button_color ">
                            Confirm
                        </button>
                    </div>
                </form>
            </div>




        </div>
    </div>
</div>