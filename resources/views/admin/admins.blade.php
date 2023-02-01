@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div>
                    <h4 class="card-title">Admin Accounts Table</h4>
                    <p class="card-description">
                      Add, delete, update <code>.admin-accounts</code>
                      <br>
                      <code>p.s password</code> 4 character of email and nomor.
                    </p>
                  </div>
                  <div class="d-flex">
                    <div>
                      <a href="{{route('admin.users.export-admin')}}" class="btn btn-primary me-3">Export Excel</a>
                    </div>
                    <div>
                      <a href="{{route('admin.users.accounts.create')}}" class="btn btn-success"><span class="mdi mdi-new-box"></span> Add</a>
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
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">
                          #
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                          Email
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
                      @foreach ($admins as $admin)
                      <tr>
                        <td class="text-center">
                          {{$no++}}
                        </td>
                        <td>
                          {{$admin['name']}}
                        </td>
                        <td>
                          {{$admin['email']}}
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('users.accounts.edit', $admin['id'])}}" class="btn btn-primary">Edit</a>
                                <form action="{{route('admin.users.accounts.delete', $admin['id'])}}" method="POST" class="ms-2">
                                  @csrf
                                  @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-white">Delete</button>
                                </form>
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