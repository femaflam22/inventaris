@extends('layouts.dashboard')

@section('content')
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Items table</h4>
        <p class="card-description">
            Data <code>.items</code>
        </p>
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
                    Available
                </th>
                <th>
                  Lending Total
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
                  {{$item['available_total']}}
                </td>
                <td class="text-center">
                  @php
                    $total = 0;
                    if (count($item['lendings']) > 0) {
                      foreach ($item['lendings'] as $lending) {
                        if (is_null($lending['return_date'])) {
                          $total++;
                        }
                      }
                    }
                  @endphp
                  {{$total}}
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