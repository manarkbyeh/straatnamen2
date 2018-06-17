@extends('main') @section('title', 'Homepage') @section('content')
<div class="straatnaam text-center">
  <div class="container">
    <div class="header">
      <h1 class="text-bold">{{$resultgemeente}}</h1>
      <h2>{{$resultgemeente}} telt {{count($aantalstraten)}}  straten. In vergelijking met de andere vlaamse gemeenten zijn er in {{$resultgemeente}} meer straten die eindigen met  <div id="max"></div>.</h2>
      <form role="form">
        <div class="form-group">
          <input type="text" id="typeahead" placeholder="ZOEK EEN GEMEENTE" data-provide="typeahead" autocomplete="off">
        </div>
      </form>
    </div>
    <div class="chartCont" id="chart">
    
            </div>
  </div>

</div>



@endSection 

@section('script')
<script>
  var resultgemeente = "{{$resultgemeente}}";
  var maxGemeente = "{{count($aantalstraten)}}";
  $(document).ready(function() {
    $('.slidershow .item').on('click', function() {
      $('.show .one').attr('src', $(this).data('img'));
      $('.show .two').attr('src', $(this).find('img').attr('src'));
    })

    function toArray(data) {
      var newData = [];
      $.each(data, function(index, value) {
        newData[index] = value.GEMNM;
      });
      return newData;
    };
    
    $('#typeahead').typeahead({
      autoSelect: true,
      afterSelect : function (itemhomepage) { 
        window.location.href= "{{route('gemeentensug')}}/"+itemhomepage;
 

        
       },
      source: function(query, process) {
       
        return $.getJSON("{{route('home')}}/" + query, function(data) {
      
          return process(toArray(data));
        });
      }
    });
  });
</script>

<script src="https://d3js.org/d3.v3.min.js"></script>
<script src="../js/gemeente.js"></script>

@endSection