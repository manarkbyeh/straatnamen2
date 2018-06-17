(function() {
    d3.queue()
        .defer(d3.csv, '../csv/ff.csv')
        .await(ready);

    function ready(error, datapoints) {
        if (error) throw error;
        var width = $(window).width(),
            height = $(window).height();

        function responsivefy(svg) {
            // get container + svg aspect ratio
            var container = d3.select(svg.node().parentNode),
                width = parseInt(svg.style("width")),
                height = parseInt(svg.style("height")),
                aspect = width / height;

            // add viewBox and preserveAspectRatio properties,
            // and call resize so that svg resizes on inital page load
            svg.attr("viewBox", "0 0 " + width + " " + height)
                .attr("perserveAspectRatio", aspect)
                .call(resize);

            // to register multiple listeners for same event type, 
            // you need to add namespace, i.e., 'click.foo'
            // necessary if you call invoke this function for multiple svgs
            // api docs: https://github.com/mbostock/d3/wiki/Selections#on
            d3.select(window).on("resize", resize);

            // get width of container and resize svg to fit it
            var first = false;

            function resize() {
                if (first) {
                    width = $('#bubblechart').width();
                    height = $('#bubblechart').height();
                    svg.attr("viewBox", "0 0 " + width + " " + height)
                    svg.attr("width", width);
                    svg.attr("height", height)
                    d3.select("g").attr('transform', 'translate(' + (width >> 1) + ',' + (height >> 1) + ')');
                    simulation && simulation.restart();
                } else {
                    first = true;
                }

            }
        }
        var svg = d3
            .select('#' + 'bubblechart')
            .append('svg').attr('class', 'classsvg')
            .call(responsivefy)
            .append('g')
            .attr('transform', 'translate(' + (width >> 1) + ',' + (height >> 1) + ')')

        var defs = svg.append("defs");
        var tooltip = d3.select("body")
            .append("div")
            .style("position", "absolute")
            .style("z-index", "10")
            .style("visibility", "hidden")
            .style("color", "white")
            .style("padding", "8px")
            .style("background-color", "rgba(0, 0, 0, 0.75)")
            .style("border-radius", "6px")
            .style("font", "12px sans-serif")
            .text("test");

        var RadiusScale = d3
            .scaleSqrt()
            .domain([3, 128])
            .range([10, 50]);

        var anticolliding = d3.forceCollide(function(d) {
            return RadiusScale(d.aantal) + 3;
        });

        var simulation = d3
            .forceSimulation()
            .force('charge', d3.forceManyBody())
            .force("collide", anticolliding);




        defs.selectAll(".artist-pattern")
            .data(datapoints)
            .enter()
            .append("pattern")
            .attr('class', 'artist-pattern')
            .attr("id", function(d) {
                return d
                    .straatname
                    .toLowerCase()
                    .replace(/ /g, "-");
            })
            .attr('height', '100%')
            .attr('width', '100%')
            .attr('patternContentUnits', 'objectBoundingBox')
            .append("image")
            .attr('height', 1)
            .attr('width', 1)
            .attr('preserveAspectRatio', 'none')
            .attr('xmlns:xlink', 'http://www.w3.org/1999/xlink')
            .attr('xlink:href', function(d) {
                return 'images/person/' + d.afbeelding;
            })


        var Circles = svg
            .selectAll(".artist")
            .data(datapoints)
            .enter()
            .append("circle")
            .attr('class', 'artist')
            .attr('r', function(d) {
                return RadiusScale(d.aantal)
            })
            .attr('fill', function(d) {
                // 'url(#jon-snow)'
                return ' url(#' + d
                    .straatname
                    .toLowerCase()
                    .replace(/ /g, "-") + ')';
            })
            .on("mouseover", function(d) {
                tooltip.text("aantal straten vernoemd" + "   " + d.aantal + "   " + d.straatname + ": " + d.beroepcategorie);
                tooltip.style("visibility", "visible");
            })
            .on("mousemove", function() {
                return tooltip.style("top", (d3.event.pageY - 10) + "px").style("left", (d3.event.pageX + 10) + "px");
            })
            .on("mouseout", function() { return tooltip.style("visibility", "hidden"); })
            .on('click', function(d) {
                d3.select(this).style("cursor", "pointer");
                window.open(d.wiki, "_blanck");
            });







        function werkForceX(d) {

            if (d.beroepcategorie === "politicus" || d.beroepcategorie === "schrijver") {

                return -width / 10 * 3;
            }
            if (d.beroepcategorie === "wetenschapper" || d.beroepcategorie === "monarchie") {
                return -width / 10;
            }
            if (d.beroepcategorie === "muziek" || d.beroepcategorie === "verpleegkundige" || d.beroepcategorie === "militair" || d.beroepcategorie === "atleet" || d.beroepcategorie === "zakenman" || d.beroepcategorie === "adel" || d.beroepcategorie === "spion" || d.beroepcategorie === "econoom" || d.beroepcategorie === "feminist" || d.beroepcategorie === "filosoof" || d.beroepcategorie === "wever" || d.beroepcategorie === "fictief" || d.beroepcategorie === "jurist") {
                return width / 10;
            }
            return width / 10 * 3;
        }

        function werkForceY(d) {
            if (d.beroepcategorie === "politicus" || d.beroepcategorie === "wetenschapper" || d.beroepcategorie === "muziek" || d.beroepcategorie === "beeldend kunstenaar") {
                return -height >> 2
            }
            return height >> 2;
        }

        function persoonForceX(d) {
            if (d.eeuw === "twintigsteeeuw" || d.eeuw === "vijftiendeeeuw") {
                return -width >> 2
            }
            if (d.eeuw === "zestiendeeeuw" || d.eeuw === "derdeeeuw" || d.eeuw === "zestiendeeeuw" || d.eeuw === "achttiendeeeuw" || d.eeuw === "vierdeeeuw" || d.eeuw === "zevendeeeuw" || d.eeuw === "twaalfdeeeuw" || d.eeuw === "dertiendeeeuw" || d.eeuw === "veertiendeeeuw") {
                return 0;
            }
            return width >> 2
        }

        function persoonForceY(d) {

            if (d.eeuw === "twintigsteeeuw" || d.eeuw === "zestiendeeeuw" || d.eeuw === "negentiendeeeuw") {
                return -height >> 2;
            }

            return height >> 2;
        }




        var forceXseprate = d3.forceX(function(d) {
                if (d.sekseofgeslacht === 'vrouwelijk') {
                    return width >> 2;
                } else {
                    return -width >> 2;
                }
            }).strength(0.05),
            forceXcombine = d3.forceX(0).strength(0.05),
            forceYcombine = d3.forceY(0).strength(0.05),
            forceXwerk = d3.forceX(werkForceX).strength(0.05),
            forceYwerk = d3.forceY(werkForceY).strength(0.05),
            forceXgeborte = d3.forceX(persoonForceX).strength(0.05),
            forceYgeborte = d3.forceY(persoonForceY).strength(0.05);

        var active = "c0";
        window.addEventListener('scroll', function() {
            if (window.scrollY > 518 && window.scrollY < 1272) {
                if (active != "c1") {
                    active = "c1";
                    simulation.stop();
                    simulation
                        .force("x", forceXseprate)
                        .force("Y", forceYcombine)
                        .alphaTarget(2)
                        .restart();
                }

            } else if (window.scrollY > 1272 && window.scrollY < 2070) {
                if (active != "c2") {
                    active = "c2";
                    simulation.stop();
                    simulation
                        .force("x", forceXwerk)
                        .force("Y", forceYwerk)
                        .alphaTarget(2)
                        .restart()
                }
            } else if (window.scrollY > 2070) {
                if (active != "c3") {
                    active = "c3";
                    simulation.stop();
                    simulation
                        .force("x", forceXgeborte)
                        .force("Y", forceYgeborte)
                        .alphaTarget(2)
                        .restart()
                }
            } else {
                if (active != "c0") {
                    active = "c0";
                    simulation.stop();
                    simulation
                        .force("x", forceXcombine)
                        .force("Y", forceYcombine)
                        .alphaTarget(1.5)
                        .restart()
                }
            }
        })
        x = datapoints.sort(function(a, b) { return b.aantal - a.aantal; });
        var activeClass = "c0";
        simulation
            .nodes(datapoints)
            .on("tick", function(d) {
                Circles.attr("cx", function(d) { return d.x; })
                    .attr("cy", function(d) { return d.y; })
                    .attr("class", function(d) {
                        if (window.scrollY > 518 && window.scrollY < 1272) {
                            if (d.sekseofgeslacht === 'vrouwelijk') {
                                return 'p';
                            } else {
                                return 'b';
                            }
                        } else if (window.scrollY > 1272 && window.scrollY < 2070) {
                            if (d.beroepcategorie === 'politicus') {
                                return 'Politici';
                            }
                            if (d.beroepcategorie === 'schrijver') {
                                return 'schrijvers';
                            }
                            if (d.beroepcategorie === 'wetenschapper') {
                                return 'wetenschappers';
                            }
                            if (d.beroepcategorie === 'monarchie') {
                                return 'monarchies';
                            }
                            if (d.beroepcategorie === 'muziek') {
                                return 'muziek';
                            }
                            if (d.beroepcategorie === 'beeldend kunstenaar') {
                                return 'kunstenaars';
                            }
                            if (d.beroepcategorie === 'religieus') {
                                return 'religieus';
                            }
                            if (d.beroepcategorie === "verpleegkundige" || d.beroepcategorie === "militair" || d.beroepcategorie === "atleet" || d.beroepcategorie === "zakenman" || d.beroepcategorie === "adel" || d.beroepcategorie === "spion" || d.beroepcategorie === "econoom" || d.beroepcategorie === "feminist" || d.beroepcategorie === "filosoof" || d.beroepcategorie === "wever" || d.beroepcategorie === "fictief" || d.beroepcategorie === "jurist") {
                                return 'overige';

                            }
                        } else if (window.scrollY > 2070) {
                            if (d.eeuw === "twintigsteeeuw") {
                                return 'Politici';
                            }
                            if (d.eeuw === 'vijftiendeeeuw') {
                                return 'schrijvers';
                            }
                            if (d.eeuw === 'zestiendeeeuw') {
                                return 'wetenschappers';
                            }
                            if (d.eeuw === 'negentiendeeeuw') {
                                return 'muziek';
                            }
                            if (d.eeuw === "zestiendeeeuw" || d.eeuw === "derdeeeuw" || d.eeuw === "zestiendeeeuw" || d.eeuw === "achttiendeeeuw" || d.eeuw === "vierdeeeuw" || d.eeuw === "zevendeeeuw" || d.eeuw === "twaalfdeeeuw" || d.eeuw === "dertiendeeeuw" || d.eeuw === "veertiendeeeuw") {
                                return 'overige';
                            }
                            if (d.eeuw === 'zeventiendeeeuw') {
                                return 'monarchies';
                            }


                        } else {
                            return 'artist';
                        }
                    })
            });

    }

})();