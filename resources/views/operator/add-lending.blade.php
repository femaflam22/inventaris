@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Lending form</h4>
                <p class="card-description">
                    Please <code>.fill-all</code> input form with right value.
                </p>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="{{route('operator.lendings.store')}}">
                  @csrf
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name">
                    @error('name')
                      <div>
                        <small class="text-danger">{{ $message }}</small>
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="items">Items</label>
                    <select name="item_id[]" id="items" class="form-control @error('item_id') is-invalid @enderror">
                        <option selected hidden disabled>Select Items</option>
                        @foreach ($items as $item)
                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                        @endforeach
                    </select>
                    @error('item_id')
                      <div>
                        <small class="text-danger">{{ $message }}</small>
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="total_item">Total</label>
                    <input type="number" class="form-control @error('total_item') is-invalid @enderror" id="total_item" placeholder="total item" name="total_item[]">
                    @error('total_item')
                      <div>
                        <small class="text-danger">{{ $message }}</small>
                      </div>
                    @enderror
                  </div>
                  <div id="more-input"></div>
                  <div class="mb-3">
                    <span class="text-info" id="more-text" style="cursor: pointer">
                      <i class="mdi mdi-chevron-down"></i>
                      More
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="ket">Ket.</label>
                    <textarea class="form-control @error('ket') is-invalid @enderror" id="ket" rows="4" name="ket"></textarea>
                    @error('ket')
                      <div>
                        <small class="text-danger">{{ $message }}</small>
                      </div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <a href="{{route('operator.lendings.index')}}" class="btn btn-light">Cancel</a>
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection

@section('js')
<script>
  var counter = 0;
  $('#more-text').click(function () {
    counter++;
    let content = `<div style="width: 100%; padding: 20px; border: 1px solid #333; margin: 10px 0;" id="input-${counter}">
                  <div class="d-flex justify-content-end">
                    <i class="text-danger mdi mdi-close-box" style="cursor: pointer" data="input-${counter}" onclick="removeEl(event)"></i>
                  </div>
                <div class="form-group">
                  <label for="items">Items</label>
                  <select name="item_id[]" id="items" class="form-control @error('item_id') is-invalid @enderror">
                      <option selected hidden disabled>Select Items</option>
                      @foreach ($items as $item)
                      <option value="{{$item['id']}}">{{$item['name']}}</option>
                      @endforeach
                  </select>
                  @error('item_id')
                    <div>
                      <small class="text-danger">{{ $message }}</small>
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="total_item">Total</label>
                  <input type="number" class="form-control @error('total_item') is-invalid @enderror" id="total_item" placeholder="total item" name="total_item[]">
                  @error('total_item')
                    <div>
                      <small class="text-danger">{{ $message }}</small>
                    </div>
                  @enderror
                </div>
                </div>`;
    $('#more-input').append(content);
  });

  function removeEl(event) {
    let id = '#'+event.target.getAttribute("data");
    $(id).remove();
  }
</script>
@endsection