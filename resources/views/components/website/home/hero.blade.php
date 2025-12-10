@push("styles")
<style>
  .hero-container {
    position: relative;
    width: 100%;
    height: 100vh; /* full viewport height */
    overflow: hidden;
  }

  .hero-container img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* cover the container without distortion */
  }

  .overlay_text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* center both vertically and horizontally */
    text-align: center;
    color: white;
    font-weight: 600;
    padding: 0 1rem; /* small padding for mobile */
  }

  /* responsive font sizes */
  @media (max-width: 768px) {
    .overlay_text {
      font-size: 2rem;
    }
  }

  @media (max-width: 480px) {
    .overlay_text {
      font-size: 1.5rem;
    }
  }
</style>
@endpush

<div class="hero-container">
  <img src="{{ asset('images/hero.png') }}" alt="Sample">
  <div class="overlay_text">
    <h1 class="m-0">Skip the queue,</h1>
    <h1 class="m-0">Consult with doctor online.</h1>
  </div>
</div>
