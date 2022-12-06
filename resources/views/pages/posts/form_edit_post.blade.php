@extends('layouts.admin_template')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Edit Post</h4>

        <div class="row">
            @include('notif')
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Post</h5>
                    <div class="card-body">

                        <form action="{{ route('posts.update', $edit->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class='mb-6'>
                                <label for="title" class="form-label">Category</label>
                                <select name="category" class="form-select" required>
                                    <option value="">Pilih Category</option>
                                    @forelse ($category as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $cat->id== $edit->categories_id ? 'selected' : '' }}>
                                            {{$cat->name_category}}
                                        </option>
                                    @empty

                                    @endforelse
                                </select>
                                @error('title')
                                    <div class="error" style="position:absolute">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='mb-4'>
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Post title" aria-describedby="defaultFormControlHelp"  value="{{ $edit->title }}"/>
                                @error('title')
                                    <div class="error" style="position:absolute">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class='mb-4'>
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" rows='3' id="desc" name="description"
                                    placeholder="Post Description" aria-describedby="defaultFormControlHelp">{{ $edit->description }}</textarea>
                                @error('description')
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


@push('scriptjs')
<script>
        ClassicEditor
        .create( document.querySelector( '#desc' ) )
        .catch( error => {
            console.error( error );
        } );

</script>
@endpush
