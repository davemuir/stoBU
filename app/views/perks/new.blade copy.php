@include("header2")
<?php
  $user = Auth::user();

  ?>  
  @include("guestNav2")
<?php
$media = Media::where('status','=',1)->where('company','=',$user->companyID)->get();
?>
<style>
.optionButton{
  float:left !important;
  clear:both !important;
}
.whitePanel{
  margin:10px;
  background:#fff;
  padding:8px;
  box-shadow: 1px 1px 1px 1px #dedede;
  min-height:516px;
}

</style>
<!-- =========================================Create New Beam Section Begins Here============================================ -->
<div id="mainInnerContent" class="innerContent">
   
  <div class="container"> 
      <div class="row">
             {{ Form::open([
                "route"        => "store new perk",
                "autocomplete" => "off",
                "enctype" =>"multipart/form-data",
                "id" => "beamForm"
            ]) }}
        <div class="col-md-12">
      
          <h1>Content</h1>
          <h4>New Beam</h4>
        </div>
        <div class="col-md-8">
           
             
          
             <div class="whitePanel">
        
      <div class="row bColor beamRow">
          
          <div class="col-md-12">
             
              <div class="item">
            
               {{ Form::label("beamtitle", "Beam Title") }}
                 {{ Form::text("label", Input::get("label"), [
                    "placeholder" => "Title (max characters 40)","class" =>"form-control",'id'=>'beamLabel'
                ]) }}
                    {{ Form::label("beamtitle", "Beam Heading") }}
                {{ Form::text("beamtitle", Input::get("beamTitle"), [
                    "placeholder" => "Heading ","class" =>"form-control",'id'=>'beamTitle'
                ]) }}
                  <div style="float:left;" class="showSelectedLogo"></div>
              {{ Form::label("logo", "Main Image (above title)") }}
                <button class="btn-primary btn" style="clear: both;float: left;" id="logoBtn" 
						onclick="callLoadLogo('<?php echo $user->companyID; ?>');return false;">Add Main Image</button>

                

                {{ Form::text("image", Input::get("image"), ["class" =>"form-hidden", "id" => "mediaImg"]) }}

                {{ Form::label("perkdetails", "Beam Tags") }}
                <input class="form-control" type="text" data-role="tagsinput" style="display: none;">

                 {{ Form::label("perkdetails", "Beam Details") }}
                <div id="option_html" class="optionButton btn btn-primary">Beam Details</div>
                </div>
                <input type="number" name="size" id="counter" value='0' hidden >

            </div>
          </div>
      <div class="row"> <!-- 3rd row for content for eg field choosen-->

        <div class="col-md-12">
          <div id="field_wrap">
            <h3 id="fieldTitle"></h3>

          </div>
        </div>

      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="sendBeamButtonContainer">
                      {{ Form::submit("Save Beam" , array('class' => 'sendBeam', "id" => "sendBeam", "onclick" => "validateBeam()")) }}
              </div>
          </div>
    </div>
    </div>
  </div><!--end left-->
    <div class="col-md-4">
        
          <div class="whitePanel">
              <div id="iphonePreview">
                <div class="container" id="iphonePerk">
                  
                </div>
              </div>
            </div>
          </div>
       
    </div><!-- end right col -->
    </div><!-- end main row -->

  </div>

</div>

  {{ Form::close() }}
<!-- ========================================Create New Beam Section Ends Here================================================= -->


<?php
$user = Auth::user();
?>

  <script>
     $(document).ready(function(){

      setTimeout(function(){ 
        console.log('tring to set bootstrap');
        $('.bootstrap-tagsinput input').css('width','6em !important');
       }, 3000);
      

      var imgUpdate = 0;
      $('#sendBeam').hide();
      $("#iphonePerk").niceScroll();
      $('#beamTitle').keyup(function(){
        var mainImage = $("#mediaImg").val();
        if(mainImage == '' || mainImage == undefined){
          mainImage = ' ';
        }else{
          mainImage = '<img style="margin-bottom:10px;" src="'+mainImage+'">';
        }
        var val = $("#edit_0").editable("getHTML");
        $("#field_name_0").attr('value',val);
        $("#field_value_0").attr('value',val);
        var disclaimer = $("#beamDisclaimer").val();
        disclaimer = ' ';
        var label = $("#beamLabel").val();
        var string = $("#field_name_0").val();

        var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
        var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;">'+mainImage+'<h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
       

        //var html5 = '<style>.perkBody img{width:100%;}</style><div class="perkBody" style="width:100%;background:#00b8ba;"><div class="perkHeader" style="width:90%;margin:auto;background:white;padding:5px;"><h3>'+$('#beamTitle').val()+'</h3><img src="'+mainImage+'"></div><div class="perkDesc" style="padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
        $("#iphonePerk").html(html5);
      });

      $('#beamDisclaimer').keyup(function(){
        var mainImage = $("#mediaImg").val();
            if(mainImage == '' || mainImage == undefined){
          mainImage = ' ';
        }else{
          mainImage = '<img style="margin-bottom:10px;" src="'+mainImage+'">';
        }
        var val = $("#edit_0").editable("getHTML");
        $("#field_name_0").attr('value',val);
        $("#field_value_0").attr('value',val);
        var disclaimer = $("#beamDisclaimer").val();
         disclaimer = ' ';
        var label = $("#beamLabel").val();
        var string = $("#field_name_0").val();

        var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
        var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;">'+mainImage+'<h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
       
        $("#iphonePerk").html(html5);
      });
      $('#beamLabel').keyup(function(){
        var mainImage = $("#mediaImg").val();
        if(mainImage == '' || mainImage == undefined){
          mainImage = ' ';
        }else{
          mainImage = '<img style="margin-bottom:10px;" src="'+mainImage+'">';
        }
        var val = $("#edit_0").editable("getHTML");
        $("#field_name_0").attr('value',val);
        $("#field_value_0").attr('value',val);
        var disclaimer = $("#beamDisclaimer").val();
         disclaimer = ' ';
        var label = $("#beamLabel").val();
        var string = $("#field_name_0").val();

        var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
        var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;">'+mainImage+'<h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
       
        $("#iphonePerk").html(html5);
      });
      $('.logo').click(function(){
        var mainImage = $("#mediaImg").val();
        if(mainImage == '' || mainImage == undefined){
          mainImage = ' ';
        }else{
          mainImage = '<img style="margin-bottom:10px;" src="'+mainImage+'">';
        }
        var val = $("#edit_0").editable("getHTML");
        $("#field_name_0").attr('value',val);
        $("#field_value_0").attr('value',val);   
        var disclaimer = $("#beamDisclaimer").val();
         disclaimer = ' ';
        var label = $("#beamLabel").val();
        var string = $("#field_name_0").val();

        var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
        var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;">'+mainImage+'<h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
       
        $("#iphonePerk").html(html5);
      });
      $('#sendBeam').click(function(){
    //event.preventDefault();
       
    
        var confirmed =  confirm('Are you Sure?');
        if(confirmed == false){
            return false;
        }else{

         
        }
      });
      //check for the image
      function loopImg(){
        
          setInterval(function(){
           var img = $("#mediaImg").val();
           imgLen = img.length;
            if($("#mediaImg").val()){
              //alert('its here');
              var mainImage = $("#mediaImg").val();
              if(mainImage == '' || mainImage == undefined){
                mainImage = ' ';
              }else{
                mainImage = '<img style="margin-bottom:10px;" src="'+mainImage+'">';
              }
              var val = $("#edit_0").editable("getHTML");
              $("#field_name_0").attr('value',val);
              $("#field_value_0").attr('value',val);   
              var disclaimer = $("#beamDisclaimer").val();
               disclaimer = ' ';
              var label = $("#beamLabel").val();
              var string = $("#field_name_0").val();

              var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
              var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;">'+mainImage+'<h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
             
              $("#iphonePerk").html(html5);
            }else{
              console.log($("#mediaImg").val());
            }
         }, 1000);
        }
     
      loopImg();
    });
    </script>

<script type="text/javascript">
var count=0;
var fcount=0;
var tcount = 0;
var ccount = 0;
function increment() {
}
function appendField(argument) {
      var ibody = '<div class="field crit_'+fcount+'"><p><span class="option_title"></span></p><input value="'+argument+'" class="field_name form-control hidden" type="text" id="field_name_'+fcount+'" name="field_name_'+fcount+'" /></input> <section id="editor"><div id="edit_'+fcount+'" style="margin-top: 30px;"></div></section><hr/><input class="field_value form-control hidden" type="text" id="field_value_'+fcount+'" name="field_value_'+fcount+'" /></input></div>';
	if (fcount<3) {
     $('#sendBeam').show();
		$('#field_wrap').append(ibody);
		var editID="#edit_"+fcount;
		$(editID).editable({
			imageUploadURL: '/uploadImage',
			inlineMode: false,  
			preloaderSrc: "", 
			imageDeleteURL: "", 
			imagesLoadURL:"/asset/images/true",
			buttons: [ 
      'italic','bold','underline',
      'strikeThrough','createLink','insertHorizontalRule','insertVideo','html','selectAll'
      ],
				/*'bold','italic','underline',
				'strikeThrough','subscript','superscript',
				'align','createLink',
				'insertMyImage',
				'insertHorizontalRule','undo','redo','html' */
			customButtons: {
				insertMyImage: {
					title: 'insert image',
					icon: {
						type: 'font',
						value: 'fa fa-picture-o'
					},
					callback: function () {
						callLoadLogo3('<?php echo $user->companyID; ?>',editID);
					}
				}
			}
		});
  //  .editable({inlineMode: false,  preloaderSrc: "", imageDeleteURL: ""});
    //$("#edit_"+fcount).editable({imagesUploadURL:"/uploads"});
   //$("#edit_"+fcount).editable("option", "imageUploadURL", "/uploads");
    fcount++;
   $('#counter').val( function(i, oldval) {
        count++;
        return count;
    });
      $('.option_remove').off('click').on("click", function() {
          event.preventDefault();
          count = count-1;
          $(this).closest('.field').remove();
          fcount--;
      });
    };

    $('#edit_0').keyup(function(){
         var mainImage = $("#mediaImg").val();
        if(mainImage == '' || mainImage == undefined){
          mainImage = ' ';
        }else{
          mainImage = '<img style="margin-bottom:10px;" src="'+mainImage+'">';
        }
        var val = $("#edit_0").editable("getHTML");
        $("#field_name_0").attr('value',val);
        $("#field_value_0").attr('value',val);
        var disclaimer = $("#beamDisclaimer").val();
         disclaimer = '';
        var label = $("#beamLabel").val();
        var string = $("#field_name_0").val();

        var style = '<style>.right{height:30px;float:left;}.banner .left{float:left;padding-right: 10px;}.banner .right span{margin-top:10px;}img{float:left;}.banner{clear:both}.banner span{font-size:10px;padding-top:5%;line-height:1;font-weight:300;}.banner img{width:25px !important;height:25px;padding:5px;float:left;}.perkBody img{width:100%;}.perkHeader{text-align:center;}.perkDesc p{font-size:10px;}</style><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
        var html5 = style+'<div class="perkBody" style="width:100%;background:#fff;"><div class="banner"><div class="left"><img src="<?php echo $company->setImage;?>"></div><div class="right"><span><br/>'+label+'</span></div></div><div class="perkHeader" style="width:100%;margin:auto;background:white;clear:both;"><h3 style="font-family:Lato light 100;font-weight:300;margin-top:20px;line-height: 49px;">'+$('#beamTitle').val()+'</h3></div><div class="perkDesc" style="padding:5px;text-align:center;width:92%;margin:auto;background:white;">'+string+'</div><div class="perkFooter" style="font-style:italic;font-size:10px;padding:5px;text-align:center;width:90%;margin:auto;background:white;">'+disclaimer+'</div></div>';
       
        $("#iphonePerk").html(html5);
      });
}
function validateBeam(){
  for (var i = 0; i < count; i++) {
      var val = $("#edit_"+i).editable("getHTML");
      $("#field_value_"+i).val(val);
  };
  return true;
}
function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}
$('#option_html').bind("click", function(){
 
// event.preventDefault();
 if($(this).hasClass('clicked')){
    //alert('handling only one');
  }else{
    $('#option_html').addClass('clicked');
    appendField("html");
  }
});
</script>
<script type="text/javascript">
/***********************************************
* Drop Down Date select script- by JavaScriptKit.com
* This notice MUST stay intact for use
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
***********************************************/
var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
function populatedropdown(dayfield, monthfield, yearfield){
var today=new Date()
var dayfield=document.getElementById(dayfield)
var monthfield=document.getElementById(monthfield)
var yearfield=document.getElementById(yearfield)
for (var i=1; i<=31; i++)
dayfield.options[i]=new Option(i, i+1)
dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true) //select today's day
for (var m=1; m<12; m++)
monthfield.options[m]=new Option(monthtext[m], monthtext[m])
monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
var thisyear=today.getFullYear()
for (var y=1; y<20; y++){
yearfield.options[y]=new Option(thisyear, thisyear)
thisyear+=1
}
yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
}
</script>

<script type="text/javascript">
//populatedropdown(id_of_day_select, id_of_month_select, id_of_year_select)
//window.onload=function(){
  $( document ).ready(function() {
populatedropdown("daydropdown", "monthdropdown", "yeardropdown")
populatedropdown("enddaydropdown", "endmonthdropdown", "endyeardropdown")
});
//}
</script>
  
  
<!--------------------------------- addLogo Dialog ---------------------------------------->
<style>
	#addLogoModal .logoArea{ max-height:250px;overflow:auto; }
	#addLogoModal .logoArea .logo{ margin:10px;border-radius:8px; }
	#addLogoModal .logoArea .logo:hover{ cursor:pointer;box-shadow:0 0 10px #000; }
</style>
<div class="modal fade" id="addLogoModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add image</h4>
			</div>
			<div class="modal-body">
				<div align="center" class="logoArea"></div>
				<div class="uploadLogoArea">
					<div class="innerLR">
						<!-- Widget -->
						<div class="widget widget-heading-simple widget-body-gray">
							<!--<div class="widget-body">-->
							<!-- Plupload -->
							<form id="pluploadForm">
								<input type="hidden" name="dir" id="dir" value="<?php echo $user->companyID; ?>"  />
							</form>
							<div id="pluploadUploader">
								<!-- // Plupload END -->
								<!--</div>-->
							</div>
							<!-- // Widget END -->
						</div><!--inner LR end-->
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" id="closeModalBtn" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<script src="/js/logoUpload.js"></script>

</div>

<script type="text/javascript">
//----------------------------------------------
$( document ).ready(function(){
	$('.pree_img').bind("click", function(e){
		event.preventDefault();
		$('#display_pre > span')
			.html('<img align="middle" src="'+$(this).attr("href")+'"/><p><a class="delete_media" data-method="delete" href="'+
				$(this).attr("href").replace('uploads', 'media/image')+'">delete</a></p>');
		bindDelete();
	});
	$('.pree_vid').bind("click", function(e){
		event.preventDefault();
		$('#display_pre > span')
			.html('<video width="480" height="360" controls><source src="'+
				$(this).attr("href")+'" type="video/mp4">Your browser does not support the video tag.</video><p><a class="delete_media" data-method="delete" href="'+
				$(this).attr("href").replace('uploads/videos', 'media/video')+'">delete</a></p>');
		bindDelete();
	});
});
//----------------------------------------------
function bindDelete(){
	$('.delete_media').bind("click", function(){
		var result = confirm("Want to delete?");
		if (result==true){
			return true;
		}
		return false;
	});
}
//----------------------------------------------
</script>
