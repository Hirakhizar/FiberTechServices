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
      <h1></h1>
      <nav>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12 col-sm-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Blog</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ route('addBlog') }}" enctype="multipart/form-data">
                  @csrf

                <div class="col-md-12 " style="margin-top: 10px;">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 " style="margin-top: 10px;">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 " style="margin-top: 10px;">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 " style="margin-top: 10px;">
                    <label for="details" class="form-label">Details</label>
                        <textarea class="form-control tinymce " name="details" id="details">{{ old('details') }}</textarea>
                    </div>

                    @error('details')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3"  style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
