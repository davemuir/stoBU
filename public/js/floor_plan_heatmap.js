
//window.onload = function() {
  $( document ).ready(function() {
    var floorPlan = document.getElementById('floorPlanImg');
    cvi_map.add(floorPlan,{opacity: 50, areacolor: '#e5412d', noborder: true});
  //ById('parliament_blind').innerHTML = "<p><b>Show Hot Spots<\/b><\/p>";
});
//}

function getMousePos(canvas, evt) {
  var rect = canvas.getBoundingClientRect();

  return {
    x: evt.clientX - rect.left,
    y: evt.clientY - rect.top
  };

}
var canvas = document.getElementById('floorPlanImg');


setTimeout(function(){$('.d3canvas').css('position','absolute')}, 1000);
canvas.addEventListener('mousemove', function(evt) {
  var mousePos = getMousePos(canvas, evt);
  var message = 'Mouse position: ' + mousePos.x + ',' + mousePos.y;

  $(".coords").html(message);


}, false);
$('#editMode').click(function() {
  if($('#editMode').is(':checked')) {
    $(".beaconPlaceForm #aliasList").show();
    $(".beaconPlaceForm .info").show();
    $('.d3canvas').hide();
    $('#floorPlanContainer').css('z-index','1');
    canvas.addEventListener('click', function(evt) {

      var mousePos = getMousePos(canvas, evt);

        //var dt = document.getElementById('dots');
        var dta = $('#dots area').attr("id");

        var ct = document.getElementById('floorPlanImg_image').getContext("2d");

        if (dta != "EH"){

        }
        ct.beginPath();
        ct.arc(mousePos.x , mousePos.y, 30, 0, 2*Math.PI);
        ct.fillStyle = 'green';
        ct.fill();
        ct.closePath();
        $("#xCo").val(mousePos.x);
        $("input#yCo").val(mousePos.y);

        var aliasList = $('#aliasList');
        var aValue = aliasList.find(":selected").val();
        //document.getElementById('EH').id = aValue;
        $(".aliasHolder").attr("id",aValue);
        $("input#alias").val(aValue);
        var base_url = 'http://localhost:8000'

        $( "#placebeaconform" ).submit();
      }, false);

  }else{
   $(".beaconPlaceForm #aliasList").hide();
   $(".beaconPlaceForm #editbtn").hide();
   $(".beaconPlaceForm .info").hide();
   $('.d3canvas').show();
   $('#floorPlanContainer').css('z-index','1');
 };

 var width= $('#chart_lines_test').width(),
 height= $('#chart_lines_test').height();

    var canvas = d3.select("#chart_lines_test").append("svg:svg")  // Setting up the canvas -->
    .attr("width", width)
    .attr("height", height)
      //.style({"background":"url(img/const_map.png)","background-position-x":"center"})
      //.style("background-repeat","no-repeat")
      .attr("id","canvasContainer")
      .append("g")  // append to group(g) -->
      .attr("transform", "translate(50, 50)");
    var pack = d3.layout.pack() // Calling the bubble layout from D3 -->
    .size([width, height - 50])
    .padding(10);

    var color = d3.scale.linear()
    .domain([0,39, 40,150,151,250]).range(["#0016A6","#0077FF","#FFFB00","#FF6303","#FF0A0A","#e7422e"]);




          //alert(color.domain);       // }else

          d3.json('/roomActivity' , function (data) {

            var nodes = pack.nodes(data);
            var beacons = data['beacons'];
            var rooms = data['children'];
            var size = data['size'];
            size = size.length;

            var node = canvas.selectAll(".node")
            .data(nodes)
            .enter()
            .append("g")
            .attr("class", "node")
            .attr("id", function (d) { return d.children ? "" : d.name; })
            .attr("val", function (d) { return d.children ? "" : d._id; })
            .attr("name", function (d) { return d.children ? "" : d.name; })
            .attr("transform", function (d) { console.log(d.name + "  translate(" + d.testx + "," + d.testy + ")");return "translate(" + d.plotx + "," + d.ploty + ")"; });

            node.append("circle")
            .attr("r", function (d) { return 30; })
            .attr("fill", function (d) { return color(d.value) })
            .attr("opacity", 0.5)
            .attr("class", "circle")
            .attr("stroke", function (d) { return d.children ? "#fff" : "#ADADAD"; })
            .attr("stroke-width", "2")
            ;
            $(".node").each(function( index ) {

              if( $(this).attr("name") == "" ){
               $(this).remove();
             }else{
              $('#aliasList').append("<option value='"+$(this).attr("val")+"'>"+$(this).attr("name").replace(/_/g, ' ')+"</option>");

            }

          });

        //node.append("text").attr("font-size", "15px").attr("font-weight", "bold").attr("class","svgtext").attr("text-anchor", "middle").text(function (d) { return d.children ? "" : d.name; });

        for(var j=0; j <= rooms.length; j++){
          for(var k=0; k <= beacons.length; k++){
            if(rooms[j]._id == beacons[k].room){
              $( ".node" ).each(function(index) {
                if($(this).attr('val') == rooms[j]._id){

                   // d3.select('.node#'+rooms[j].name).append("text").attr("font-size", "10px").attr("dy", 1+"em").attr("font-weight", "bold").attr("class","svgtext").attr("text-anchor", "middle").text(function (d) { return "beacons : "+ beacons[k].alias; });

                   d3.select('.node#'+rooms[j].name).append("text").attr("font-size", "18px").attr("fill", "#fff").attr("font-weight", "bold").attr("class","svgtext").attr("text-anchor", "middle").text(function (d) { return size; });
                 }
               });
            }
          }
        }


        $(".svgtext").each(function( index ) {

          var theText = $(this);
          theText.text(theText.text().replace(/_/g, ' '));
        });


      });

});