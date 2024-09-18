@include('layouts.header')

<!-- Navbar -->
<nav>
    <!-- Include your navigation bar here -->
    @include('layouts.navebar')
</nav>
@include('layouts.sidebar')

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
              <h5 class="card-title">Add Category</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ route('storeCategory') }}" enctype="multipart/form-data">
                  @csrf
                <div class="col-md-12 " style="margin-top: 10px;">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3"  style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
