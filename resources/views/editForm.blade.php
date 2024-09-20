@include('layouts.header')

<!-- Navbar -->
<nav>
    <!-- Include your navigation bar here -->
    @include('layouts.navebar')
</nav>
@include('layouts.sidebar')

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
                    <textarea class="form-control" id="details" name="details" rows="4" required>{{ old('details', $blog->details) }}</textarea>
                    @error('details')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                @php
              $seoData = json_decode($blog->seo);
                  @endphp

       
               
                <div class="mb-3">
                  <label for="meta_title" class="form-label">Meta Title</label>
                  <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $seoData->meta_title ?? '') }}" required>
                  @error('meta_title')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
              </div>
              
              <div class="mb-3">
                  <label for="meta_description" class="form-label">Meta Description</label>
                  <textarea class="form-control" id="meta_description" name="meta_description" rows="2" required>{{ old('meta_description', $seoData->meta_description ?? '') }}</textarea>
                  @error('meta_description')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
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
