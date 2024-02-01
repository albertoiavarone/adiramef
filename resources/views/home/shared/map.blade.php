<div class="card card-custom gutter-b">
 <div class="card-body">
  <div id="map" style="width:300; height:600px;"></div>
 </div>
</div>

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
                if(!isset($value['latitude'])) continue;
                $str_markers.='{ "loc": ['.$value['latitude'].', '.$value['longitude'].'], "title": "'.$value['text'].'", "status": "'.$value['status'].'" },'."\n";
              }
              rtrim($str_markers);
              echo $str_markers;
            ?>
          ];
        @else
              var marker_data = [];
        @endif
        getMap('map',marker_data );
      });
    </script>
@endsection
