<x-retailer.header />

<style>
    body {
        background: #ffffff;
    }

    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
        padding: 24px 0;
    }

    .package-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .test-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ef4444, #f97316);
        color: #fff;
        font-size: 24px;
        margin-bottom: 12px;
    }

    .test-title {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 6px;
        color: #111827;
    }

    .labnote {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .test-features {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .test-features li {
        font-size: 14px;
        color: #374151;
        margin-bottom: 6px;
    }

    .view-more {
        margin-top: 6px;
        font-size: 14px;
        font-weight: 600;
        color: #2563eb;
        cursor: pointer;
        width: fit-content;
    }
</style>
</head>

<body>

    <!-- Header -->
    <div class="border-bottom py-4 mb-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="fw-bold text-decoration-none text-dark">
                <i class="bi bi-arrow-left"></i> Back to Home
            </a>

            <div class="text-end">
                <h1 class="h5 mb-1">Health Test Packages</h1>
                <p class="text-muted mb-0">Choose from top laboratories</p>
            </div>
        </div>
    </div>


    <!-- Packages -->
    <div class="container">
        <div class="packages-grid">

            @foreach ($allpackages as $package)

                @php
                    // Decode JSON into array
                    $description = json_decode($package->description, true);

                    // Get tests array or empty array if not present
                    $tests = $description['tests'] ?? [];
                @endphp

                <div class="package-card">

                    <div class="test-icon">
                        <i class="bi bi-clipboard-pulse"></i>
                    </div>

                    <div class="test-title">
                        {{ $package->packagename }}
                    </div>

                    <p class="labnote">
                        {{ $package->short_description ?? 'Comprehensive health screening tests' }}
                    </p>


                    <!-- Tests List -->
                    <ul class="test-features">
                        @foreach($tests as $index => $test)
                            <li class="{{ $index >= 4 ? 'd-none extra-test-' . $package->id : '' }}">
                                <i class="bi bi-check-circle text-success"></i>
                                {{ $test }}
                            </li>
                        @endforeach
                    </ul>

                    @if(!empty($tests) && count($tests) > 2)

                        <a href="{{ route('retailer.individual_package', ['id' => $package->id]) }}"
                            class="view-more text-decoration-none">
                            View more
                        </a>

                    @endif

                </div>
            @endforeach
        </div>
    </div>


     @if(isset($redcliffcartitems))
     <x-retailer.recliffcart   :redcliffcartitems="$redcliffcartitems" />
     @endif
    @if (isset($srlcartitems))
    <x-retailer.srlcart :srlcartitems="$srlcartitems"/>
        
    @endif


    <x-retailer.footer />
    <script>
        function toggleTests(packageId, el) {
            const extraTests = document.querySelectorAll('.extra-test-' + packageId);
            const isHidden = extraTests[0].classList.contains('d-none');

            extraTests.forEach(item => {
                item.classList.toggle('d-none');
            });

            el.innerText = isHidden ? 'View less' : 'View more';
        }
    </script>

</body>

</html>