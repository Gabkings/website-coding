@extends('layout.mainlayout')
@section('page_content')

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ route('search') }}"><span class="glyphicon glyphicon-chevron-left"></span>
            Back to Trips
      </a>
        
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-lg-12">
      <div class="container">
        @foreach ($trip as $trip_detail)
            <div class="row">
                <div class="col-lg-6">
                {{$trip_detail['request_date']}}
                </div>
                <div class="col-lg-6">
                    {{$trip_detail['cost']." ". $trip_detail['cost_unit']}}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-7">
                {{$trip_detail['pickup_location']}}
                </div>
                <div class="col-lg-5">
                    {{$trip_detail['pickup_date']}}
                </div>
                <div class="col-lg-7">
                {{$trip_detail['dropoff_location']}}
                </div>
                <div class="col-lg-5">
                {{$trip_detail['dropoff_date']}}
                </div>
            </div><hr>
            <div class="row">
                <div class="col-lg-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{$trip_detail['car_pic']}}" style="width: 100%;height: 240px;" class="card-img-top" alt="img">
                    <div class="card-body">
                        <h5 class="card-title" style="margin: auto;">{{$trip_detail['car_make']." ".$trip_detail['car_model']}}</h5>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            Distance
                        </div>
                        <div class="col-lg-6 mt-3">
                            {{$trip_detail['distance']." ".$trip_detail['distance_unit']}}
                        </div>
                        <div class="col-lg-6 mt-4">
                            Duration
                        </div>
                        <div class="col-lg-6 mt-4">
                            {{$trip_detail['duration']." ".$trip_detail['duration_unit']}}
                        </div>
                        <div class="col-lg-6 mt-4">
                            Sub Total
                        </div>
                        <div class="col-lg-6 mt-4">
                            {{$trip_detail['cost']." ".$trip_detail['cost_unit']}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                <div class="card" style="width: 18rem;">
                <h5 class="card-title" style="margin: auto;">{{$trip_detail['driver_name']}}</h5>
                <img src="{{$trip_detail['driver_pic']}}" style="width: 100%;height: 240px;" class="card-img-top"  alt="...">
                <h5 class="card-title rating" data-size="lg" id="input-id">{{$trip_detail['driver_rating']}}</h5>
                </div>
                </div>
            </div>
         @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
