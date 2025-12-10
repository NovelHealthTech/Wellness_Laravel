@extends("layouts.app")
@section('content')
@push("styles")
    <style>
        .blogsearch {
            border: 1px solid grey;
            border-radius: 23px !important;
        }
        
        .hidden-row {
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: opacity 0.6s ease, max-height 0.6s ease;
        }
        
        .hidden-row.show {
            opacity: 1;
            max-height: 1000px;
        }
    </style>
@endpush
<x-website.header />
<div class="px-5">
    <div class="d-flex justify-content-end">
        <input type="text" class="px-3 py-2 mx-3 blogsearch" placeholder="Search blogsearch for any health topics">
    </div>
    <h1 class="text_grey text-center my-3">Read top articles from our doctor's desk</h1>
    <x-website.blogs.hero />
    <h2 class="my-5 text_grey text-center">Read our all articles</h2>

    <!-- Visible Rows -->
    <div class="row px-3">
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog1.png') }}" class="card-img-top img-fluid" alt="Image 1">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog2.png') }}" class="card-img-top img-fluid" alt="Image 2">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog3.png') }}" class="card-img-top img-fluid" alt="Image 3">
            </div>
        </div>
    </div>

    <div class="row px-3 py-3">
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog1.png') }}" class="card-img-top img-fluid" alt="Image 1">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog2.png') }}" class="card-img-top img-fluid" alt="Image 2">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog3.png') }}" class="card-img-top img-fluid" alt="Image 3">
            </div>
        </div>
    </div>

    <!-- Hidden Rows -->
    <div class="row px-3 py-3 hidden-row">
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog4.png') }}" class="card-img-top img-fluid" alt="Image 4">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog5.png') }}" class="card-img-top img-fluid" alt="Image 5">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog6.png') }}" class="card-img-top img-fluid" alt="Image 6">
            </div>
        </div>
    </div>

    <div class="row px-3 py-3 hidden-row">
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog7.png') }}" class="card-img-top img-fluid" alt="Image 7">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog8.png') }}" class="card-img-top img-fluid" alt="Image 8">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/website/blogs/blog9.png') }}" class="card-img-top img-fluid" alt="Image 9">
            </div>
        </div>
    </div>

    <!-- Show More Button -->
    <div class="text-center my-4">
        <button id="showMoreBtn" class="btn btn-primary">Show More</button>
    </div>

</div>
<x-website.footer />

@push('scripts')
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('showMoreBtn');
        const hiddenRows = document.querySelectorAll('.hidden-row');
        let index = 0;
        
        btn.addEventListener('click', function() {
            // Show 1 row per click with smooth animation
            if (index < hiddenRows.length) {
                hiddenRows[index].classList.add('show');
                index++;
            }
            
            // Hide button if all rows are visible
            if (index >= hiddenRows.length) {
                btn.style.display = 'none';
            }
        });
    });

</script>
@endpush
@endsection