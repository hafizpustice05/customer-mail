@extends('layouts.mainTemplate')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Create Category</h3>
        </div>

        <div class="row mt-5">
            <form action="{{ url('admin/category') }}" method="POST">
                @csrf
                @error('failed')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name </label>
                    <input type="text" name="categoryName" required value="{{ old('categoryName') }}"
                        class="form-control @error('categoryName') is-invalid @enderror" id="categoryName"
                        aria-describedby="emailHelp">

                    @error('categoryName')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="categoryDescription" class="form-label">Description</label>
                    <input type="text" name="description" required
                        class="form-control @error('description') is-invalid @enderror" id="categoryDescription"
                        value="{{ old('description') }}">

                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="parentCategory" class="form-label">Parent Category</label>
                    <select name="parentCategoryId" class="form-control" id="parentCategory">
                        @forelse($categories as $key => $item)
                            <option value="{{ $item->id }}"> {{ $item->categoryName }} </option>
                        @empty
                        @endforelse

                    </select>
                </div>


                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button"href="{{ url('admin/category') }}" class="btn btn-warning">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>


<script>
    $(document).ready(function () {
      // Initialize form validation
      $("#myForm").validate({
        rules: {
          name: {
            required: true,
            minlength: 3
          },
          email: {
            required: true,
            email: true
          },
          age: {
            required: true,
            digits: true,
            min: 18
          }
        },
        messages: {
          name: {
            required: "Please enter your name",
            minlength: "Your name must consist of at least 3 characters"
          },
          email: "Please enter a valid email address",
          age: {
            required: "Please enter your age",
            digits: "Please enter a valid number",
            min: "You must be at least 18 years old"
          }
        },
        submitHandler: function (form) {
          form.submit();
        }
      });
    });
</script>
@endpush

