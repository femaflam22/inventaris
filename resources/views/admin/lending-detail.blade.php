@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Lending Table</h4>
                        <p class="card-description">
                        Data of <code>.lendings</code>
                        </p>
                    </div>
                    <div class="d-flex">
                      <div>
                        <a href="{{route('admin.items.index')}}" class="btn btn-secondary">Back</a>
                      </div>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Total</th>
                        <th>Name</th>
                        <th>Ket.</th>
                        <th>Date</th>
                        <th>Returned</th>
                        <th>Edited By</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $no = 1;
                      @endphp
                      @foreach ($lendings as $lending)
                      <tr>
                        <td>{{$no++}}</td>
                        <td>{{$lending['item']['name']}}</td>
                        <td>{{$lending['total_item']}}</td>
                        <td>{{$lending['name']}}</td>
                        <td>{{$lending['ket']}}</td>
                        <td>{{\Carbon\Carbon::parse($lending['date'])->format('j F, Y')}}</td>
                        <td>
                          @if (is_null($lending['return_date']))
                          <span class="badge badge-warning">not returned</span>
                          @else
                          <span class="badge badge-success">{{\Carbon\Carbon::parse($lending['return_date'])->format('j F, Y')}}</span>
                          @endif
                        </td>
                        <td><b>{{$lending['user']['name']}}</b></td>
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