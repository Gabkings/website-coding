@extends('layout.mainlayout')
@section('page_content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="text-center">Trip Search</h1>
      </div>
    </div>
    <hr>

    <form method="POST" action=" {{ url('search')}}">
      @csrf
    <div class="row">
      <div class="col-lg-12">


            <div class="form-group">
                <label for="keywordInput">Keyword</label>
                <input type="keyword" name="keyword" class="form-control" id="keywordInput" placeholder="Keyword Here">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-12">
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="include_conceled" type="checkbox" id="include_conceled" value="include">
            <label class="form-check-label" for="include_conceled">Include conceled trips</label>
          </div>
      </div>

    </div>
<br>
    <div class="row">
        <div class="col-lg-6">
          <h5>Distance</h5>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="distance" id="Any" value="Any">
            <label class="form-check-label" for="Any">
            Any
          </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="distance" id="Any" value="under_3km">
            <label class="form-check-label" for="Any">
            Under 3 km
          </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="distance" id="Any" value="3_to_8km">
            <label class="form-check-label" for="Any">
            3 to 8 km
          </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="distance" id="Any" value="8_to_15km">
            <label class="form-check-label" for="Any">
            8 to 15 km
          </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="distance" id="Any" value="more_15km">
            <label class="form-check-label" for="Any">
            More than 15 km
          </label>
          </div>
        </div>

  <div class="col-lg-6">
    <h5>Time</h5>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="time" id="Any" value="Any">
      <label class="form-check-label" for="Any">
      Any
    </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="time" id="Any" value="under_5min">
      <label class="form-check-label" for="Any">
      Under 5 min
    </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="time" id="Any" value="5_to_10min">
      <label class="form-check-label" for="Any">
      5 to 10 min
    </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="time" id="Any" value="10_to_20min">
      <label class="form-check-label" for="Any">
      10 to 20 min
    </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="time" id="Any" value="more_20min">
      <label class="form-check-label" for="Any">
      More than 20 min
    </label>
    </div>
</div>

</div>
<br>
<hr>
<div class="row">
  <div class="col-lg-6 offset-lg-4">
    <button type="submit" class="btn btn-primary">Search</button>
  </div>
</div>
    </form>

  </div>

</form>
@endsection
