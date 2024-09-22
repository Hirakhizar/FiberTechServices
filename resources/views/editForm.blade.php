@include('layouts.header')

<!-- Navbar -->
<nav>
    <!-- Include your navigation bar here -->
    @include('layouts.navebar')
</nav>
@include('layouts.sidebar')


<script>
    function initTinyMCE() {
        tinymce.init({
            selector: 'textarea.tinymce',  // Applies TinyMCE to any textarea with the class 'tinymce'
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | ' +
                    'alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | removeformat',
            height: 300
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        initTinyMCE();
    });
</script>


<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Blog</h1>
      <nav>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12 col-sm-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Blog</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ route('updateBlog', $blog->id) }}" enctype="multipart/form-data">
                  @csrf

                <div class="col-md-12 " style="margin-top: 10px;">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <!-- Display current image -->
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" style="width: 100px; margin-top: 10px;">
                    @endif
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 " style="margin-top: 10px;">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 " style="margin-top: 10px;">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $blog->description) }}" required>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 " style="margin-top: 10px;">
                    <label for="details" class="form-label">Details</label>
                            <textarea class="form-control tinymce " name="details" id="details">{{ old('details',$blog->description) }}</textarea>
                        @error('details')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3"  style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary">Update Blog</button>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
