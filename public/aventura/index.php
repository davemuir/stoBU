<?php

?>
<script src="//code.jquery.com/jquery-1.11.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src='https://public.tableausoftware.com/javascripts/api/tableau_v8.js'></script>
<script>
 $(document).ready( function() {
////////////////////////////////////////////////////////////////////////////////
// Global Variables

var viz, workbook, activeSheet, sheetChoice;

////////////////////////////////////////////////////////////////////////////////
// 1 - Create a View
   

function initializeViz() {
  var company = "<?php if(isset($company)){echo $company->name;}?>";
  company = company.replace(/\s+/g, '');
  var placeholderDiv = document.getElementById("tableauViz");
    var url = "http://public.tableausoftware.com/views/AventuraAnalytics/FootTraficandWalkbys";

  var options = {
    width: "100%",
    height: "100%",
    hideTabs: false,
    hideToolbar: false,
    onFirstInteractive: function () {
      workbook = viz.getWorkbook();
      activeSheet = workbook.getActiveSheet();
    }
  };
  
  viz = new tableauSoftware.Viz(placeholderDiv, url, options);
}
initializeViz();

function initializeBook(book,sheet) {
  var placeholderDiv = document.getElementById("tableauViz");
  book = book.replace(/\s+/g, '');
  sheet = sheet.replace(/\s+/g, ''); sheet = sheet.replace(/\./g, '_');
  book = 'AventuraAnalytics';
  sheet = 'FootTraficandWalkbys';
  var url = "http://public.tableausoftware.com/views/"+book+"/"+sheet;
  var options = {
    width: "100%",
    height: "100%",
    hideTabs: true,
    hideToolbar: true,
    onFirstInteractive: function () {
      workbook = viz.getWorkbook();
      activeSheet = workbook.getActiveSheet();

    }
  };
  viz = new tableauSoftware.Viz(placeholderDiv, url, options);
  //$('#tableauButtons').show();
  //$('#visualConnect').hide();
  //$('#sheetList').empty();
}
});
</script>
<div class="innerContent" id="mainInnerContent">
<div class="container">
  <div class="row">

    <div class="col-md-12">
      
    
  <!-- // Form Wizard / Arrow navigation & Progress bar END -->
    <div id="tableauViz">
    </div>
   </div>
</div>
</div>
</div>