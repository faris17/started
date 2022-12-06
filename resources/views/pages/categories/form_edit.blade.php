@extends('layouts.admin_template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Edit Category</h4>

        <div class="row">
            @include('notif')
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Category</h5>
                    <div class="card-body">

                        <form action="{{ route('categories.update', $edit->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class='mb-4'>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Category name" value="{{ $edit->name_category }}" />
                                @error('name')
                                    <div class="error" style="position:absolute">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <input type='submit' class='btn btn-primary' value="Update" id="update"
                                    name="update" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
