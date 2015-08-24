<nav class="navbar navbar-inverse">
	<div class="container-fluid"> 
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php $companyI = Company::where('_id',$user['companyID'])->get(); ?>
			<a class="navbar-brand" href="#"><img style="max-height:26px;" src="<?php echo $companyI[0]->setImage; ?>"></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{URL::route('CRM')}}">CRM</a></li>
				<li><a href="{{URL::route('Media')}}">Media</a></li>
				<li><a href="{{URL::route('Beacons')}}">Beacons</a></li>
				<li><a href="{{URL::route('Analytics')}}">Analytics</a></li>
				<li><a href="{{URL::route('Dashboard')}}">Dashboard</a></li>
				<li><a href="{{URL::route('profile')}}">Account</a></li>
				<li><a class="" href="{{URL::to('logout')}}">log out</a></li> 
			</ul>
			<!--
			<form class="navbar-form navbar-right">
				<input type="text" class="form-control" placeholder="Search...">
			</form>
			-->
		</div>
	</div>
</nav>