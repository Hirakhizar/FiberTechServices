


@include('layouts.header')


<!-- Navbar -->
<nav>
    <!-- Include your navigation bar here -->
    @include('layouts.navebar')
</nav>
@include('layouts.sidebar')

<main id="main" class="main">
    <div class="card">
        <div class="card-body shadow p-5">
 <h2>{{ $blog->title }}</h2>
<div style="text-align: center">
 <img src="{{asset('storage/'.$blog->image) }}" height="50% " width="50%" class="mx-auto " alt="">         
</div>
<p style="margin-top: 4%;"> {{$blog->description }}</p>
<p>{{$blog->details}}</p>
        </div>
      </div>

  </main><!-- End #main -->
    @include('layouts.footer')


    <script>
        function getFirst8Words(description) {
            // Split the description by spaces and get the first 8 words
            return description.split(/\s+/).slice(0, 5).join(" ");
        }

        // Loop through all blog descriptions
        document.querySelectorAll("td[id^='description-']").forEach(function(td) {
            let fullDescription = td.textContent.trim();  // Get the full description
            let shortDescription = getFirst8Words(fullDescription);  // Get the first 8 words
            td.textContent = shortDescription;  // Set the short description as the content
        });
    </script>
