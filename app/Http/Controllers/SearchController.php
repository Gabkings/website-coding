<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

class SearchController extends Controller
{
    // a methode that process the Request
    public function search_process(Request $request)
    {
      // loading the json file
      $json=file_get_contents(base_path('resources/json/recent.json'));
      // change to php array
      $json_to_php_array= json_decode($json,true);
      // get the trip array from that array
      $trips=$json_to_php_array['trips'];


      // recieving user Input
      $keyword = $request->input('keyword');
      $include_conceled = $request->input('include_conceled');
      $distance = $request->input('distance');
      $time = $request->input('time');


      // list of filtered trip's
      $filter_times=[];
     $filter_keywords = [];
     //////////////////////////search by keyword
     if($keyword != ""){
       foreach($trips as $trip){
        $pickup=$trip['pickup_date'];
        $dropoff=$trip['dropoff_date'];
        $to=new Carbon($pickup);
        $from= new Carbon($dropoff);
        foreach($trip as $key => $value){
          if($value === $keyword){
            array_push($filter_keywords, $trip);
          }
        }
       }
     }

      /////////////////////////// filter using time
      if($time=='more_20min'){
        foreach ($trips as $trip) {
        // here change the trip array to laravel collection to using contains methode
        $pickup=$trip['pickup_date'];
        $dropoff=$trip['dropoff_date'];
        $to=new Carbon($pickup);
        $from= new Carbon($dropoff);
         $diff_in_minutes = $to->diffInMinutes($from);
         if($diff_in_minutes >= 20){
          array_push($filter_times,$trip);
         }
      }
      }elseif ($time == 'under_5min') {

          foreach ($trips as $trip) {
          // here change the trip array to laravel collection to using contains methode
           $pickup=$trip['pickup_date'];
           $dropoff=$trip['dropoff_date'];
           $to=new Carbon($pickup);
           $from= new Carbon($dropoff);
           $diff_in_minutes = $to->diffInMinutes($from);
           if($diff_in_minutes < 5){
             array_push($filter_times,$trip);
           }

        }
      }elseif ($time == '5_to_10min') {
        // code...
        foreach ($trips as $trip) {
        // here change the trip array to laravel collection to using contains methode
         $pickup=$trip['pickup_date'];
         $dropoff=$trip['dropoff_date'];
         $to=new Carbon($pickup);
         $from= new Carbon($dropoff);
         $diff_in_minutes = $to->diffInMinutes($from);
         if($diff_in_minutes >= 5 && $diff_in_minutes <10){
           array_push($filter_times,$trip);
         }
      }
    }elseif ($time == '10_to_20min') {
      // code...
      foreach ($trips as $trip) {
      // here change the trip array to laravel collection to using contains methode
       $pickup=$trip['pickup_date'];
       $dropoff=$trip['dropoff_date'];
       $to=new Carbon($pickup);
       $from= new Carbon($dropoff);
       $diff_in_minutes = $to->diffInMinutes($from);
       if($diff_in_minutes >= 10 && $diff_in_minutes <20){
         array_push($filter_times,$trip);
       }
    }
  }else{
    // code...
            $filter_times=$trips;
  }
  ///////////////////////////// filter by Distance
  $filter_distances=[];
  if ($distance=='under_3km') {
    // code...
     foreach ($filter_times as $filter_time) {
      $latFrom=deg2rad($filter_time['pickup_lat']);
      $latTo=deg2rad($filter_time['dropoff_lat']);
      $lonFrom=deg2rad($filter_time['pickup_lng']);
      $lonTo=deg2rad($filter_time['dropoff_lng']);

      $latDelta = $latTo - $latFrom;
      $lonDelta  = $lonTo - $lonFrom;
      $earth_radius = 6372.795477598;
      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      $distance_km = $angle * $earth_radius;
      // add to filter Distance
      if($distance_km < 3){
        array_push($filter_distances,$filter_time);
      }
    }
  }elseif ($distance=='3_to_8km') {
    // code...
     foreach ($filter_times as $filter_time) {
      $latFrom=deg2rad($filter_time['pickup_lat']);
      $latTo=deg2rad($filter_time['dropoff_lat']);
      $lonFrom=deg2rad($filter_time['pickup_lng']);
      $lonTo=deg2rad($filter_time['dropoff_lng']);

      $latDelta = $latTo - $latFrom;
      $lonDelta  = $lonTo - $lonFrom;
      $earth_radius = 6372.795477598;
      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      $distance_km = $angle * $earth_radius;
      // add to filter Distance
      if($distance_km >= 3 && $distance_km <8 ){
        array_push($filter_distances,$filter_time);
      }
    }
  }elseif ($distance=='8_to_15km') {
    // code...
     foreach ($filter_times as $filter_time) {
      $latFrom=deg2rad($filter_time['pickup_lat']);
      $latTo=deg2rad($filter_time['dropoff_lat']);
      $lonFrom=deg2rad($filter_time['pickup_lng']);
      $lonTo=deg2rad($filter_time['dropoff_lng']);

      $latDelta = $latTo - $latFrom;
      $lonDelta  = $lonTo - $lonFrom;
      $earth_radius = 6372.795477598;
      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      $distance_km = $angle * $earth_radius;
      // add to filter Distance
      if($distance_km >= 8 && $distance_km < 15 ){
        array_push($filter_distances,$filter_time);
      }
    }
  }elseif ($distance=='more_15km') {
    // code...
     foreach ($filter_times as $filter_time) {
      $latFrom=deg2rad($filter_time['pickup_lat']);
      $latTo=deg2rad($filter_time['dropoff_lat']);
      $lonFrom=deg2rad($filter_time['pickup_lng']);
      $lonTo=deg2rad($filter_time['dropoff_lng']);

      $latDelta = $latTo - $latFrom;
      $lonDelta  = $lonTo - $lonFrom;
      $earth_radius = 6372.795477598;
      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      $distance_km = $angle * $earth_radius;
      // add to filter Distance
      if($distance_km >= 15 ){
        array_push($filter_distances,$filter_time);
      }
    }
  }else{
    $filter_distances=$filter_times;
  }

  /////////////////////// filter by Include conceled
   $filter_conceled=[];

   if($include_conceled == 'include'){
     foreach ($filter_distances as $filter_distance) {
       // code...
       if($filter_distance['status'] == 'CANCELED' || $filter_distance['status'] == 'COMPLETED'){
          array_push($filter_conceled,$filter_distance);
       }
     }
   }else{
     foreach ($filter_distances as $filter_distance) {
       // code...
       if($filter_distance['status'] == 'COMPLETED'){
          array_push($filter_conceled,$filter_distance);
       }
     }
   }

   // search keyword on $filter_conceled
    // $filter_keyword=[];
    // foreach ($filter_conceled as $filter_concele) {
    //   $collection=collect($filter_concele);
    //   $result=$collection->where('status','CANCELED')->all();
    //   if(count($result) > 0){
    //     array_push($filter_keyword,$result);
    //   }
    // }
    // dd($filter_keyword);

    // after that change the filter_conceled below with filter_keyword
    return view('tripSearchResult')->with('trips',$filter_conceled);

    }


    public function view_details($trip){
      // loading the json file
      $json=file_get_contents(base_path('resources/json/recent.json'));
      // change to php array
      $json_to_php_array= json_decode($json,true);
      // get the trip array from that array
      $trip_details = [];
      $trips=$json_to_php_array['trips'];
      foreach($trips as $obj){
        if($obj['id'] == $trip){
          array_push($trip_details,$obj);
          return view('tripDetails')->with('trip',$trip_details);
        }
      }
    }
}
