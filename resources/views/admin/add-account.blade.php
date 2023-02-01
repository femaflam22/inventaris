@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Account forms</h4>
                  <p class="card-description">
                    Please <code>.fill-all</code> input form with right value.
                  </p>
                  <form class="form-inline" method="POST" action="{{route('admin.users.accounts.store')}}">
                    @csrf
                    <label class="sr-only mb-3" for="name">Name</label>
                    <input type="text" name="name" class="form-control mb-2 mr-sm-2 @error('name') is-invalid @enderror" id="name" placeholder="Fema Flamelina Putri">
                    @error('name')
                      <div>
                        <small class="text-danger">{{ $message }}</small>
                      </div>
                    @enderror

                    <label class="sr-only mb-3" for="email">Email</label>
                    <input type="email" class="form-control mb-2 mr-sm-2 @error('email') is-invalid @enderror" id="email" placeholder="femaflam22@gmail.com" name="email">
                    @error('email')
                      <div>
                        <small class="text-danger">{{ $message }}</small>
                      </div>
                    @enderror

                    <label class="sr-only mb-3" for="role">Role</label>
                    <select name="role" id="role" class="form-control mb-2 mr-sm-2 @error('role') is-invalid @enderror">
                      <option selected hidden disabled>Select Role</option>
                      <option value="admin" style="font-size: 1rem">admin</option>
                      <option value="operator" style="font-size: 1rem">operator</option>
                    </select>
                    @error('role')
                      <div>
                        <small class="text-danger">{{ $message }}</small>
                      </div>
                    @enderror
                    
                    <div class="d-flex justify-content-end mt-3">
                        {{-- if else role --}}
                        <div class="me-3">
                            <a href="{{route('admin.users.accounts.index')}}" class="btn btn-secondary">Cancel</a>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
    </div>
@endsection