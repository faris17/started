@extends('layouts.admin_template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Add User</h4>

        <div class="row">
            @if ($message = Session::get('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @if ($message = Session::get('failed'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

              </div>
            @endif
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Tambah User</h5>
                    <div class="card-body">
                        {{-- display error --}}
                        {{-- @if($errors->any())
                            {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                        @endif --}}

                        <form action="{{ route('users.update', $edit->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class='mb-4'>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Your name" aria-describedby="defaultFormControlHelp" value="{{ $edit->name }}" />
                                @error('name')
                                    <div class="error" style="position:absolute">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='mb-4'>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="example@example.com" aria-describedby="email" value="{{ $edit->email }}" />
                                    @error('email')
                                    <div class="error" style="position:absolute">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='mb-4'>
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="password" aria-describedby="password" />
                                <span>Biarkan kosong, jika tidak ingin mengganti password</span>
                                @error('password')
                                    <div class="error" style="position:absolute">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <input type='submit' class='btn btn-info' value="Update" id="save"
                                    name="save" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
