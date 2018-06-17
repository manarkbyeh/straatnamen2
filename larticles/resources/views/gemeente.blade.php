@extends('main') @section('title', 'Homepage') @section('content')
<div class="straatnaam text-center">
  <div class="container">
    <div class="header header-image">
      <h1 class="text-bold">Gemeenten</h1>
      <h3 >Welke straatnamen komen voor in uw gemeente? Zoek het hier uit</h3>
      <form role="form">
        <div class="form-group">
          <input type="text" id="typeahead" placeholder="ZOEK EEN GEMEENTE" data-provide="typeahead" autocomplete="off">
        </div>
      </form>
    </div>

  </div>
  
  <div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-xs-12">
        <div>
          <div class="row">
          
      
       
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-left:2px;padding-right:2px ">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/aalst'"><img src="images/aalst.png" alt="molenstraat" height="100px" width="100%" /></a>
                <h5>Aalst 882</h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-left:2px;padding-right:2px ">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/Aalter'"><img src="images/Aalter.png" alt="Nieuwstraat" height="100px" width="100%" /></a>
                <h5>Aalter 311</h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-left:2px;padding-right:2px ">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/Aartselaar'"><img src="images/Aartselaar.png" alt="Aarschot" width="100%" /></a>
                <h5>Aartselaar 123 </h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-left:2px;padding-right:2px ">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/Aarschot'"><img src="images/Aarschot.png" alt="kerkstraat" width="100%" /></a>
                <h5>Aarschot 435</h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-left:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/Affligem'"><img src="images/Affligem.png" alt="molenstraat" width="100%" /></a>
                <h5>Affligem 151</h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-right:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/Alken'"><img src="images/Alken.png" alt="Nieuwstraat" width="100%" /></a>
                <h5>Alken 154</h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-left:2px;padding-right:2px ">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/Alveringem'"><img src="images/Alveringem.png" alt="Schoolstraat" width="100%" /></a>
                <h5>Alveringem 118</h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-left:2px;padding-right:2px ">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/Anderlecht'"><img src="images/Anderlecht.png" alt="kerkstraat" width="100%" /></a>
                <h5>Anderlecht 517</h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-right:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/Antwerpen'"><img src="images/Antwerpen.png" alt="kerkstraat" height="100px" width="100%" /></a>
                <h5>Antwerpen 3491</h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-left:2px;padding-right:2px ">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/As'"><img src="images/As.png" alt="molenstraat" width="100%" /></a>
                <h5>As 155</h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-left:2px;padding-right:2px ">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/Asse'"><img src="images/Asse.png" alt="Nieuwstraat" width="100%" /></a>
                <h5>Asse 394 </h5>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6" style="padding-left:2px">
              <div class="itemhomepage">
                <a onclick="location.href='{{route('gemeente')}}/Assenede'"><img src="images/Assenede.png" alt="Schoolstraat" width="100%" /></a>
                <h5>Assenede 243</h5>
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
            newData[index] = value.GEMNM;
          });
          console.log(newData)
          return newData;
        };
        $('#typeahead').typeahead({
          autoSelect: true,
          afterSelect : function (itemhomepage) { 
        window.location.href= "{{route('gemeente')}}/"+itemhomepage;
       },
          source: function(query, process) {
            return $.getJSON("{{route('home')}}/gemeentesuggestions/" + query, function(data) {
              console.log(data)
              return process(toArray(data));
            });
          }
        });
      }
      typeAhead();
</script>
@endSection