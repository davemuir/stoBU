/*-------------- View -----------------*/
$( ".collapseCampaign" ).bind('click',function(e) {
  e.preventDefault();
  var data_id = $(this).attr('data-req');
  var div_id = $(this).attr('id');

        //start checking
        if ($('#campVisbd_'+div_id).hasClass('active')){ //for when the graphs are shown and active and details need to be shown

            $('.stats-wrap').each(function(){
              var req =  $(this).attr('data-req');
              if($(this).attr('data-req') == data_id){
                  $(this).toggle("slow", function(){
                     $(this).children('.stats-body').removeClass('active');
                     $(this).children('.stats-body').hide();
                  });
                 $(this).toggle("slow", function(){
                  $(this).children(".view-body").show("slow");
                  $(this).children(".view-body").addClass('active');
                  var infoDiv = $(this).children(".view-body");
                  var xhr = new XMLHttpRequest();
                  xhr.open('GET', '/campaignview?id='+ data_id, false);
                  xhr.send(null);
                   if (xhr.status == 200) {
                    console.log('here');
                      var arr = JSON.parse(xhr.response);
                      var id ='#viewVisbd_'+div_id;
                      var beamAppend = "";
                      var exbeamAppend = "";
                      var surveyAppend = "";
                      var exsurveyAppend = "";
                      var campaign = arr.camp;
                        var startDate = campaign.startDay+"/"+campaign.startMonth+"/"+campaign.startYear;
                          var endDate = campaign.endDay+"/"+campaign.endMonth+"/"+campaign.endYear;
                        var active = campaign.active;
                        if(active==true){
                            active = "Active";
                        }else{
                            active="Inactive";
                        }
                        var beams = arr.beams;
                        var len = beams.length;
                        if ( len > 0) {
                          for (var i = 0; i < beams.length; i++) {
                          //if (typeof beams[i] == 'string') {beams[i] = JSON.parse(beams[i]);};
                          var beamsTitle = beams[i][0];
                          beamAppend += "<p id='"+beams[i][0]+"'>"+beamsTitle+"</p>";
                          }
                        }else{
                          beamAppend += "<p>No Beams</p>";
                        }

                        var beams = arr.exitbeams;
                        var len = beams.length;
                        if ( len > 0) {
                          for (var i = 0; i < beams.length; i++) {
                          //if (typeof beams[i] == 'string') {beams[i] = JSON.parse(beams[i]);};
                          var beamsTitle = beams[i][0];
                          exbeamAppend += "<p id='"+beams[i][0]+"'>"+beamsTitle+"</p>";
                          }
                        }else{
                          exbeamAppend += "<p>No Exit Beams</p>";
                        }
                        var beams = arr.surveys;
                        var len = beams.length;
                        if ( len > 0) {
                          for (var i = 0; i < beams.length; i++) {
                          //if (typeof beams[i] == 'string') {beams[i] = JSON.parse(beams[i]);};
                          var beamsTitle = beams[i][0];
                          surveyAppend += "<p id='"+beams[i][0]+"'>"+beamsTitle+"</p>";
                          }
                        }else{
                          surveyAppend += "<p>No Surveys</p>";
                        }

                        var beams = arr.exitsurveys;
                        var len = beams.length;
                        if ( len > 0) {
                          for (var i = 0; i < beams.length; i++) {
                          //if (typeof beams[i] == 'string') {beams[i] = JSON.parse(beams[i]);};
                          var beamsTitle = beams[i][0];
                          exsurveyAppend += "<p id='"+beams[i][0]+"'>"+beamsTitle+"</p>";
                          }
                        }else{
                          exsurveyAppend += "<p>No Exit Surveys</p>";
                        }
                          //$(id).html("<p> entry Beams :"+beamAppend+"</p><p> exit Beams :"+exbeamAppend+"</p><p> entry Survey :"+surveyAppend+"</p><p> exit Survey :"+exsurveyAppend+"</p> ");
                          $(id).html("<div class='viewCampaignCon'><div class='col-md-12 clear'><h4>From : "+startDate+" - To : "+endDate+"</h4></div><div class='col-md-2'><h4>Status: "+active+"</h4></div><div class='col-md-10'><h4>Type: "+campaign.campaigntype+"</h4></div><div class='col-md-2' > <h4>Entry Beams</h4>"+beamAppend+"</div><div class='col-md-2'> <h4>Exit Beams</h4>"+exbeamAppend+"</div><div class='col-md-2'> <h4>Entry Survey </h4>"+surveyAppend+"</div><div class='col-md-2'> <h4>Exit Survey</h4>"+exsurveyAppend+"</div><div class='col-md-4'></div></div>");

                        console.log(beamAppend);
                        console.log(exbeamAppend);
                        console.log(surveyAppend);
                        console.log(exsurveyAppend);

                    }else{
                         var id ='#viewVisbd_'+div_id;

                        var beamAppend = "Nothing Attached";
                        var exbeamAppend = "Nothing Attached";
                        var surveyAppend = "Nothing Attached";
                        var exsurveyAppend = "Nothing Attached";
                        $(id).html("<div class='col-md-2'><h4>Entry Beams</h4>"+beamAppend+"</div><div class='col-md-2'> <h4>Exit Beams</h4>"+exbeamAppend+"</div><div class='col-md-2'> <h4>Entry Survey </h4>"+surveyAppend+"</div><div class='col-md-2'> <h4>Exit Survey</h4>"+exsurveyAppend+"</div> ");
                    }
                 });
              }
            });
        }else if( $("#viewVisbd_"+div_id).hasClass('active')){
          $('.stats-wrap').each(function(){
            var req =  $(this).attr('data-req');
            if($(this).attr('data-req') == data_id){
               $(this).toggle("slow", function() {

                  $(this).children("#viewVisbd_"+div_id).removeClass("active");
                   $(this).children('#viewVisbd_'+div_id).hide("slow");
               });
            }
          });
        }
        else{
          $('.stats-wrap').each(function(){
            var req =  $(this).attr('data-req');
            if($(this).attr('data-req') == data_id){

              $(this).children('.stats-body').hide();
              $(this).toggle("slow", function() {

               $(this).children(".view-body").show("slow");
               $(this).children(".view-body").addClass('active');
               var xhr = new XMLHttpRequest();
                  xhr.open('GET', '/campaignview?id='+ data_id, false);
                  xhr.send(null);
                    if (xhr.status == 200) {
                      var arr = JSON.parse(xhr.response);
                      var id ='#viewVisbd_'+div_id;
                      var beamAppend = "";
                      var exbeamAppend = "";
                      var surveyAppend = "";
                      var exsurveyAppend = "";
                      var campaign = arr.camp;
                        var startDate = campaign.startDay+"/"+campaign.startMonth+"/"+campaign.startYear;
                          var endDate = campaign.endDay+"/"+campaign.endMonth+"/"+campaign.endYear;
                        var active = campaign.active;
                        if(active==true){
                            active = "Active";
                        }else{
                            active="Inactive";
                        }

                        var beams = arr.beams;
                        var len = beams.length;
                        if ( len > 0) {
                          for (var i = 0; i < beams.length; i++) {
                          //if (typeof beams[i] == 'string') {beams[i] = JSON.parse(beams[i]);};
                          var beamsTitle = beams[i][0];
                          beamAppend += "<p id='"+beams[i][0]+"'>"+beamsTitle+"</p>";
                          }
                        }else{
                          beamAppend += "<p>No Beams</p>";
                        }

                        var beams = arr.exitbeams;
                        var len = beams.length;
                        if ( len > 0) {
                          for (var i = 0; i < beams.length; i++) {
                          //if (typeof beams[i] == 'string') {beams[i] = JSON.parse(beams[i]);};
                          var beamsTitle = beams[i][0];
                          exbeamAppend += "<p id='"+beams[i][0]+"'>"+beamsTitle+"</p>";
                          }
                        }else{
                          exbeamAppend += "<p>No Exit Beams</p>";
                        }
                        var beams = arr.surveys;
                        var len = beams.length;
                        if ( len > 0) {
                          for (var i = 0; i < beams.length; i++) {
                          //if (typeof beams[i] == 'string') {beams[i] = JSON.parse(beams[i]);};
                          var beamsTitle = beams[i][0];
                          surveyAppend += "<p id='"+beams[i][0]+"'>"+beamsTitle+"</p>";
                          }
                        }else{
                          surveyAppend += "<p>No Surveys</p>";
                        }

                        var beams = arr.exitsurveys;
                        var len = beams.length;
                        if ( len > 0) {
                          for (var i = 0; i < beams.length; i++) {
                          //if (typeof beams[i] == 'string') {beams[i] = JSON.parse(beams[i]);};
                          var beamsTitle = beams[i][0];
                          exsurveyAppend += "<p id='"+beams[i][0]+"'>"+beamsTitle+"</p>";
                          }
                        }else{
                          exsurveyAppend += "<p>No Exit Surveys</p>";
                        }
                          //$(id).html("<p> entry Beams :"+beamAppend+"</p><p> exit Beams :"+exbeamAppend+"</p><p> entry Survey :"+surveyAppend+"</p><p> exit Survey :"+exsurveyAppend+"</p> ");
                          $(id).html("<div class='viewCampaignCon'><div class='col-md-12 clear'><h4>From : "+startDate+" - To : "+endDate+"</h4></div><div class='col-md-2'><h4>Status: "+active+"</h4></div><div class='col-md-10'><h4>Type: "+campaign.campaigntype+"</h4></div><div class='col-md-2' > <h4>Entry Beams</h4>"+beamAppend+"</div><div class='col-md-2'> <h4>Exit Beams</h4>"+exbeamAppend+"</div><div class='col-md-2'> <h4>Entry Survey </h4>"+surveyAppend+"</div><div class='col-md-2'> <h4>Exit Survey</h4>"+exsurveyAppend+"</div><div class='col-md-4'></div></div>");

                        console.log(beamAppend);
                        console.log(exbeamAppend);
                        console.log(surveyAppend);
                        console.log(exsurveyAppend);

                    }else{
                         var id ='#viewVisbd_'+div_id;

                        var beamAppend = "Nothing Attached";
                        var exbeamAppend = "Nothing Attached";
                        var surveyAppend = "Nothing Attached";
                        var exsurveyAppend = "Nothing Attached";
                        $(id).html("<div class='col-md-2'><h4>Entry Beams</h4>"+beamAppend+"</div><div class='col-md-2'> <h4>Exit Beams</h4>"+exbeamAppend+"</div><div class='col-md-2'> <h4>Entry Survey </h4>"+surveyAppend+"</div><div class='col-md-2'> <h4>Exit Survey</h4>"+exsurveyAppend+"</div> ");
                    }
            });


            }
          });
        }
  //
});
/*-------------- Stats -----------------*/




$('.select-test').on('change', function (e) {
  console.log($(this).attr('class'));
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if (valueSelected == "unique") { charts.campaign_chart.reset($(this).attr('class'));}
    if (valueSelected == "accepted") { charts.campaign_chart.dataset($(this).attr('class'));};




});




