@extends('main') @section('title', 'Street detail page') @section('head')
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.css' rel='stylesheet' />
@endSection 

@section('content')

<div class="straatnaam text-center">
    <div class="container">
        <div class="header header-image">
            <h1 class="text-bold">De straten van Antwerpen</h1>
            <h4>Naar wie en wat zijn de Antwerpse straten en pleinen genoemd?</h4>
            <p>Meer dan een derde van de straten in Antwerpen zijn vernoemd naar personen. De man-vrouw verhouding is sterk
                vertekend: voor elke straat vernoemd naar een vrouw zijn er bijna 15 vernoemd naar een man. Andere straatnamen
                verwijzen naar plaatsen en gebouwen, naar de natuur en naar voorwerpen.</p>
        </div>
    </div>
</div>
<div id='mapant'>
    <form name='filtergroup' class='filter-group all'>
        <div class="straatnamen-container ">
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="0">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 100%; background-color: ;"></div>
                </div>
                <div class="straatnamen-text" data-layerindex="0">
                    <input class="radio" id="all" type="radio" name="radios" value="all" checked="checked">
                    <label for="all" class="" style="color: #99999c;">Alle straatnamen 3300 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 60.960180838115114%; background-color: #675589;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="persoon" type="radio" name="radios" value="persoon">
                    <label for="persoon" class="" style="color: #675589;">Persoon 1178 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="3">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 50.622674317509997%; background-color: #938e44;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="plaats/gebouw" type="radio" name="radios" value="plaats/gebouw">
                    <label for="plaats/gebouw" class="" style="color: #938e44;">Plaats/Gebouw 657 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="20">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 40.022604764388802%; background-color: #7dd88a;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="natuur" type="radio" name="radios" value="natuur">
                    <label for="natuur" class="" style="color: #7dd88a;">Natuur 417 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="22">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 12.206572769953052%; background-color: #35ad9e;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="religie" type="radio" name="radios" value="religie">
                    <label for="religie" class="" style="color: #35ad9e;">Religie 160 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="3">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 10.622674317509997%; background-color: #447c93;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="economie" type="radio" name="radios" value="economie">
                    <label for="economie" class="" style="color: #447c93;">Activiteiten 150 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="6">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 9.910624239262736%; background-color: #d8e266;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="straateigenschap" type="radio" name="radios" value="straateigenschap">
                    <label for="straateigenschap" class="" style="color: #d8e266;">Straateigenschap 89 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="1">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 5.277343070770301%; background-color: #7c0c16;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="gebeurtenis" type="radio" name="radios" value="gebeurtenis">
                    <label for="gebeurtenis" class="" style="color: #7c0c16;">Gebeurtenis 39 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="4">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 25.206572769953052%; background-color: #b4b4b6f7;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="onbepaald" type="radio" name="radios" value="onbepaald">
                    <label for="onbepaald" class="" style="color: #b4b4b6f7;">Onbepaald 204 </label>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="straatnaam text-center">
    <div class="container">
        <div class="header header-image">
            <h2 class="text-bold">Mannen en vrouwen </h2>
        </div>
    </div>
</div>
<div id='mapmanvrouw'>
    <form name='filtergroup2' class='filter-group manvrouw'>
        <div class="straatnamen-container ">
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="0">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 100%; background-color: ;"></div>
                </div>
                <div class="straatnamen-text" data-layerindex="0">
                    <input class="radio" id="alls" type="radio" name="radios" value="alls" checked="checked">
                    <label for="alls" class="" style="color: #99999c;">Alle personen 1178</label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 92.960180838115114%; background-color: #0f4ff0;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="man" type="radio" name="radios" value="man">
                    <label for="man" class="" style="color: #0f4ff0;">Mannen 1103</label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="1">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 5.277343070770301%; background-color: #eb1e1e;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="vrouw" type="radio" name="radios" value="vrouw">
                    <label for="vrouw" class="" style="color: #eb1e1e;">Vrouwen 75</label>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="straatnaam text-center">
    <div class="container">
        <div class="header header-image">
            <h2 class="text-bold">Fauna en flora</h2>
        </div>
    </div>
</div>
<div id='mapfaunaflora'>
    <form name='filtergroup3' class='filter-group faunaflora'>
        <div class="straatnamen-container ">
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="0">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 100%; background-color: ;"></div>
                </div>
                <div class="straatnamen-text" data-layerindex="0">
                    <input class="radio" id="faunaflora" type="radio" name="radios" value="faunaflora" checked="checked">
                    <label for="faunaflora" class="" style="color: #99999c;">Natuur 417 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="1">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 60%; background-color: #f0bb0f;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="flora" type="radio" name="radios" value="flora">
                    <label for="flora" class="" style="color: #f0bb0f;">Flora 203 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 45%; background-color: #41d228;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="fauna" type="radio" name="radios" value="fauna">
                    <label for="fauna" class="" style="color: #41d228;">Fauna 188 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 13%; background-color: #edea07;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="astronomie" type="radio" name="radios" value="astronomie">
                    <label for="astronomie" class="" style="color: #edea07;">Astronomie 17 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="1">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 10%; background-color: #5e98cf;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="mineraal" type="radio" name="radios" value="mineraal">
                    <label for="mineraal" class="" style="color: #5e98cf;">Mineraal 12 </label>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="straatnaam text-center">
    <div class="container">
        <div class="header header-image">
            <h2 class="text-bold">Voorwerpen en dingen </h2>
        </div>
    </div>
</div>
<div id='mapvoorwerp'>
    <form name='filtergroup4' class='filter-group voorwerpen'>
        <div class="straatnamen-container ">
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="0">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 100%; background-color: ;"></div>
                </div>
                <div class="straatnamen-text" data-layerindex="0">
                    <input class="radio" id="allvoorwerpen" type="radio" name="radios" value="allvoorwerpen" checked="checked">
                    <label for="allvoorwerpen" class="" style="color: #99999c;">Voorwerpen 224</label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="5">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 25.022604764388802%; background-color: #e5d715;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="voorwerp" type="radio" name="radios" value="voorwerp">
                    <label for="voorwerp" class="" style="color: #e5d715;">Voorwerp 134 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="1">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 30%; background-color: #b34ed4;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="abstract" type="radio" name="radios" value="abstract">
                    <label for="abstract" class="" style="color: #b34ed4;">Abstract 53 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 20%; background-color: #6ac89b;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="voedsel" type="radio" name="radios" value="voedsel">
                    <label for="voedsel" class="" style="color: #6ac89b;">Voedsel 26 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="1">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 10%; background-color: #87a4cf;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="voertuig" type="radio" name="radios" value="voertuig">
                    <label for="voertuig" class="" style="color: #87a4cf;">Voertuig 12 </label>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="straatnaam text-center">
    <div class="container">
        <div class="header header-image">
            <h2 class="text-bold">Plaatsen en gebouwen</h2>
        </div>
    </div>
</div>
<div id='mapplaats'>
    <form name='filtergroup6' class='filter-group plaats'>
        <div class="straatnamen-container ">
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="0">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 100%; background-color: ;"></div>
                </div>
                <div class="straatnamen-text" data-layerindex="0">
                    <input class="radio" id="Plaatsengebouwen" type="radio" name="radios" value="Plaatsengebouwen" checked="checked">
                    <label for="Plaatsengebouwen" class="" style="color: #99999c;">Plaatsen en gebouwen 657</label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 40%; background-color: #21e8d1;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="gemeente" type="radio" name="radios" value="gemeente">
                    <label for="gemeente" class="" style="color: #21e8d1;">Gemeente 116 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 25%; background-color: #80ad34;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="stad" type="radio" name="radios" value="stad">
                    <label for="stad" class="" style="color: #80ad34;">Stad (buitenland) 87 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 20%; background-color: #e7905a;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="land" type="radio" name="radios" value="land">
                    <label for="land" class="" style="color: #e7905a;">Land 37 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 19%; background-color: #220efb;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="rivier" type="radio" name="radios" value="rivier">
                    <label for="rivier" class="" style="color: #220efb;">Rivier 31</label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 17%; background-color: #7df514;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="regio" type="radio" name="radios" value="regio">
                    <label for="regio" class="" style="color: #7df514;">Regio 29 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 15%; background-color: #d90da9;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="gebouw" type="radio" name="radios" value="gebouw">
                    <label for="gebouw" class="" style="color: #d90da9;">Gebouw 26 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 9%; background-color: #c520ee;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="continent" type="radio" name="radios" value="continent">
                    <label for="continent" class="" style=" color: #c520ee;">Continent 14 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 60%; background-color: #786d6d;"></div>
                </div>
                <div class="straatnamen-text">
                <input class="radio" id="plaatsnaam niet specifiek" type="radio" name="radios" value="plaatsnaam niet specifiek">
                <label for="plaatsnaam niet specifiek" class="" style="color: #786d6d;">plaatsnaam niet specifiek 290 </label>
            </div>
            </div>
        
        </div>
    </form>
</div>


<div class="straatnaam text-center">
    <div class="container">
        <div class="header header-image">
            <h2 class="text-bold">Activiteiten en beroepen </h2>
        </div>
    </div>
</div>
<div id='mapactiviteiten'>
    <form name='filtergroup5' class='filter-group activiteiten'>
        <div class="straatnamen-container ">
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="0">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 100%; background-color: ;"></div>
                </div>
                <div class="straatnamen-text" data-layerindex="0">
                    <input class="radio" id="activiteiten" type="radio" name="radios" value="activiteiten" checked="checked">
                    <label for="activiteiten" class="" style="color: #99999c;">Activiteiten 150</label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="1">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 30%; background-color: #69d0dd;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="beroep" type="radio" name="radios" value="beroep">
                    <label for="beroep" class="" style="color: #69d0dd;">Beroep 107 </label>
                </div>
            </div>
            <div class="straatnamen-entry straatnamen-chart" data-layerindex="2">
                <div class="straatnamen-bar-container">
                    <div class="straatnamen-fill" style="width: 20%; background-color: #9866f0;"></div>
                </div>
                <div class="straatnamen-text">
                    <input class="radio" id="grondstof" type="radio" name="radios" value="grondstof">
                    <label for="grondstof" class="" style="color: #9866f0;">Grondstof 37 </label>
                </div>
            </div>
        </div>
    </form>
</div>

@endSection 

@section('script')
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.js'></script>
<script>
  mapboxgl.accessToken = 'pk.eyJ1IjoibWFuYXJsIiwiYSI6ImNqaDR4aWNvbjE3ZW8yd2xuZ2MzdXFiYzUifQ.dPJ9d8kwone40OCc5Is1qA';
  // Create a popup, but don't add it to the map yet.
  var popup = new mapboxgl.Popup({
    closeButton: false,
    closeOnClick: false
  });

  function config(container,style){
    return {
      container: container,
      style: style,
      zoom: 11,
      minZoom: 10.15,
      center: [4.365806, 51.262766]
    }
  }


  var mapAnt = new mapboxgl.Map(config('mapant','mapbox://styles/manarl/cji61g3bn3z5k2slgqewigl09'));
  mapAnt.addControl(new mapboxgl.NavigationControl());
  mapAnt.scrollZoom.disable();
  mapAnt.on('load', function() {
    var radios = document.filtergroup.radios;
    var prev = null;
    for (var i = 0; i < radios.length; i++) {
      radios[i].onclick = function() {
        //(prev)? console.log(prev.value):null;
        if (this !== prev) {
          prev = this;
        }
        if (this.value == "all") {
          mapAnt.setFilter('straten-antwerpen-categories-domkkt',['has', 'hoofdcat']);
        } else {
          mapAnt.setFilter('straten-antwerpen-categories-domkkt', ['==', 'hoofdcat', this.value]);
        }
      };
    }

    mapAnt.on('mouseenter', 'straten-antwerpen-categories-domkkt', function(e) {
      // Change the cursor style as a UI indicator.
      mapAnt.getCanvas().style.cursor = 'pointer';

      var coordinates = e.lngLat;
      var description ='<div class="tooltipantwerp">'+e.features[0].properties.straatnaam +'</div>'+ "  Categorie: " + e.features[0].properties.cat +'</div>' ;

      // Ensure that if the map is zoomed out such that multiple
      // copies of the feature are visible, the popup appears
      // over the copy being pointed to.
      while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
      }

      // Populate the popup and set its coordinates
      // based on the feature found.
      popup.setLngLat(coordinates)
        .setHTML(description)
        .addTo(mapAnt);
    });

    mapAnt.on('mouseleave', 'straten-antwerpen-categories-domkkt', function() {
      mapAnt.getCanvas().style.cursor = '';
      popup.remove();
    });



  });

  var mapManvrouw = new mapboxgl.Map(config('mapmanvrouw','mapbox://styles/manarl/cji7sc87m1fnc2rq8vcfvaicr'));
  mapManvrouw.addControl(new mapboxgl.NavigationControl());
  mapManvrouw.scrollZoom.disable();
  mapManvrouw.on('load', function() {
    var radios = document.filtergroup2.radios;

    var prev = null;
    for (var i = 0; i < radios.length; i++) {
      radios[i].onclick = function() {
        if (this !== prev) {
          prev = this;
        }
        if (this.value == "alls") {
            mapManvrouw.setFilter('straten-antwerpen-categories-domkkt',['has', 'cat']);
        } else {
          console.log(this.value)
          mapManvrouw.setFilter('straten-antwerpen-categories-domkkt', ['==', 'cat', this.value]);
        }
      };
    }
    mapManvrouw.on('mouseenter', 'straten-antwerpen-categories-domkkt', function(e) {
      // Change the cursor style as a UI indicator.
      mapManvrouw.getCanvas().style.cursor = 'pointer';

      var coordinates = e.lngLat;
      var description = e.features[0].properties.straatnaam + "   is  " + e.features[0].properties.cat;

      // Ensure that if the map is zoomed out such that multiple
      // copies of the feature are visible, the popup appears
      // over the copy being pointed to.
      while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
      }

      // Populate the popup and set its coordinates
      // based on the feature found.
      popup.setLngLat(coordinates)
        .setHTML(description)
        .addTo(mapManvrouw);
    });

    mapManvrouw.on('mouseleave', 'straten-antwerpen-categories-domkkt', function() {
      mapManvrouw.getCanvas().style.cursor = '';
      popup.remove();
    });
  });

  var mapFaunaflora = new mapboxgl.Map(config('mapfaunaflora','mapbox://styles/manarl/cji7v42dh1p852sl0pknsdpq9'));
  mapFaunaflora.scrollZoom.disable();
  mapFaunaflora.addControl(new mapboxgl.NavigationControl());
  mapFaunaflora.on('load', function() {
    var radios = document.filtergroup3.radios;

    var prev = null;
    for (var i = 0; i < radios.length; i++) {
      radios[i].onclick = function() {
        if (this !== prev) {
          prev = this;
        }
        if (this.value == "faunaflora") {
          mapFaunaflora.setFilter('straten-antwerpen-categories-domkkt (1)', ['has', 'cat']);
        } else {
          console.log(this.value)
          mapFaunaflora.setFilter('straten-antwerpen-categories-domkkt (1)', ['==', 'cat', this.value]);
        }
      };
    }
    mapFaunaflora.on('mouseenter', 'straten-antwerpen-categories-domkkt (1)', function(e) {
      // Change the cursor style as a UI indicator.
      mapFaunaflora.getCanvas().style.cursor = 'pointer';

      var coordinates = e.lngLat;
      var description = e.features[0].properties.straatnaam + "   is  " + e.features[0].properties.cat;

      // Ensure that if the map is zoomed out such that multiple
      // copies of the feature are visible, the popup appears
      // over the copy being pointed to.
      while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
      }

      // Populate the popup and set its coordinates
      // based on the feature found.
      popup.setLngLat(coordinates)
        .setHTML(description)
        .addTo(mapFaunaflora);
    });

    mapFaunaflora.on('mouseleave', 'straten-antwerpen-categories-domkkt (1)', function() {
      mapManvrouw.getCanvas().style.cursor = '';
      popup.remove();
    });
  });

  var mapVoorwerp = new mapboxgl.Map(config('mapvoorwerp','mapbox://styles/manarl/cjiajxfsi0m732ro56gstxc9r'));
  mapVoorwerp.scrollZoom.disable();
  mapVoorwerp.addControl(new mapboxgl.NavigationControl());
  mapVoorwerp.on('load', function() {
    var radios = document.filtergroup4.radios;

    var prev = null;
    for (var i = 0; i < radios.length; i++) {
      radios[i].onclick = function() {
        if (this !== prev) {
          prev = this;
        }
        if (this.value == "allvoorwerpen") {
            mapVoorwerp.setFilter('straten-antwerpen-categories-domkkt',['has', 'cat']);
        } else {
          console.log(this.value)
          mapVoorwerp.setFilter('straten-antwerpen-categories-domkkt', ['==', 'cat', this.value]);
        }
      };
    }
    mapVoorwerp.on('mouseenter', 'straten-antwerpen-categories-domkkt', function(e) {
      // Change the cursor style as a UI indicator.
      mapVoorwerp.getCanvas().style.cursor = 'pointer';

      var coordinates = e.lngLat;
      var description = e.features[0].properties.straatnaam + "   is  " + e.features[0].properties.cat;

      // Ensure that if the map is zoomed out such that multiple
      // copies of the feature are visible, the popup appears
      // over the copy being pointed to.
      while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
      }

      // Populate the popup and set its coordinates
      // based on the feature found.
      popup.setLngLat(coordinates)
        .setHTML(description)
        .addTo(mapVoorwerp);
    });

    mapVoorwerp.on('mouseleave', 'straten-antwerpen-categories-domkkt', function() {
      mapManvrouw.getCanvas().style.cursor = '';
      popup.remove();
    });
  });

  var mapActiviteiten = new mapboxgl.Map(config('mapactiviteiten','mapbox://styles/manarl/cjiam9s8q0bkm2rnu764wip2l'));
  mapActiviteiten.addControl(new mapboxgl.NavigationControl());
  mapActiviteiten.scrollZoom.disable();
  mapActiviteiten.on('load', function() {
    var radios = document.filtergroup5.radios;

    var prev = null;
    for (var i = 0; i < radios.length; i++) {
      radios[i].onclick = function() {
        if (this !== prev) {
          prev = this;
        }
        if (this.value == "activiteiten") {
            mapActiviteiten.setFilter('straten-antwerpen-categories-domkkt',['has', 'cat']);
        } else {
          console.log(this.value)
          mapActiviteiten.setFilter('straten-antwerpen-categories-domkkt', ['==', 'cat', this.value]);
        }
      };
    }
    mapActiviteiten.on('mouseenter', 'straten-antwerpen-categories-domkkt', function(e) {
      // Change the cursor style as a UI indicator.
      mapActiviteiten.getCanvas().style.cursor = 'pointer';

      var coordinates = e.lngLat;
      var description = e.features[0].properties.straatnaam + "   is  " + e.features[0].properties.cat;

      // Ensure that if the map is zoomed out such that multiple
      // copies of the feature are visible, the popup appears
      // over the copy being pointed to.
      while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
      }

      // Populate the popup and set its coordinates
      // based on the feature found.
      popup.setLngLat(coordinates)
        .setHTML(description)
        .addTo(mapActiviteiten);
    });

    mapActiviteiten.on('mouseleave', 'straten-antwerpen-categories-domkkt', function() {
      mapActiviteiten.getCanvas().style.cursor = '';
      popup.remove();
    });
  });

  var mapPlaats = new mapboxgl.Map(config('mapplaats','mapbox://styles/manarl/cjibn355h156i2snp2e1tdh6y'));
  mapPlaats.scrollZoom.disable();
  mapPlaats.addControl(new mapboxgl.NavigationControl());
  mapPlaats.on('load', function() {
    var radios = document.filtergroup6.radios;

    var prev = null;
    for (var i = 0; i < radios.length; i++) {
      radios[i].onclick = function() {
        if (this !== prev) {
          prev = this;
        }
        if (this.value == "Plaatsengebouwen") {
            mapPlaats.setFilter('straten-antwerpen-categories-domkkt',['has', 'cat']);
        } else {
          mapPlaats.setFilter('straten-antwerpen-categories-domkkt', ['==', 'cat', this.value]);
        }
      };
    }
    mapPlaats.on('mouseenter', 'straten-antwerpen-categories-domkkt', function(e) {
      // Change the cursor style as a UI indicator.
      mapPlaats.getCanvas().style.cursor = 'pointer';

      var coordinates = e.lngLat;
      var description = e.features[0].properties.straatnaam + "   is  " + e.features[0].properties.cat;

      // Ensure that if the map is zoomed out such that multiple
      // copies of the feature are visible, the popup appears
      // over the copy being pointed to.
      while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
      }

      // Populate the popup and set its coordinates
      // based on the feature found.
      popup.setLngLat(coordinates)
        .setHTML(description)
        .addTo(mapPlaats);
    });

    mapPlaats.on('mouseleave', 'straten-antwerpen-categories-domkkt', function() {
      mapActiviteiten.getCanvas().style.cursor = '';
      popup.remove();
    });
  });
</script>
@endSection