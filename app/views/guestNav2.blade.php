<nav class="navbar navbar-inverse"> 
	<div class="container-fluid">
		<div class="navbar-header">
		<!--	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>-->
			<?php $companyI = Company::where('_id',$user['companyID'])->get(); ?>
			<a class="navbar-brand" href="#"><img style="max-height:48px;" src="<?php echo $companyI[0]->setImage; ?>"></a>
			<svg id="menuSideBarIcon" data="off" class="icon icon-menu"><use xlink:href="#icon-menu"></use></svg><span class="mls"></span>
		</div>
		<div id="navbar" > <!-- class="navbar-collapse collapse" -->
			<!--<ul class="nav navbar-nav navbar-right">
      			
				<li><a class="glyphicons power" href="{{URL::to('profile')}}">Account</a></li>
				<li><a class="glyphicons power" href="{{URL::to('logout')}}">log out</a></li>
			</ul>-->

    	<div id="clock">
            <div id="time"></div>
            <div id="date"></div>
        </div>
		<div class="dashRight">
			<div class="arrow-down" data="off">
			</div>
					<div class="profileCircle">
				<?php
					if(isset($user['img'])){
						echo '<img src="'.$user['img'].'" >';
					}
				?>
			</div>
			<span class="dashName"><?php echo $user["fname"].' '.$user["lname"];?></span>	
	
			
		</div>
		
			<!--<form class="navbar-form navbar-right">
				<input type="hidden" class="form-control" placeholder="Search...">
			</form>-->
		</div>

	</div>
</nav>
<div class="dashRightMenu">
			<ul>
      			<!--<li><a href="{{URL::route('CMS')}}">Messages</a></li>-->
				<li><a  href="{{URL::to('profile')}}">Profile</a></li>
				
			</ul>
			<ul>
      			
				<li><a  href="{{URL::to('logout')}}">Log Out</a></li>
			</ul>
		</div>
<div id="preNav">
		<li id="Dashboard"><svg class="icon icon-dashboard-10"><use xlink:href="#icon-dashboard-10"></use></svg><span class="mls"></span><a href="{{URL::route('Dashboard')}}">Dashboard</a></li>
		<li id="Locations"><svg class="icon icon-locations-09"><use xlink:href="#icon-locations-09"></use></svg><span class="mls"></span><a href="{{URL::route('Locations')}}">Locations</a></li>
		<li id="CMS"><svg class="icon icon-content-14"><use xlink:href="#icon-content-14"></use></svg><span class="mls"></span><a href="{{URL::route('CMS')}}">Content</a></li>
		<li id="Campaigns"><svg class="icon icon-campaigns-12"><use xlink:href="#icon-campaigns-12"></use></svg><span class="mls"></span><a href="{{URL::route('Campaigns')}}">Campaigns</a></li>
		<li id="CRM"><svg class="icon icon-network-13"><use xlink:href="#icon-network-13"></use></svg><span class="mls"></span><a href="{{URL::route('CRM')}}">Network</a></li>
		<!--<li><a href="{{URL::route('Media')}}">Media</a></li>-->
		<li id="reports"><svg class="icon icon-reports-15"><use xlink:href="#icon-reports-15"></use></svg><span class="mls"></span><a href="{{URL::route('Analytics')}}">Reports</a></li>
		<li id="beacons"><svg class="icon icon-beacon-11"><use xlink:href="#icon-beacon-11"></use></svg><span class="mls"></span><a href="{{URL::route('Beacons')}}">Beacons</a></li>		
      <!--<li><a href="{{URL::route('CMS')}}">Messages</a></li>-->
				
</div>
<script>
$(document).ready(function(){
	 var rootLocation = location.hostname;
	 var startDevice;
	function startTime(){
        
        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        var todayC= new Date();
        var hClock=todayC.getHours();
        var min=todayC.getMinutes();
        var sec=todayC.getSeconds();
        var d = todayC.getDate();
        var Mo = todayC.getMonth();
        var ye = todayC.getFullYear();


        var day = days[ todayC.getDay() ];
        var month = months[ todayC.getMonth() ];

        min = checkTime(min);
        sec = checkTime(sec);
        $('#time').html(hClock+":"+min);
        $('#date').html(day+", "+month+" "+d+", "+ye);
        var t = setTimeout(function(){startTime()},1500);
    }
    function checkTime(a) {
        if (a<10) {a = "0" + a};  // add zero in front of numbers < 10
        return a;
    }
    startTime();

	var route = '<?php echo Route::currentRouteName();?>';
	
	
	 
	    var ua = navigator.userAgent;
	    var checker = {
	      iphone: ua.match(/(iPhone|iPod|iPad)/),
	      blackberry: ua.match(/BlackBerry/),
	      android: ua.match(/Android/)
	    };
	    if (checker.android){
	      startDevice = 'android';
	      startScreen = screen.width;
	      localStorage.setItem("route", route);
	      //var link = '<meta name="viewport" content="width=device-width, initial-scale=0.4">';
	      if(screen.width <= 480){
				//$('head').remove(link);
			}
			if(screen.width <= 767 && screen.width >= 481){
			//	$('head').append(link);
			}
	    }
	    else if (checker.iphone){
	        
	    }
	    else if (checker.blackberry){
	        
	    }
	    else {
	       startDevice = 'web';
	       localStorage.setItem("route", route);	
	    }
	

	$( window ).resize(function() {
		
		//var link = '<meta name="viewport" content="width=device-width, initial-scale=0.4">';
		if(startDevice == 'android'){
			//alert(screen.width);
			if(screen.width <= 480){
				//$('head').remove(link);
			}
			if(screen.width <= 767 && screen.width >= 481){
				//$('head').append(link);
			}
			
		}
	});

	   
	$('#preNav').hide();
	$('.dashRightMenu').hide();

	$('#menuSideBarIcon').click(function(){
		if($(this).attr('data') == "off"){
			$('#preNav').fadeIn();
			if(startDevice == 'web'){
				localStorage.setItem("sidebar", "on");
			}
			
			
			//$('#preNav').css('height',mad+'px');
			$('#menuSideBarIcon').css('background','#1c8cb6');
			if(route == "Dashboard"){
				if(screen.width <= 480){
					$('#mainInnerContent').css({'width':'100%','float':'left','padding-left':'0px'});
				}else{
					$('#mainInnerContent').css({'width':'70%','float':'left','padding-left':'150px'});
				}
				
			}else{
				if(screen.width <= 480){
					$('#mainInnerContent').css({'width':'100%','float':'left','padding-left':'0px'});
				}else{
				$('#mainInnerContent').css({'width':'100%','float':'left','padding-left':'150px'});
				$('#mainInnerContent').css({'padding-left':'150px'});
				}
			}
			$(this).attr('data','on');
		}else{
			$(this).attr('data','off');
			if(startDevice == 'web'){
				localStorage.setItem("sidebar", "off");
			}
			$('#menuSideBarIcon').css('background','none');
			$('#preNav').fadeOut(function(){
				if(route == "Dashboard"){
					$('#mainInnerContent').css({'width':'100%','float':'none','padding-left':'0'});
				}else{
					$('#mainInnerContent').css({'width':'90%','float':'none','padding-left':'0'});
				}
			});
			
		}
		
	});
	$('.arrow-down').click(function(){
		if($(this).attr('data') == "off"){
			$('.dashRightMenu').show();
			$(this).attr('data','on');
		}else{
			$(this).attr('data','off');
			$('.dashRightMenu').hide();
		}
	});

	$(window).scroll(function(){
    	var win = $(window).scrollTop();
    	var scro = 70;
    	//console.log(win+ ' - '+scro);
    	if(win > scro){
    		if(screen.width <= 480){
    			$('#preNav').css({'position':'fixed',  'margin-top':'-70px'});
    		}else{
    			$('#preNav').css({'position':'fixed',  'margin-top':'-70px'});
    		}
    		
    	}
    	else 	if(win < scro){
    		$('#preNav').css({'position':'absolute','margin-top':'0px'});
    	}
    	
	});

		

	if(typeof(Storage) !== "undefined") {
    // Code for localStorage/sessionStorage.
    	var sidebar = localStorage.getItem("sidebar");
    	console.log("SCREEN:" + $(window).width() );
    	//sidebar
    	if(sidebar == "on"){
    		$('#preNav').fadeIn();
			localStorage.setItem("sidebar", "on");
			//$('#preNav').css('height',mad+'px');
			$('#menuSideBarIcon').css('background','#1c8cb6');
		
			//var route = '<?php echo Route::currentRouteName();?>';

			if(route == "Dashboard"){
				
				$('#mainInnerContent').css({'width':'70%','float':'left','padding-left':'150px'});
				
				
			}else{
				$('#mainInnerContent').css({'width':'100%','float':'left','padding-left':'150px'});
				$('#mainInnerContent').css({'padding-left':'150px'});
			}
			$('#menuSideBarIcon').attr('data','on');
		}
		//routes
		if(route == 'Edit Campaign' || route == 'New Campaign'){
			route = 'Campaigns';
		}
		if(route == 'Media' || route == 'new perk' || route == 'edit perk'){
			route = 'CMS';
		}
		if(route == 'Beacons' ){
			route = 'beacons';
		}
		if(route == 'Analytics' ){
			route = 'reports';
		}
		if(route == 'Locations' ){
			route = 'Locations';
		}
		$('#'+route).css("background","#1c8cb6");
		
		
	}

});


</script>