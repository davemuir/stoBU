(function(){

	var points = raw.models.points();
	var result = [];



	var chart = raw.chart()
		.title('Bar Chart')
		.description(
            "Create a bar chart counting interactions over date(time).  By dragging time into X axis and hour into Y, the bar chart will plot the amount of interactions by date. ")
		.thumbnail("imgs/custom1.png")
	    .category('Custom')
		.model(points)


	var width = chart.number()
		.title("Width")
		.defaultValue(847)
		.fitToWidth(true)

	var height = chart.number()
		.title("Height")
		.defaultValue(500)

	var maxRadius = chart.number()
		.title("max radius")
		.defaultValue(20)

	var useZero = chart.checkbox()
		.title("set origin at (0,0)")
		.defaultValue(false)

	var colors = chart.color()
		 .title("Color scale")

	var showPoints = chart.checkbox()
		.title("show points")
		.defaultValue(true)

	chart.draw(function (selection, data){
		
		var mata = data;
		var cnt = [];
		var count = 1;
		//data.push({y:0,x:"Jan 1 1970 00:00:00 GMT-0400 (EDT)",size:1,color:null,label:null});
		//loop for date, counts how many hits for that date.
		for(var piece in data){
			var match = data[piece].x;
			for(var inner in mata){
				var inside = mata[inner].x;
				if(match.toString()  == inside.toString()){
					count++;
				}
			}
			//console.log(data[piece].x +' - '+count);
			data[piece].y = count;
			count = 1;
		}
		console.log(data);
	
		//data.push({y:0,x:0,size:1,color:null,label:null});
		
		// Retrieving dimensions from model
		var x = points.dimensions().get('x'),
			y = points.dimensions().get('y');
			
		var g = selection
			.attr("width", +width()+50 )
			.attr("height", +height() )
			.append("g")
			.attr("id", "viz" )

		var marginLeft = d3.max([maxRadius(),(d3.max(data, function (d) { return (Math.log(d.y) / 2.302585092994046) + 1; }) * 9)]),
			marginBottom = 20,
			w = width() - marginLeft,
			h = height() - marginBottom;

		var xExtent = !useZero()? d3.extent(data, function (d){ return d.x; }) : [0, d3.max(data, function (d){ return d.x; })],
			yExtent = !useZero()? d3.extent(data, function (d){ return d.y; }) : [0, d3.max(data, function (d){ return data.y; })];

		var xScale = x.type() == "Date"
				? d3.time.scale().range([marginLeft,width()-maxRadius()]).domain(xExtent)
				: d3.scale.linear().range([marginLeft,width()-maxRadius()]).domain(xExtent),
			yScale = y.type() == "Date"
				? d3.time.scale().range([h-maxRadius(), maxRadius()]).domain(yExtent)
				: d3.scale.linear().range([h-maxRadius(), maxRadius()]).domain(yExtent),
			sizeScale = d3.scale.linear().range([1, Math.pow(+maxRadius(),2)*Math.PI]).domain([0, d3.max(data, function (d){ return d.size; })]),
			xAxis = d3.svg.axis().scale(xScale).tickSize(-h+maxRadius()*2).orient("bottom")//.tickSubdivide(true),
    		yAxis = d3.svg.axis().scale(yScale).ticks(10).tickSize(-w+maxRadius()).orient("left");


        g.append("g")
            .attr("class", "x axis")
            .style("stroke-width", "1px")
        	.style("font-size","10px")
        	.style("font-family","Arial, Helvetica")
            .attr("transform", "translate(" + 50 + "," + (h-maxRadius()) + ")")
             //.attr("transform", "translate(" + 50 + "," + (h-maxRadius()) + ")")
            .call(xAxis);

      	g.append("g")
            .attr("class", "y axis")
            .style("stroke-width", "1px")
            .style("font-size","10px")
			.style("font-family","Arial, Helvetica")
            //.attr("transform", "translate(" + marginLeft + "," + 0 + ")")
            .attr("transform", "translate(" + 50 + "," + 0 + ")")
            .call(yAxis);

        
        d3.selectAll(".y.axis line, .x.axis line, .y.axis path, .x.axis path")
         	.style("shape-rendering","crispEdges")
         	.style("fill","none")
         	.style("stroke","#ccc")

		var circle = g.selectAll("g.circle")
			.data(data)
			.enter().append("g")
			.attr("class","bar")
			.attr("id",function(d) { return d.x })
			//.attr("id",function(d) { return yScale(d.y) })

		var point = g.selectAll("g.point")
			.data(data)
			.enter().append("g")
			.attr("class","point")

		colors.domain(data, function(d){ return d.color; });
		

    	circle.append("rect")
            .style("fill", function(d) { return colors() ? colors()(d.color) : "steelblue"; })
            .style("fill-opacity", .8)
            .attr("width",19)           
            .attr("height",function(d) { return (h-maxRadius()-yScale(d.y))+5 })
            //.attr("x", function(d) { return xScale(d.x)+50 })
            .attr("x", function(d) { return xScale(d.x)+30 })
            .attr("y", function(d) { return yScale(d.y) })
    	    

    	
    	//can append the date on the bar
    	circle.append("text")
    	    .attr("transform", function(d) { return "translate(" + xScale(d.x) + "," + yScale(d.y) + ")"; })
    		.attr("text-anchor", "middle")
    		.style("font-size","9px")
    		.attr("class","circleText")
    		.attr("dy", 15)
    		.style("font-family","Arial, Helvetica")
    	  	.text(function (d){ return d.label? d.label.join(", ") : ""; });
    	
    	$('.tick').each(function(){
    		$(this).children('text').attr("y",8);
    		
    	});

   		$('#viz .bar').each(function(){
    		var item = $(this);
    		var cl = $(this).attr("class");
    		var tcl = $(this).attr("id");
    		removeDupes(cl,tcl,item);
    	});
    	function removeDupes(cl,tcl,item){
    		var countDupe = 0;
    		$('#viz .bar').each(function(){
    			if($(this).attr("id") == tcl){
    				countDupe++;
    			}
    			
    		});
    		if(countDupe >= 1){
    			finalizeDupes(countDupe,tcl)
    		}
    		


    	}

    	function finalizeDupes(countDupe,tcl){
    		console.log(countDupe);
    		var nut = countDupe;
    		var newCount = 0;
    		if(countDupe <= 1){
    			console.log('dupe low');
    			return false;
    		}
    		$('#viz .bar').each(function(){
    			if(nut == 1){
    				return false;
    			}
    			if($(this).attr("id") == tcl && newCount < countDupe && countDupe > 1){
    				nut--;
    				newCount++;
    				$(this).remove();
    			}
    			
    		});
    	}


	})
	 
})();