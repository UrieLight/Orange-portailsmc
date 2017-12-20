$(document).ready(function(){

		
	var site_url = $('#site_url').attr('site_url');
	

	$('.family_caracter_class').on('click', function(event) {
		
		var clicked_family = $(this).attr('famille');
		site_url = site_url+'/Catalogue/services_family_get/'+clicked_family;
		// site_url = site_url+'/Catalogue/services_display';
		console.log('clicked_family: '+clicked_family);
		//console.log('site_url: '+site_url);

		//event.preventDefault();
		/* Act on the event *
		$.ajax({
			url: site_url,
			method: 'POST',
			data: {clicked_family: clicked_family},
			success: function (data) {
				 /* body... *
				 console.log('data: '+data);
				 //window.location.assign(site_url);//+'/Catalogue/services_family_get/'+clicked_family);
			}
		});//*/
		
	});

});