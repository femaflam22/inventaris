@extends('layouts.dashboard')

@section('content')
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="card-title">Items table</h4>
                <p class="card-description">
                Add, delete, update <code>.items</code>
                </p>
            </div>
            <div class="d-flex">
              <div>
                <a href="{{route('admin.items.export')}}" class="btn btn-primary me-3">Export Excel</a>
              </div>
              <div>
                <a href="{{route('admin.items.create')}}" class="btn btn-success"><span class="mdi mdi-new-box"></span> Add</a>
              </div>
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
                  Category
                </th>
                <th>
                  Name
                </th>
                <th>
                  Total
                </th>
                <th>
                  Repair
                </th>
                <th>
                  Lending
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

              @foreach ($items as $item)
              <tr>
                <td class="text-center">
                  {{$no++}}
                </td>
                <td>
                  {{$item['category']['name']}}
                </td>
                <td>
                  {{$item['name']}}
                </td>
                <td class="text-center">
                  {{$item['total']}}
                </td>
                <td class="text-center">
                  {{$item['repair_total']}}
                </td>
                <td class="text-center">
                  @if (count($item['lendings']) > 0)
                  <a href="{{route('admin.items.lending', $item['id'])}}">{{count($item['lendings'])}}</a>
                  @else
                  <span>{{count($item['lendings'])}}</span>
                  @endif
                </td>
                <td>
                  <div class="d-flex justify-content-center">
                    <a href="{{route('admin.items.edit', $item['id'])}}" class="btn btn-primary">Edit</a>
                    {{-- <form action="{{route('admin.items.delete', $item['id'])}}" method="POST" class="ms-2">
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