@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Category forms</h4>
                  <p class="card-description">
                    Please <code>.fill-all</code> input form with right value.
                  </p>
                  <form class="form-inline" method="POST" action="{{route('admin.categories.update', $category['id'])}}">
                    @csrf
                    @method('PATCH')
                    <label class="sr-only mb-3" for="name">Name</label>
                    <input type="text" class="form-control mb-2 mr-sm-2 @error('name') is-invalid @enderror" id="name" placeholder="Alat Dapur" name="name" value="{{$category['name']}}">
                    @error('name')
                    <div class="mb-3">
                      <small class="text-danger">{{ $message }}</small>
                    </div>
                    @enderror
                  
                    <label class="sr-only mb-3" for="division_pj">Division PJ</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="mdi mdi-account-star"></span>
                        </div>
                      </div>
                      <select name="division_pj" id="division_pj" class="form-control @error('division_pj') is-invalid @enderror">
                        <option selected hidden disabled>Select Division PJ</option>
                        <option value="Sarpras" {{$category['division_pj'] == 'Sarpras' ? 'selected' : ''}}>Sarpras</option>
                        <option value="Tata Usaha" {{$category['division_pj'] == 'Tata Usaha' ? 'selected' : ''}}>Tata Usaha</option>
                        <option value="Tefa" {{$category['division_pj'] == 'Tefa' ? 'selected' : ''}}>tefa</option>
                      </select>
                    </div>
                    @error('division_pj')
                      <div>
                        <small class="text-danger">{{ $message }}</small>
                      </div>
                    @enderror
                    <div class="d-flex justify-content-end mt-3">
                        <div class="me-3">
                            <a href="{{route('admin.categories.index')}}" class="btn btn-secondary">Cancel</a>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
    </div>
@endsection