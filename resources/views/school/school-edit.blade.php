@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit Data Sekolah</div>

                <div class="card-body">
                    <form method="POST"  action="{{ route('school.update', $school->id) }}" enctype="multipart/form-data">
                        @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="sekolah_nama">Nama Sekolah</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="name" value="{{ old('name', $school->name) }}">

                        <label for="sekolah_lat">Latitude: </label>
                        <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $school->latitude) }}" />
                        <label for="sekolah_lng">Longitude: </label>
                        <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $school->longitude) }}"/>
                        <label for="sekolah_radius">Radius: </label>
                        <input type="text" id="radius" value="50" name="radius" value="{{ old('radius', $school->radius) }}" />
                        <br>
                        <div id="map" style="width:800px; height:400px; background-color:#000000;">
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
<script type="text/javascript" class="init">


$(document).ready(function () {
	var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
});

</script>
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyD7R6gDLqkVN6FvMZW89hqFlfLq7u9cHfI'></script>
<script src="{{ asset("plugins/jquery-locationpicker-plugin-master/dist/locationpicker.jquery.js") }}"></script>
<style>
    .pac-container{
        z-index:x 9999999999;
    }
</style>
<script type="text/javascript" class="init">


$(document).ready(function () {
	var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
});

</script>

 <!-- JAVASCRIPT -->
 <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false'></script>
 <script type="text/javascript" src="jquery-1.4.4.min.js"></script>

 <script type="text/javascript">

     $(document).ready(function(){

         var Circle = null;
         var Radius = $("#radius").val();

         var StartPosition = new google.maps.LatLng(-2.35835, 115.45873);

         function DrawCircle(Map, Center, Radius) {

             if (Circle != null) {
                 Circle.setMap(null);
             }

             if(Radius > 0) {
                 Radius *= 2;
                 Circle = new google.maps.Circle({
                     center: Center,
                     radius: Radius,
                     strokeColor: "#0000FF",
                     strokeOpacity: 0.35,
                     strokeWeight: 2,
                     fillColor: "#0000FF",
                     fillOpacity: 0.20,
                     map: Map
                 });
             }
         }

         function SetPosition(Location, Viewport) {
             Marker.setPosition(Location);
             if(Viewport){
                 Map.fitBounds(Viewport);
                 Map.setZoom(map.getZoom() + 2);
             }
             else {
                 Map.panTo(Location);
             }
             Radius = $("#radius").val();
             DrawCircle(Map, Location, Radius);
             $("#latitude").val(Location.lat().toFixed(5));
             $("#longitude").val(Location.lng().toFixed(5));
         }

         var MapOptions = {
             zoom: 13,
             center: StartPosition,
             mapTypeId: google.maps.MapTypeId.ROADMAP,
             mapTypeControl: false,
             disableDoubleClickZoom: true,
             streetViewControl: false
         };

         var MapView = $("#map");
         var Map = new google.maps.Map(MapView.get(0), MapOptions);

         var Marker = new google.maps.Marker({
             position: StartPosition,
             map: Map,
             title: "Drag Me",
             draggable: true
         });

         google.maps.event.addListener(Marker, "dragend", function(event) {
             SetPosition(Marker.position);
         });

         $("#radius").keyup(function(){
             google.maps.event.trigger(Marker, "dragend");
         });

         DrawCircle(Map, StartPosition, Radius);
         SetPosition(Marker.position);

     });

 </script>

@endsection




