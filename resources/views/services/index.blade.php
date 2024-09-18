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
                <h5 class="card-title">Services</h5>
                <a href="{{ route('serviceForm') }}" class="btn btn-primary   ms-auto" style="height: 50px; padding: 5px 10px; margin-top:10px;" >Add Service</a>
            </div>
            <table id="servicesTable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Id </th>
                <th>Name</th>
                <th>Category</th>
                <th>Thumbnail</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                     @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td> {{ $service->title  }} </td>
                        <td >{{ $service->category->name }}</td>
                        <td> <img src="{{asset('storage/'.$service->thumbnail)}}" alt="{{asset('storage/'.$service->thumbnail)}}" height="100px" width="100px">
                         </td>
                           <td>
                            <a href="{{ route('editService',['id'=>$service->id]) }}" class=" " ><img src="{{ asset('images/edit.png') }}"  height= 20px width=20px alt=""></a>
                            <a  href="{{ route('deleteService',['id'=>$service->id]) }}" class=" "><img src="{{ asset('images/delete.png') }}"  height= 20px width=20px    ></a>
                          </td>
                    </tr>
                     @endforeach
            </tbody>
          </table>

        </div>
      </div>

  </main>
    @include('layouts.footer')
    <script>
        $(document).ready(function() {
            $('#servicesTable').DataTable({
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
            let fullDescription = td.textContent.trim();
            let shortDescription = getFirst8Words(fullDescription);
            td.textContent = shortDescription;
        });
    </script>
