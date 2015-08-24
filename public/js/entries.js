$( document ).ready(function() {

  var currentTime = new Date();
  var currentYear = currentTime.getFullYear();
  var currentDay = currentTime.getDate();
  var currentMonth = currentTime.getMonth() + 1;
  $('#start_chart_year').val(currentYear);
  $('#end_chart_year').val(currentYear);
  $('#end_chart_day').val(currentDay);
  $('#end_chart_month').val(currentMonth);

  global_array = [];
  pie_array = [];


  // some elements are hidden by default

  // $('.customersTable').hide();
  // $('.repeatTable').hide();

  // show the hidden customerstable if desired

  showCustomersTable = function() {
    $('.customersTable').show();
    hideRepeatCustomersTable();
  };

  hideCustomersTable = function() {
    $('.customersTable').hide();
     
  };

  showRepeatCustomersTable = function() {
    $('.repeatTable').show();
    hideCustomersTable();
  };

  hideRepeatCustomersTable = function() {
    $('.repeatTable').hide();
     $('.customersTable').show();

  };

  // helper function for the export stuff


// ===========================================EXPORT PDF ENGINE===========================================

function docDraw(global_array, pie_array) {
  console.log(global_array);
  var doc = new jsPDF('landscape');

  for (var i = 0; i < global_array.length; i++) {

    var chartwidth = $('#chart_div'+i).offsetWidth;
    var chartheight = $('#chart_div'+i).offsetHeight;
    var ratio = Math.min(200 / chartwidth, 74 /  chartheight);

    chartheight = (chartheight*ratio);
    chartwidth = (chartwidth*ratio);


    doc.addImage(global_array[i], 'JPEG', 10, 10, chartwidth, chartheight);
    if (!(i == global_array.length)) {
      doc.addPage();
    };

  }
  for (var t = 0; t < pie_array.length; t++) {

    var chartwidth = document.getElementById('piechartGender').offsetWidth;
    var chartheight = document.getElementById('piechartGender').offsetHeight;
    var ratio = Math.min(300 / chartwidth, 111 /  chartheight);

    chartheight = (chartheight*ratio);
    chartwidth = (chartwidth*ratio);

    console.log(chartwidth);
    doc.addImage(pie_array[t], 'JPEG', 10, 10, chartwidth, chartheight);
    if (!(i == pie_array.length)) {
      doc.addPage();
    };

  };
  doc.save('data - '+ parseInt(new Date().getTime()/1000, 10)+'.pdf');
};

function getChartPDF(chart){
  google.visualization.events.addOneTimeListener(chart, 'ready', function() {
    var imgUri = chart.getImageURI();
    global_array.push(imgUri);
  });
};

function getPiePDF(chart){
  google.visualization.events.addOneTimeListener(chart, 'ready', function() {
    var imgUri = chart.getImageURI();
    pie_array.push(imgUri);
  });
};

function checkGraphsForContent() {

  var chartDiv = '#chart_div';
  var charts = [];
  var chartCount = 6;

  for (var i = charts.length; chartCount > charts.length; i++) {
    charts.push(chartDiv + i);
  };

  for (var i = 0; i < charts.length; i++) {
    charts[i].toString();
  };

  for (var i = 0; i < charts.length; i++) {
    if(!( $(charts[i]).is(':empty') ) ) {
      console.log(charts[i] + ' is not empty');
    } else {
      console.log(charts[i] + ' is empty');
    }
  };
};

  // button click events 

  $(document).on('click', '.refreshMe', function(e){
    e.preventDefault();
    window.location.reload();
  });

  $(document).on('click', '.exportPDF', function(e){
    e.preventDefault();
    checkGraphsForContent();
    docDraw(global_array, pie_array);
  });

  // ===========================================ANALYTICS/CUSTOMERS===========================================

  $(document).on('click', '.customersTableButton', function(e){
    e.preventDefault();
    showCustomersTable();
    $('.customersTableButton')
    .addClass("hideCustomersTableButton")
    .removeClass("customersTableButton")
    .removeClass("btn-primary")
    .addClass("btn-success");

    $('.hideRepeatCustomersTableButton')
    .removeClass("hideRepeatCustomersTableButton")
    .addClass("repeatCustomersTableButton")
    .addClass("btn-primary")
    .removeClass("btn-success");

  });

  $(document).on('click', '.hideCustomersTableButton', function(e){
    e.preventDefault();
    showCustomersTable();

    $('.hideCustomersTableButton')
    .removeClass("hideCustomersTableButton")
    .addClass("customersTableButton")
    .addClass("btn-primary")
    .removeClass("btn-success");

    $('.hideRepeatCustomersTableButton')
    .removeClass("hideRepeatCustomersTableButton")
    .addClass("repeatCustomersTableButton")
    .addClass("btn-primary")
    .removeClass("btn-success");

  });

  $(document).on('click', '.repeatCustomersTableButton', function(e){
    e.preventDefault();
    showRepeatCustomersTable();
    $('.repeatCustomersTableButton')
    .addClass("hideRepeatCustomersTableButton")
    .removeClass("repeatCustomersTableButton")
    .removeClass("btn-primary")
    .addClass("btn-success");

    $('.hideCustomersTableButton')
    .removeClass("hideCustomersTableButton")
    .addClass("customersTableButton")
    .addClass("btn-primary")
    .removeClass("btn-success");

  });

  $(document).on('click', '.hideRepeatCustomersTableButton', function(e){
    e.preventDefault();
    hideRepeatCustomersTable();
    $('.hideRepeatCustomersTableButton')
    .removeClass("hideRepeatCustomersTableButton")
    .addClass("repeatCustomersTableButton")
    .addClass("btn-primary")
    .removeClass("btn-success");

    $('.hideCustomersTableButton')
    .removeClass("hideCustomersTableButton")
    .addClass("customersTableButton")
    .addClass("btn-primary")
    .removeClass("btn-success");

  });


  // append charts function

  hidePieCharts = function() {
    $('.hideMe').hide();
  };

  hideTitles = function(){
    $('.chartTitle').hide()
  };


  // gcharts function begins:


// ==========================================ANALYTICS UI TOGGLES==========================================

$(document).ready(function(){
  $('#button1').css('background-color', "#75cdb9");
  $('#button2, #button3, #button4, #button5').css('background-color', "#e4412d");
  $('.chart1').show(function() {
  //$('.chart2, .chart3, .chart4, .chart5').hide();
});
});

$('#button1').click(function() {
  $(this).css('background-color', "#75cdb9");
  $('#button2, #button3, #button4, #button5').css('background-color', "#e4412d");
  $('.chart1').show('slow', function() {
    $('.chart2, .chart3, .chart4, .chart5').hide('slow');
  });
});

$('#button2').click(function() {
  $(this).css('background-color', "#75cdb9");
  $('#button1, #button3, #button4, #button5').css('background-color', "#e4412d");
  $('.chart2').show('slow', function() {
    $('.chart1, .chart3, .chart4, .chart5').hide('slow');
  });
});

$('#button3').click(function() {
  $(this).css('background-color', "#75cdb9");
  $('#button1, #button2, #button4, #button5').css('background-color', "#e4412d");
  $('.chart3').show('slow', function() {
    $('.chart1, .chart2, .chart4, .chart5').hide('slow');
  });
});

$('#button4').click(function() {
  $(this).css('background-color', "#75cdb9");
  $('#button1, #button2, #button3, #button5').css('background-color', "#e4412d");
  $('.chart4').show('slow', function() {
    $('.chart1, .chart2, .chart3, .chart5').hide('slow');
  });
});

$('#button5').click(function() {
  $(this).css('background-color', "#75cdb9");
  $('#button1, #button2, #button3, #button4').css('background-color', "#e4412d");
  $('.chart5').show('slow', function() {
    $('.chart1, .chart2, .chart3, .chart4').hide('slow');
  });
});



// ===========================================ENTRY ACTIVITY===========================================


(function($) {
  Gcharts = {

    makeCall: function (uri) {
      var name = location.pathname.replace('/','')
      if (sessionStorage.getItem("pageData_"+name)) {
        return JSON.parse(sessionStorage.getItem("pageData_"+name));
      } else {
       var xhr = new XMLHttpRequest();
       xhr.open('GET', uri, false);
       xhr.onload = function(){
        document.getElementById('piechartGender').innerHTML = "<h2>Loading</h2>";
      }

      xhr.send(null);
      if (xhr.status == 200) {
        var today = new Date();

        var farr = JSON.parse(xhr.response);
        sessionStorage.setItem("pageData_"+name, JSON.stringify(farr));
        return JSON.parse(sessionStorage.getItem("pageData_"+name));
      }
    }
  },

      // draw a table of all our customers

      drawChart: function(data) {

        document.getElementById('piechartGender').innerHTML = '<div id="fountainG"><div id="fountainG_1" class="fountainG"></div><div id="fountainG_2" class="fountainG"></div><div id="fountainG_3" class="fountainG"></div><div id="fountainG_4" class="fountainG"></div><div id="fountainG_5" class="fountainG"></div><div id="fountainG_6" class="fountainG"></div><div id="fountainG_7" class="fountainG"></div><div id="fountainG_8" class="fountainG"></div></div>';

        var today = new Date();
        var farr = JSON.parse(data);
        console.log(farr);
        for (var i = farr.length - 1; i >= 0; i--) {



          if (farr[i].type === 'line' ) {
            document.getElementById('chart_div'+i).style.height='500px';


            var garr = '';
            var Adata = [];
            var arr = farr[i].data;
            var data = new google.visualization.DataTable();
            var count = 0;

            data.addColumn('string', 'day');
            data.addColumn('number', farr[i].title);

            for (var key in arr) {

              if (arr.hasOwnProperty(key)) {
                var dd = key;
                var mm = arr[key];
                garr = [dd,mm];
                Adata.push(garr);
              }

            }
            //console.log(window.innerWidth*0.90);
            data.addRows(Adata);
            var options = {
              title: farr[i].title,
              legend: { position: 'bottom' },
              'width': document.getElementById('analyticsRow').innerWidth,
              colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
              backgroundColor: 'rgba(0,0,0,0)',
              titleTextStyle: {
                fontName: 'lato',
                position: 'center',
              },
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'+i));
            getChartPDF(chart);
            chart.draw(data, options);


          };


          if ((farr[i].type === 'pie') && (farr[i].title === 'Gender') ){
            document.getElementById('piechartGender').style.height='400px';
            var arr = farr[i].data;
            console.log(arr['male']);
            if(arr['male'] != 0 || arr['female'] != 0 || arr['unconfirmedEntries'] != 0){
                     var data = google.visualization.arrayToDataTable([
             ['Gender', 'Number'],
             ['Male', arr['male']], ['Female', arr['female']], ['Unconfirmed Entries', arr['unconfirmedEntries']]
             ]);
            }else{
              var data = google.visualization.arrayToDataTable([
             ['Gender', 'Number'],
             ['No Analytics', 1]
             ]);
            //console.log('not here');
            }
            var options = {
              title: 'Gender Representation',
              legend: { position: 'bottom' },
              colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
              pieHole: 0.6,
              titleTextStyle: {
                fontName: 'lato',
                position: 'center',
              },
             backgroundColor: 'rgba(0,0,0,0)',
              pieSliceTextStyle: {color: 'black'}, 
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechartGender'));
            getPiePDF(chart);
            chart.draw(data, options);
          }

          if ((farr[i].type === 'pie') && (farr[i].title === 'Device') ){
            document.getElementById('piechartDevice').style.height='400px';
            var arr = farr[i].data;

            if(arr['iOS'] != 0 || arr['android'] != 0 || arr['unknown'] != 0){
              var data = google.visualization.arrayToDataTable([
             ['Device', 'Number'],
             ['iOS', arr['iOS']], ['Android', arr['android']], ['Other', arr['unknown']]
             ]);

            }else{
              var data = google.visualization.arrayToDataTable([
             ['Device', 'Number'],
             ['No Analytics',1]
             ]);
            }
            var options = {
              title: 'Device Representation',
              legend: { position: 'bottom' },
              colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
              pieHole: 0.6,
              titleTextStyle: {
                fontName: 'lato',
                position: 'center',
              },
              backgroundColor: 'rgba(0,0,0,0)',
              pieSliceTextStyle: {color: 'black'},
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechartDevice'));

            getPiePDF(chart);
            chart.draw(data, options);
          }
          if ((farr[i].type === 'column') && (farr[i].title === 'Unique Visits') ){
            var column_arr = farr[i].data;
           // console.log(column_arr);
            var column_garr = [];
            var column_Adata = [];
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'day');
            data.addColumn('number', farr[i].title);
            for (var ckey in column_arr) {
              if (column_arr.hasOwnProperty(ckey)) {
                column_garr = [ ckey, parseInt(column_arr[ckey])];
                column_Adata.push(column_garr);
              }
            }


            data.addRows(column_Adata);
            var options = {
              title: 'Daily Unique Vistors',
              hAxis: {title: 'Visitors', titleTextStyle: {color: 'red'}},
              legend: { position: 'bottom' },
              colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
              backgroundColor: 'rgba(0,0,0,0)',
              titleTextStyle: {
                fontName: 'lato',
                position: 'center',
              },
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'+i));
            getChartPDF(chart);
            chart.draw(data, options);

          }
        };




      },
   //index
   indexChart: function(data) {

    var farr = data;
    var genderArray = new Array;

    document.getElementById('piechart').style.height='250px';
    for (var i = farr.length - 1; i >= 0; i--) {

      var arr = 'Ages '+farr[i]['age_group'];
      var age = parseInt(farr[i]['number_of_users']);
      genderArray.unshift([arr,age]);

    };
    genderArray.unshift(['age-group','value']);
    console.log(genderArray);
    if(genderArray.length >= 2){
    var data = google.visualization.arrayToDataTable(
      genderArray
      );
    }else{
      console.log('else');
      var data = google.visualization.arrayToDataTable([['age-group','value'],['No Analytics',1]]
      );
    }
    var options = {
      title: 'Age Groups',
      legend: { position: 'bottom' },
      pieHole: 0.4,
      colors:['9dabd7','#83cdb8', '#ed8369', '#efc174' ],
      titleTextStyle: {
        fontName: 'lato',
        position: 'center',
      },
      backgroundColor: 'rgba(0,0,0,0)',
      pieSliceTextStyle: {color: 'black'},
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    getChartPDF(chart);
    chart.draw(data, options);

  },
  // ===========================================START/END DATE BAR===========================================

  rangeChart: function() {
    var year = document.getElementById('start_chart_year').value;
    var month = document.getElementById('start_chart_month').value;
    var day = document.getElementById('start_chart_day').value;
    var endYear = document.getElementById('end_chart_year').value;
    var endMonth = document.getElementById('end_chart_month').value;
    var endDay = document.getElementById('end_chart_day').value;
    var choice = document.getElementById('choice').value;
    var start = year+"-"+month+"-"+day;
    var end = endYear+"-"+endMonth+"-"+endDay;
    var xhr = new XMLHttpRequest();
    if(choice == 'entries'){
      xhr.open('GET', '/entryActivity/'+start+"/"+end, false);
    }
    if(choice == 'accepted'){
      xhr.open('GET', '/acceptedActivity/'+start+"/"+end, false);
    }
    if(choice == 'completed'){
      xhr.open('GET', '/completedActivity/'+start+"/"+end, false);
    }
    if(choice == 'confirmed'){
      xhr.open('GET', '/confirmedActivity/'+start+"/"+end, false);
    }
    xhr.onload = function(){
      document.getElementById('piechartGender').innerHTML = "<h2>Loading</h2>";
    }

    xhr.send(null);
    if (xhr.status == 200) {
      var today = new Date();

      // var sTime = '';
      // var garr = '';
      // var Adata = [];
      var farr = JSON.parse(xhr.response);
      console.log(farr);
      for (var i = farr.length - 1; i >= 0; i--) {
        if (farr[i].type === 'line') {
          var garr = '';
          var Adata = [];
          var arr = farr[i].data;
          var data = new google.visualization.DataTable();
          var count = 0;
          data.addColumn('string', 'day');


          if(farr[i].which == 'dwell'){
            var whichArr = farr[i].difference;
            var data2 = farr[i].data2;
            data.addColumn('number', farr[i].title);
            document.getElementById('chart_div'+i).style.height='500px';

            for (var key in arr) {

              if (arr.hasOwnProperty(key)) {
                var dd = key;
                var mm = arr[key];
                var count = whichArr[key];
                garr = [dd,(mm / count)];
                console.log(mm);
                Adata.push(garr);

              }
            }
          }else if(farr[i].which == 'plots'){
            var whichArr = farr[i].difference;
            var data2 = farr[i].data2;
            document.getElementById('chart_div'+i).style.height='500px';
            
            data.addColumn('number', farr[i].subtitle);
            data.addColumn('number', farr[i].subtitle2);
            for (var key in arr) {

              if (arr.hasOwnProperty(key)) {
                var dd = key;
                var mm = arr[key];
                var count = data2[key];
                garr = [dd,mm,count];

                Adata.push(garr);

              }
            }
          }else{
            document.getElementById('chart_div'+i).style.height='500px';

            data.addColumn('number', farr[i].title);
            for (var key in arr) {

              if (arr.hasOwnProperty(key)) {
                var dd = key;
                var mm = arr[key];
                garr = [dd,mm];
                Adata.push(garr);
              }
            }
          }
          data.addRows(Adata);
          var options = {
            title: farr[i].title,
            colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
           backgroundColor: 'rgba(0,0,0,0)',
            titleTextStyle: {
              fontName: 'lato',
              position: 'center',
            },

          };//end if line


          var chart = new google.visualization.LineChart(document.getElementById('chart_div'+i));
          getChartPDF(chart);
          chart.draw(data, options);


        };


        if ((farr[i].type === 'pie') && (farr[i].title === 'Gender') ){

          var arr = farr[i].data;

          var data = google.visualization.arrayToDataTable([
           ['Gender', 'Number'],
           ['Male', arr['male']], ['Female', arr['female']]
           ]);

          var options = {
            title: 'Gender Representation',
            legend: { position: 'bottom' },
            colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
            pieHole: 0.6,
            titleTextStyle: {
              fontName: 'lato',
              position: 'center',
            },
            backgroundColor: 'rgba(0,0,0,0)',
            pieSliceTextStyle: {color: 'black'},
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechartGender'));
          getPiePDF(chart);
          chart.draw(data, options);
        }


        if ((farr[i].type === 'pie') && (farr[i].title === 'Device') ){

          var arr = farr[i].data;

          var data = google.visualization.arrayToDataTable([
           ['Device', 'Number'],
           ['iOS', arr['iOS']], ['Android', arr['android']], ['Other', arr['unknown']]
           ]);

          var options = {
            title: 'Device Representation',
            legend: { position: 'bottom' },
            colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
            pieHole: 0.6,
            titleTextStyle: {
              fontName: 'lato',
              position: 'center',
            },
            backgroundColor: 'rgba(0,0,0,0)',
            pieSliceTextStyle: {color: 'black'}, 
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechartDevice'));
          getPiePDF(chart);
          chart.draw(data, options);
        }

        if ((farr[i].type === 'column') && (farr[i].title === 'Unique Visits') ){
          var column_arr = farr[i].data;
          var column_garr = [];
          var column_Adata = [];
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'day');
          data.addColumn('number', farr[i].title);
          for (var ckey in column_arr) {
            if (column_arr.hasOwnProperty(ckey)) {
              column_garr = [ ckey, parseInt(column_arr[ckey])];
              column_Adata.push(column_garr);
            }
          }

          data.addRows(column_Adata);
          var options = {
            title: 'Daily Unique Vistors',
            hAxis: {title: 'Visitors', titleTextStyle: {color: 'red'}},
            legend: { position: 'bottom' },
            colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
           backgroundColor: 'rgba(0,0,0,0)',
            titleTextStyle: {
              fontName: 'lato',
              position: 'center',
            },
          };

          var chart = new google.visualization.BarChart(document.getElementById('chart_div2'));
          getChartPDF(chart);
          chart.draw(data, options);
        }
      };//end for of all the charts coming in

    }

  },

  // ===========================================ACCEPTED ACTIVITY===========================================

  acceptedChart : function(data) {


    var today = new Date();

    var farr = JSON.parse(data);

    for (var i = farr.length - 1; i >= 0; i--) {
     if ((farr[i].type === 'pie') && (farr[i].title === 'Gender') ){
       document.getElementById('piechartGender').style.height='400px';
       var arr = farr[i].data;

       if(arr['male'] != 0 || arr['female'] != 0 || arr['unconfirmedEntries'] != 0){
                     var data = google.visualization.arrayToDataTable([
             ['Gender', 'Number'],
             ['Male', arr['male']], ['Female', arr['female']], ['Unconfirmed Entries', arr['unconfirmedEntries']]
             ]);
            }else{
              var data = google.visualization.arrayToDataTable([
             ['Gender', 'Number'],
             ['No Analytics', 1]
             ]);
            //console.log('not here');
            }
       var options = {
        title: 'Gender Representation',
        legend: { position: 'bottom' },
        colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
        pieHole: 0.6,
        titleTextStyle: {
          fontName: 'lato',
          position: 'center',
        },
        backgroundColor: 'rgba(0,0,0,0)',
        pieSliceTextStyle: {color: 'black'},  
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechartGender'));
      getPiePDF(chart);
      chart.draw(data, options);
    }


    if ((farr[i].type === 'pie') && (farr[i].title === 'Device') ){
     document.getElementById('piechartDevice').style.height='400px';
     var arr = farr[i].data;

     if(arr['iOS'] != 0 || arr['android'] != 0 || arr['unknown'] != 0){
              var data = google.visualization.arrayToDataTable([
             ['Device', 'Number'],
             ['iOS', arr['iOS']], ['Android', arr['android']], ['Other', arr['unknown']]
             ]);

            }else{
              var data = google.visualization.arrayToDataTable([
             ['Device', 'Number'],
             ['No Analytics',1]
             ]);
            }

     var options = {
      title: 'Device Representation',
      legend: { position: 'bottom' },
      colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
      pieHole: 0.6,
      titleTextStyle: {
        fontName: 'lato',
        position: 'center',
      },
     backgroundColor: 'rgba(0,0,0,0)',
      pieSliceTextStyle: {color: 'black'}, 
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechartDevice'));
    getPiePDF(chart);
    chart.draw(data, options);
  }


  if (farr[i].type === 'line') {
    var garr = '';
    var Adata = [];
    document.getElementById('chart_div'+i).style.height='500px';
    var arr = farr[i].data;
    var data = new google.visualization.DataTable();
    var count = 0;
    data.addColumn('string', 'day');
    data.addColumn('number', farr[i].title);

    for (var key in arr) {

      if (arr.hasOwnProperty(key)) {
        var dd = key;
        var mm = arr[key];
        garr = [dd,mm];
        Adata.push(garr);
      }


    }
    console.log(farr);
    data.addRows(Adata);
    var options = {
      title: farr[i].title,
      legend: { position: 'bottom' },
      colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
      backgroundColor: 'rgba(0,0,0,0)',
      titleTextStyle: {
        fontName: 'lato',
        position: 'center',
      }, 
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'+i));
    getChartPDF(chart);
    chart.draw(data, options);
  };



};



},

// ===========================================CONFIRMED ACTIVITY===========================================

confirmedChart : function(data) {


  var today = new Date();

  var farr = JSON.parse(data);

  for (var i = farr.length - 1; i >= 0; i--) {
   if ((farr[i].type === 'pie') && (farr[i].title === 'Gender') ){
     document.getElementById('piechartGender').style.height='400px';
     var arr = farr[i].data;

     if(arr['male'] != 0 || arr['female'] != 0 || arr['unconfirmedEntries'] != 0){
                     var data = google.visualization.arrayToDataTable([
             ['Gender', 'Number'],
             ['Male', arr['male']], ['Female', arr['female']], ['Unconfirmed Entries', arr['unconfirmedEntries']]
             ]);
            }else{
              var data = google.visualization.arrayToDataTable([
             ['Gender', 'Number'],
             ['No Analytics', 1]
             ]);
            //console.log('not here');
            }

     var options = {
      title: 'Gender Representation',
      legend: { position: 'bottom' },
      colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
      pieHole: 0.6,
      titleTextStyle: {
        fontName: 'lato',
        position: 'center',
      },
     backgroundColor: 'rgba(0,0,0,0)',
      pieSliceTextStyle: {color: 'black'}, 
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechartGender'));
    getPiePDF(chart);
    chart.draw(data, options);
  }


  if ((farr[i].type === 'pie') && (farr[i].title === 'Device') ){
   document.getElementById('piechartDevice').style.height='400px';
   var arr = farr[i].data;

   if(arr['iOS'] != 0 || arr['android'] != 0 || arr['unknown'] != 0){
              var data = google.visualization.arrayToDataTable([
             ['Device', 'Number'],
             ['iOS', arr['iOS']], ['Android', arr['android']], ['Other', arr['unknown']]
             ]);

            }else{
              var data = google.visualization.arrayToDataTable([
             ['Device', 'Number'],
             ['No Analytics',1]
             ]);
            }

   var options = {
    title: 'Device Representation',
    legend: { position: 'bottom' },
    colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
    pieHole: 0.6,
    titleTextStyle: {
      fontName: 'lato',
      position: 'center',
    },
    backgroundColor: 'rgba(0,0,0,0)',
    pieSliceTextStyle: {color: 'black'}, 
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechartDevice'));
    //chart.draw(data, options);

    getPiePDF(chart);
    chart.draw(data,options);
  }


  if (farr[i].type === 'line') {
    var garr = '';
    var Adata = [];
    document.getElementById('chart_div'+i).style.height='500px';
    var arr = farr[i].data;
    var data = new google.visualization.DataTable();
    var count = 0;
    data.addColumn('string', 'day');
    data.addColumn('number', farr[i].title);

    for (var key in arr) {

      if (arr.hasOwnProperty(key)) {
        var dd = key;
        var mm = arr[key];
        garr = [dd,mm];
        Adata.push(garr);
      }


    }
    console.log(farr);
    data.addRows(Adata);
    var options = {
      title: farr[i].title,
      legend: { position: 'bottom' },
      colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
      backgroundColor: 'rgba(0,0,0,0)',
      titleTextStyle: {
        fontName: 'lato',
        position: 'center',
      },
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'+i));

    getChartPDF(chart);
    chart.draw(data, options);
  };



};



},


// ===========================================PHONE ACTIVITY===========================================
//phone charts entries and exit queries and calls to ajax
phoneChart : function(data) {

 var farr = JSON.parse(data);

 for (var i = farr.length - 1; i >= 0; i--) {
   if ((farr[i].type === 'pie') ){

    var arr = farr[i].data;

    var data = google.visualization.arrayToDataTable([
     ['Gender', 'Number'],
     ['Male', arr['male']], ['Female', arr['female']],['Other', arr['other']]
     ]);

    var options = {
      title: farr[i].title,
      legend: { position: 'bottom' },
      colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
      pieHole: 0.6,
      titleTextStyle: {
        fontName: 'lato',
        position: 'center',
      },
      backgroundColor: 'rgba(0,0,0,0)',
      pieSliceTextStyle: {color: 'black'}, 
    };

    var chart = new google.visualization.PieChart(document.getElementById('phone'+i));
    getPiePDF(chart);
    chart.draw(data, options);
  }

};



},

// ===========================================COMPLETED ACTIVITY===========================================
//completed survey ajax call
completedChart: function(data){


 var farr = JSON.parse(data);
 var len = farr.length;

 for (var i = farr.length - 1; i >= 0; i--) {
   if ((farr[i].type === 'pie') && (farr[i].title === 'Gender') ){
     document.getElementById('piechartGender').style.height='400px';
     var arr = farr[i].data;

     if(arr['male'] != 0 || arr['female'] != 0 || arr['unconfirmedEntries'] != 0){
                     var data = google.visualization.arrayToDataTable([
             ['Gender', 'Number'],
             ['Male', arr['male']], ['Female', arr['female']], ['Unconfirmed Entries', arr['unconfirmedEntries']]
             ]);
            }else{
              var data = google.visualization.arrayToDataTable([
             ['Gender', 'Number'],
             ['No Analytics', 1]
             ]);
            //console.log('not here');
            }

     var options = {
      title: 'Gender Representation',
      legend: { position: 'bottom' },
      colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
      pieHole: 0.6,
      titleTextStyle: {
        fontName: 'lato',
        position: 'center',
      },
     backgroundColor: 'rgba(0,0,0,0)',
      pieSliceTextStyle: {color: 'black'},  
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechartGender'));
    getPiePDF(chart);
    chart.draw(data, options);
  }


  if ((farr[i].type === 'pie') && (farr[i].title === 'Device') ){
   document.getElementById('piechartDevice').style.height='400px';
   var arr = farr[i].data;

   if(arr['iOS'] != 0 || arr['android'] != 0 || arr['unknown'] != 0){
              var data = google.visualization.arrayToDataTable([
             ['Device', 'Number'],
             ['iOS', arr['iOS']], ['Android', arr['android']], ['Other', arr['unknown']]
             ]);

            }else{
              var data = google.visualization.arrayToDataTable([
             ['Device', 'Number'],
             ['No Analytics',1]
             ]);
            }


   var options = {
    title: 'Device Representation',
    'width': document.getElementById('analyticsRow').innerWidth,
    legend: { position: 'bottom' },
    colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
    pieHole: 0.6,
    titleTextStyle: {
      fontName: 'lato',
      position: 'center',
    },
   backgroundColor: 'rgba(0,0,0,0)',
    pieSliceTextStyle: {color: 'black'},  
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechartDevice'));
  getPiePDF(chart);
  chart.draw(data, options);
}
if (farr[i].type === 'line') {
  var garr = '';
  var Adata = [];

  var arr = farr[i].data;
  var whichArr = farr[i].difference;
  var data2 = farr[i].data2;
  console.log(farr[i].which);
  var data = new google.visualization.DataTable();
  var count = 0;
  data.addColumn('string', 'day');


  if(farr[i].which == 'dwell'){
    data.addColumn('number', farr[i].title);
    document.getElementById('chart_div'+i).style.height='500px';
    for (var key in arr) {

      if (arr.hasOwnProperty(key)) {
        var dd = key;
        var mm = arr[key];
        var count = whichArr[key];
        garr = [dd,(mm / count)];
        console.log(mm);
        Adata.push(garr);

      }
    }
  }else if(farr[i].which == 'plots'){
    document.getElementById('chart_div'+i).style.height='500px';
    data.addColumn('number', farr[i].subtitle);
    data.addColumn('number', farr[i].subtitle2);
    for (var key in arr) {

      if (arr.hasOwnProperty(key)) {
        var dd = key;
        var mm = arr[key];
        var count = data2[key];
        garr = [dd,mm,count];

        Adata.push(garr);

      }
    }
  }else{
    document.getElementById('chart_div'+i).style.height='500px';
    data.addColumn('number', farr[i].title);

    for (var key in arr) {

      if (arr.hasOwnProperty(key)) {
        var dd = key;
        var mm = arr[key];
        garr = [dd,mm];
        Adata.push(garr);
      }


    }
  }
  data.addRows(Adata);
  var options = {
    title: farr[i].title,
    'width': document.getElementById('analyticsRow').innerWidth,
    legend: { position: 'bottom' },
    colors:['#83cdb8', '#ed8369', '#efc174', '9dabd7'],
  backgroundColor: 'rgba(0,0,0,0)',
    titleTextStyle: {
      fontName: 'lato',
      position: 'center',
    },
  };
  var chart = new google.visualization.LineChart(document.getElementById('chart_div'+i));
  getChartPDF(chart);
  chart.draw(data, options);
}

}


}

}

})();

// hover stuff, why not?

$( ".glyphLink" ).hover(
  function() {
    $( this ).css("color", 'red');
    $( this ).parent().css("border-color", 'red');
  }, function() {
    $( this ).css("color", 'rgb(128 ,128, 128)');
    $( this ).parent().css("border-color", '#e6e6e6');
  }
);
 

});

google.load("visualization", "1", {packages:["corechart"]});

