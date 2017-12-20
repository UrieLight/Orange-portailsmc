<!-- 
	Script pour la page de creation 
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
		$('#bouton_confirmtn_creation_plateforme').prop('disabled', true).css({
				cursor: 'not-allowed'
		});

		$('#platform_nom').on('keyup', function() {
		
			if ($('#platform_nom').val() != "" ) {

				// console.log('pas de groupe de soutien');

				$('#bouton_confirmtn_creation_plateforme').prop('disabled', false).css({
					cursor: 'default'
				});
			}else{

				$('#bouton_confirmtn_creation_plateforme').prop('disabled', true).css({
					cursor: 'not-allowed'
				});
			}
		});



		var id_chaineselected = null;

		//affichage de la chaine de support selected //et de ses chaines d'escalades
		$('select[name=select_chaine_sout').on('change', (function(){

			//parcours des diff chaines de soutiens dans la liste de selection des chaines
			$(this).children().each(function () {

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
							$('div .chaine_select_pane').show(300, function (argument) {
								  $('#selected_chainsout').html('<br>'+data);
							});
							// alert('Chaine de soutien crée avec succès !!');
						}
					});

					//escalation chain displaying request
					/*$.ajax({
						url: '<= $site_url."/Administration/display_escalationchain"; ?>',
						method: "POST",
						data: {
							id_chaineselected: id_chaineselected
						},
						success:function (data) {

							// console.log(data);
							$('div .esc_chaine_select_pane').show('500', function (argument) {
								  $('div .esc_chaine_select_pane').html(data);
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
					Ajax, creation d'une nouvelle plate-forme
		\*==========									========== */

			var $site_url = $('#site_url').attr('class');

			$('#save_plateforme').on('click', function(event) {
				
				var platform_nom = $('#platform_nom').val();
	        	var platform_desc = $('#platform_desc').val();
	        	var platform_adresse = $('#platform_adresse').val();
	        	// var outils_supervision_plateforme = new Object();
	        	// console.log(outils_supervision_plateforme = $('#outils_supervision_plateforme').val());
				
				$.ajax({
	                url: $site_url+'/Plateforme/save_new_plateforme',
	                method: "POST",
	                data: {
	                    platform_nom: platform_nom,
	                    platform_desc: platform_desc,
	                    platform_adresse: platform_adresse,
	                    // outils_supervision_plateforme: outils_supervision_plateforme,
	                    id_chaineselected: id_chaineselected
	                },
	                success:function (data) {

	                    console.log(data);
	                    /*platform_nom = $('#platform_nom').val('');
						platform_constructeur = $('#platform_constructeur').val('');
						outils_supervision_plateforme = $('#outils_supervision_plateforme').val();*/
						alert('Plate-forme/outil créée avec succès !!');

						location.reload(true);
	                },
	                error: function() {
	                    alert('Echec de céation de la plate-forme/outil !!');
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