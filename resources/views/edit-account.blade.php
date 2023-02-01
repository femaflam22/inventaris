{{-- if else role for extends --}}
@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Account forms</h4>
                  <p class="card-description">
                    Please <code>.fill-all</code> input form with right value.
                  </p>
                  <form class="form-inline" method="POST" action="{{route('users.change', $data['id'])}}">
                    @csrf
                    @method('PATCH')
                    <label class="sr-only mb-3" for="name">Name</label>
                    <input type="text" class="form-control mb-2 mr-sm-2 @error('name') is-invalid @enderror" id="name" placeholder="Fema Flamelina Putri" name="name" value="{{$data['name']}}">
                    @error('name')
                    <div class="mb-3">
                      <small class="text-danger">{{ $message }}</small>
                    </div>
                    @enderror

                    <label class="sr-only mb-3" for="email">Email</label>
                    <input type="email" class="form-control mb-2 mr-sm-2 @error('email') is-invalid @enderror" id="email" placeholder="femaflam22@gmail.com" name="email" value="{{$data['email']}}">
                    @error('email')
                    <div class="mb-3">
                      <small class="text-danger">{{ $message }}</small>
                    </div>
                    @enderror

                    <label class="sr-only mb-3" for="password">New Password <small class="text-warning">optional</small></label>
                    <input type="password" class="form-control mb-2 mr-sm-2" id="password" name="password">
                    
                    <div class="d-flex justify-content-end mt-3">
                        {{-- if else role --}}
                        <div class="me-3">
                          @if (Auth::user()->role == 'admin')
                          <a href="{{route('admin.users.accounts.index')}}" class="btn btn-secondary">Cancel</a>
                          @elseif (Auth::user()->role == 'operator')
                          <a href="{{route('dashboard')}}" class="btn btn-secondary">Cancel</a>
                          @endif 
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
    </div>
@endsection