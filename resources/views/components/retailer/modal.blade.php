@props([
    'id'       => 'appModal',
    'title'    => 'Modal Title',
    'subtitle' => null,
    'size'     => '',
    'link'=>'',
])

<div class="modal fade retailermodal" id="{{ $id }}" tabindex="-1"
     aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $size }}">
        <div class="modal-content border-0 shadow-lg" style="border-radius:16px; overflow:hidden;">
            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-1" id="{{ $id }}Label">
                        {{ $title }}
                    </h5>
                    @if($subtitle)
                        <p class="text-muted mb-0" style="font-size:13px;">{{ $subtitle }}</p>
                    @endif
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body  px-4 py-3">
               <form action="{{$link }}" class="retailer_modal_form">

               </form>
            </div>

            {{-- FOOTER (optional slot) --}}
            @if($footer ?? false)
                <div class="modal-footer border-0 px-4 pb-4 pt-2">
                    {{ $footer }}
                </div>
            @endif

        </div>
    </div>
</div>