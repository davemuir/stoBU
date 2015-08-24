$( document ).ready(function() {
	$('.pree_img').bind("click", function(e){
		event.preventDefault();
		$('#display_pre > span').html(
			'<img align="middle" src="'+
			$(this).attr("href")+'"/><p><a class="delete_media" data-method="delete" href="'+
			$(this).attr("href").replace('uploads', 'media/image')+'">delete</a></p>');
		bindDelete();
	});
	$('.pree_vid').bind("click", function(e){
		event.preventDefault();
		$('#display_pre > span').html(
			'<video width="480" height="360" controls><source src="'+
			$(this).attr("href")+'" type="video/mp4">Your browser does not support the video tag.</video><p><a class="delete_media" data-method="delete" href="'+
			$(this).attr("href").replace('uploads/videos', 'media/video')+'">delete</a></p>');
		bindDelete();
	});
});

function bindDelete(){
	$('.delete_media').bind("click", function() {
		var result = confirm("Want to delete?");
		if(result==true){
			return true;
		}
		return false;
	});
}


function callLoadLogo(id){
//	console.log(id);
	var posting = $.post( 'listLogo', { companyID: id } );
	$("#addLogoModal .logoArea").html('');
	posting.done(function( data ){
		if(data.result=='ok'){
			var columnCounter=1;
			for( var i=0 ; i<data.list.length ; i++ ){
				$("#addLogoModal .logoArea")
					.append('<img class="logo" src="'+window.location.origin+data.list[i].path2+'" onclick="getLogoUrl(this,\''+data.list[i].path1+'\')" />');
				if( columnCounter==5 ){
					columnCounter=0;
					$("#addLogoModal .logoArea").append("<br/>");
				}
				columnCounter++;
			}
			$("#addLogoModal").modal({show:true});//show();
		}
	});
}

function callLoadLogo2(id){
	var posting = $.post( 'listLogo', { companyID: id } );
	$("#addLogoModal .logoArea").html('');
	posting.done(function( data ){
		if(data.result=='ok'){
			var columnCounter=1;
			for( var i=0 ; i<data.list.length ; i++ ){
				$("#addLogoModal .logoArea").append('<img class="logo" src="'+window.location.origin+data.list[i].path2+'" onclick="getLogoUrl2(\''+data.list[i].path1+'\')" />');
				if( columnCounter==5 ){
					columnCounter=0;
					$("#addLogoModal .logoArea").append("<br/>");
				}
				columnCounter++;
			}
			$("#addLogoModal").modal({show:true});//show();
		}
	});
}
// insert image in add perk
function callLoadLogo3(id,eID){
	var posting = $.post( 'listLogo', { companyID: id } );
	$("#addLogoModal .logoArea").html('');
	posting.done(function( data ){
		if(data.result=='ok'){
			var columnCounter=1;
			for( var i=0 ; i<data.list.length ; i++ ){
				$("#addLogoModal .logoArea").append('<img class="logo" src="'+window.location.origin+data.list[i].path2+'" onclick="getLogoUrl3(\''+data.list[i].path1+'\',\''+eID+'\')" />');
				if( columnCounter==5 ){
					columnCounter=0;
					$("#addLogoModal .logoArea").append("<br/>");
				}
				columnCounter++;
			}
			$("#addLogoModal").modal({show:true});//show();
		}
	});

}

function getLogoUrl(logo,img){
	var url = $(logo).attr('src'   );
	var wdh = $(logo).attr('width' );
	var hgt = $(logo).attr('height');
	$("#mediaImg").val(img);
	$("#addLogoModal").modal("hide");
	$(".showSelectedLogo").html('');
	$(".showSelectedLogo").append( '<img src="' + url+'" width="'+wdh+'" height="'+hgt+'" />' );
	$("#removeLogo").show();

}
// insert image in edit perk
function getLogoUrl2(url){
	$("#addLogoModal").modal("hide");

	$("#edit_ .froala-element p").append( '<img src="'+window.location.origin+url+'" />' );

}
// insert image in add perk
function getLogoUrl3(url,eID){
	$("#addLogoModal").modal("hide");
	$(eID+" .froala-element p").append( '<img src="'+window.location.origin+url+'" />' );


}

function callBackUploadComplete(files,company){
	console.log('callBackUploadComplete');
	var cntr=0;
	for(var i=0 ; i<files.length ; i++ ){
		if( files[i].status==5){
			var last=(i==(files.length-1))?1:0;
			var posting = $.post( "Uploader", { name: files[i].name, realName: files[i].target_name , last:last} );
			posting.done(function( data ){
				if(data.result='ok'){
					if( (cntr%5) ==0 ){ $("#addLogoModal .logoArea").append("<br/>"); }
					cntr++;
					$("#addLogoModal .logoArea").
						append('<img class="logo" src="'+
							   	window.location.origin+'/userlogo/'+data.path+'" width="'+data.w+'" height="'+data.h
//								+'" onclick="getLogoUrl(this)" />');
								+'"onclick="getLogoUrl(this,\'/userlogo/'+data.pathO+'\')" />');
				}
			});
		}
	}
}
function callShowLogo(src,w,h,name){
	if(w>590 || h>590 ){
		$("#deleteLogoModal .modal-header").show();
		$("#deleteLogoModal .modal-header").html('<h4>'+name+'</h4><h5>Image is too large to fit, please use scroll bars</h5>');
	}else{
		$("#deleteLogoModal .modal-header").show();
		$("#deleteLogoModal .modal-header").html('<h4>'+name+'</h4>');
//		$("#deleteLogoModal .modal-header").hide();
	}
	$("#deleteLogoModal #deleteLogo").attr('src'   ,src);
	$("#showHideDeleteDIV1").show();
	$("#showHideDeleteDIV2").hide();
	$("#showHideDeleteDIV3").hide();
	$("#deleteLogoModal").modal({show:true});
}

function callDeleteLogo(src,name,id){
	$("#deleteLogoModal .modal-header").html("<h3>Delete:</h3><h5>"+name+"</h5>");
	$("#deleteLogoModal .modal-header").show();

	$("#deleteLogoModal #deleteLogo").attr('src',src);
	$("#showHideDeleteDIV1").hide();
	$("#showHideDeleteDIV2").show();
	$("#showHideDeleteDIV3").hide();

	$("#deleteLogoModal #id").val(id);

	$("#deleteLogoModal").modal({show:true});
}

function doDeleteLogo(){
	var id  = $("#deleteLogoModal #id").val();
//	var thumb = $("#deleteLogoModal #thumbFile" ).val();

//	var posting = $.post( "/upload_manager/deletelogo.php", { file: file , thumb:thumb } );
	var posting = $.post( "deleteLogo", { id: id } );
	posting.done(function( data ){
		if(data.result=='ok'){
			window.location.reload();
		}
		$("#deleteLogoModal").modal('hide');
	});
}

function callRenameLogo(src,name,id){
	var fileName=name.split(".");
	$("#deleteLogoModal .modal-header").html("<h5>Rename:<i>"+fileName[0]+"</i></h5>");
	$("#deleteLogoModal .modal-header").show();

	$("#deleteLogoModal #deleteLogo").attr('src',src);
	$("#showHideDeleteDIV1").hide();
	$("#showHideDeleteDIV2").hide();
	$("#showHideDeleteDIV3").show();

	$("#deleteLogoModal #id").val(id);
	$("#deleteLogoModal #newLogoName" ).val('');
	$("#deleteLogoModal #newLogoName" ).focus();

	$("#deleteLogoModal").modal({show:true});
}

function doRenameLogo(){
	var id  = $("#deleteLogoModal #id").val();
	var rename   = $.trim($("#deleteLogoModal #newLogoName" ).val());
	var posting = $.post( "renameLogo", { id: id , newName: rename } );
	posting.done(function( data ){
		if(data.result=='ok'){
			window.location.reload();
		}
		$("#deleteLogoModal").modal('hide');
	});
}

function callRecycleLogo(){
	$("#recycleBinModal").modal({show:true});
}

function callRestoreLogo(src,name,id){
	var fileName=name.split(".");
	$("#recycleBinChildModal .modal-header").html("<h5>Restore:<i>"+fileName[0]+"</i></h5>");
	$("#recycleBinChildModal .modal-header").show();

	$("#recycleBinChildModal #recycleBinChildLogo").attr('src',src);
	$("#showHideRecycleBinChildDIV1").hide();
	$("#showHideRecycleBinChildDIV2").hide();
	$("#showHideRecycleBinChildDIV3").show();

	$("#recycleBinChildModal #id").val(id);

	$("#recycleBinChildModal").modal({show:true});
}


function callDeleteRLogo(src,name,id){
	var fileName=name.split(".");
	$("#recycleBinChildModal .modal-header").html("<h5>Delete:<i>"+fileName[0]+"</i></h5>");
	$("#recycleBinChildModal .modal-header").show();

	$("#recycleBinChildModal #recycleBinChildLogo").attr('src',src);
	$("#showHideRecycleBinChildDIV1").hide();
	$("#showHideRecycleBinChildDIV2").show();
	$("#showHideRecycleBinChildDIV3").hide();

	$("#recycleBinChildModal #id").val(id);

	$("#recycleBinChildModal").modal({show:true});
}


function callDeleteAllRLogo(){
	$("#recycleBinChildModal .modal-header").html("<h5>Empty recycle bin</h5>");
	$("#recycleBinChildModal .modal-header").show();

	$("#recycleBinChildModal #recycleBinChildLogo").attr('src','/userlogo/animate/trash.gif');
	$("#showHideRecycleBinChildDIV1").show();
	$("#showHideRecycleBinChildDIV2").hide();
	$("#showHideRecycleBinChildDIV3").hide();

	$("#recycleBinChildModal #id").val(0);

	$("#recycleBinChildModal").modal({show:true});
}

function doRecycleBinActionLogo(act){
	var id = $("#recycleBinChildModal #id").val();
	var posting = $.post( act, { id: id } );
	posting.done(function( data ){
		if(data.result=='ok'){
			window.location.reload();
		}
		$("#recycleBinChildModal").modal('hide');
		$("#recycleBinModal"     ).modal('hide');
	});
}

/**/
function printObject(o) {
	var out = '';
	for (var p in o) {
		out += p + ': ' + o[p] + '\n';
	}
	alert(out);
}
/**/
