@extends('layout.app')
@section('title','GoogleMap')
@section('page_name','GoogleMap')
@section('content')




<div class="card card-custom gutter-b">
 <div class="card-header">
  <div class="card-title">
   <h3 class="card-label">
    Multi Markers Colors
   </h3>
  </div>
 </div>
 <div class="card-body">
  <div id="map" style="width:300; height:600px;"></div>
 </div>
</div>


@endsection

@section('head')
    @parent


@endsection

@section('script')
    @parent


		    @include('layout.basic.js.leaflet')

        <script>

          $(document).ready(function () {
            @if(!empty($positions))
              var marker_data = [
                <?php
                  $str_markers = '';
                  foreach($positions as $value){
                  //  $str_markers.='{ "loc": ['.$value['location']['latitude'].', '.$value['location']['latitude'].'], "title": "'.$value['address'].'" },'."\n";
                    $str_markers.='{ "loc": ['.$value['position_latitude'].', '.$value['position_longitude'].'], "title": "KM '.$value['vehicle_mileage'].'" },'."\n";
                  }
                  rtrim($str_markers);
                  echo $str_markers;
                ?>
              ];
            @else
                  var marker_data = [
                    { "loc": [41.575330, 13.102411], "title": "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. " },
                    { "loc": [41.575730, 13.002411], "title": "black", "class": "svg-icon-success" },
                    { "loc": [41.807149, 13.162994], "title": "blue" },
                    { "loc": [41.507149, 13.172994], "title": "chocolate" },
                    { "loc": [41.847149, 14.132994], "title": "coral" },
                    { "loc": [41.219190, 13.062145], "title": "cyan" },
                    { "loc": [41.344190, 13.242145], "title": "darkblue" },
                    { "loc": [41.679190, 13.122145], "title": "Darkred" },
                    { "loc": [41.329190, 13.192145], "title": "Darkgray" },
                    { "loc": [41.379290, 13.122545], "title": "dodgerblue" },
                    { "loc": [41.409190, 13.362145], "title": "gray" },
                    { "loc": [41.794008, 12.583884], "title": "<div class=\"text-right\"><p>Ciao <strong class='text-primary'>Mario</strong></p><p>Come va?</p></div>" },
                    { "loc": [41.805008, 12.982884], "title": "greenyellow" },
                    { "loc": [41.536175, 13.273590], "title": "red" },
                    { "loc": [41.516175, 13.373590], "title": "rosybrown" },
                    { "loc": [41.507175, 13.273690], "title": "royalblue" },
                    { "loc": [41.836175, 13.673590], "title": "salmon" },
                    { "loc": [41.796175, 13.570590], "title": "seagreen" },
                    { "loc": [41.436175, 13.573590], "title": "seashell" },
                    { "loc": [41.336175, 13.973590], "title": "silver" },
                    { "loc": [41.236175, 13.273590], "title": "skyblue" },
                    { "loc": [41.546175, 13.473590], "title": "yellow" },
                    { "loc": [41.239290, 13.032145], "title": "white" }
                  ];
            @endif

               getMap('map',marker_data );


          });


        </script>




@endsection
