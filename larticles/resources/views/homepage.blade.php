@extends('main') @section('title', 'Homepage') @section('content')
<div class="straatnaam text-center">
  <div class="container">
    <div class="header header-image">
      <h1 class="text-bold">Straatnamen</h1>
      <h3 >Vlaanderen en België tellen 91.731 verschillende straatnamen. Waar komt de naam van jou straat nog meer voor?</h3>
      <form role="form">
        <div class="form-group">
          <input type="text" id="typeahead" placeholder="ZOEK EEN STRAAT" data-provide="typeahead" autocomplete="off">
        </div>
      </form>
    </div>

  </div>
  
  <div class="container-fluid">
    <div class="row">
    <div class="col-md-4 col-xs-12">
        <div>
          <h3 class="text-bold">Vaak voorkomend</h3>
          <div class="row">
          
      
            <div class="col-xs-6" style="padding-right:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('street')}}/kerkstraat'"><img src="images/kerkstraat1.png" alt="kerkstraat" width="100%" /></a>
                <h5>Kerkstraat</h5>
              </div>
            </div>
            <div class="col-xs-6" style="padding-left:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('street')}}/Molenstraat'"><img src="images/Molenstraat.png" alt="molenstraat" width="100%" /></a>
                <h5>Molenstraat</h5>
              </div>
            </div>
            <div class="col-xs-6" style="padding-right:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('street')}}/Nieuwstraat'"><img src="images/Nieuwstraat.png" alt="Nieuwstraat" width="100%" /></a>
                <h5>Nieuwstraat</h5>
              </div>
            </div>
            <div class="col-xs-6" style="padding-left:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('street')}}/Schoolstraat'"><img src="images/Schoolstraat.png" alt="Schoolstraat" width="100%" /></a>
                <h5>Schoolstraat</h5>
              </div>
            </div>


          </div>
        </div>
      </div>
      <div class="col-md-4 col-xs-12">
        <div>
          <h3 class="text-bold">Geografische patronen</h3>
          <div class="row">
            <div class="col-xs-6" style="padding-right:2px">
          
              <div class="itemhomepage">
                <a onclick="location.href='{{route('street')}}/Kapellestraat'"><img src="images/Kapellestraat.png" alt="Kapellestraat" width="100%" /></a>
                <h5>Kapellestraat</h5>
              </div>
            </div>
            <div class="col-xs-6" style="padding-left:2px">
              <div class="itemhomepage">
                <a href="#"><img src="images/kerkstraat.png" width="100%" /></a>
                <h5>Molenstraat</h5>
              </div>
            </div>
            <div class="col-xs-6" style="padding-right:2px">
              <div class="itemhomepage">
                <a href="#"><img src="images/kerkstraat.png" width="100%" /></a>
                <h5>Straat X</h5>
              </div>
            </div>
            <div class="col-xs-6" style="padding-left:2px">
              <div class="itemhomepage">
                <a href="#"><img src="images/kerkstraat.png" width="100%" /></a>
                <h5>Straat Y</h5>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-md-4 col-xs-12">
        <div>
          <h3 class="text-bold">Speciallekes</h3>
          <div class="row">
            <div class="col-xs-6" style="padding-right:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('street')}}/Kromme Elleboogstraat'"><img src="images/Kromme Elleboogstraat.png" alt="Kromme Elleboogstraat" width="100%" /></a>
                <h5>Kromme Elleboogstraat</h5>
              </div>
            </div>
            <div class="col-xs-6" style="padding-left:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('street')}}/Wijvestraat'"><img src="images/wijvestraat.png" alt="wijvestraat" width="100%" /></a>
                <h5>Wijvestraat</h5>
              </div>
            </div>
            <div class="col-xs-6" style="padding-right:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('street')}}/Vortekoestraat'"><img src="images/Vortekoestraat.png" alt="Vortekoestraat" width="100%" /></a>
                <h5>Vortekoestraat</h5>
              </div>
            </div>
            <div class="col-xs-6" style="padding-left:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('street')}}/Boterham'"><img src="images/Boterham.png" alt="Boterham" width="100%" /></a>
                <h5>Boterham</h5>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endSection @section('script')
<script>

 
    function typeAhead() {
        function toArray(data) {
          var newData = [];
          $.each(data, function(index, value) {
            newData[index] = value.STRAATNM;
          });
          return newData;
        };
        $('#typeahead').typeahead({
          autoSelect: true,
          afterSelect : function (itemhomepage) { 
        window.location.href= "{{route('street')}}/"+itemhomepage;
       },
          source: function(query, process) {
            return $.getJSON("{{route('home')}}/suggestions/" + query, function(data) {
        
              return process(toArray(data));
            });
          }
        });
      }
      typeAhead();
</script>
@endSection