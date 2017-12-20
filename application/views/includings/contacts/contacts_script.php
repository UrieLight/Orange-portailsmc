<script type="text/javascript" src="<?= $root_path ?>/js/contacts_script.js"></script>

<script>
	
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
	
</script>

<script>

	$(document).ready(function() {
		
		//activer la surbrillance lors d'un hover sur l'image d'un contact
		$('.img_contact').hover(function() {
			/* Stuff to do when the mouse enters the element */
			$(this).parent().next().children().css('color', '#ff6501');
			// console.log($(this).parent().next());
		});
		
		//desactiver la surbrillance lors d'un hover off sur l'image d'un contact
		$('.img_contact').mouseout(function() {
			/* Act on the event */

			$(this).parent().next().children().css('color', '#000');
		});

		//activer la surbrillance lors d'un hover sur le nom d'un contact
		$('.contact_name').hover(function() {
			/* Stuff to do when the mouse enters the element */
			$(this).css({
				color: '#ff6501',
				cursor: 'pointer'
			});
		});

		//desactiver la surbrillance lors d'un hover sur le nom d'un contact
		$('.contact_name').mouseout(function() {
			/* Stuff to do when the mouse enters the element */
			$(this).css({
				color: '#000',
				cursor: 'pointer'
			});
		});



		var site_url = $('#site_url').attr('site_url');
		// console.log($('.recherche_contact'));
		//recherche d'un contact par click sur le bouton de recherche
		$('button.recherche_contact').on('click', function() {
			
			init_search_contact ();
		});

		//recherche d'un contact en pressant la touche enter
		$('input.recherche_contact').on('keyup', function(e) {
			
			 if (e.which === 13){

				init_search_contact ();
			 }
		});



		function init_search_contact () {
			 
			var contact_name_input = $('#recherche_contact').val();

			console.log('contact input: '+contact_name_input);

			if (contact_name_input == "") {

				$.ajax({
					url: site_url+'/Contacts/contacts_display',
					method: 'POST',
					// data: {contact_name_input: contact_name_input},
					success: function(data) {

						// $('#bloc_contact').html(data);
					}
				});
			}else
				$.ajax({
					url: site_url+'/Contacts/search_contact',
					method: 'POST',
					data: {contact_name_input: contact_name_input},
					success: function(data) {

						$('#bloc_service').fadeIn('1000').html(data);
					}
				});
		}

	});

</script>