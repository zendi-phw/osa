function draw(csv) {
          "use strict";

          var margin = 0,
            width = 600,
            height = 600,
            maxBarHeight = height / 2 - (margin + 70);

          var innerRadius = 0.1 * maxBarHeight; // innermost circle

          var svg = d3.select('body')
            .append("svg")
            .attr("width", width)
            .attr("height", height)
            .append("g")
            .attr("class", "chart")
            .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

          var defs = svg.append("defs");

//question_label
var gradients = defs
         .append("linearGradient")
            .attr("id", "gradient-chart-area")
            .attr("x1", "50%")
            .attr("y1", "0%")
            .attr("x2", "50%")
            .attr("y2", "100%")
            .attr("spreadMethod", "pad");

          gradients.append("stop")
            .attr("offset", "0%")
            .attr("stop-color", "#EDF0F0")
            .attr("stop-opacity", 1);

          gradients.append("stop")
            .attr("offset", "100%")
            .attr("stop-color", "#ACB7BE")
            .attr("stop-opacity", 1);

          gradients = defs
            .append("linearGradient")
            .attr("id", "gradient-questions")
            .attr("x1", "50%")
            .attr("y1", "0%")
            .attr("x2", "50%")
            .attr("y2", "100%")
            .attr("spreadMethod", "pad");

          gradients.append("stop")
            .attr("offset", "0%")
            .attr("stop-color", "#F6F8F9")
            .attr("stop-opacity", 1);

          gradients.append("stop")
            .attr("offset", "100%")
            .attr("stop-color", "#D4DAE0")
            .attr("stop-opacity", 1);


          //Arc Digitale Ressourcen
          var arc_1 = d3.svg.arc()
            .innerRadius(maxBarHeight + 40)
            .outerRadius(maxBarHeight + 70)
            .startAngle(0 * (Math.PI/180)) //convert from degs to radians
            .endAngle(360 / 13 * 4 * (Math.PI/180)); 

          svg.append("path")
              .attr("d", arc_1)
              .classed("category-arc-1", true);

          //Arc Lehren & Lernen
          var arc_2 = d3.svg.arc()
            .innerRadius(maxBarHeight + 40)
            .outerRadius(maxBarHeight + 70)
            .startAngle(360 / 13 * 4 * (Math.PI/180)) //convert from degs to radians
            .endAngle(360 / 13 * (4 + 7) * (Math.PI/180)); 

          svg.append("path")
              .attr("d", arc_2)
              .classed("category-arc-2", true);

          //Arc Lerner Orientierung
          var arc_3 = d3.svg.arc()
            .innerRadius(maxBarHeight + 40)
            .outerRadius(maxBarHeight + 70)
            .startAngle(360 / 13 * (4 + 7) * (Math.PI/180)) //convert from degs to radians
            .endAngle(360 / 13 * (4 + 7 + 2) * (Math.PI/180)); 

          svg.append("path")
              .attr("d", arc_3)
              .classed("category-arc-3", true);



          svg.append("circle")    //hellgrau Kreis Question
            .attr("r", maxBarHeight + 40)
            .classed("question-circle", true);

          svg.append("circle")    //Chart Hintergrund (grauer Verlauf)
            .attr("r", maxBarHeight)
            .classed("chart-area-circle", true);

          svg.append("circle")    //kleiner weißer Kreis im Zentrum
            .attr("r", innerRadius)
            .classed("center-circle", true);

          
            var tooltip = d3.select("body").append("div")	
            .attr("class", "tooltip")				


          d3.csv(csv, function(error, data) {

            var cats = data.map(function(d, i) {
              return d.category_label;
            });

            var elements = data.map(function(d, i) {
              return d.question_nr;
            });

            var catCounts = {};
            for (var i = 0; i < cats.length; i++) {
              var num = cats[i];
              catCounts[num] = catCounts[num] ? catCounts[num] + 1 : 1;
            }
            // remove dupes (not exactly the fastest)
            cats = cats.filter(function(v, i) {
              return cats.indexOf(v) == i;
            });
            var numCatBars = cats.length;

            //###
            var elementsCounts = {};
            for (var i = 0; i < elements.length; i++) {
              var num = elements[i];
              elementsCounts[num] = elementsCounts[num] ? elementsCounts[num] + 1 : 1;
            }
            // remove dupes (not exactly the fastest)
            elements = elements.filter(function(v, i) {
              return elements.indexOf(v) == i;
            });
            var numElementBars = elements.length;

            //###

            var angle = 0,
              rotate = 0;

            data.forEach(function(d, i) {
              // bars start and end angles
              d.startAngle = angle;
              angle += (2 * Math.PI) / numElementBars / elementsCounts[d.question_nr];
              d.endAngle = angle;

              // y axis minor lines (i.e. questions) rotation
              d.rotate = rotate;
              rotate += 360 / numElementBars / elementsCounts[d.question_nr];
            });



            var arc_category_label = d3.svg.arc()
              .startAngle(function(d, i) {
                if (i == 0) {
                  return (0 * (Math.PI/180));
                }
                else if (i == 1) {
                  return (360 / 13 * 4 * (Math.PI/180));
                }
                else if (i == 2) {
                  return (360 / 13 * (4 + 7) * (Math.PI/180));
                }
                //return (0 * (Math.PI/180));
              })
              .endAngle(function(d, i) {
                if(i == 0) {
                  return (360 / 13 * 4 * (Math.PI/180));
                }
                else if (i == 1) {
                  return (360 / 13 * (4 + 7) * (Math.PI/180));
                }
                else if (i == 2) {
                  return (360 / 13 * (4 + 7 + 2) * (Math.PI/180));
                }
                //return (360 / 13 * (4 + 7) * (Math.PI/180));
              })
              .innerRadius(maxBarHeight + 40)
              .outerRadius(maxBarHeight + 64);


            var category_text = svg.selectAll("path.category_label_arc")
              .data(cats)
              .enter().append("path")
              .classed("category-label-arc", true)
              .attr("id", function(d, i) {
                return "category_label_" + i;
              }) //Give each slice a unique ID
              .attr("fill", "none")
              .attr("d", arc_category_label);


           category_text.each(function(d, i) {
            //Search pattern for everything between the start and the first capital L
            var firstArcSection = /(^.+?)L/;

            //Grab everything up to the first Line statement
            var newArc = firstArcSection.exec(d3.select(this).attr("d"))[1];
            //Replace all the commas so that IE can handle it
            newArc = newArc.replace(/,/g, " ");

            //If the whole bar lies beyond a quarter of a circle (90 degrees or pi/2)
            // and less than 270 degrees or 3 * pi/2, flip the end and start position
            var startAngle = (function(d, i) {
              if (i == 0) {
                return (360 / 13 * (2) * (Math.PI/180));
              }
              else if (i == 1) {
                return (360 / 13 * (2 + 4) * (Math.PI/180));
              }
              else if (i == 2) {
                return (360 / 13 * (2+ 4 + 7) * (Math.PI/180));
              }
              //return (0 * (Math.PI/180));
            }), endAngle = (function(d, i) {
              if(i == 0) {
                return (360 / 13 * (2 + 4) * (Math.PI/180));
              }
              else if (i == 1) {
                return (360 / 13 * (2 + 4 + 7) * (Math.PI/180));
              }
              else if (i == 2) {
                return (360 / 13 * (2) * (Math.PI/180));
              }
              //return (360 / 13 * (4 + 7) * (Math.PI/180));
            })

            if (startAngle > Math.PI / 2 && startAngle < 3 * Math.PI / 2 && endAngle > Math.PI / 2 && endAngle < 3 * Math.PI / 2) {
              var startLoc = /M(.*?)A/, //Everything between the capital M and first capital A
                middleLoc = /A(.*?)0 0 1/, //Everything between the capital A and 0 0 1
                endLoc = /0 0 1 (.*?)$/; //Everything between the 0 0 1 and the end of the string (denoted by $)
              //Flip the direction of the arc by switching the start and end point (and sweep flag)
              var newStart = endLoc.exec(newArc)[1];
              var newEnd = startLoc.exec(newArc)[1];
              var middleSec = middleLoc.exec(newArc)[1];

              //Build up the new arc notation, set the sweep-flag to 0
              newArc = "M" + newStart + "A" + middleSec + "0 0 0 " + newEnd;
            } //if

            //Create a new invisible arc that the text can flow along
            svg.append("path")
             .attr("class", "hiddenDonutArcs")
             .attr("id", "category_label_"+i)
             .attr("d", newArc)
             .style("fill", "none");

            // modifying existing arc instead
            d3.select(this).attr("d", newArc);
          });


        svg.selectAll(".category-label-text")
           .data(cats)
           .enter().append("text")
           .attr("class", "category-label-text")
           .attr("x", 0)   //Move the text from the start angle of the arc
           //Move the labels below the arcs for those slices with an end angle greater than 90 degrees
          .attr("dy", function(d, i) {
              var startAngle = (function(d, i) {
                if (i == 0) {
                  return (360 / 13 * (2) * (Math.PI/180));
                }
                else if (i == 1) {
                  return (360 / 13 * (2 + 4) * (Math.PI/180));
                }
                else if (i == 2) {
                  return (360 / 13 * (2+ 4 + 7) * (Math.PI/180));
                }
                //return (0 * (Math.PI/180));
              }), endAngle = (function(d, i) {
                if(i == 0) {
                  return (360 / 13 * (2 + 4) * (Math.PI/180));
                }
                else if (i == 1) {
                  return (360 / 13 * (2 + 4 + 7) * (Math.PI/180));
                }
                else if (i == 2) {
                  return (360 / 13 * (2) * (Math.PI/180));
                }
                //return (360 / 13 * (4 + 7) * (Math.PI/180));
              })
              return (startAngle > Math.PI / 2 && startAngle < 3 * Math.PI / 2 && endAngle > Math.PI / 2 && endAngle < 3 * Math.PI / 2 ? -4 : 14);
            })
           .append("textPath")
           .attr("startOffset", "50%")
           .style("text-anchor", "middle")
           .attr("xlink:href", function(d, i) {
             return "#category_label_" + i;
           })
           .text(function(d) {
             return d;
           })

            // question_label
            var arc_question_label = d3.svg.arc()
              .startAngle(function(d, i) {
                return d.startAngle;
              })
              .endAngle(function(d, i) {
                return d.endAngle;
              })
              .innerRadius(maxBarHeight + 2)
              .outerRadius(maxBarHeight + 2);

            var question_text = svg.selectAll("path.question_label_arc")
              .data(data)
              .enter().append("path")
              .classed("question-label-arc", true)
              .attr("id", function(d, i) {
                return "question_label_" + i;
              }) //Give each slice a unique ID
              .attr("fill", "none")
              .attr("d", arc_question_label);

            question_text.each(function(d, i) {
              //Search pattern for everything between the start and the first capital L
              var firstArcSection = /(^.+?)L/;

              //Grab everything up to the first Line statement
              var newArc = firstArcSection.exec(d3.select(this).attr("d"))[1];
              //Replace all the commas so that IE can handle it
              newArc = newArc.replace(/,/g, " ");

              //If the end angle lies beyond a quarter of a circle (90 degrees or pi/2)
              //flip the end and start position
              if (d.startAngle > Math.PI / 2 && d.startAngle < 3 * Math.PI / 2 && d.endAngle > Math.PI / 2 && d.endAngle < 3 * Math.PI / 2) {
                var startLoc = /M(.*?)A/, //Everything between the capital M and first capital A
                  middleLoc = /A(.*?)0 0 1/, //Everything between the capital A and 0 0 1
                  endLoc = /0 0 1 (.*?)$/; //Everything between the 0 0 1 and the end of the string (denoted by $)
                //Flip the direction of the arc by switching the start and end point (and sweep flag)
                var newStart = endLoc.exec(newArc)[1];
                var newEnd = startLoc.exec(newArc)[1];
                var middleSec = middleLoc.exec(newArc)[1];

                //Build up the new arc notation, set the sweep-flag to 0
                newArc = "M" + newStart + "A" + middleSec + "0 0 0 " + newEnd;
              } //if

              //Create a new invisible arc that the text can flow along
              svg.append("path")
               .attr("class", "hiddenDonutArcs")
               .attr("id", "question_label_"+i)
               .attr("d", newArc)
               .style("fill", "none");

              // modifying existing arc instead
              d3.select(this).attr("d", newArc);
            });

            question_text = svg.selectAll(".question-label-text")
              .data(data)
              .enter().append("text")
              .attr("class", "question-label-text")
              .attr("x", 0)   //Move the text from the start angle of the arc
              .attr("y", 0)
              //Move the labels below the arcs for those slices with an end angle greater than 90 degrees
              .attr("dy", function (d, i) {
                return (d.startAngle > Math.PI / 2 && d.startAngle < 3 * Math.PI / 2 && d.endAngle > Math.PI / 2 && d.endAngle < 3 * Math.PI / 2 ? 10 : -10);
              })
              .append("textPath")
              //.attr("startOffset", "50%")
              .style("text-anchor", "middle")
              .style("dominant-baseline", "central")
              .style("fill", function(d, i) {
                return d.color;
              })
              .attr("xlink:href", function(d, i) {
                return "#question_label_" + i;
              })
              .text(function(d) {
                return d.question_nr;
              })
              .call(wrapTextOnArc, maxBarHeight);

            // adjust dy (labels vertical start) based on number of lines (i.e. tspans)
            question_text.each(function(d, i) {
              //console.log(d3.select(this)[0]);
              var textPath = d3.select(this)[0][0],
                tspanCount = textPath.childNodes.length;

              if (d.startAngle > Math.PI / 2 && d.startAngle < 3 * Math.PI / 2 && d.endAngle > Math.PI / 2 && d.endAngle < 3 * Math.PI / 2) {
                // set baseline for one line and adjust if greater than one line
                d3.select(textPath.childNodes[0]).attr("dy", 1.1 + (tspanCount - 1) * -0.6 + 'em');
              } else {
                d3.select(textPath.childNodes[0]).attr("dy", -1.1 + (tspanCount - 1) * -0.6 + 'em');
              }
            });

            /* bars */
            var arc = d3.svg.arc()
              .startAngle(function(d, i) {
                return d.startAngle;
              })
              .endAngle(function(d, i) {
                return d.endAngle;
              })
              .innerRadius(innerRadius)
              .padRadius(innerRadius);

            var bars = svg.selectAll("path.bar")
              .data(data)
              .enter().append("path")
              //.classed("bars", true)
              //.style("fill", "#019A47")
              .style("fill", function(d, i) {
                return d.color;
              })
              .each(function(d) {
                d.outerRadius = innerRadius;
              })
              .attr("d", arc)
              .on("mouseover", function(d){tooltip.text(d.question_label).style("color", d.color); return tooltip.style("visibility", "visible");})
              .on("mousemove", function(){return tooltip.style("top", (d3.event.pageY-20)+"px").style("left",(d3.event.pageX+20)+"px");})
              .on("mouseout", function(){return tooltip.style("visibility", "hidden");})


            bars.transition().ease("elastic").duration(1000).delay(function(d, i) {
                return i * 100;
              })
              .attrTween("d", function(d, index) {
                var i = d3.interpolate(d.outerRadius, x_scale(+d.value));
                return function(t) {
                  d.outerRadius = i(t);
                  return arc(d, index);
                };
              });

            var x_scale = d3.scale.linear()
              .domain([0, 100])
              .range([innerRadius, maxBarHeight]);


            var y_scale = d3.scale.linear()
              .domain([0, 100])
              .range([-innerRadius, -maxBarHeight]);
              

            svg.selectAll("circle.x.minor")
              .data(y_scale.ticks(0))
              .enter().append("circle")
              .classed("gridlines minor", true)
              .attr("r", function(d) {
                return x_scale(d);
              })
              ;

            // question lines
            svg.selectAll("line.y.minor")
              .data(data)
              .enter().append("line")
              .classed("gridlines minor", true)
              .attr("y1", -innerRadius)
              .attr("y2", -maxBarHeight - 40)
              .attr("transform", function(d, i) {
                return "rotate(" + (d.rotate) + ")";
              });

             // category lines
        /*    svg.selectAll("line.y.major")
              .data(cats)
              .enter().append("line")
              .classed("gridlines major", true)
              .attr("y1", -innerRadius)
              .attr("y2", -maxBarHeight - 70)
              .attr("transform", function(d, i) {
                return "rotate(" + (i * 360 / numElementBars) + ")";
              }); */
            
            // category line 0
            svg.selectAll("line.y.major")
              .data(cats)
              .enter().append("line")
              .classed("gridlines major", true)
              .attr("y1", -innerRadius)
              .attr("y2", -maxBarHeight - 70)
              .attr("transform", "rotate(" + (0) + ")")
              
            // category line 4
            svg.selectAll("line.y.major")
              .data(cats)
              .enter().append("line")
              .classed("gridlines major", true)
              .attr("y1", -innerRadius)
              .attr("y2", -maxBarHeight - 70)
              .attr("transform", "rotate(" + (360 / 13 * 4) + ")")

            // category line 11
            svg.selectAll("line.y.major")
              .data(cats)
              .enter().append("line")
              .classed("gridlines major", true)
              .attr("y1", -innerRadius)
              .attr("y2", -maxBarHeight - 70)
              .attr("transform", "rotate(" + (360 / 13 * (4 + 7)) + ")")
  

            svg.append("circle")    //25 %
              .attr("r", (innerRadius + (maxBarHeight - innerRadius) / 4 * 1))
              .classed("circle-scale", true);
            svg.append("circle")    //50 %
              .attr("r", (innerRadius + (maxBarHeight - innerRadius) / 4 * 2))
              .classed("circle-scale", true);
            svg.append("circle")    //75 %
              .attr("r", (innerRadius + (maxBarHeight - innerRadius) / 4 * 3))
              .classed("circle-scale", true);
              
            svg.append("circle")    //100 % weiß
              .attr("r", (innerRadius + (maxBarHeight - innerRadius) / 4 * 4))
              .classed("circle-scale-100", true);

          });
        }

        // https://bl.ocks.org/mbostock/7555321
        function wrapTextOnArc(text, radius) {
          // note getComputedTextLength() doesn't work correctly for text on an arc,
          // hence, using a hidden text element for measuring text length.
          var temporaryText = d3.select('svg')
            .append("text")
            .attr("class", "temporary-text") // used to select later
            .style("font", "7px sans-serif")
            .style("opacity", 0); // hide element

          var getTextLength = function(string) {
            temporaryText.text(string);
            return temporaryText.node().getComputedTextLength();
          };

          text.each(function(d) {
            var text = d3.select(this),
              words = text.text().split(/[ \f\n\r\t\v]+/).reverse(), //Don't cut non-breaking space (\xA0), as well as the Unicode characters \u00A0 \u2028 \u2029)
              word,
              wordCount = words.length,
              line = [],
              textLength,
              lineHeight = 1.1, // ems
              x = 0,
              y = 0,
              dy = 0,
              tspan = text.text(null).append("tspan").attr("x", x).attr("y", y).attr("dy", dy + "em"),
              arcLength = ((d.endAngle - d.startAngle) / (2 * Math.PI)) * (2 * Math.PI * radius),
              paddedArcLength = arcLength - 16;

            while (word = words.pop()) {
              line.push(word);
              tspan.text(line.join(" "));
              textLength = getTextLength(tspan.text());
              tspan.attr("x", (arcLength - textLength) / 2);

              if (textLength > paddedArcLength && line.length > 1) {
                // remove last word
                line.pop();
                tspan.text(line.join(" "));
                textLength = getTextLength(tspan.text());
                tspan.attr("x", (arcLength - textLength) / 2);

                // start new line with last word
                line = [word];
                tspan = text.append("tspan").attr("dy", lineHeight + dy + "em").text(word);
                textLength = getTextLength(tspan.text());
                tspan.attr("x", (arcLength - textLength) / 2);
              }
            }
          });

          d3.selectAll("text.temporary-text").remove()
        }