<script type="text/javascript" src="<?= $root_path ?>/js/go-debug.js"></script>

<script type="text/javascript" src="<?= $root_path ?>/js/catalogue_content_script.js"></script>

<!-- <script type="text/javascript" src="<= $root_path ?>/js/service_architecture_viewer_script.js"></script> -->
<script type="text/javascript" src="<?= $root_path ?>/js/architectures_display_script.js"></script>

<script>
	
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
	
</script>

<script>

	$(document).ready(function() {
		
		//activer la surbrillance lors d'un hover sur l'image d'un contact
		$('.service_img').hover(function() {
			/* Stuff to do when the mouse enters the element */
			// $(this).next().children().css('color', '#ff6501');
			// console.log($(this).parent().next());
		});
		

		//desactiver la surbrillance lors d'un hover off sur l'image d'un contact
		$('.service_img').mouseout(function() {
			/* Act on the event */

			// $(this).next().children().css('color', '#000');
		});

		//activer la surbrillance lors d'un hover sur le nom d'un contact
		/*$('.service_name').hover(function() {
			 Stuff to do when the mouse enters the element 
			$(this).css({
				color: '#ff6501',
				cursor: 'pointer'
			});
		});*/

		
		var site_url = $('#site_url').attr('site_url');
		// console.log($('.recherche_service'));
		//recherche d'un service par click sur le bouton de recherche
		$('button.recherche_service').on('click', function() {
			
			init_search_service ();
		});

		//recherche d'un service en pressant la touche enter
		$('input.recherche_service').on('keyup', function(e) {
			
			 if (e.which === 13){

				init_search_service ();
			 }
		});



		function init_search_service () {
			 
			var service_name_input = $('#recherche_service').val();

			console.log('service input: '+service_name_input);

			if (service_name_input == "" || service_name_input == null) {

				$.ajax({
					url: site_url+'/Catalogue/services_display',
					method: 'POST',
					// data: {service_name_input: service_name_input},
					success: function(data) {

						// $('#bloc_service').html(data);
					}
				});
			}else
				$.ajax({
					url: site_url+'/Administration/search_service',
					method: 'POST',
					data: {service_name_input: service_name_input},
					success: function(data) {

						$('#bloc_service').fadeIn('1000').html(data);
					}
				});

		}

	});

</script>