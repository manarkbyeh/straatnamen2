@extends('main') @section('title', 'Street detail page') @section('content')


<div class="straatnaam text-center">
  <div class="container">
    <div class="header header-image">
      <div id="headers"></div>
      <form role="form">
        <div class="form-group">
          <input type="text" id="typeahead" class="streetname" placeholder="ZOEK EEN STRAAT" data-provide="typeahead" autocomplete="off">
        </div>
      </form>
      <div class="drawDetalies row" id="DrawDetailes">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="item test x"> 
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="item1" id="map"></div>
              </div> 
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="item1" id = "pano" ></div>
              </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row" id="node-id">
    </div>
    <div id="pagination">
    </div>
  </div>

@endSection @section('script')
  <script>
    var straatnaam = "@if(!is_null ($straten)) {{$straten->first()->STRAATNM}} @endif";
    
    var straten = @if(!is_null ($straten)) {!!$straten->toJson(); !!} @else [] @endif;
    var gemeente = "{{$gemeente}}";
    var load = 0;
    
    function updateHeader() {
        var len = straten.length;
        if (len > 0) {
          $('#headers').html('<h1 class="text-bold" id="zoneName">' + straatnaam +'  in   '  + gemeente+ '</h1>');
        }
    }
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
          afterSelect: function(item) {
            update(item);
            $('#typeahead').val('');
          },
          source: function(query, process) {
            return $.getJSON("{{route('home')}}/suggestions/" + query, function(data) {
              return process(toArray(data));
            });
          }
        });
    }
    function cardGoogleMap(start) {
        var len = straten.length;
        var max = Math.min(len, 6);
        start = start || 1;
        start = parseInt(start, 10);
        if (isNaN(start)) {
          start = 1;
        }
        start = (start - 1) * 6;
        max = start + Math.min(6 - ((start + 6) - len), 6);


        if (max < 1) return false;
        $('#node-id').html('');
  
        for (var i = start; i < max; i++) {
          $('<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" data-index'+i+'="0"> <div class="item test"> <h3 class="kaart" id="zoneName' + i + '"> </h3> <div ' +
              'class="col-lg-6 col-md-6 col-sm-4 col-xs-6"> <div class="item1" id="map' + i + '"></div> </div> <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6"> <div class="it' +
              'em1" id = "pano' + i + '" > </div></div> </div> </div>')
            .appendTo('#node-id').on('click',event);
        };
        for (var i = start; i < max; i++) {
          (function(mapix) {
            $.ajax({
              url: 'https://maps.googleapis.com/maps/api/geocode/json',
              data: {
                address: straatnaam + straten[mapix].GEMNM.replace('_', '') + "België",
                key: 'AIzaSyAVIrMTgTorsdnk5zBxPAr09FBieOZ2RJs'
              },
              type: "get"
            }).done(function(data) {
              var arrLatt = [];
              if (data.results[0]) {
                var latt = data.results[0].geometry.location.lat;
                var lngg = data.results[0].geometry.location.lng;
                initialize(latt, lngg, mapix, data.results[0].address_components[1].long_name ,data.results[0].address_components[0].long_name)
              }
            })
          })(i);

        };
        return true;
    }
    function initialize(latt, lngg, index, title , straat) {
        var fenway = {
          lat: latt,
          lng: lngg
        };
        var $pano = document.getElementById('pano' + index);
        var $map = document.getElementById('map' + index);
        var sv = new google.maps.StreetViewService();
        var panorama = new google.maps.StreetViewPanorama($pano);

        var map = new google.maps.Map($map, {
          center: fenway,
          zoom: 10
        });
        sv.getPanorama({
          location: fenway,
          radius: 50
        }, function(data, status) {
          if (status === 'OK') {
            panorama.setPano(data.location.pano);
            panorama.setPov({
              heading: 34,
              pitch: 10
            });
            panorama.setVisible(true);
            map.setStreetView(panorama)
          } else {
            var marker = new google.maps.Marker({
              map: map,
              position: fenway,
              title: title
            });
            $pano.innerHTML = "Er is geen Street View data voor deze locatie.";
            $pano.style.backgroundColor = "black";
            $pano.style.color = "white";
          }
          var $parent = $map.parentElement.parentElement.parentElement;
          $parent.setAttribute('data-latt',latt);
          $parent.setAttribute('data-lngg',lngg);
          if ( 'zoneName' + index != 'zoneName' && document.getElementById('zoneName' + index)) {
            document.getElementById('zoneName' + index).innerText = straat + "  " + title;
          }
     
        });
    };
    function bindFirstCard(gem){
      var o = straten[0]
      if(gem){
          o = straten.filter(o => o.GEMNM == gem)[0];
      }
      if(o && o.STRAATNM){
          $('#DrawDetailes').css('display','block');
            $.ajax({
              url: 'https://maps.googleapis.com/maps/api/geocode/json',
              data: {
                address: o.STRAATNM + o.GEMNM.replace('_', '') + "België",
                key: 'AIzaSyAVIrMTgTorsdnk5zBxPAr09FBieOZ2RJs'
              }, 
              type: "get"
            }).done(function(data) {
              var arrLatt = [];
              if (data.results[0]) {
                var latt = data.results[0].geometry.location.lat;
                var lngg = data.results[0].geometry.location.lng;
                initialize(latt, lngg, '', data.results[0].formatted_address);
              }
            })
            return true;
        }else{
          $('#DrawDetailes').css('display','none');
          $('#pano','#map').html('');
          return false;
        }
         
    }
    function pagination(active) {
        var start = 0;
        var len = straten.length;
        var page = Math.ceil(len / 6);
        var short = false;
        var i;
        limit = 7;
        if (page > limit + 2) {
          short = true;
        }
        if (page < limit) {
          limit = page;
        }
        var mid = limit >> 1;
        if (page - (active - mid) > 7) {
          if (active - mid > 0) {
            start = active - mid;
          }
        } else {
          start = page - limit;
        }
        if (straten.length > 0) {
          var str = '<ul class="pagination">' +
            '<li ' + (active == 1 ? 'class="disabled"' : '') + '><span>«</span></li>';
          for (i = start; i < limit + start && i < page; i++) {
            str += ' <li ' + (i == active - 1 ? 'class="active"' : '') + '><span>' + (i + 1) + '</span></li>';
          }
          str += '<li ' + (active == page ? 'class="disabled"' : '') + '><span>»</span></li>';
          $('#pagination').html(str);
        }
    }
    function eventPagination() {
        $("#pagination").on("click", "li", function() {
          if (!this.classList.contains('active')) {
            var $this = $(this);
            $this.addClass('active');
            $this.siblings().removeClass('active');
            var value = $this.children().text()
            switch (value) {
              case '«':
                pagination(1)
                cardGoogleMap()
                break;
              case '»':
                var page = Math.ceil(straten.length / 6);
                pagination(page)
                cardGoogleMap(page)
                break;
              default:
                if (!isNaN(+value) && +value > 0 && +value <= Math.ceil(straten.length / 6)) {
                  pagination(+value)
                  cardGoogleMap(+value)
                }
            }
          }
        });
    }
    function update(st) {
        $.ajax({
            url: "{{ route('home')}}/street/search/" + st,
            type: "get"
          })
          .done(function(data) {
            data = JSON.parse(data);
            if (typeof data === 'object' && straten.length > 0) {
              straten = data;
              straatnaam = st.charAt(0).toUpperCase() + st.slice(1)
              updateHeader();
              if(bindFirstCard()){
                cardGoogleMap();
                pagination(1)
                eventPagination();
              }
            }
          });

    }
    function init() {
      if(straten.length == 0)
        return;
      load++;
      if (load == 2) {
        updateHeader();
        typeAhead();
        if(bindFirstCard(gemeente)){
          cardGoogleMap();
          pagination(1)
         eventPagination();
        }        
      }
    }
    function event(e){
      $elem = $(this);
      if($elem){
        initialize( $elem.data('latt'),$elem.data('lngg'),'',$elem.find('h3').text())
      }
    }
    $(document).ready(function() {
      init();
    });
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJyGa-Bx9uBXJAF1e_gCczxOcJCg4F_H8&callback=init">
    </script>
@endSection