<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

use Carbon\Carbon;

class ViewTripsResultsTest extends TestCase
{
    
    public function testSeeTrips()
    {
        //Arrangement 

              // loading the json file
        $json=file_get_contents(base_path('resources/json/recent.json'));
        // change to php array
        $json_to_php_array= json_decode($json,true);
        // get the trip array from that array
        $trips=$json_to_php_array['trips'];
        $time = 21;
        $filter_times = [];
        //action
        //Assertions
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
        
        $response = $this->post('search');
        $response->assertStatus(200);
        $response->assertSee($filter_times[0]['request_date']);
        $response->assertSee($filter_times[0]['pickup_location']);
        $response->assertSee($filter_times[0]['dropoff_location']);
        $response->assertSee($filter_times[0]['cost']);
        $response->assertSee($filter_times[0]['cost_unit']);
        $response->assertSee($filter_times[0]['status']);
    }

    public function testCanTripsFiveToTenMin()
    {

        $json=file_get_contents(base_path('resources/json/recent.json'));
          // change to php array
        $json_to_php_array= json_decode($json,true);
          // get the trip array from that array
        $trips=$json_to_php_array['trips'];
          // recieving user Input
        $time = 6;
          // list of filtered trip's
        $filter_times=[];

       if ($time >= 5 || $time <= 10) {
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
        }
        
        $response = $this->post('search');
        $response->assertStatus(200);
        $response->assertSee($filter_times[0]['request_date']);
        $response->assertSee($filter_times[0]['pickup_location']);
        $response->assertSee($filter_times[0]['dropoff_location']);
        $response->assertSee($filter_times[0]['cost']);
        $response->assertSee($filter_times[0]['cost_unit']);
        $response->assertSee($filter_times[0]['status']);
    }

        public function testCanTripsTenToTwentyMin()
    {

        $json=file_get_contents(base_path('resources/json/recent.json'));
          // change to php array
        $json_to_php_array= json_decode($json,true);
          // get the trip array from that array
        $trips=$json_to_php_array['trips'];
          // recieving user Input
        $time = 15;
          // list of filtered trip's
        $filter_times=[];

       if ($time > 10 || $time <= 20) {
        // code...
            foreach ($trips as $trip) {
            // here change the trip array to laravel collection to using contains methode
             $pickup=$trip['pickup_date'];
             $dropoff=$trip['dropoff_date'];
             $to=new Carbon($pickup);
             $from= new Carbon($dropoff);
             $diff_in_minutes = $to->diffInMinutes($from);
             if($diff_in_minutes > 10 && $diff_in_minutes <=20){
               array_push($filter_times,$trip);
             }
          }
        }
        
        $response = $this->post('search');
        $response->assertStatus(200);
        $response->assertSee($filter_times[0]['request_date']);
        $response->assertSee($filter_times[0]['pickup_location']);
        $response->assertSee($filter_times[0]['dropoff_location']);
        $response->assertSee($filter_times[0]['cost']);
        $response->assertSee($filter_times[0]['cost_unit']);
        $response->assertSee($filter_times[0]['status']);
    }

        public function testSeeTripsAnytime()
    {
        //Arrangement 

              // loading the json file
        $json=file_get_contents(base_path('resources/json/recent.json'));
        // change to php array
        $json_to_php_array= json_decode($json,true);
        // get the trip array from that array
        $trips=$json_to_php_array['trips'];
        $time = 1;
        $filter_times = [];
        //action
        //Assertions
        if($time > 0){
            foreach ($trips as $trip) {
            // here change the trip array to laravel collection to using contains methode
                $pickup=$trip['pickup_date'];
                $dropoff=$trip['dropoff_date'];
                $to=new Carbon($pickup);
                $from= new Carbon($dropoff);
                 $diff_in_minutes = $to->diffInMinutes($from);
                 if($diff_in_minutes > 0){
                    array_push($filter_times,$trip);
                 }
            }
        }
        $response = $this->post('search');
        $response->assertStatus(200);
        $response->assertSee($filter_times[0]['request_date']);
        $response->assertSee($filter_times[0]['pickup_location']);
        $response->assertSee($filter_times[0]['dropoff_location']);
        $response->assertSee($filter_times[0]['cost']);
        $response->assertSee($filter_times[0]['cost_unit']);
        $response->assertSee($filter_times[0]['status']);
    }

    public function testSeeTripsAnyDistance()
    {
        //Arrangement 

              // loading the json file
        $json=file_get_contents(base_path('resources/json/recent.json'));
        // change to php array
        $json_to_php_array= json_decode($json,true);
        // get the trip array from that array
        $trips=$json_to_php_array['trips'];
        $distance = 1;
        $filter_distance = [];
        //action
        //Assertions
        if ($distance > 0) {
            // code...
             foreach ($trips as $trip) {
              $latFrom=deg2rad($trip['pickup_lat']);
              $latTo=deg2rad($trip['dropoff_lat']);
              $lonFrom=deg2rad($trip['pickup_lng']);
              $lonTo=deg2rad($trip['dropoff_lng']);

              $latDelta = $latTo - $latFrom;
              $lonDelta  = $lonTo - $lonFrom;
              $earth_radius = 6372.795477598;
              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
              $distance_km = $angle * $earth_radius;
              // add to filter Distance
              if($distance_km > 0){
                array_push($filter_distance,$trip);
              }
            }
        }
        $response = $this->post('search');
        $response->assertStatus(200);
        $response->assertSee($filter_distance[0]['request_date']);
        $response->assertSee($filter_distance[0]['pickup_location']);
        $response->assertSee($filter_distance[0]['dropoff_location']);
        $response->assertSee($filter_distance[0]['cost_unit']);
        $response->assertSee($filter_distance[0]['status']);
    }

        public function testSeeTripsUnder3KM()
    {
        //Arrangement 

              // loading the json file
        $json=file_get_contents(base_path('resources/json/recent.json'));
        // change to php array
        $json_to_php_array= json_decode($json,true);
        // get the trip array from that array
        $trips=$json_to_php_array['trips'];
        $distance = 1;
        $filter_distance = [];
        //action
        //Assertions
        if ($distance < 3) {
            // code...
             foreach ($trips as $trip) {
              $latFrom=deg2rad($trip['pickup_lat']);
              $latTo=deg2rad($trip['dropoff_lat']);
              $lonFrom=deg2rad($trip['pickup_lng']);
              $lonTo=deg2rad($trip['dropoff_lng']);

              $latDelta = $latTo - $latFrom;
              $lonDelta  = $lonTo - $lonFrom;
              $earth_radius = 6372.795477598;
              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
              $distance_km = $angle * $earth_radius;
              // add to filter Distance
              if($distance_km < 3){
                array_push($filter_distance,$trip);
              }
            }
        }
        $response = $this->post('search');
        $response->assertStatus(200);
        $response->assertSee($filter_distance[0]['request_date']);
        $response->assertSee($filter_distance[0]['pickup_location']);
        $response->assertSee($filter_distance[0]['dropoff_location']);
        $response->assertSee($filter_distance[0]['cost_unit']);
        $response->assertSee($filter_distance[0]['status']);
    }

    public function testSeeTripsUnder3to8KM()
    {
        //Arrangement 

              // loading the json file
        $json=file_get_contents(base_path('resources/json/recent.json'));
        // change to php array
        $json_to_php_array= json_decode($json,true);
        // get the trip array from that array
        $trips=$json_to_php_array['trips'];
        $distance =  5;
        $filter_distance = [];
        
        if ($distance > 3 || $distance <= 8) {
            // code...
             foreach ($trips as $trip) {
              $latFrom=deg2rad($trip['pickup_lat']);
              $latTo=deg2rad($trip['dropoff_lat']);
              $lonFrom=deg2rad($trip['pickup_lng']);
              $lonTo=deg2rad($trip['dropoff_lng']);

              $latDelta = $latTo - $latFrom;
              $lonDelta  = $lonTo - $lonFrom;
              $earth_radius = 6372.795477598;
              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
              $distance_km = $angle * $earth_radius;
              // add to filter Distance
              if($distance_km > 3 || $distance_km <= 8){
                array_push($filter_distance,$trip);
              }
            }
        }
        //action
        $response = $this->post('search');
        //Assertions
        $response->assertStatus(200);
        $response->assertSee($filter_distance[0]['request_date']);
        $response->assertSee($filter_distance[0]['pickup_location']);
        $response->assertSee($filter_distance[0]['dropoff_location']);
        $response->assertSee($filter_distance[0]['cost_unit']);
        $response->assertSee($filter_distance[0]['status']);
    }

        public function testSeeTripsUnder8to15KM()
    {
        //Arrangement 

              // loading the json file
        $json=file_get_contents(base_path('resources/json/recent.json'));
        // change to php array
        $json_to_php_array= json_decode($json,true);
        // get the trip array from that array
        $trips=$json_to_php_array['trips'];
        $distance =  12;
        $filter_distance = [];
        
        if ($distance > 8 || $distance <= 15) {
            // code...
             foreach ($trips as $trip) {
              $latFrom=deg2rad($trip['pickup_lat']);
              $latTo=deg2rad($trip['dropoff_lat']);
              $lonFrom=deg2rad($trip['pickup_lng']);
              $lonTo=deg2rad($trip['dropoff_lng']);

              $latDelta = $latTo - $latFrom;
              $lonDelta  = $lonTo - $lonFrom;
              $earth_radius = 6372.795477598;
              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
              $distance_km = $angle * $earth_radius;
              // add to filter Distance
              if($distance_km > 8 || $distance_km <= 15){
                array_push($filter_distance,$trip);
              }
            }
        }
        //action
        $response = $this->post('search');
        //Assertions
        $response->assertStatus(200);
        $response->assertSee($filter_distance[0]['request_date']);
        $response->assertSee($filter_distance[0]['pickup_location']);
        $response->assertSee($filter_distance[0]['dropoff_location']);
        $response->assertSee($filter_distance[0]['cost_unit']);
        $response->assertSee($filter_distance[0]['status']);
    }

}
