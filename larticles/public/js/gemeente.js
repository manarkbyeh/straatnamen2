var resultgemeente = resultgemeente;
// function formatDecimal(n){
// 	if((n|0) != n){
// 		(+n).toFixed(2);
// 	}
// 	return n;
// }
(function(gemeente) {

    if (gemeente.length < 2)
        return;

    d3.json('../api/getachtervoegselsgemeente/' + gemeente, function(error, d) {
            var result = d.data;
            var dataArr = initSate(result)
            drawStat(error, dataArr)
        })
})(resultgemeente)

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
        total.push(subObj)

    }

    return total

}

function drawStat(error, data) {
    // svg grote
    var fullwidth = 1000,
        fullheight = 500;

    var margin = {
        top: 20,
        right: 250,
        bottom: 20,
        left: 200
    };

    var width = 1000 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    var widthScale = d3
        .scale  
        .linear()
        .range([0, width]);

    var heightScale = d3
        .scale
        .ordinal()
        .rangeRoundBands([
            margin.top, height
        ], 0.2);

    var xAxis = d3
        .svg
        .axis()
        .scale(widthScale)
        .orient("bottom");

    var yAxis = d3
        .svg
        .axis()
        .scale(heightScale)
        .orient("left")
        .innerTickSize([0]);

    var svg = d3
        .select("#chart")
        .append("svg")
        .attr("width", fullwidth)
        .attr("height", fullheight);

    if (error) {
        console.log("error reading file");
    }

    data.sort(function(a, b) {
            return d3.descending(+a.gemeente, +b.gemeente);
        });
		console.log(data)

    var max = data[0].extend;
    $('#max').html(max);

    widthScale.domain([
        d3
        .min(data, function(d) {
            return d.gemeente;
        }),
        d3.max(data, function(d) {
            return d.gemeente;
        })
    ]);

    // een array met de extends
    heightScale.domain(
        data.map(function(d) {
            return d.extend;
        }));

    var linesGrid = svg
        .selectAll("lines.grid")
        .data(data)
        .enter()
        .append("line");

    linesGrid
        .attr("class", "grid")
        .attr("x1", margin.left)
        .attr("y1", function(d) {
            return heightScale(d.extend) + heightScale.rangeBand() / 2;
        })
        .attr("x2", function(d) {
            return margin.left + widthScale(+d.gemeente);

        })
        .attr("y2", function(d) {
            return heightScale(d.extend) + heightScale.rangeBand() / 2;
        });

    //de lijn tussen de dots

    // var linesBetween = svg
    //     .selectAll("lines.between")
    //     .data(data)
    //     .enter()
    //     .append("line");

    // linesBetween
    //     .attr("class", "between")
    //     .attr("x1", function(d) {
    //         return  margin.left + widthScale(+d.land);
    //     })
    //     .attr("y1", function(d) {
    //         return heightScale(d.extend) + heightScale.rangeBand() / 2;
    //     })
    //     .attr("x2", function(d) {
    //         return  margin.left + widthScale(d.gemeente);
    //     })
    //     .attr("y2", function(d) {
    //         return heightScale(d.extend) + heightScale.rangeBand() / 2;
    //     })
    //     .attr("stroke-dasharray", "5,5")
    //     .attr("stroke-width", "1");

    function sumarrygemeente() {

        var sumarrygemeente = [];

        for (i = 0; i < data.length; i++) {
            sumarrygemeente.push(data[i].gemeente)
        }
        return sumarrygemeente;

    }

    // function sumarryland() {

    //     var sumarryland = [];

    //     for (i = 0; i < data.length; i++) {
    //         sumarryland.push(data[i].land)
    //     }
    //     return sumarryland;

    // }
    var sumarry = sumarrygemeente();
    sumarry = d3.sum(sumarry);
    // var sumland = sumarryland()

    // sumland = d3.sum(sumland);
    // dots voor vlaanderen en brussel

    // var land = svg
    //     .selectAll("circle.land")
    //     .data(data)
    //     .enter()
    //     .append("circle");

    // land
    //     .attr("class", "land")
    //     .attr("cx", function(d) {

    //         return margin.left + widthScale(+d.land) ;
    //     })
    //     .attr("r", heightScale.rangeBand() / 2)
    //     .attr("cy", function(d) {
    //         return heightScale(d.extend) + heightScale.rangeBand() / 2;
    //     })
    //     .style("fill", function(d) {
    //         if (d.extend === "straat") {
    //             return "#333399";
    //         }
    //     })
    //     .append("title")
    //     .text(function(d) {
    //         var persent = (d.land / sumland) * 100;
    //         return d.extend + " in Vlaanderen en Brussel" + formatDecimal(persent) + "%";
    //     });

    // gemeente dots

    var gemeente = svg
        .selectAll("circle.gemeente")
        .data(data)
        .enter();
        

    gemeente.append("circle")
        .attr("class", "gemeente")
        .attr("cx", function(d) {

            return (margin.left + widthScale(+d.gemeente));
        })
        .attr("r", heightScale.rangeBand() / 2)
        .attr("cy", function(d) {
            return heightScale(d.extend) + heightScale.rangeBand() / 2;
        })
        .style("fill", function(d) {
            if (d.extend === "straat") {
                return "#CC0000";
            }
        });
gemeente.append("text")
		.attr("dx",function(d) {
            return (margin.left + widthScale(+d.gemeente)  + heightScale.rangeBand()+2);
        })
		.attr("dy", function(d) {
            return heightScale(d.extend) + heightScale.rangeBand() -2;
        })
		.attr("class","text-persent")
        .text(function(d) {
           
            return  ((+d.gemeente /+maxGemeente*100)|0) + "%";
        });




    // add  axes
	svg.append("g")
		.attr("class", "x axis")
		.attr("transform", "translate(" + margin.left + "," + height + ")")
		.call(xAxis);
    svg
        .append("g")
        .attr("class", "y axis")
        .attr("transform", "translate(" + (margin.left-20) + ",0)")
        .call(yAxis)
	

    svg
        .append("text")
        .attr("class", "xlabel")
        .attr("transform", "translate(" + (margin.left + width / 2) + " ," + (height + margin.bottom) + ")")
        .style("text-anchor", "middle")
        .attr("dy", "12")
        .text("Vlaanderen en Brussel");
    svg
        .append("text")
        .attr("class", "xlabel")
        .attr("transform", "translate(" + ((margin.left + width / 2) ) + " ," + (height + margin.bottom) + ")")
        .style("text-anchor", "middle")
        .attr("dy", "12")
        .text(resultgemeente);
    // Style one of the Y labels bold:

    var allYAxisLabels = d3.selectAll("g.y.axis g.tick text")[0];
    d3
        .select(allYAxisLabels[5])
        .style("font-weight", "bold");

}