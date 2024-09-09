


@include('layouts.header')


<!-- Navbar -->
<nav>
    <!-- Include your navigation bar here -->
    @include('layouts.navebar')
</nav>
@include('layouts.sidebar')

<!-- Main Content -->
{{-- <div class="container">
    @yield('content')
</div> --}}
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Blogs</h5>
                <button class="btn btn-primary   ms-auto" style="height: 50px; padding: 5px 10px; margin-top:10px;" >Add Blog</button>
            </div>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>Title </th>
                <th>Discription.</th>
                <th>Image</th>
                <th>Details</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                     @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td  id="description-{{ $blog->id }}">{{ $blog->description }}</td>
                        <td ><img src="{{ $blog->image }}" alt="" height= 60px width=60px ></td>
                        <td ><a href="{{ route('blogDetails',['id'=>$blog->id]) }}" class="btn"><img src="{{ asset('images/eye.png') }}"  height= 23px width=20px> </a></td>
                        <td>
                          <a href="" class=" " ><img src="{{ asset('images/edit.png') }}"  height= 20px width=20px alt=""></a>
                          <a href="" class=" "><img src="{{ asset('images/delete.png') }}"  height= 20px width=20px    ></a>
                        </td>
                    </tr>
                     @endforeach
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

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
