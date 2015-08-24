<?php

?>
<script src="//code.jquery.com/jquery-1.11.1.js"></script>
<script type="text/javascript">
  !function(a,b){a("Keen","https://d26b395fwzu5fz.cloudfront.net/3.2.6/keen.min.js",b)}(function(a,b,c){var d,e,f;c["_"+a]={},c[a]=function(b){c["_"+a].clients=c["_"+a].clients||{},c["_"+a].clients[b.projectId]=this,this._config=b},c[a].ready=function(b){c["_"+a].ready=c["_"+a].ready||[],c["_"+a].ready.push(b)},d=["addEvent","setGlobalProperties","trackExternalLink","on"];for(var g=0;g<d.length;g++){var h=d[g],i=function(a){return function(){return this["_"+a]=this["_"+a]||[],this["_"+a].push(arguments),this}};c[a].prototype[h]=i(h)}e=document.createElement("script"),e.async=!0,e.src=b,f=document.getElementsByTagName("script")[0],f.parentNode.insertBefore(e,f)},this);
</script>
<script>
var project_ID = "55ae574890e4bd376c52ba71";
var write_key = "d333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8";
var read_key = "b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9";
var canVal;
var lineData = [];
var companyID = "<?php echo $companyID;?>";
//event


function makeCSV(canVal,companyID){
		console.log(companyID);
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
			document.write(csvFormat);

			
		});
}
setTimeout(function(){ 
           //$('#data').remove();
           makeCSV(canVal,companyID);
       }, 400);  

//other stuff from keen class
//makes visualization for entered beacon region users
	
</script>