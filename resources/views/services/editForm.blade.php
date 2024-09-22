    @include('layouts.header')

    <nav>
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
            <h1>{{ isset($service) ? 'Edit Service' : 'Add Service' }}</h1>
            <nav></nav>
        </div><!-- End Page Title -->

        <section class="section">

            <form id="mainForm" action="{{ isset($service) ? route('updateService', $service->id) : route('addService') }}" method="post" enctype="multipart/form-data">
               @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Service Details</h5>
                                <div class="form-group mb-3">
                                    <label for="inputName">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Service Name" value="{{ old('name', isset($service) ? $service->title : '') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="inputThumbnail">Thumbnail</label>
                                    <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" id="inputThumbnail" >
                                    @error('thumbnail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if(isset($service) && $service->thumbnail)
                                        <img src="{{ asset('storage/'. $service->thumbnail) }}" alt="Thumbnail" class="img-thumbnail mt-2" style="max-width: 200px;" >
                                    @endif
                                </div>

                                <!-- Select Dropdown Field -->
                                <div class="form-group mb-3">
                                    <label for="selectCategory">Select Category:</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" id="selectCategory" name="category_id" required>
                                        <option value="" disabled>Select an option</option>
                                        <option value="{{ $service->category->id }}" selected>{{ $service->category->name }}</option>
                                            @foreach ($categories as $category)

                                                <option value="{{ $category->id }}" {{ old('category_id', isset($service) ? $service->category_id : '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div><!-- End Main Card -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-sm-6 mt-4">
                        <!-- Card for adding details -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add Section</h5>

                                <!-- Placeholder for new details -->
                                <div id="additionalForms">
                                    <!-- Use old values if available -->

                                          @if(isset($service) && $service->details)

                                        @foreach($service->details as $index => $section)
                                        <div class="card mt-3">
                                                <div class="card-body">
                                                    <h5 class="card-title">Section #{{ $index + 1 }}</h5>
                                                    <div class="form-group mb-3">
                                                        <input type="hidden" name="section_ids[]" value="{{ $section->id }}">
                                                        <label for="image{{ $index }}">Upload Image:</label>
                                                        <input type="file" name="section_images[]"  class="form-control @error('section_images.*') is-invalid @enderror" id="image{{ $index }}" >
                                                        @if($section->image)
                                                            <img src="{{ asset('storage/' .$section->image) }}" alt="Section Image" class="img-thumbnail mt-2" style="max-width: 200px;">
                                                        @endif
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="content{{ $index }}">Content:</label>
                                                        <textarea class="form-control tinymce @error('section_contents.*') is-invalid @enderror" name="section_contents[]" id="content{{ $index }}">{{ old('section_contents.'.$index, $section->service_description) }}</textarea>
                                                    </div>
                                                    @error('section_contents')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <!-- Placeholder for new details -->
                                        <div class="form-group mb-3">
                                            <label for="newSectionImage">Upload Image:</label>
                                            <input type="file" name="section_images[]" class="form-control @error('section_images.*') is-invalid @enderror" id="newSectionImage" >
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="newSectionContent">Content:</label>
                                            <textarea class="form-control tinymce @error('section_contents.*') is-invalid @enderror" name="section_contents[]" id="newSectionContent">{{ old('section_contents.0') }}</textarea>
                                        </div>
                                        @error('section_contents.*')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif

                                    <!-- Placeholder for additional details forms -->
                                </div>

                                <!-- Button to add more details -->
                                <button type="button" id="addMoreDetails" class="btn btn-primary mt-3">Add New Section</button>
                            </div>
                        </div><!-- End Add Section Card -->
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12 col-sm-6">
                        <!-- Card for Meta Information -->
                        @php
                        $seoData = json_decode($service->seo);
                            @endphp
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Meta Information</h5>
                
                                <div class="form-group mb-3">
                                    <label for="metaTitle">Meta Title:</label>
                                    <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" id="metaTitle" placeholder=" Meta Title" value="{{ old('meta_title', $seoData->meta_title ?? '') }}" required>
                                    @error('meta_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                
                                <div class="form-group mb-3">
                                    <label for="metaDescription">Meta Description:</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="metaDescription" rows="3" placeholder="Meta Description">{{ old('meta_description', $seoData->meta_description ?? '') }}</textarea>
                                    @error('meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                
                            </div>
                        </div><!-- End Meta Information Card -->
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12 col-sm-6 mt-4">
                        <!-- Card for adding data -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add Data</h5>

                                <!-- Placeholder for new data fields -->
                                <div id="dataFields">
                                    <div id="dataFields">

                                        @if(isset($service) && $service->keyPoints)
                                            @foreach($service->keyPoints as $index => $data)

                                                <div class="form-group mb-3">
                                                    <input type="hidden" name="key_point_ids[]" value="{{ $data->id }}">
                                                    <label for="data{{ $index }}">Data #{{ $index + 1 }}:</label>
                                                    <textarea class="form-control tinymce @error('data.*') is-invalid @enderror" name="data[]" id="data{{ $index }}">{{ old('data.'.$index, $data->key_points) }}</textarea>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-group mb-3">
                                                <label for="newData">Data:</label>
                                                <textarea class="form-control tinymce @error('data.*') is-invalid @enderror" name="data[]" id="newData">{{ old('data.0') }}</textarea>
                                            </div>
                                        @endif
                                    </div>

                                <!-- Button to add more data fields -->
                                <button type="button" id="addMoreData" class="btn btn-primary mt-3">Add More Data</button>
                            </div>
                        </div><!-- End Add Data Card -->
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row mt-4">
                    <div class="col-lg-12 col-sm-6">
                        <button type="submit" class="btn btn-primary">{{ isset($service) ? 'Update Service' : 'Add Service' }}</button>
                    </div>
                </div>

            </form>
        </section>
    </main>

    <script>
        let formCount = {{ isset($service) ? count($service->details) : 1 }};
        let dataCount = {{ isset($service) ? count($service->keypoints) : 1 }};

        // Function to clone form fields and add new ones inside new cards for "Add Details"
        document.getElementById('addMoreDetails').addEventListener('click', function() {
            formCount++;

            // Create a new card to hold the new form fields for details
            let newCard = document.createElement('div');
            newCard.classList.add('card');
            newCard.classList.add('mt-3');
            newCard.innerHTML = `
                <div class="card-body">
                    <h5 class="card-title">Section #${formCount}</h5>
                    <div class="form-group mb-3">
                        <label for="image${formCount}">Upload Image:</label>
                        <input type="file" name="section_images[]" class="form-control" id="image${formCount}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="content${formCount}">Content:</label>
                        <textarea class="form-control tinymce" name="section_contents[]" id="content${formCount}"></textarea>
                    </div>
                </div>
            `;
            document.getElementById('additionalForms').appendChild(newCard);
            initTinyMCE(); // Initialize TinyMCE for the new textarea
        });

        // Function to clone form fields and add new ones inside new cards for "Add Data"
        document.getElementById('addMoreData').addEventListener('click', function() {
            dataCount++;

            // Create a new card to hold the new form fields for data
            let newCard = document.createElement('div');
            newCard.classList.add('form-group');
            newCard.classList.add('mb-3');
            newCard.innerHTML = `
                <label for="data${dataCount}">Data #${dataCount}:</label>
                <textarea class="form-control tinymce" name="data[]" id="data${dataCount}"></textarea>
            `;
            document.getElementById('dataFields').appendChild(newCard);
            initTinyMCE(); // Initialize TinyMCE for the new textarea
        });
    </script>

    @include('layouts.footer')
