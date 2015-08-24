$(document).ready(function(){
$(function()
{

	var bWizardTabClass = '';
	$('.wizard').each(function()
	{
		if ($(this).is('#rootwizard'))
			bWizardTabClass = 'bwizard-steps';
		else
			bWizardTabClass = '';

		var wiz = $(this);

		$(this).bootstrapWizard(
		{
			onNext: function(tab, navigation, index)
			{

				switch(index) {
				    case 1:
				    var uri = '/index.php/vendorlist';
				   			  var xhr = new XMLHttpRequest();
						       xhr.open('GET', uri, false)
						      xhr.send(null);

						      if (xhr.status == 200) {
						      	$('#beacon_list_wrapper').empty();
						      	var list =JSON.parse(xhr.response);
						      	console.log(list);
						      	for (var i = list.length - 1; i >= 0; i--) {
						      	$('#beacon_list_wrapper').append('<div class="beacon_obj"><a class="beacon_data" data-manu="'+list[i].Manufacturer+'" data-uuid="'+list[i].UUID+'" data-major="'+list[i].Major+'" data-minor="'+list[i].Minor+'" href="#"><img src="'+list[i].Picture+'"><p>'+list[i].Manufacturer+'</p></a></div>');
						      	};



						      $('.beacon_data').on('click',function(event) {
						      	event.preventDefault();
						      	console.log('custom clicked');


                              var uuidTF = document.getElementById('uuidTF');
                              var majorTF = document.getElementById('majorTF');
                              var minorTF = document.getElementById('minorTF');
                              var manuTF = document.getElementById('manuTF');
                              var wrapper = document.getElementById('beac_wrapper');
                              uuidTF.value = $(this).attr('data-uuid');
                              majorTF.value = $(this).attr('data-major');
                              minorTF.value = $(this).attr('data-minor');
                              manuTF.value = $(this).attr('data-manu');
                               wrapper.style.display= "block";

                            });
						      }else{
						      	console.log('no success');
						      }

				        break;
				    case 2:
				    			if(!wiz.find('#uuidTF').val() || !wiz.find('#majorTF').val() || !wiz.find('#minorTF').val()) {
									alert('You must Select A Beacon type');
										 return false;
									 }
				        break;
		        case 3:
		        			if(!wiz.find('#beaconAlias').val() ) {
									alert('Please give the Beacon a Name');
										 return false;
									 }
		        		break;
		        case 4:

		        		break;

				}

			},
			onLast: function(tab, navigation, index)
			{
				// Make sure we entered the title

			},
			onTabClick: function(tab, navigation, index)
			{

				    if(index==1){
				    			if(!wiz.find('#uuidTF').val() || !wiz.find('#majorTF').val() || !wiz.find('#minorTF').val()) {
									alert('You must Select A Beacon type');
										 return false;
									 }
				        }

		       if(index==2){
		        			if(!wiz.find('#beaconAlias').val() ) {
									alert('Please give the Beacon a Name');
										 return false;
									 }
		        	}

			},
			onTabShow: function(tab, navigation, index)
			{
				if(index==1){
				    var uri = '/index.php/vendorlist';
				   			  var xhr = new XMLHttpRequest();
						       xhr.open('GET', uri, false)
						      xhr.send(null);
						      if (xhr.status == 200) {
						      	$('#beacon_list_wrapper').empty();
						      	var list =JSON.parse(xhr.response);
						      	for (var i = list.length - 1; i >= 0; i--) {
						      	$('#beacon_list_wrapper').append('<div class="beacon_obj"><a class="beacon_data" data-manu="'+list[i].Manufacturer+'" data-uuid="'+list[i].UUID+'" data-major="'+list[i].Major+'" data-minor="'+list[i].Minor+'" href="#"><img src="'+list[i].Picture+'"><p>'+list[i].Manufacturer+'</p></a></div>');
						      	};
						      $('.beacon_data').on('click', function() {

						      	if($(this).attr('data-manu') == "Other"){
						      		console.log('click');
						      		$('#uuidTFLabel').removeClass('hidden');
						      		$('#uuidTF').removeClass('hidden');
						      	}else{
						      		$('#uuidTFLabel').addClass('hidden');
						      		$('#uuidTF').addClass('hidden');
						      	}
                              event.preventDefault();
                              var uuidTF = document.getElementById('uuidTF');
                              var majorTF = document.getElementById('majorTF');
                              var minorTF = document.getElementById('minorTF');
                              var manuTF = document.getElementById('manuTF');

                              var wrapper = document.getElementById('beac_wrapper');
                              uuidTF.value = $(this).attr('data-uuid');
                              majorTF.value = $(this).attr('data-major');
                              minorTF.value = $(this).attr('data-minor');
                              manuTF.value = $(this).attr('data-manu');
                              wrapper.style.display= "block";
                            });
						      }
				       }

				 if (index==3) {
					var review_uuid = document.getElementById('review_uuid');
        var review_major = document.getElementById('review_major');
        var review_minor = document.getElementById('review_minor');
        var review_manu = document.getElementById('review_manu');
				var	review_alias = document.getElementById('review_alias');
				var	review_room = document.getElementById('review_room');

				review_uuid.innerHTML = document.getElementById('uuidTF').value;
				review_major.innerHTML = document.getElementById('majorTF').value;
				review_minor.innerHTML = document.getElementById('minorTF').value;
				review_manu.innerHTML = document.getElementById('manuTF').value;
				review_alias.innerHTML = $('#beaconAlias').val();
				review_room.innerHTML = $('#beacon_room').text();

				}
				var $total = navigation.find('li:not(.status)').length;
				var $current = index+1;
				var $percent = ($current/$total) * 100;

				if (wiz.find('.progress-bar').length)
				{
					wiz.find('.progress-bar').css({width:$percent+'%'});
					wiz.find('.progress-bar')
						.find('.step-current').html($current)
						.parent().find('.steps-total').html($total)
						.parent().find('.steps-percent').html(Math.round($percent) + "%");
				}

				// update status
				if (wiz.find('.step-current').length) wiz.find('.step-current').html($current);
				if (wiz.find('.steps-total').length) wiz.find('.steps-total').html($total);
				if (wiz.find('.steps-complete').length) wiz.find('.steps-complete').html(($current-1));

				// mark all previous tabs as complete
				navigation.find('li:not(.status)').removeClass('primary');
				navigation.find('li:not(.status):lt('+($current-1)+')').addClass('primary');

				// If it's the last tab then hide the last button and show the finish instead
				if($current >= $total) {
					wiz.find('.pagination .next').hide();
					wiz.find('.pagination .finish').show();
					wiz.find('.pagination .finish').removeClass('disabled');
				} else {
					wiz.find('.pagination .next').show();
					wiz.find('.pagination .finish').hide();
				}
			},

			tabClass: bWizardTabClass,
			nextSelector: '.next',
			previousSelector: '.previous',
			firstSelector: '.first',
			lastSelector: '.last'
		});

		wiz.find('.finish').click(function()
		{
			if(!wiz.find('#uuidTF').val() || !wiz.find('#majorTF').val() || !wiz.find('#minorTF').val()) {
									alert('You must Select A Beacon type');
										 return false;
									 }
				if(!wiz.find('#alias').val()  ) {
					// alert('You must fill all the fields');
					// 	wiz.find('#alias').focus();
					// return false;
				}
			wiz.find("a[data-toggle*='tab']:first").trigger('click');
		});
	});
});
});