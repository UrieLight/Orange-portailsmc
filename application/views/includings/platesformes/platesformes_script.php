<script type="text/javascript" src="<?= $root_path ?>/js/plateformes_script.js"></script>

<script>
	
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
	
</script>

<script>

	$(document).ready(function() {
		
		var site_url = $('#site_url').attr('site_url');
		// console.log($('.recherche_plateforme'));
		//recherche d'un contact par click sur le bouton de recherche
		$('button.recherche_plateforme').on('click', function() {
			
			init_search_plateforme ();
		});

		//recherche d'un contact en pressant la touche enter
		$('input.recherche_plateforme').on('keyup', function(e) {
			
			 if (e.which === 13){

				init_search_plateforme ();
			 }
		});



		function init_search_plateforme () {
			 
			var platform_name_input = $('#recherche_plateforme').val();

			console.log('plateformes input: '+platform_name_input);

			if (platform_name_input == "") {

				platform_name_input = " ";
				$.ajax({
					url: site_url+'/Plateforme/search_plateforme',
					method: 'POST',
					data: {platform_name_input: platform_name_input},
					success: function(data) {

						// $('#bloc_contact').html(data);
					}
				});
			}else
				$.ajax({
					url: site_url+'/Plateforme/search_plateforme',
					method: 'POST',
					data: {platform_name_input: platform_name_input},
					success: function(data) {

						$('#bloc_service').fadeIn('1000').html(data);
					}
				});
		}

	});

</script>