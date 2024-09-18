@include('layouts.header')
<nav>
    @include('layouts.navebar')
</nav>
@include('layouts.sidebar')
   <main id="main" class="main">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
  <script>
         document.addEventListener('DOMContentLoaded', function () {
                    function autoDismissAlert(alertId) {
                     var alertElement = document.getElementById(alertId);
                     if (alertElement) {
                     setTimeout(function () {
                     var bootstrapAlert = new bootstrap.Alert(alertElement);
                     bootstrapAlert.close();
                    }, 3000);
                }
              }
          autoDismissAlert('success-alert');
        autoDismissAlert('error-alert');
        });
 </script>

            <div class="d-flex justify-content-between">
                <h5 class="card-title">Blogs</h5>
                <a href="{{ route('blogForm') }}" class="btn btn-primary   ms-auto" style="height: 50px; padding: 5px 10px; margin-top:10px;" >Add Blog</a>
            </div>

          <table id="blogsTable" class="table table-striped table-borderd">
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
                        <td ><img src="{{asset('storage/'.$blog->image) }}" alt="{{ $blog->image }}" height= 60px width=60px ></td>
                        <td ><a href="{{ route('blogDetails',['id'=>$blog->id]) }}" class="btn"><img src="{{ asset('images/eye.png') }}"  height= 23px width=20px> </a></td>
                        <td>
                          <a href="{{ route('blogEdit',['id'=>$blog->id]) }}" class=" " ><img src="{{ asset('images/edit.png') }}"  height= 20px width=20px alt=""></a>
                          <a href="" class=" "><img src="{{ asset('images/delete.png') }}"  height= 20px width=20px    ></a>
                        </td>
                    </tr>
                     @endforeach
            </tbody>
          </table>
        </div>
      </div>

  </main><!-- End #main -->
    @include('layouts.footer')
    <script>
        $(document).ready(function() {
            $('#blogsTable').DataTable({
                // Add DataTable configuration options here (if needed)
                paging: true,    // Enable pagination
                searching: true, // Enable searching
                ordering: true,  // Enable column sorting
                responsive: true // Make the table responsive
            });
        });
        </script>

    <script>
        function getFirst8Words(description) {
            return description.split(/\s+/).slice(0, 5).join(" ");
        }
        document.querySelectorAll("td[id^='description-']").forEach(function(td) {
            let fullDescription = td.textContent.trim();  // Get the full description
            let shortDescription = getFirst8Words(fullDescription);  // Get the first 8 words
            td.textContent = shortDescription;  // Set the short description as the content
        });
    </script>
