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
                <h5 class="card-title">Blogs</h5>
                <a href="{{ route('blogForm') }}" class="btn btn-primary">Add Blog</a>
            </div>

            <table id="blogsTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $blog->title }}</td>
                            <td id="description-{{ $blog->id }}">{{ $blog->description }}</td>
                            <td>
                                <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->image }}" class="img-thumbnail" style="height: 60px; width: 60px;">
                            </td>
                            <td>
                                <a href="{{ route('blogDetails', ['id' => $blog->id]) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('blogEdit', ['id' => $blog->id]) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm">
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
        $('#blogsTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            responsive: true
        });
    });
</script>

<script>
    function getFirst8Words(description) {
        return description.split(/\s+/).slice(0, 8).join(" ");
    }

    document.querySelectorAll("td[id^='description-']").forEach(function(td) {
        let fullDescription = td.textContent.trim();
        let shortDescription = getFirst8Words(fullDescription);
        td.textContent = shortDescription;
    });

    </script>
