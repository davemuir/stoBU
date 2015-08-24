var _list= $("#test_array");
function show(arr, Nid, destination){
    document.getElementById("overlay").style.display="block";
    document.getElementById("popup").style.display="block";
    if (arr != " ") {

      for (var i = arr.length - 1; i >= 0; i--) {
       $('#test_array').append('<a class="mediaList" href="/uploads/'+Nid+'/'+arr[i]+'"><img  src="/uploads/'+Nid+'/100x100_crop/'+arr[i]+'"/></a>');
      };


    }else{
      $('#test_array').html("No Media uploaded");
    }

    $('#overlay').click(function(){
      $('#test_array').html("");
      document.getElementById("overlay").style.display="none";
    document.getElementById("popup").style.display="none";
    $('#display_pre > span').html('');
    });

    $('.mediaList').off('click').on("click", function(e){
      event.preventDefault();
      selectNext($(this));
      $('#display_pre > span').html('<img align="middle" src="'+$(this).attr("href")+'"/>');
      return false;
    });

    $('#mediaSubmit').off('click').on("click", function(e){
      event.preventDefault();
      console.log($("#test_array").children(".selected").attr('href'));
      destination.val(document.referrer.replace('/cms', '').replace('/adhoc','').replace('/media','').replace('/beam','')+$("#test_array").children(".selected").attr('href'));
      $("#test_array").children(".selected").removeClass('selected');
      $('#overlay').click();

    });

    if ($('#test_array').html() != " ") {
        $("#test_array").append("<div class='noMediaMessage'><h1>There are no Images in your Media Manager.</h1><p>Please go to the media manager page and upload some content</p></div>");

    }
}

function vidshow(varr, Nid, destination){
    document.getElementById("overlay").style.display="block";
    document.getElementById("popup").style.display="block";

    if (varr != " ") {
      for (var i = varr.length -1; i >= 0; i--) {
       $('#test_array').append('<a class="mediaList" href="/uploads/videos/'+Nid+'/'+varr[i]+'">Here</a>');

      };


    }else{
      $('#test_array').html("No Media uploaded");
    }

    $('#overlay').click(function(){
      $('#test_array').html("");
      document.getElementById("overlay").style.display="none";
    document.getElementById("popup").style.display="none";
    $('#display_pre > span').html('');
    });

    $('.mediaList').off('click').on("click", function(e){
      event.preventDefault();
      selectNext($(this));
      $('#display_pre > span').html('<video width="480" height="360" controls><source src="'+$(this).attr("href")+'" type="video/mp4">Your browser does not support the video tag.</video>');
      return false;
    });

    $('#mediaSubmit').off('click').on("click", function(e){
      event.preventDefault();
      console.log($("#test_array").children(".selected").attr('href'));
      destination.val(document.referrer.replace('/cms', '').replace('/adhoc','')+$("#test_array").children(".selected").attr('href'));
        $("#test_array").children(".selected").removeClass('selected');
      $('#overlay').click();
    });

    if ($('#test_array').html() != " ") {
        $("#test_array").append("<div class='noMediaMessage'><h1>There are no Videos in your Media Manager.</h1><p>Please go to the media manager page and upload some content</p></div>");

    }
}


function selectNext(thisObj){
 if (thisObj.hasClass('selected')){
    thisObj.removeClass('selected');
  }else{
    //console.log( $("#test_array").children(".selected"));
    $("#test_array").children(".selected").removeClass('selected');
    thisObj.addClass('selected');
  }

}

function AppendSpan()
{
    $('div.note-editable > p').attr('contenteditable', 'true');
    $('.note-editable ').removeAttr('contenteditable')
    //Then I want to handle the keypress event on the inserted span
    $('.note-editable > p').bind("keyup", function(e){
  $("#preview-text").html($(this).html());
 });
}
$(function()
{
    $('.note-editable').keypress(function(event){AppendSpan();});
});
