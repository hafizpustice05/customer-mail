@extends('layouts.mainTemplate')

@push('css')
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div>
                <!-- <a href="{{ url('admin/category/create') }}">+ Add Category</a> -->
                <a href="{{ url('admin/category/create') }}">+ Add Category</a>
            </div>
        </div>
        <form action="{{ url('admin/category/delete') }}" method="POST" id="categoryForm">
            @csrf
            @method('DELETE')
        <table class="table table-hover">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">CategoryName</th>
                    <th scope="col">CreatedAt</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $key => $category)
                    <tr>
                        <!-- <th>{{ $loop->index + 1 }}</th> -->
                         <td>
                            <input type="checkbox" value="{{$category->id}}" name="id[]">
                         </td>
                        <td>{{ $category->categoryName }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td> <a href="#" onclick="edit({{ json_encode($category) }})">Edit</a>
                            | <a href="#" onclick="edit({{ json_encode($category) }})">DELETE</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="4" class="text-center">Category record is empty</th>
                    </tr>
                @endforelse


            </tbody>
        </table>
        <input type="submit">
        </form>
    </div>


    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row mt-5">
            <form action="{{ url('admin/category') }}" method="POST" id="categoryForm">
                @csrf

                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name </label>
                    <input type="text" name="categoryName" required value="{{ old('categoryName') }}"
                        class="form-control @error('categoryName') is-invalid @enderror" id="categoryName"
                        aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label for="categoryDescription" class="form-label">Description</label>
                    <input type="text" name="description"
                        class="form-control @error('description') is-invalid @enderror" id="categoryDescription"
                        value="{{ old('description') }}">
                </div>

                <!-- <div class="mb-3">
                    <label for="parentCategory" class="form-label">Parent Category</label>
                    <select name="parentCategoryId" class="form-control" id="parentCategory">
                        @forelse($categories as $key => $item)
                            <option value="{{ $item->id }}"> {{ $item->categoryName }} </option>
                        @empty
                        @endforelse

                    </select>
                </div> -->


                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button"href="{{ url('admin/category') }}" class="btn btn-warning">Back</a>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection


@push('scripts')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus');

    });

      // Initialize form validation
    $("#categoryForm").validate({
        rules: {
            categoryName: {
            required: true,
            minlength: 3
          },
          description: {
            required: true
          }
        },
        messages: {
            categoryName: {
            required: "Please enter your name",
            minlength: "Your name must consist of at least 3 characters"
          },
          description: "Please enter a valid address"
        },
        submitHandler: function (form) {
          form.submit();
        }
      });
    });

    function edit(category){
        console.log(category.id, " ", category.categoryName , '\n',category)
    }
</script>
@endpush
