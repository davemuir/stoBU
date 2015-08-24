
var project_ID = "55ae574890e4bd376c52ba71";
var write_key = "d333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8";
var read_key = "b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9";

var lineData = [];
var clip = new ZeroClipboard();
//event
clip.setText( "Copy me!" );
clip.on( "ready", function( readyEvent ) {


   console.log( "ZeroClipboard SWF is ready!" );
   
 });

clip.on( "copy", function( event ) {
    alert("Copied text to clipboard: ");
 });

function makeCSV(canVal,companyID){
	
		var client = new Keen({
			projectId: project_ID,
			writeKey: write_key,
		    readKey:read_key, 
		    requestType: "jsonp"
		});

		var count = new Keen.Query("extraction", {
		 eventCollection: "enterBeaconRegion",
		  filters: [
    		{
		      "property_name": "companyID",
		      "operator": "eq",
		      "property_value": companyID
		    }
		  ]
		});

		// Send query
		client.run(count, function(err, response){
			lineData1 = response["result"];
			  	var json = lineData1;
			var fields = Object.keys(json[0]);
			var csv = json.map(function(row){
			  return fields.map(function(fieldName){
			    return '"' + (row[fieldName] || '') + '"';
			  });
			});
			csv.unshift(fields); // add header column
			var csvFormat = csv.join('\r\n');
			
			console.log(csvFormat);
			//copyToClipboard(csvFormat);

			client.on( "copy", function( event ) {
				  var clipboard = event.clipboardData;
				  clipboard.setData( "text/plain", "Copy me!" );
				  clipboard.setData( "text/html", "<b>Copy me!</b>" );
				  clipboard.setData( "application/rtf", "{\\rtf1\\ansi\n{\\b Copy me!}}" );
			});
		});
}
function copyToClipboard(csvFormat) {
	clip.setText(csvFormat);
}



//other stuff from keen class
//makes visualization for entered beacon region users
function keenQueryReports(keenQueryID){
		console.log(keenQueryID);
		var client = new Keen({
			projectId: project_ID,
			writeKey: write_key,
		    readKey:read_key, 
		    requestType: "jsonp"
		});

		var count = new Keen.Query("count", {
		 eventCollection: "enterBeaconRegion",
		  group_by: "timestamp",
		  referrer: document.referrer,
		  timeframe: "this_1_month",
		  filters: [
    		{
		      "property_name": "companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});

		// Send query
		client.run(count, function(err, response){
		  // if (err) handle the error
		  var lineData1 = response['result'];
		  for(var piece in lineData1){
		  		lineData.push({'date':lineData1[piece].timestamp,'sum':lineData1[piece].result});
		  }


		  	var json = lineData1;
			var fields = Object.keys(json[0]);
			var csv = json.map(function(row){
			  return fields.map(function(fieldName){
			    return '"' + (row[fieldName] || '') + '"';
			  });
			});
			csv.unshift(fields); // add header column
			var csvFormat = csv.join('\r\n');
			console.log("csvFormat");
			console.log(csvFormat);

		  	var reportchartVars = "KoolOnLoadCallFunction=reportPieChartReadyHandler";
			KoolChart.create("reportpiechart","reportPiechartHolder", reportchartVars, "100%", "100%");
		});
}						
function reportPieChartReadyHandler(id){
			document.getElementById(id).setLayout(reportStr);
	      	document.getElementById(id).setData(lineData);
}
function keenQueryCampaign(keenQueryID){
		var client = new Keen({
			projectId: "55ae574890e4bd376c52ba71",
			writeKey: "d333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8",
		      //, protocol: "https"
		    //host: 'http://sto.apengage.io',
		    readKey:"b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9", 
		    requestType: "jsonp"
		});
		var count_unique = new Keen.Query("count_unique", {
		  eventCollection: "newCampaign",
		  targetProperty: "newCampaign.entry",
		  referrer: document.referrer,
		  timeframe: "this_7_days",
		  filters: [
    		{
		      "property_name": "newCampaign.companyID",
		      "operator": "gt",
		      "property_value": keenQueryID
		    }
		  ]
		});

		// Send query
		client.run(count_unique, function(err, response){
		  // if (err) handle the error
		  
		  var respData = response.result;
		  makeViz(respData);
		});
}						