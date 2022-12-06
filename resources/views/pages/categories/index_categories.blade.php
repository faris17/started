@extends('layouts.admin_template')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Categories /</span> List
    </h4>
    <div class="row">
      <div class="col-lg-12 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-12">
              <div class="card-body">
                @include('notif')
                <div class="d-flex justify-content-between">
                    <h5 class="card-title text-primary">Halaman Category</h5>

                    <a href="{{ route('categories.create') }}">
                        <button class='btn btn-primary'> Tambah </button>
                    </a>
                </div>

                <table class='table'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($results as $row)
                            <tr>
                                <td>{{ $no++ }} </td>
                                <td>{{ $row->name_category }}</td>
                                <td>
                                    <div class='d-flex justify-content-end'>
                                        <a href="{{ route('categories.edit', $row->id) }}">
                                            <button class='btn btn-primary'>Edit</button>
                                        </a>
                                        &nbsp;
                                            <form onsubmit="return confirm('are you sure?')" action="{{ route('categories.destroy', $row->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class='btn btn-danger'>Delete</button>
                                            </form>
                                    </div>


                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Data Tidak ada </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  @endsection
