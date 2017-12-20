<!-- 
	Script pour la page de mise a jour 
	d'une plateforme
-->
<script>
	
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
	
</script>

<script type="text/javascript" >

	$(document).ready(function() {														



		//désactivation du bouton de modification lorsqu'aucun groupe n'a été sélectionné//
		$('#bouton_confirmtn_modification_plateforme').prop('disabled', true).css({
				cursor: 'not-allowed'
		});

		$('#platform_nom').on('keyup', function() {
		
			if ($('#platform_nom').val() != "" ) {

				// console.log('pas de groupe de soutien');

				$('#bouton_confirmtn_modification_plateforme').prop('disabled', false).css({
					cursor: 'default'
				});
			}else{

				$('#bouton_confirmtn_modification_plateforme').prop('disabled', true).css({
					cursor: 'not-allowed'
				});
			}
		});


		//lors de la modification de la liste des outils, on active le 
		//bouton de validation si le non de la plateforme est non vide
		$('#platform_desc').on('keyup', function() {
			// event.preventDefault();
			/* Act on the event */
			if ($('#platform_nom').val() != "" ) {

				// console.log('pas de groupe de soutien');

				$('#bouton_confirmtn_modification_plateforme').prop('disabled', false).css({
					cursor: 'default'
				});
			}else{

				$('#bouton_confirmtn_modification_plateforme').prop('disabled', true).css({
					cursor: 'not-allowed'
				});
			}

		});
		
		$('#platform_adresse').on('keyup', function() {
			// event.preventDefault();
			/* Act on the event */
			if ($('#platform_nom').val() != "" ) {

				// console.log('pas de groupe de soutien');

				$('#bouton_confirmtn_modification_plateforme').prop('disabled', false).css({
					cursor: 'default'
				});
			}else{

				$('#bouton_confirmtn_modification_plateforme').prop('disabled', true).css({
					cursor: 'not-allowed'
				});
			}

		});

		$('select[name="select_plateforme"]').on('change', function() {
			// event.preventDefault();
			if ($('#platform_nom').val() != "" ) {

				// console.log('pas de groupe de soutien');

				$('#bouton_confirmtn_modification_plateforme').prop('disabled', false).css({
					cursor: 'default'
				});
			}else{

				$('#bouton_confirmtn_modification_plateforme').prop('disabled', true).css({
					cursor: 'not-allowed'
				});
			}
		});


		var plateforme_selected_id;
		var id_chaineselected;
		//retrieving on change de l'id de la plateforme selected
		$('select[name="select_plateforme"]').on('change', function() {
			// event.preventDefault();
			/* Act on the event */
			var plateforme_selected = $(this).val();
			// console.log('plateforme: '+plateforme_selected);
			//going through all the options to find the one having the 
			//same value than the value of the select tag
			$(this).children().each(function() {
				
				// console.log($(this).attr('value'));
				if ($(this).attr('value') == plateforme_selected) {

					plateforme_selected_id = $(this).attr('id');
					id_chaineselected = $(this).attr('id_chainsout');
					// console.log($(this).attr('id_chainsout'));
					chaine_sout_display(id_chaineselected);

					//remplissage des champs de textes avec les donnees deja en bases, pour etre modifiees
					$('#platform_nom').val($(this).val());
					$('#platform_desc').val($(this).attr('description'));
					$('#platform_adresse').val($(this).attr('url_connexion'));
				}
			});
		});




		//affichage de la chaine de support selected //et de ses chaines d'escalades
		//on change de la chaine de soutien
		$('select[name=select_chaine_sout').on('change', (function(){

			//parcours des diff chaines de soutiens dans la liste de selection des chaines
			$(this).children().each(function (index) {

				// console.log(this);
				//récupération de l'id de l'option sélectionnée

				//en parcourant, on recherche dans la liste, l'option dont la valeur est equal to la valeur de la box de selection
				//cet à dire celle sélectionnée
				if ($(this).attr('value') == $('select[name=select_chaine_sout').val()) {

					id_chaineselected = $(this).attr('id');

					//support chain displaying request
					chaine_sout_display(id_chaineselected);
				}
			});
		}));



		function chaine_sout_display (id_chaineselected) {
			
			// console.log('chainsout display request');
			// console.log('Fonction d\'affichage de la chaine de soutien called');

			$.ajax({
				url: '<?= $site_url."/Administration/display_selected_chainsout"; ?>',
				method: "POST",
				data: {id_chaineselected: id_chaineselected},
				success:function (data) {

					// console.log(data);
					$('#selected_chainsout').show(300, function (argument) {
						  $('#selected_chainsout').html('<br>'+data);
					});
					// alert('Chaine de soutien crée avec succès !!');
				}
			});
		}



		/*==========  									========== *\					
					Ajax, creation d'une nouvelle plate-forme
		\*==========									========== */

		var $site_url = $('#site_url').attr('class');

		$('#update_plateforme').on('click', function(event) {
			
			var platform_nom = $('#platform_nom').val();
        	var platform_desc = $('#platform_desc').val();
        	var platform_adresse = $('#platform_adresse').val();
        	// var outils_supervision_plateforme = $('#outils_supervision_plateforme').val();
			
			$.ajax({
                url: $site_url+'/Plateforme/update_plateforme',
                method: "POST",
                data: {
                    plateforme_selected_id : plateforme_selected_id,
                    platform_nom: platform_nom,
                    platform_desc: platform_desc,
                    platform_adresse: platform_adresse,
                    id_chaineselected: id_chaineselected
                },
                success:function (data) {

                    // console.log(data);
					alert('Plate-forme modifiée avec succès !!');

					location.reload(true);
                },
                error: function() {
                    alert('Echec de modification de la plate-forme !!');
                }
        	});

		});

		/*==========  									========== *\
			actions sur les boutons de rafraichissements
		\*==========									========== */

			//evenement de click sur le bouton de rafraichissement de la liste des chaines de soutien
			$('#refresh_chainsout_list').on('click', function(event) {
				
				$.ajax({
					url: $site_url+'/Administration/refresh_chainsout_list',
					method: "POST",
					success:function (data) {

						// console.log(data);
						$('#select_chaine_sout').html(data);
					}
				});
			});

	});

</script>