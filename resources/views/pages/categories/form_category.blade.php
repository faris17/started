@extends('layouts.admin_template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Add Category</h4>

        <div class="row">
            @include('notif')
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Tambah Category</h5>
                    <div class="card-body">

                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class='mb-4'>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Category name" aria-describedby="defaultFormControlHelp" />
                                @error('name')
                                    <div class="error" style="position:absolute">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <input type='submit' class='btn btn-primary' value="Save" id="save"
                                    name="save" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
