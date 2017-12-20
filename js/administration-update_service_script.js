/*
	Script pour la page de modification d'un service
*/

$(document).ready(function($) {
	
	//désactivation du bouton de modification lorsqu'aucun groupe n'a été sélectionné//bouton_confirmtn_modification_service
	$('#bouton_confirmtn_modification_service').prop('disabled', true).css({
		cursor: 'not-allowed'
	});

	//activation suivant les événements clés
	$('#service_name').on('keyup', function() {
		

		//si après la dernière touche clavier enfoncée, le nom est vide, on désactive le bouton, 
		//car un service doit avoir un nom
		if ($('#service_name').val() == "") {

			$('#bouton_confirmtn_modification_service').prop('disabled', true).css({
				cursor: 'not-allowed'
			});
			// $('#bouton_confirmtn_modification_service').attr('title', 'Remplissez les champs obligatoires');
			// $('#bouton_confirmtn_modification_service').attr('title', 'Remplissez les champs obligatoires(*)');
		}else {
			
			activate_the_confirm_button ();
		}
	});

	$('#select_chaine_sout, #architectur_select').on('change', function() {
		// event.preventDefault();
		/* Act on the event */
		if ($('#service_name').val() == "") {

			$('#bouton_confirmtn_modification_service').prop('disabled', true).css({
				cursor: 'not-allowed'
			});
			// $('#bouton_confirmtn_modification_service').attr('title', 'Remplissez les champs obligatoires');
			// $('#bouton_confirmtn_modification_service').attr('title', 'Remplissez les champs obligatoires(*)');
		}else {
			
			activate_the_confirm_button ();
		}
	});

	$('#outil, #plateformes').on('mouseup', function() {
		// event.preventDefault();
		/* Act on the event */
		if ($('#service_name').val() == "") {

			$('#bouton_confirmtn_modification_service').prop('disabled', true).css({
				cursor: 'not-allowed'
			});
			// $('#bouton_confirmtn_modification_service').attr('title', 'Remplissez les champs obligatoires');
			// $('#bouton_confirmtn_modification_service').attr('title', 'Remplissez les champs obligatoires(*)');
		}else {
			
			activate_the_confirm_button ();
		}
	});



	//fonction d'activation des bouttons
	function activate_the_confirm_button () {
		
		 $('#bouton_confirmtn_modification_service').prop('disabled', false).css({
			cursor: 'default'
		});
	}



	var site_url = $('#site_url').attr('class');//

	var id_chainsout_first_service;
	id_chainsout_first_service = $('select[name=list_of_services_to_update]').children(':first-child').attr('id_chainesout');//);//.first());

	initialisation_selected_chainesout (id_chainsout_first_service);
	chaine_sout_display (id_chainsout_first_service);

	// $('select[name=select_chaine_sout] option[id=1]').attr('selected', 'selected');

	/*$('input[name="service_name_to_update"').off('click');

	$(document).on('click', '#service_name_to_update', function() {

		// console.log('this service_name_to_update: '+$(this));//test

		//recherche du service
		$('#service_name_to_update').on('keyup', 
			
			function() {

				// console.log('service_name_to_update on keyup: '+$(this));//test

				var nom_service = $(this).val();
				// console.log(nom_service);

				$.ajax({
					url: site_url+'/Administration/search_service',
					//type: 'default GET (Other values: POST)',
					//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
					method: "POST",
					data: {nom_service: nom_service},
					success:function (data) {

						// console.log(data);
						$('#service_list').slideDown(200, function() {
							$('#service_list').html(data);
						});
					}
				});
			}
		);

	});

	$('.ul_service_list li').on('mouseup', function() {
		
		console.log('li for service input: '+$(this));
	});*/

	// var id_chaineselected;
	var id_chainesout_serviceSelected = null;
	var possede_chainesout;

	//affichage de la description de la chaine de support selected
	//changing selecting the service to update
	$('select[name=list_of_services_to_update]').on('change', (function(){

		//puting the name of the selected service in the service name input field
		$('.new_service_name').val($(this).val());

		//parcours des diff services pour qfficher la chaines de soutiens dans 
		//la liste de selection des chaines, correspondant au service actif
		$(this).children().each(function () {

			// console.log(this);
			//récupération de l'id de l'option sélectionnée

			//en parcourant, on recherche dans la liste, l'option dont la valeur est equal to la valeur de la box de selection
			//cet à dire celle sélectionnée
			if ($(this).attr('value') == $('select[name=list_of_services_to_update').val()) {//on cherche l'option équivalente à la valeur de la sélection, pour afficher la chaine de soutien

				// console.log('option found, now searching attributes.');

				var id_serviceSelected = $(this).attr('id');
				var desc_serviceSelected = $(this).attr('service_desc');
				id_chainesout_serviceSelected = $(this).attr('id_chainesout');
				// console.log('id_chainesout_serviceSelected on service chang: '+id_chainesout_serviceSelected);

				//remplacement de la description du service selected dans le textarea
				$('#service_desc').html(desc_serviceSelected);

				//removing the selected attribute
				/*
					$('select[name=select_chaine_sout]').children().each(function() {
						
						if ($(this).attr('selected') == "selected") {
							$(this).removeAttr('selected');// attr('selected', ''); 
						}
					});
				*/

				//support chain displaying request
				$('select[name=select_chaine_sout]').children().each(function() {//puutting the name of the correspondant chainsout name on the chainsout select tag, and displaying the chain
					
					possede_chainesout = false;

					if ($(this).attr('id') == id_chainesout_serviceSelected) {

						$('select[name=select_chaine_sout]').val($(this).attr('value'));//forcing the chainsout select list to display the name of the chaine sout of this service
						$(this).prop('selected', 'selected');//or putting the select attribute to "selected"
						// console.log($(this).attr('value'));

						chaine_sout_display(id_chainesout_serviceSelected);//calling the function displaying the chain
						// console.log('appel de la fonction d\'affichage de la chaine de soutien');

						possede_chainesout = true;
					}

					//si le service selected n'a pas de chaine de soutien, on met du vide
					if (!possede_chainesout) {
						// console.log('ce service n\'a pas de chaine de soutien...');
						$('select[name=select_chaine_sout]').val('');
						$('#selected_chainsout').hide(200);
					}

				});

				// console.log('id_chainesout: '+id_chainesout_serviceSelected);
			}
		});

		if ($('#service_name').val() == "") {

			$('#bouton_confirmtn_modification_service').prop('disabled', true).css({
				cursor: 'not-allowed'
			});
			// $('#bouton_confirmtn_modification_service').attr('title', 'Remplissez les champs obligatoires');
			// $('#bouton_confirmtn_modification_service').attr('title', 'Remplissez les champs obligatoires(*)');
		}

	}));

	//function called at the loading of the page
	function initialisation_selected_chainesout (id_chaineselected) {
		
		var possede_chainesout = false;

		$('.new_service_name').val($('select[name=list_of_services_to_update]').val());//puting the name of the selected service in the service name input field

		$('select[name=select_chaine_sout]').children().each(function() {
					
			if ($(this).attr('id') == id_chaineselected) {

				$('select[name=select_chaine_sout]').val($(this).attr('value'));
				
				chaine_sout_display(id_chaineselected);

				possede_chainesout = true;
			}

			//si le service selected n'a pas de chaine de soutien, on met du vide
			if (!possede_chainesout) {
				$('select[name=select_chaine_sout]').val('');
				$('#selected_chainsout').hide(200);
			}		
		});
	}


	function chaine_sout_display (id_chaineselected) {
		
		// console.log('Fonction d\'affichage de la chaine de soutien called');

		$.ajax({
			url: site_url+'/Administration/display_selected_chainsout',
			method: 'POST',
			data: {id_chaineselected: id_chaineselected},
			success:function (data) {

				//console.log(data);
				$('#selected_chainsout').slideDown(300, function () {
					  $('#selected_chainsout').html('<br>'+data);
				});
				// alert('Chaine de soutien crée avec succès !!');
			}
		}); 
	}

	//affichage de la chaine de soutien dans la partie de modification des chaine de soutien, au changement + mise a jour de l'id de la chaine de soutien
	$('select[name=select_chaine_sout]').on('change', function(event) {
		
		// event.preventDefault();
		//support chain displaying 
		$('select[name=select_chaine_sout]').children().each(function() {//puutting the name of the correspondant chainsout name on the chainsout select tag, and displaying the chain
			
			// possede_chainesout = false;
			// chaine_sout_display(id_chainesout_serviceSelected);
			

			if ($(this).attr('value') == $('select[name=select_chaine_sout]').val()) {
				
				id_chainesout_serviceSelected = $(this).attr('id');
				chaine_sout_display($(this).attr('id'));
				/*$('select[name=select_chaine_sout]').val($(this).attr('value'));//forcing the chainsout select list to display the name of the chaine sout of this service
				$(this).prop('selected', 'selected');//or putting the select attribute to "selected"
				// console.log($(this).attr('value'));
				//calling the function displaying the chain
				console.log('appel de la fonction d\'affichage de la chaine de soutien');

				possede_chainesout = true;*/

			}

			//si le service selected n'a pas de chaine de soutien, on met du vide
			/*if (!possede_chainesout) {
				console.log('ce service n\'a pas de chaine de soutien...');
				$('select[name=select_chaine_sout]').val('');
				$('#selected_chainsout').hide(200);
			}*/

		});
		// chaine_sout_display(id_chainesout_serviceSelected);
	});


	/*==========  												========== *\
				action sur le bouton de modification d'un service
	\*==========												========== */

		$('#update_service').on('click', function(event) {
			
			// event.preventDefault();

			var service_id;
			$('select[name="list_of_services_to_update"]').children().each(function() {
				
				// $(this).children().each(function () {
					
					// console.log('option: '+$(this));
					if ($(this).attr('value') == $('select[name=list_of_services_to_update').val())
						// console.log('2- selection de l\'id de la chaine de soutien');
						service_id = $(this).attr('id');// == id_chainesout_serviceSelected) {
					
				// });

			});
			
			var service_name = $('input[name=service_name]').val();
			var service_desc = $('textarea[name=service_desc]').val();
			var service_chainsout_id;// = id_chaineselected;//$('select[name=select_chaine_sout').val()

			// console.log('test');
			//retrieving id of chainsout selected or active
			/*$('select[name="select_chaine_sout"]').children().each(function() {
				
				// $(this).children().each(function () {
					
					// console.log('option: '+$(this));
					if ($(this).attr('value') == $('select[name=select_chaine_sout').val())
						// console.log('2- selection de l\'id de la chaine de soutien');
						service_chainsout_id = $(this).attr('id');// == id_chainesout_serviceSelected) {
					
				// });

			});*/

			// console.log('id chaine: '+service_chainsout_id);
			var plateformes_selected = new Object();
			plateformes_selected = $('#plateformes').val();
			/*console.log('platesformes: '+Object.keys(plateformes_selected));
			for (plateforme in plateformes_selected) {
				console.log('in: '+plateforme);
			}*/

			var outils_selected = new Object();
			outils_selected = $('#outil').val();
			// console.log('outils: '+outils_selected);

			var id_architecture;
			$('select[name=architectur_select]').children().each(function () {
				
				//récupérationi de l'id de l'option sélectionnée

				//en parcourant, on recherche dans la liste, l'option dont la valeur est equal to la valeur de la box de selection
				//cet à dire celle sélectionnée
				if ($(this).attr('value') == $('select[name=architectur_select').val()) {

					id_architecture = $(this).attr('id');
					// console.log('on change: '+id_architecture);
				}

				// $('.esc_chaine_select_pane').show(300);
				// $('#nom_chainesout_selected').append($(this).val());
			});

			// id_architecture = $('#id_architecture').val();
			/*console.log('service_name: '+service_name);
			console.log('service_desc: '+service_desc);
			console.log('service_chainsout_id: '+service_chainsout_id);
			console.log('plateformes_selected: '+plateformes_selected);
			console.log('outils_selected: '+outils_selected);
			console.log('id_architecture: '+id_architecture);*/

			$.ajax({
				url: site_url+'/Administration/update_service',
				method: "POST",
				data: {
					service_id: service_id,
					service_name: service_name,
					service_desc: service_desc,
					service_chainsout_id: id_chainesout_serviceSelected,
					plateformes_selected: plateformes_selected,
					outils_selected: outils_selected,
					id_architecture: id_architecture
				},
				success:function (data) {

					console.log(data);
					/*$('input[name=service_name]').val('');
					$('textarea[name=service_desc]').val('');*/
					
					// alert('Service Modifé avec succès !!');
					$('#success_operation').modal();

					//rechargement de la page
					location.reload(true);
				},error: function() {
					/* Act on the event */
					$('.error_event').text('de la modification du service');
					$('.erro_message').text(error);
					$('#error_dialog_window').modal();
				}
			});
		});


	/*==========  									========== *\
			actions sur les boutons de rafraichissements
	\*==========									========== */

		//evenement de click sur le bouton de rafraichissement de la liste des chaines de soutien
		$('#refresh_chainsout_list').on('click', function(event) {
			
			$.ajax({
				url: site_url+'/Administration/refresh_chainsout_list',
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
				url: site_url+'/Administration/refresh_plateformes_list',
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
				url: site_url+'/Administration/refresh_outils_list',
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
				url: site_url+'/Administration/refresh_architectur_list',
				method: "POST",
				success:function (data) {

					// console.log(data);
					$('#architectur_select').html(data);
				}
			});
		});

});