var resultgemeente = resultgemeente;
var formatDecimal = d3.format(".1f");

(function(gemeente) {
    if (gemeente.length < 2) return;
    d3.json("../api/getachtervoegselsgemeente/" + gemeente, function(error, d) {
        drawStat(error, initSate(d.data));
    });

    function initSate(d) {
        var total = [];
        var land = d.slice(0, 32);
        var gemeente = d.slice(32, d.length);
        for (i = 0; i < land.length; i++) {
            var subObj = {};
            subObj.extend = land[i].extend;
            subObj.land = land[i].total;
            subObj.gemeente = 0;
            for (ii = 0; ii < gemeente.length; ii++) {
                if (gemeente[ii].extend == land[i].extend)
                    subObj.gemeente = gemeente[ii].total;
            }
            total.push(subObj);
        }

        return total;
    }

    function drawStat(error, data) {
        if (error)
            throw ("error reading file");

        // svg grote
        var fullwidth = 1000,
            fullheight = 600;

        var margin = {
            top: 20,
            right: 25,
            bottom: 20,
            left: 200
        };

        var width = 1000 - margin.left - margin.right,
            height = 500 - margin.top - margin.bottom;

        var widthScale = d3.scale.linear().range([
            0,
            d3.max(data, function(d) {
                return d.gemeente;
            })
        ]);

        var heightScale = d3.scale
            .ordinal()
            .rangeRoundBands([margin.top, height], 0.2);

        var xAxis = d3.svg
            .axis()
            .scale(widthScale)
            .orient("bottom");

        var yAxis = d3.svg
            .axis()
            .scale(heightScale)
            .orient("left")
            .innerTickSize([0]);

        var svg = d3
            .select("#chart")
            .append("svg")
            .attr("width", fullwidth)
            .attr("height", fullheight);



        data.sort(function(a, b) {
            return b.gemeente - a.gemeente;
        });
        var max = data[0].extend;
        $("#max").html(max);


        widthScale.domain([
            d3
            .min(data, function(d) {
                return d.land;
            }),
            d3.max(data, function(d) {
                return d.land;
            })
        ]);
        // een array met de extends

        function sumarrygemeente() {
            var sumarrygemeente = [];

            for (i = 0; i < data.length; i++) {
                sumarrygemeente.push(data[i].gemeente);
            }
            return sumarrygemeente;
        }

        function sumarryland() {
            var sumarryland = [];

            for (i = 0; i < data.length; i++) {
                sumarryland.push(data[i].land);
            }
            return sumarryland;
        }
        var sumarry = sumarrygemeente();
        sumarry = d3.sum(sumarry);
        var sumland = sumarryland();

        sumland = d3.sum(sumland);
        // dots voor vlaanderen en brussel

        var land = svg
            .selectAll("circle.land")
            .data(data)
            .enter()
            .append("circle");

        land
            .attr("class", "land")
            .attr("cx", function(d) {
                if (d.extend === "straat") {
                    if (d.land > 2000) {
                        d.land = 2000;
                    }
                }
                return margin.left + widthScale(+d.land);
            })
            .attr("r", heightScale.rangeBand() / 2)
            .attr("cy", function(d) {
                return heightScale(d.extend) + heightScale.rangeBand() / 2;
            })

        .append("title")
            .text(function(d) {
                var persent = (d.land / sumland) * 100;
                return (
                    d.extend +
                    " in Vlaanderen en Brussel     " +
                    formatDecimal(persent) +
                    "%"
                );
            });

        // gemeente dots

        var gemeente = svg
            .selectAll("circle.gemeente")
            .data(data)
            .enter()
            .append("circle");

        gemeente
            .attr("class", "gemeente")
            .attr("cx", function(d) {
                if (d.extend === "straat") {
                    if (d.gemeente > 2000) {
                        d.gemeente = 2000;
                    }
                }
                return margin.left + d.gemeente;
            })
            .attr("r", heightScale.rangeBand() / 2)
            .attr("cy", function(d) {
                return heightScale(d.extend) + heightScale.rangeBand() / 2;
            })
            .style("fill", function(d) {
                if (d.extend === "straat") {
                    return "#CC0000";
                }
            })
            .append("title")
            .text(function(d) {
                var persent = (d.gemeente / sumarry) * 100;
                return (
                    d.extend +
                    " in " +
                    resultgemeente +
                    "  " +
                    formatDecimal(persent) +
                    "%"
                );
            });

        // add  axes

        svg
            .append("g")
            .attr("class", "y axis")
            .attr("transform", "translate(" + margin.left + ",0)")
            .call(yAxis);

        svg
            .append("text")
            .attr("class", "xlabel")
            .attr(
                "transform",
                "translate(" +
                (margin.left + width / 2) +
                " ," +
                (height + margin.bottom) +
                ")"
            )
            .style("text-anchor", "middle")
            .attr("dy", "12")
            .text("Vlaanderen en Brussel");
        svg
            .append("text")
            .attr("class", "xlabel")
            .attr(
                "transform",
                "translate(" +
                (margin.left + width / 2 + 100) +
                " ," +
                (height + margin.bottom) +
                ")"
            )
            .style("text-anchor", "middle")
            .attr("dy", "12")
            .text(resultgemeente);
        // Style one of the Y labels bold:

        var allYAxisLabels = d3.selectAll("g.y.axis g.tick text")[0];
        d3.select(allYAxisLabels[5]).style("font-weight", "bold");
    }
})(resultgemeente);