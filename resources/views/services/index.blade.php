@include('layouts.header')


<nav>
    @include('layouts.navebar')
</nav>
@include('layouts.sidebar')

<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show  mt-4" role="alert" id="success-alert">
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

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Services</h5>
                <a href="{{ route('serviceForm') }}" class="btn btn-primary">Add Service</a>
            </div>

            <table id="servicesTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
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
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->category->name }}</td>
                            <td>
                                <img src="{{ asset('storage/'.$service->thumbnail) }}" alt="Thumbnail" class="img-thumbnail" style="height: 100px; width: 100px;">
                            </td>
                            <td>
                                <a href="{{ route('editService', ['id' => $service->id]) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('deleteService', ['id' => $service->id]) }}" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
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
            paging: true,
            searching: true,
            ordering: true,
            responsive: true
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