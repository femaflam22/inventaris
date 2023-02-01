@extends('layouts.dashboard')

@section('content')
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="card-title">Categories table</h4>
                <p class="card-description">
                Add, delete, update <code>.categories</code>
                </p>
            </div>
            <div>
                <a href="{{route('admin.categories.create')}}" class="btn btn-success"><span class="mdi mdi-new-box"></span> Add</a>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('deleted'))
            <div class="alert alert-warning">
                {{ session('deleted') }}
            </div>
        @endif
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">
                  #
                </th>
                <th>
                  Name
                </th>
                <th>
                  Division PJ
                </th>
                <th>
                  Total Items
                </th>
                <th class="text-center">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              @php
                  $no = 1;
              @endphp
              @foreach ($categories as $category)
              <tr>
                <td class="text-center">
                  {{$no++}}
                </td>
                <td>
                  {{$category['name']}}
                </td>
                <td>
                  {{$category['division_pj']}}
                </td>
                <td class="text-center">
                  {{ count($category['items']) }}
                </td>
                <td>
                  <div class="d-flex justify-content-center">
                    <a href="{{route('admin.categories.edit', $category['id'])}}" class="btn btn-primary">Edit</a>
                    {{-- <form action="{{route('admin.categories.delete', $category['id'])}}" method="POST" class="ms-2">
                      @csrf
                      @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white">Delete</button>
                    </form> --}}
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection