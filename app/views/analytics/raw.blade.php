<!doctype html>
<html lang="en" ng-app="raw">
<head>
  <title>RAW</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="Keywords" content="RAW,visualization,data,design,spreadsheet,interface,vector graphics,SVG,PNG,JSON">
  <meta name="Description" content="RAW, missing link between spreadsheets and vector graphics, by DensityDesign, Giorgio Caviglia, Matteo Azzi, Michele Mauri, Giorgio Uboldi">


  <script>

    document.write('<base href="' + document.location + '" />');
    console.log(document.location);
  </script>

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic|Lato:400,700,900|Open+Sans:400,300,600,700,800|Roboto+Slab:400,300,100,700|Roboto:400,100,300,500,700,900&subset=latin,latin-ext"/>
  <link rel="stylesheet" href="/raw-master/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="/raw-master/bower_components/angular-bootstrap-colorpicker/css/colorpicker.css">
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/raw-master/bower_components/codemirror/lib/codemirror.css">  
  <link rel="stylesheet" href="/raw-master/css/raw.css"/>
  <link rel="icon" href="/raw-master/favicon.ico?v=2" type="image/x-icon">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

</head>
<?php
  $user = Auth::user();
?>
<div class="innerContent" id="mainInnerContent">
<div class="container">
<div class="row">

  <nav class="navbar" role="navigation" id="raw-nav">
    <div class="container">

     <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#raw-navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/#">RAW</a>
      </div>

      <div class="collapse navbar-collapse navbar-right" id="raw-navbar">
      </div>


    </div>
  </nav>
  </div>
  <div ng-view class="wrap"></div>

</div>
</div>
</div>
  
  
  <!-- jquery -->
  <script type="text/javascript" src="/raw-master/bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/jquery-ui/ui/minified/jquery-ui.min.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js"></script>
  <!-- bootstrap -->
  <script type="text/javascript" src="/raw-master/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
  <!-- d3 -->
  <script type="text/javascript" src="/raw-master/bower_components/d3/d3.min.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/d3-plugins/sankey/sankey.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/d3-plugins/hexbin/hexbin.js"></script>
  <!-- codemirror -->
  <script type="text/javascript" src="/raw-master/bower_components/codemirror/lib/codemirror.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/codemirror/addon/display/placeholder.js"></script>
  <!-- canvastoblob -->
  <script type="text/javascript" src="/raw-master/bower_components/canvas-toBlob.js/canvas-toBlob.js"></script>
  <!-- filesaver -->
  <script type="text/javascript" src="/raw-master/bower_components/FileSaver/FileSaver.js"></script>
  <!-- zeroclipboard -->
  <script type="text/javascript" src="/raw-master/bower_components/zeroclipboard/ZeroClipboard.min.js"></script>

  <!-- raw -->
  <script type="text/javascript" src="/raw-master/lib/raw.js"></script>

 

  <!-- charts -->
  <script src="/raw-master/charts/treemap.js"></script>
  <script src="/raw-master/charts/streamgraph.js"></script>
  <script src="/raw-master/charts/scatterPlot.js"></script>
  <script src="/raw-master/charts/packing.js"></script>
  <script src="/raw-master/charts/clusterDendrogram.js"></script>
  <script src="/raw-master/charts/voronoi.js"></script>
  <script src="/raw-master/charts/delaunay.js"></script>
  <script src="/raw-master/charts/alluvial.js"></script>
  <script src="/raw-master/charts/clusterForce.js"></script>
  <script src="/raw-master/charts/convexHull.js"></script>
  <script src="/raw-master/charts/hexagonalBinning.js"></script>
  <script src="/raw-master/charts/reingoldTilford.js"></script>
  <script src="/raw-master/charts/parallelCoordinates.js"></script>
  <script src="/raw-master/charts/circularDendrogram.js"></script>
  <script src="/raw-master/charts/smallMultiplesArea.js"></script>
  <script src="/raw-master/charts/bumpChart.js"></script>
  <script src="/raw-master/charts/custom1.js"></script>

  <!-- angular -->
  <script type="text/javascript" src="/raw-master/bower_components/angular/angular.min.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/angular-route/angular-route.min.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/angular-animate/angular-animate.min.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/angular-sanitize/angular-sanitize.min.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/angular-strap/dist/angular-strap.min.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/angular-ui/build/angular-ui.min.js"></script>
  <script type="text/javascript" src="/raw-master/bower_components/angular-bootstrap-colorpicker/js/bootstrap-colorpicker-module.js"></script>

  <script src="/raw-master/js/app.js"></script>
  <script src="/raw-master/js/services.js"></script>
 <!-- <script src="http://rack.apengage.io/analytics/js/controllers.js"></script> -->
 <script>
 'use strict';
 var cID = "<?php echo($user->companyID);?>";//$("#companyIDInput").val();

/* Controllers Script embedded here*/

angular.module('raw.controllers', [])

  .controller('RawCtrl', function ($scope, dataService) {
    console.log(cID);
    $scope.samples = [
      { title : 'Beacon Interactions (Raw)', url : 'http://rack.apengage.io/analytics/csvConversion/2/55b0c82fbff661c11920bd47' },
     
    ]

    $scope.$watch('sample', function (sample){
      if (!sample) return;
      dataService.loadSample(sample.url).then(
        function(data){
          $scope.text = data;
        }, 
        function(error){
          $scope.error = error;
        }
      );
    });

    // init
    $scope.raw = raw;
    $scope.data = [];
    $scope.metadata = [];
    $scope.error = false;
    $scope.loading = true;

    $scope.categories = ['Correlations', 'Distributions', 'Time Series', 'Hierarchies', 'Others', 'Custom'];

    $scope.parse = function(text){

      if ($scope.model) $scope.model.clear();

      $scope.data = [];
      $scope.metadata = [];
      $scope.error = false;
      $scope.$apply();

      try {
        var parser = raw.parser();
        $scope.data = parser(text);
        $scope.metadata = parser.metadata(text);
        $scope.error = false;
      } catch(e){
        $scope.data = [];
        $scope.metadata = [];
        $scope.error = e.name == "ParseError" ? +e.message : false;
      }
      if (!$scope.data.length && $scope.model) $scope.model.clear();
      $scope.loading = false;
    }

    $scope.delayParse = dataService.debounce($scope.parse, 500, false);

    $scope.$watch("text", function (text){
      $scope.loading = true;
      $scope.delayParse(text);
    });

    $scope.charts = raw.charts.values().sort(function (a,b){ return a.title() < b.title() ? -1 : a.title() > b.title() ? 1 : 0; });
    $scope.chart = $scope.charts[0];
    $scope.model = $scope.chart ? $scope.chart.model() : null;

    $scope.$watch('error', function (error){
      if (!$('.CodeMirror')[0]) return;
      var cm = $('.CodeMirror')[0].CodeMirror;
      if (!error) {
        cm.removeLineClass($scope.lastError,'wrap','line-error');
        return;
      }
      cm.addLineClass(error, 'wrap', 'line-error');
      cm.scrollIntoView(error);
      $scope.lastError = error;

    })

    $('body').mousedown(function (e,ui){
      if ($(e.target).hasClass("dimension-info-toggle")) return;
      $('.dimensions-wrapper').each(function (e){
        angular.element(this).scope().open = false;
        angular.element(this).scope().$apply();
      })
    })

    $scope.codeMirrorOptions = {
      lineNumbers : true,
      lineWrapping : true,
      placeholder : 'Paste your text or drop a file here. No data on hand? Try one of our sample datasets!'
    }

    $scope.selectChart = function(chart){
      if (chart == $scope.chart) return;
      $scope.model.clear();
      $scope.chart = chart;
      $scope.model = $scope.chart.model();
    }

    function refreshScroll(){
      $('[data-spy="scroll"]').each(function () {
        $(this).scrollspy('refresh');
      });
    }

    $(window).scroll(function(){

      // check for mobile
      if ($(window).width() < 760 || $('#mapping').height() < 300) return;

      var scrollTop = $(window).scrollTop() + 0,
          mappingTop = $('#mapping').offset().top + 10,
          mappingHeight = $('#mapping').height(),
          isBetween = scrollTop > mappingTop + 50 && scrollTop <= mappingTop + mappingHeight - $(".sticky").height() - 20,
          isOver = scrollTop > mappingTop + mappingHeight - $(".sticky").height() - 20,
          mappingWidth = mappingWidth ? mappingWidth : $('.col-lg-9').width();
     
      if (mappingHeight-$('.dimensions-list').height() > 90) return;
      //console.log(mappingHeight-$('.dimensions-list').height())
      if (isBetween) {
        $(".sticky")
          .css("position","fixed")
          .css("width", mappingWidth+"px")
          .css("top","20px")
      } 

     if(isOver) {
        $(".sticky")
          .css("position","fixed")
          .css("width", mappingWidth+"px")
          .css("top", (mappingHeight - $(".sticky").height() + 0 - scrollTop+mappingTop) + "px");
          return;
      }

      if (isBetween) return;

      $(".sticky")
        .css("position","relative")
        .css("top","")
        .css("width", "");

    })

    $(document).ready(refreshScroll);


  })
 </script>
  <script src="/raw-master/js/filters.js"></script>
  <script src="/raw-master/js/directives.js"></script>

  <!-- google analytics -->
  <script src="/raw-master/js/analytics.js"></script>

    <!--keen-->
  <script type="text/javascript">
  !function(a,b){a("Keen","https://d26b395fwzu5fz.cloudfront.net/3.2.6/keen.min.js",b)}(function(a,b,c){var d,e,f;c["_"+a]={},c[a]=function(b){c["_"+a].clients=c["_"+a].clients||{},c["_"+a].clients[b.projectId]=this,this._config=b},c[a].ready=function(b){c["_"+a].ready=c["_"+a].ready||[],c["_"+a].ready.push(b)},d=["addEvent","setGlobalProperties","trackExternalLink","on"];for(var g=0;g<d.length;g++){var h=d[g],i=function(a){return function(){return this["_"+a]=this["_"+a]||[],this["_"+a].push(arguments),this}};c[a].prototype[h]=i(h)}e=document.createElement("script"),e.async=!0,e.src=b,f=document.getElementsByTagName("script")[0],f.parentNode.insertBefore(e,f)},this);
</script>

  <script>
     $(document).ready(function(){
      var companyID = "<?php echo($user->companyID);?>";
       setTimeout(function(){ 
           $('#companyIDInput').val(companyID);
       }, 400);  

       $('#cannedList li').click(function(){
          var canVal = $(this).attr('value');
          makeCSV(canVal,companyID);
       });

    });
  </script>
  
   <!--zero clip-->
  <script src="/zeroclipboard-master/dist/ZeroClipboard.js"></script>
  <script src="/js/rawCanned.js"></script>
</body>
</html>

