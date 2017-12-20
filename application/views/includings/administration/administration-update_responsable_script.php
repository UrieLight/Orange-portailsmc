<!-- 
	Scripts de modification d'un membre d'escalade
-->
<script type="text/javascript" src="<?= $root_path; ?>/js/chaines_script.js"></script>


<script type="text/javascript" >

	$(document).ready(function() {


		/*==========  								========== *\
					Modification d'un responsable
		\*==========								========== */

			//remplissage prealable de champs
			$('#membre_nom_prenom').val($('#responsable_nomprenom').attr('value'));
			$('#membre_fonction').val($('#responsable_fonct').attr('value'));
			$('#membre_email').val($('#responsable_email').attr('value'));
			$('#membre_tel1').val($('#responsable_tel1').attr('value'));
			$('#membre_tel2').val($('#responsable_tel2').attr('value'));
			$('#membre_eds').val($('#responsable_eds').attr('value'));
			$('#membre_disponibility').val($('#responsable_disponibilite').attr('value'));


			//désactivation du bouton de modification lorsqu'aucune information princicpale n'a été renseignée
			$('#bouton_confirmtn_modification_responsable').prop('disabled', true).css({
				cursor: 'not-allowed'
			});

			
			$('#membre_nom_prenom, #membre_fonction, #membre_email, #membre_tel1').on('keyup', function() {
			
				if ($('#membre_nom_prenom').val() != "" && $('#membre_fonction').val() != "" && $('#membre_email').val() != "" && $('#membre_tel1').val() != "") {

					// console.log('pas de groupe de soutien');

					$('#bouton_confirmtn_modification_responsable').prop('disabled', false).css({
						cursor: 'default'
					});
				}else{

					$('#bouton_confirmtn_modification_responsable').prop('disabled', true).css({
						cursor: 'not-allowed'
					});
				}
			});


			$('#modifier_responsable').on('click', function(event) {

				//retrieving informations sur le groupe de soutien
				var new_resp_obj = {
					"responsable_nomprenom": $('#membre_nom_prenom').val(),
					"responsable_fonct": $('#membre_fonction').val(),
					"responsable_email": $('#membre_email').val(),
					"responsable_tel1": $('#membre_tel1').val(),
					"responsable_tel2": $('#membre_tel2').val(),
					"responsable_eds": $('#membre_eds').val(),
					"responsable_disponibilite": $('#membre_disponibility').val()
				}

				responsable_id = $('#responsable_id').val();

				// console.log(responsable_id_obj);

				//in javascript, array index starts to 1
				//test if the responsable array list isn't empty
				if(Object.keys(new_resp_obj).length != 0){

					$.ajax({
						url: '<?= $site_url."/Administration/save_responsable_updated_infos"; ?>',
						method: "POST",
						data: {
							new_resp_obj: new_resp_obj,
							responsable_id: responsable_id
						},
						success:function (data) {

							console.log(data);
							//emptying the inputs 
							/*$('#membre_nom_prenom').val('');
							$('#membre_fonction').val('');
							$('#membre_email').val('');
							$('#membre_tel1').val('');
							$('#membre_tel2').val('');
							$('#membre_eds').val('');
							$('#membre_disponibility').val('');*/
							// alert('Informations modifées avec succès !!');
							$('.success_operation').modal();

							//Redirection vers la page de la liste des membres
							window.location.assign('<?= $site_url."/Administration/membre_groupe_soutien_updating"; ?>');
						},
		                error: function() {
		                    // alert('Echec de modification des informations sur ce membre !!');
		                    $('.error_event').text('de la modification des informations de ce contact.');
		                    $('.erro_message').text(error);
		                    $('#error_dialog_window').modal();
		                }
					});
				}else
					console.log('Objet vide');

				//réinitialisation des champs de renseignements des informations dès que la requête est exécutée
				//$('#membre_nom_prenom, #membre_fonction, #membre_email, #membre_tel1, #membre_tel2, #membre_eds, #membre_disponibility').val('');
				//resetting the fields
				// console.log(JSON.parse(responsables_array));	
			});


	});

</script>