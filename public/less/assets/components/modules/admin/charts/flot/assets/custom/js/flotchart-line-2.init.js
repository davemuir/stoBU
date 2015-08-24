$( document ).ready(function() {
(function($)
{
	if (typeof charts == 'undefined')
		return;

	charts.chart_lines_fill_nopoints_2 =
	{
		// chart data
		data:
		{
			d1: []
		},

		// will hold the chart object
		plot: null,

		// chart options
		options:
		{
			colors: [ primaryColor ],
			grid: {
				color: "#dedede",
			    borderWidth: 1,
			    borderColor: "transparent",
			    clickable: true,
			    hoverable: true
			},
	        series: {
	        	grow: {active:false},
	            lines: {
            		show: true,
            		fill: false,
            		lineWidth: 5,
            		steps: false,
            		color: primaryColor
            	},
	            points: {show:false}
	        },
	        legend: { position: "nw", backgroundColor: null, backgroundOpacity: 0 },
	        yaxis: {
	        	ticks:3,
	        	tickSize: 50,
	        	tickFormatter: function(val, axis) { return val ;}
	    	},
	        xaxis: { ticks:4, tickDecimals: 0, tickColor: 'transparent' },
	        shadowSize:0,
	        tooltip: true,
			tooltipOpts: {
				content: "%s : %y.0",
				shifts: {
					x: -35,
					y: -50
				},
				defaultTheme: false
			}
		},

		placeholder: "#chart_lines_fill_nopoints_2",

		// initialize
		init: function()
		{
			var d = new Date();
			var n = "May";//d.getMonth();
			var day = d.getDate();
			var d1 = [[1, 0]];
			//for the days to plot
			var xhr = new XMLHttpRequest();
			xhr.open('GET', '/graphModal', false);
			xhr.send(null);


			if (xhr.status == 200) {
				 //console.log(xhr.response);
				var arr = JSON.parse(xhr.response.replace("<?", ''));
				var arrLen = arr.length;
				for(var j=0; j <  arrLen; j++){
					d1[j] = [arr[j]['day'], arr[j]['unique_visits']];

					//var month = [arr[j]['month']];


					//if( month != n){
					//	for(var k = 1; k =1; k++){
					//		$('#pastMonths').append('<option>'+month+'</option');
					//	}
					//}
				}
			}

			this.data.d1 = d1;
			// make chart
			this.plot = $.plot(
				this.placeholder,
				[{
         			label: "Unique Visitors",
         			data: this.data.d1
         		}
         		],
         		this.options);
		},
		select: function(month, year) {
			var d = new Date();
			var n = "May";//d.getMonth();
			var day = d.getDate();
			var d1 = [[1, 0]];
			//for the days to plot
			var xhr = new XMLHttpRequest();
			xhr.open('GET', '/graphModal?month='+month+'&year='+year, false);
			xhr.send(null);

			if (xhr.status == 200) {
				var arr = JSON.parse(xhr.response.replace("<?", ''));
				var arrLen = arr.length;
				for(var j=0; j < arrLen; j++){
					d1[j] = [arr[j]['day'], arr[j]['unique_visits']];

				}
			}

			this.data.d1 = d1;
			// make chart
			this.plot = $.plot(
				this.placeholder,
				[{
         			label: "Unique Visitors",
         			data: this.data.d1
         		}
         		],
         		this.options);
		}


	};

	$(window).on('load', function(){
		setTimeout(function(){
			charts.chart_lines_fill_nopoints_2.init();
		}, 1000);
	});

})(jQuery);



});