<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reports</title>
@include("header2")
<?php
  $user = Auth::user();
 
  ?> 
  @include("guestNav2")
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
<script src="/js/keenLayouts.js"></script>
<script src="/js/keenClass.js"></script>
<script>
 $(document).ready( function() {
////////////////////////////////////////////////////////////////////////////////
// Global Variables

var viz, workbook, activeSheet, sheetChoice;
var keenQueryID = "<?php echo $company->_id;?>";
////////////////////////////////////////////////////////////////////////////////
// 1 - Create a View
   
setTimeout(function(){ 
  keenQueryReports(keenQueryID);
}, 2000);

});
</script>
<div class="innerContent" id="mainInnerContent">
<div class="container">
  <div class="row">

    <div class="col-md-12">
      
      <h1>Reports</h1>
      <h4> <?php if(isset($company)){echo $company->name;}?></h4>
    
  <!-- // Form Wizard / Arrow navigation & Progress bar END -->
  <!--  <div id="tableauViz"> --> 
    </div>

    <div id="rawViz">
      <div id="reportPiechartHolder" style="width:40%; min-height:200px;height:30%;margin:auto;"></div>
    <!--<script src="/raw-master/charts/chart.js"></script>-->
    </div>
    </div>

</div>
</div>
</div>
