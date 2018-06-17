@extends('main') @section('title', 'Street name page') @section('content')

<div class="straatnaam text-center">
  <div class="container">
    <div class="header header-image">
      <div id="header"></div>
      <form role="form">
        <div class="form-group">
          <input type="text" id="typeahead" placeholder="ZOEK EEN STRAAT" data-provide="typeahead" autocomplete="off">
        </div>
      </form>
      <div id="mapcontainer">

      </div>
    </div>
  
  <div class="container-fluid googlemaps">
    <div class="row" id="node-id">
    </div>
    <div id="pagination">
    </div>
  </div>
  </div>
  @endSection @section('script')
  
  <script src="	https://cdnjs.cloudflare.com/ajax/libs/d3/3.2.2/d3.v3.min.js"></script>
  <script>
    var straatnaam = "{{$straten->first()->STRAATNM}}";
    var straten = {!!$straten->toJson(); !!}
    var load = 0;

    function init() {
      load++;
      if (load == 2) {
        typeAhead();
        colorMap();
        cardGoogleMap();
        pagination(0)  
        eventPagination();
      }
    }

    function otherPage(gemeente, straat) {
      window.location = "/detailpage/" + gemeente + "/" + straat;
    }
    $(document).ready(function() {
      function updateHeader() {
        var len = straten.length;
        if (len > 0) {
          $('#header').html('<h1 class="text-bold">' + straatnaam + '</h1><h2>\'' + straatnaam + '\' komt ' + len + ' keer voor als straatnaam in Vlaanderen en Brussel.' + (straatnaam == "Kerkstraat" ? 'Het is nummer 1 op de ranglijst met meest voorkomende straatnamen.' : '') + '</h2>');
        }
      }
      updateHeader();

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
      function responsivefy(svg) {
    // get container + svg aspect ratio
    var container = d3.select(svg.node().parentNode),
        width = parseInt(svg.style("width")),
        height = parseInt(svg.style("height")),
        aspect = width / height;

    // add viewBox and preserveAspectRatio properties,
    // and call resize so that svg resizes on inital page load
    svg.attr("viewBox", "-100 0 " + width + " " + height)
        .attr("perserveAspectRatio", "xMinYMid")
        .call(resize);

    // to register multiple listeners for same event type, 
    // you need to add namespace, i.e., 'click.foo'
    // necessary if you call invoke this function for multiple svgs
    // api docs: https://github.com/mbostock/d3/wiki/Selections#on
    d3.select(window).on("resize." + container.attr("id"), resize);

    // get width of container and resize svg to fit it
    function resize() {
        var targetWidth = parseInt(container.style("width"));
        svg.attr("width", targetWidth);
        svg.attr("height", Math.round(targetWidth / aspect));
    }
}
      //teken map met color map
      var canvas = d3.select("#mapcontainer").append("svg").attr("width", 960)
    .attr("height", 400)
    .call(responsivefy);
      var tooltip = d3.select("#mapcontainer").append("div").attr("class", "tooltip hidden");

      d3.json("../gementen.json", function(mapdata) {
        var group = canvas.selectAll("g")
          .data(mapdata.features)
          .enter()
          .append("g");

        var projection = d3.geo.mercator().scale(11000).translate([-430, 11600]);
        var path = d3.geo.path().projection(projection);

        var areas = group.append("path")
          .attr("d", path)
          .attr("class", "area")
          .attr("style", "height:110%;width:100%;")
          //regex replace for removing spaces in id's
          .attr("id", function(d) {
            return d.properties.NAME_DUT.replace(/ /g, "_");
          })
          .on("mousemove", function(d, i) {
            var mouse = d3.mouse(canvas.node()).map(function(d) {
              return parseInt(d);
            });
            //hover
            var $path = d3.select('path#' + d.properties.NAME_DUT);
            if ($path[0][0] && $path[0][0].style && $path[0][0].style.fill === "rgb(210, 114, 105)") {
              $path.style('fill', '#C0392B');
            }
            //einde hover
            tooltip
              .classed("hidden", false)
              .attr("style", "left:" + (mouse[0] + 22) + "px;top:" + (mouse[1]) + "px")
              .html(d.properties.NAME_DUT)
          })
          .on("mouseout", function(d, i) {
            //hover
            var $path = d3.select('path#' + d.properties.NAME_DUT);
            if ($path[0][0] && $path[0][0].style && $path[0][0].style.fill === "rgb(192, 57, 43)") {
              $path.style('fill', '#d27269');
            }
            //einde hover

            tooltip.classed("hidden", true)
          })
        load++;
        if (load == 2) {
          typeAhead();
          colorMap();
          cardGoogleMap();
          pagination(1)
          eventPagination();
        }

      });

      function colorMap() {
        if (straten.length > 0) {
          for (var straat in straten) {
            if (straten.hasOwnProperty(straat)) {
              d3.select('path#' + straten[straat].GEMNM.replace(/ /g, "_")).style('fill', '#d27269');
            };
          };
        }
      }
      // google Map  start =1;
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
          $('<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <div class="item test"> <h3 id="zoneName' + i + '"> </h3> <div ' +
              'class="col-lg-6 col-md-6 col-sm-4 col-xs-6"> <div class="item1" id="map' + i + '"></div> </div> <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6"> <div class="it' +
              'em1" id = "pano' + i + '" > </div></div> </div> </div>')
            .appendTo('#node-id')
            .attr("onclick", "otherPage('" + straten[i].GEMNM + "','" + straatnaam + "')")
        };
        for (var i = start; i < max; i++) {
          (function(mapix) {
            $.ajax({
              url: 'https://maps.googleapis.com/maps/api/geocode/json',
              data: {
                address: straatnaam + straten[i].GEMNM.replace('_', '') + "België",
                key: 'AIzaSyAVIrMTgTorsdnk5zBxPAr09FBieOZ2RJs'
              },
              type: "get"
            }).done(function(data) {
              var arrLatt = [];
              if (data.results[0]) {
                var latt = data.results[0].geometry.location.lat;
                var lngg = data.results[0].geometry.location.lng;
                console.log( data.results[0])
                initialize(latt, lngg, mapix, data.results[0].address_components[1].long_name ,data.results[0].address_components[0].long_name
);
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
        var sv = new google.maps.StreetViewService();
        var panorama = new google.maps.StreetViewPanorama($pano);

        var map = new google.maps.Map(document.getElementById('map' + index), {
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
          if (document.getElementById('zoneName' + index)) {
            document.getElementById('zoneName' + index).innerText = straat + "  " + title;
            console.log(title)
          }
        });
      };

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

      function clearMap() {
        var $paths = d3.selectAll('path').style('fill', '#e2e2e2');
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
              clearMap();
              colorMap();
              cardGoogleMap();
              pagination(1)
              eventPagination();
            }
          });

      }
    });
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJyGa-Bx9uBXJAF1e_gCczxOcJCg4F_H8&callback=init">
    </script>
  @endSection