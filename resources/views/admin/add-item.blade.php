@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Item forms</h4>
                  <p class="card-description">
                    Please <code>.fill-all</code> input form with right value.
                  </p>
                  <form class="form-inline" method="POST" action="{{route('admin.items.store')}}">
                    @csrf
                    <label class="sr-only mb-3" for="name">Name</label>
                    <input type="text" class="form-control mb-2 mr-sm-2 @error('name') is-invalid @enderror" id="name" placeholder="Alat Dapur" name="name">
                    @error('name')
                      <div>
                        <small class="text-danger">{{ $message }}</small>
                      </div>
                    @enderror

                    <label class="sr-only mb-3" for="category">Category</label>
                    <select name="category_id" id="category" class="form-control mb-2 mr-sm-2 @error('category_id') is-invalid @enderror" >
                      <option selected hidden disabled>Pilih Category</option>
                      @foreach ($categories as $category)
                      <option value="{{$category['id']}}" style="font-size: 1rem">{{$category['name']}}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                      <div>
                        <small class="text-danger">{{ $message }}</small>
                      </div>
                    @enderror

                    <label class="sr-only mb-3" for="total">Total</label>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" placeholder="10" class="form-control @error('total') is-invalid @enderror" id="total" name="total">
                        <div class="input-group-append">
                          <span class="input-group-text">item</span>
                        </div>
                      </div>
                      @error('total')
                        <div>
                          <small class="text-danger">{{ $message }}</small>
                        </div>
                      @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end mt-3">
                        <div class="me-3">
                            <a href="{{route('admin.items.index')}}" class="btn btn-secondary">Cancel</a>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
    </div>
@endsection