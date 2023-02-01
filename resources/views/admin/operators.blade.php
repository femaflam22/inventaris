@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div>
                    <h4 class="card-title">Operator Accounts Table</h4>
                    <p class="card-description">
                      Add, delete, update <code>.operator-accounts</code>
                      <br>
                      <code>p.s password</code> 4 character of email and nomor.
                    </p>
                  </div>
                  <div class="d-flex">
                    <div>
                      <a href="{{route('admin.users.export-operator')}}" class="btn btn-primary me-3">Export Excel</a>
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
                      @foreach ($operators as $operator)
                      <tr>
                        <td class="text-center">
                          {{$no++}}
                        </td>
                        <td>
                          {{$operator['name']}}
                        </td>
                        <td>
                          {{$operator['email']}}
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                              <div>
                                <a href="{{route('admin.users.reset', $operator['id'])}}" class="btn btn-warning">Reset Password</a>
                              </div>
                              @if (count($operator['lendings']) == 0)
                              <form action="{{route('admin.users.accounts.delete', $operator['id'])}}" method="POST" class="ms-2">
                                @csrf
                                @method('DELETE')
                                  <button type="submit" class="btn btn-danger text-white">Delete</button>
                              </form>
                              @endif
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