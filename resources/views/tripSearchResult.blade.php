@extends('layout.mainlayout')
@section('page_content')

<div class="container">
  <div class="row mt-3">
    <div class="col-lg-12">
      <a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a>
        Trips ({{count($trips)}}) <div class="pull-right"><a href="{{route('home')}}">Back to Search</a></div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-lg-12">
      <div class="container">
        @foreach ($trips as $trip)
      <a href="{{ route('trip_details', $trip['id']) }}" style="text-decoration: none;">
      <div class="card">
        <div class="card-body">
        <div class="row">

              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-7">
                    {{ $trip['request_date']}}
                  </div>
                  <div class="col-lg-5">
                    <h3>{{ $trip['cost']." ". $trip['cost_unit']}}</h3> 
                     <div class="stars-outer">
                        <div class="stars-inner"></div>
                      </div>
                  </div>
                </div>

              </div>
              <div class="col-lg-12">
                <span class="glyphicon glyphicon-target bg-primary"></span> 
                {{ $trip['pickup_location'] }}
              </div>
              <div class="col-lg-12">
                 <span class="glyphicon glyphicon-target bg-danger"></span> 
                {{ $trip['dropoff_location'] }}
              </div>

              <div class="col-lg-4 offset-lg-7">
                {{ $trip['status'] }} @if($trip['status'] == "COMPLETED") 
                <span class="glyphicon glyphicon-ok"></span> 
                @else 
                  <span class="glyphicon glyphicon-ban-circle"></span> 
                  @endif
              </div>


        </div>
      </div>
    </div>
    </a>
         @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
