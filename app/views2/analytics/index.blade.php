@include("header")
<?php
  $user = Auth::user();
  if($user->user_access == "Admin"){
  ?>  @include("nav")<?php
  }else{
  ?>  @include("guestNav")<?php
  }
?>
<style>
.item {
  width:20%;
  margin-top:4%;
  height: auto;
  float:left;
  border-radius:5px;
  border: 1px solid #dedede;
  background: #fff;
  min-width:300px;
}
.item-2 {
  width:50%;
  height: auto;
  float:left;
  border-radius:5px;
  border: 1px solid #dedede;
  background: #fff;
  margin-top:4%;
  min-width:500px;
}
.masonImg{
  width:50px;
  margin-right:20px;
}
.itemContainer{
  padding:20px;
  min-height:130px;
}
.itemContainer-2{
  padding:20px;
  min-height:350px;
  /*overflow-x:scroll;*/

}
.itemContainer ul{
  float:left;

}
.itemContainer ul li{
  list-style:none;
  color:#fff;
  font-size:13px;
}
.itemContainer a{
  color:#fff;
}
.itemFooter{
  background:#fff;
  padding:0px 20px;
  height:20px;
  border-radius:0px 0px 5px 5px;
}
.itemFooter a{
  float:right;
  padding:5px 0px;
}
.item:first-child .itemContainer{
background:#337ab7;
border-radius:5px 5px 0px 0px;
}
.item:nth-last-child(4) .itemContainer{
background:#5cb85c;
border-radius:5px 5px 0px 0px;
}
.item:nth-last-child(6) .itemContainer{
background:#f0ad4e;
border-radius:5px 5px 0px 0px;
}
.item:nth-last-child(5) .itemContainer{
background:#d9534f;
border-radius:5px 5px 0px 0px;
}
.vizPre{
  min-width:300px;
}
#tableauViz{
  width:100%;
  height:700px;
  margin-bottom:4%;
  background:#fff;
  margin-top:4%;
}
</style>
 <!--<script>
  $(document).ready( function() {
  var viz, workbook, activeSheet, sheetChoice, handleID;
  var company = "<?php if(isset($company)){echo $company->name;}?>";
  company = company.replace(/\s+/g, '');
  var container = document.querySelector('#masonryContainer');
  var msnry = new Masonry( container, {
    columnWidth: 100
  });
    $('.analyticsButton').click(function(){
    $('#analyticsModal').modal('show');
  });
  
      function initializeViz() {

      for(var i = 1; i <= 3; i++){

      var placeholderDiv = document.getElementById("tableauViz"+i);
      var placeholder = document.getElementById("viz"+i);
      var url = "https://public.tableausoftware.com/views/streetToAnalytics/"+company+i;
      var options = {
        width: 500,
        height: 500,
        hideTabs: true,
        hideToolbar: true,
        onFirstInteractive: function () {
          workbook = viz.getWorkbook();
          activeSheet = workbook.getActiveSheet();
        }
      };

      viz = new tableauSoftware.Viz(placeholderDiv, url, options);
    
    } 
  }
  initializeViz();

  
  //rehandle init


});



</script>-->

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
  var url = "http://public.tableausoftware.com/views/streetToAnalytics/"+company+"Dashboard";
  var options = {
    width: "100%",
    height: "700px",
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
  var url = "http://public.tableausoftware.com/views/"+book+"/"+sheet;
  var options = {
    width: "100%",
    height: "700px",
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
<div class="innerContent">

  <div class="row">
    <div class="col-md-12">
      
      <h1>Analytics -  <?php if(isset($company)){echo $company->name;}?></h1>
    
  <!-- // Form Wizard / Arrow navigation & Progress bar END -->
    <div id="tableauViz">
    </div>
</div>
</div>
</div>
@include('footer')