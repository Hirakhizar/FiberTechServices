 @include('layouts.header')


<nav>
    @include('layouts.navebar')
</nav>
@include('layouts.sidebar')

<main id="main" class="main">
    <div class="card ">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" id="success-alert">
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
                <h5 class="card-title">Categories</h5>
                <a href="{{ route('addCategory') }}" class="btn btn-primary">Add Category</a>
            </div>

            <table id="categoriesTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categoryEdit', ['id' => $category->id]) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('categoryDelete', ['id' => $category->id]) }}" class="btn btn-danger btn-sm">
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
        $('#categoriesTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            responsive: true
        });
    });
</script>
