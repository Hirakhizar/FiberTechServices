


@include('layouts.header')


<!-- Navbar -->
<nav>
    <!-- Include your navigation bar here -->
    @include('layouts.navebar')
</nav>
@include('layouts.sidebar')

<main id="main" class="main py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        
                        <!-- Blog Title -->
                        <h1 class="text-center mb-4 display-4">{{ $blog->title }}</h1>

                        @php
                            $seoData = json_decode($blog->seo);
                        @endphp

                        <!-- Meta Title and Description -->
                        @if(isset( $seoData->meta_title) || isset($seoData->meta_description))
                            <div class="seo-data mb-4 p-4 bg-light rounded">
                                <h4 class="font-weight-bold">Meta Information</h4>
                                <p><strong>Meta Title:</strong> {{  $seoData->meta_title ?? 'N/A' }}</p>
                                <p><strong>Meta Description:</strong> {{  $seoData->meta_description ?? 'N/A' }}</p>
                            </div>
                        @endif

                        <!-- Blog Image -->
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/'.$blog->image) }}" class="img-fluid rounded shadow-lg" alt="Blog Image" style="max-width: 100%; height: auto;">
                        </div>

                        <!-- Blog Description -->
                        <div class="blog-content">
                            <h3 class="mt-4">Overview</h3>
                            <p class="lead text-muted" style="margin-top: 1%;">{{ $blog->description }}</p>

                            <!-- Blog Details -->
                            <h4 class="mt-4">Details</h4>
                            <p class="text-justify">{{ $blog->details }}</p>
                        </div>

                        <!-- Back to Blog List or Home -->
                        <div class="mt-5 text-center">
                            <a href="{{ url()->previous() }}" class="btn btn-lg btn-outline-primary shadow-sm">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.footer')

<!-- Optional JavaScript to truncate description -->
<script>
    function getFirst8Words(description) {
        return description.split(/\s+/).slice(0, 8).join(" ");
    }

    // Truncate blog descriptions if necessary
    document.querySelectorAll("td[id^='description-']").forEach(function(td) {
        let fullDescription = td.textContent.trim();
        let shortDescription = getFirst8Words(fullDescription);
        td.textContent = shortDescription;
    });
</script>

