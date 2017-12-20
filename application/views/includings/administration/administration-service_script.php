<!-- 
	Script de creation d'un service
-->


<script type="text/javascript" src="<?= $root_path; ?>/js/go-debug.js"></script>

<script type="text/javascript" src="<?= $root_path; ?>/js/DragCreatingTool.js"></script>

<!-- <script type="text/javascript" src="<?= $root_path; ?>/js/chaines_script.js"></script> -->


<script type="text/javascript" >

	$(document).ready(function() {

		//désactivation du bouton de modification lorsqu'aucune modification n'a lieu
		$('#bouton_confirmtn_creation_service').prop('disabled', true).css({
			cursor: 'not-allowed'
		});

		//activation suivant les événements clés
		$('#service_name').on('keyup', function() {
			
			activate_the_confirm_button ();

			//si après la dernière touche clavier enfoncée, le nom est vide, on désactive le bouton, 
			//car un service doit avoir un nom
			if ($('#service_name').val() == "") {

				$('#bouton_confirmtn_creation_service').prop('disabled', true).css({
					cursor: 'not-allowed'
				});
				// $('#bouton_confirmtn_creation_service').attr('title', 'Remplissez les champs obligatoires');
				$('#bouton_confirmtn_creation_service').attr('title', 'Remplissez les champs obligatoires');
			}
		});

		//fonction d'activation des bouttons
		function activate_the_confirm_button () {
			
			 $('#bouton_confirmtn_creation_service').prop('disabled', false).css({
				cursor: 'default'
			});
		}




	
		//hide the responsable list when the input loses focus 
		$(document).on('click', '*', 
			function() {
				$('[id*=service_list]').on('focusout', 
					(function() {
						// console.log('@b\s');
						$('[id*=service_list]').slideUp(150);
					})
				);
			}
		); 

		var id_chaineselected;
		//affichage de la chaine de support selected //et de ses chaines d'escalades
		$('select[name=select_chaine_sout]').on('change', (function(){

			//parcours des diff chaines de soutiens dans la liste de selection des chaines
			$(this).children().each(function (index) {

				// console.log(this);
				//récupérationi de l'id de l'option sélectionnée

				//en parcourant, on recherche dans la liste, l'option dont la valeur est equal to la valeur de la box de selection
				//cet à dire celle sélectionnée
				if ($(this).attr('value') == $('select[name=select_chaine_sout').val()) {

					id_chaineselected = $(this).attr('id');

					//support chain displaying request
					$.ajax({
						url: '<?= $site_url."/Administration/display_selected_chainsout"; ?>',
						method: "POST",
						data: {id_chaineselected: id_chaineselected},
						success:function (data) {

							// console.log(data);
							$('div .chaine_select_pane').slideDown(300, function (argument) {
								  $('#selected_chainsout').html('<br>'+data);
							});
							// alert('Chaine de soutien crée avec succès !!');
						}
					});
				}
			});

			// $('.esc_chaine_select_pane').show(300);
			// $('#nom_chainesout_selected').append($(this).val());
		}));


		var id_architecture;
		//affichage de l'architecture selected
		$('select[name=architectur_select]').on('change', (function(){

			//parcours des diff chaines de soutiens dans la liste de selection des chaines
			$(this).children().each(function (index) {

				// console.log(this);
				//récupérationi de l'id de l'option sélectionnée

				//en parcourant, on recherche dans la liste, l'option dont la valeur est equal to la valeur de la box de selection
				//cet à dire celle sélectionnée
				if ($(this).attr('value') == $('select[name=architectur_select').val()) {

					id_architecture = $(this).attr('id');
					console.log('on change: '+id_architecture);

					//support chain displaying request
					/*$.ajax({
						url: '<?= $site_url."/Administration/display_selected_chainsout"; ?>',
						method: "POST",
						data: {id_architecture: id_architecture},
						success:function (data) {

							// console.log(data);
							$('div .chaine_select_pane').show(300, function (argument) {
								  $('#selected_chainsout').html('<br>'+data);
							});
							// alert('Chaine de soutien crée avec succès !!');
						}
					});*/
				}
			});

			// $('.esc_chaine_select_pane').show(300);
			// $('#nom_chainesout_selected').append($(this).val());
		}));



		/*==========  									========== *\
				actions sur les boutons de rafraichissements
		\*==========									========== */

			//evenement de click sur le bouton de rafraichissement de la liste des chaines de soutien
			$('#refresh_chainsout_list').on('click', function(event) {
				
				$.ajax({
					url: '<?= $site_url."/Administration/refresh_chainsout_list"; ?>',
					method: "POST",
					success:function (data) {

						// console.log(data);
						$('#select_chaine_sout').html(data);
					}
				});
			});

			
			//evenement de click sur le bouton de rafraichissement de la liste des plateformes
			$('#refresh_platesformes_list').on('click', function(event) {
				
				$.ajax({
					url: '<?= $site_url."/Administration/refresh_plateformes_list"; ?>',
					method: "POST",
					success:function (data) {

						// console.log(data);
						$('#plateformes').html(data);
					}
				});
			});


			//evenement de click sur le bouton de rafraichissement de la liste des outils
			$('#refresh_outils_list').on('click', function(event) {
				
				$.ajax({
					url: '<?= $site_url."/Administration/refresh_outils_list"; ?>',
					method: "POST",
					success:function (data) {

						// console.log(data);
						$('#outil').html(data);
					}
				});
			});


			//evenement de click sur le bouton de rafraichissement de la liste des architectures
			$('#refresh_architectur_list').on('click', function(event) {
				
				$.ajax({
					url: '<?= $site_url."/Administration/refresh_architectur_list"; ?>',
					method: "POST",
					success:function (data) {

						// console.log(data);
						$('#architectur_select').html(data);
					}
				});
			});



		/*==========  									========== *\
				action sur le bouton de creation d'un service
		\*==========									========== */

			$('#save_service').on('click', function(event) {
				
				// event.preventDefault();

				var service_name = $('input[name=service_name]').val();
				var service_desc = $('textarea[name=service_desc]').val();
				var service_chainsout_id = id_chaineselected;//$('select[name=select_chaine_sout').val();
				// console.log('id chaine: '+service_chainsout_id);
				var plateformes_selected = new Object();
				plateformes_selected = $('#plateformes').val();
				// console.log('platesformes: '+plateformes_selected);

				var outils_selected = new Object();
				outils_selected = $('#outil').val();
				// console.log('outils: '+outils_selected);

				// id_architecture = $('#id_architecture').val();
				console.log('just before saving the service: '+id_architecture);

				$.ajax({
					url: '<?= $site_url."/Administration/save_new_service"; ?>',
					method: "POST",
					data: {
						service_name: service_name,
						service_desc: service_desc,
						service_chainsout_id: service_chainsout_id,
						plateformes_selected: plateformes_selected,
						outils_selected: outils_selected,
						id_architecture: id_architecture
					},
					success:function (data) {

						console.log(data);
						$('input[name=service_name]').val('');
						$('textarea[name=service_desc]').val('');
						
						// alert('Service crée avec succès !!');
						$('#success_operation').modal();

						location.reload(true);
					},error: function() {
						/* Act on the event */
						$('.error_event').text('de la création du service');
						$('.erro_message').text(error);
						$('#error_dialog_window').modal();
					}
				});
			});
		
	});

</script>