@push("styles")


@endpush

<div class="row mx-0 mt-5 align-items-center">
  <!-- LEFT COLUMN -->
  <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right"  data-aos-delay="400">
    <h2 class="text_grey">Read top articles</h2>
    <h2 class="text_grey">from our doctor's desk</h2>
    <p>Health articles that keep you informed about</p>
    <p>good health practices and achieve your goals.</p>
    <div class="mt-3">
      {{-- <a class="text_grey text-decoration-none pt-5" href="#">See all articles</a> --}}
    </div>
  </div>
  
  <!-- RIGHT COLUMN -->
  <div class="col-md-6" data-aos="fade-left" data-aos-delay="400">
    <div class="row g-3">
      <div class="col-6">
        <div class="h-100 text-center">
          <img src="{{ asset('images/website/home/aids.png') }}" 
               class="img-fluid rounded  shadow-sm" 
               alt="World Aids Day">
          <h4 class="card-title text-center mt-2">World Aids Day</h4>
        </div>
      </div>

      <div class="col-6">
        <div class="h-100 text-center">
          <img src="{{ asset('images/website/home/pheumonia.png') }}" 
               class="img-fluid rounded shadow-sm" 
               alt="Pneumonia Awareness">
          <h5 class="card-title text-center mt-2">Pneumonia Awareness</h5>
        </div>
      </div>
    </div>
  </div>
</div>
