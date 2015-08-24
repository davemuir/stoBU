$(function () {
	/* Plupload */
	console.log('pluploader');
	$("#pluploadUploader").pluploadQueue({
		// General settings
		runtimes: 'html5,flash,gears,browserplus,silverlight,html4',
		url: '/upload_manager/upload.php',
//		url: '/userlogo/upload.php',
//		url: '/media/myUpload',
		max_file_size : '10mb',
		chunk_size    : '1mb',
		unique_names  : true,
		rename        : true,
// Resize images on clientside if we can
		//resize: {width: 320, height: 240, quality: 90},
		// Specify what files to browse for
		filters: [

            //max_file_size : '10mb',
			{title: "Image files", extensions: "jpg,gif,png,jpeg"}
			/*
			{title: "Image files", extensions: "jpg,gif,png"},
			{title: "Zip files", extensions: "zip"},
			{title: "Video files", extensions: "mp4"}
			*/
		],
		multipart_params:{
			dir : $("#pluploadForm #dir").val()
		},
		init:{
			FileUploaded: function (upldr, file, object){
				var mdata = JSON.parse(object.response);
				var _type;
				$("#meta_data_wrapper").append("<div id='meta_data_"+mdata._asset._id+"' class='row meta_wrap'></div>");
				if (mdata._asset.type === "Image"){
					_type = "Image";
					$("#meta_data_"+mdata._asset._id).append("<div class='media_meta col-md-6'><img src='"+mdata._asset.path+"'></div>");
				};
				if (mdata._asset.type === "Video"){
					_type = "Video";
					$("#meta_data_"+mdata._asset._id).append("<div class='media_meta col-md-6'><video width='320' height='240' controls><source src='"+
								mdata._asset.path+"'type='video/mp4'>Your browser does not support the video tag.</video></div>");
				};
				$("#meta_data_"+mdata._asset._id).append("<div class='media_meta col-md-6'><form class='update_asset' action='/asset/update/"+
						mdata._asset._id+"' method='POST'><label class='' for='name'>Name: </label><input class='form-control' type='text' name='name' value='"+
						mdata._asset.name+"'><label class='' for='type'>File Type: </label><input class='form-control' type='text' name='type' value='"+_type+
						"' readonly><label class='' for='extension'>File Extension: </label><input class='form-control' type='text' name='extension' value='"+
						mdata._asset.extension+
						"' readonly><label class='' for='tags'>Tags: </label><input class='form-control' type='text' name='tags' value=''>"+
						"<input type='submit' id='submitButton' class='meta_submit '  name='submitButton' hidden value='Submit'></form></div>");
			},
			UploadComplete: function(up, files){
				 $(".plupload_buttons").css("display", "inline");
try{
callBackUploadComplete(files,$("#pluploadForm #dir").val());
up.splice();
up.refresh();
}catch(err){}
				$("#meta_data_wrapper").append(
						   "<input type='submit' id='submitAll' class='form-control'  name='submitButton' value='Submit All Changes' "+
						   "style='background-color: #58c078; width: 150px;'>");
				$('.update_asset').submit(function(event) {
						/* stop form from submitting normally */
						event.preventDefault();
						/* get some values from elements on the page: */
						var $form = $( this ),
							url = $form.attr( 'action' );
						var _name = $form.find('input[name="name"]').val()
						var _tags = $form.find('input[name="tags"]').val()
						console.log($(this));
						/* Send the data using post */
						var posting = $.post( url, { name: _name, tags: _tags } );
						posting.done(function( data ){
							console.log('success');
						});
				});
				$('#submitAll').on('click', function(){
					event.preventDefault();
					$('.meta_submit').click();
					location.reload();
				})
			}
		},
		// Flash settings
		flash_swf_url: 'plupload.flash.swf',
		// Silverlight settings
		silverlight_xap_url: 'plupload.silverlight.xap'
	});
	// Client side form validation
	$('#pluploadForm').submit(function (e){
		var uploader = $('#pluploadUploader').pluploadQueue();
		// Files in queue upload them first
		if (uploader.files.length > 0) {
			// When all files are uploaded submit form
			uploader.bind('StateChanged', function () {
				if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
					$('#pluploadForm').submit();
				}
			});
			uploader.start();
		} else {
			alert('You must queue at least one file.');
		}
		return false;
	});
});
