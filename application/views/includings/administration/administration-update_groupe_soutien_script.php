<!-- 
- Script inclus dans la page de modification des goupes de soutien
-->

<script type="text/javascript" src="<?= $root_path; ?>/js/chaines_script.js"></script>
<!-- <script type="text/javascript" src="<= $root_path; ?>/js/groupe_soutien_update.js"></script> -->

<script>

	$(document).ready(function($) {
		
		//désactivation du bouton de modification lorsqu'aucun groupe n'a été sélectionné
		$('#bouton_confirmtn_modification_groupe_de_sout, #bouton_confirmtn_modification_chainesc_groupe_de_sout').prop('disabled', true).css({
				cursor: 'not-allowed'
		});

		// $('select[name=select_groupe_sout_to_update]').on('change', function() {
		$('#groupe_nom, #groupe_localisation, #groupe_disponibility, #groupe_other_info').on('keyup', function() {
			
			// event.preventDefault();
			/* Act on the event */
			// si le nom du groupe n'a pas 
			if ($('#groupe_nom').val() != "" && $('select[name=select_groupe_sout_to_update]').val() != "") {

				$('#bouton_confirmtn_modification_groupe_de_sout').prop('disabled', false).css({
					cursor: 'default'
				});
			}else
				$('#bouton_confirmtn_modification_groupe_de_sout').prop('disabled', true).css({
					cursor: 'not-allowed'
				});
		});




		
		var site_url = $('#site_url').attr('class');

		$('#groupe_nom').val($('select[name=select_groupe_sout_to_update]').val());//puting the name of the selected groupsout inside the groupsout name input field

		var id_groupe_selected;

		//initialisation de l'id du groupe de soutien sélectionné
		$('select[name=select_groupe_sout_to_update]').children().each(function (index) {

			if ($(this).attr('value') == $('select[name=select_groupe_sout_to_update]').val()) {

				id_groupe_selected = $(this).attr('id');
			}
		});
		

		var id_chainesc;
		//affichage de la chaine d'escalade du groupe selected 
		$('select[name=select_groupe_sout_to_update]').on('change', (function(){

			$('#groupe_nom').val($(this).val());//puting the name of the selected chainsout in the chainsout name input field
			// id_chainesc = $('input[name="id_chainesc"]').attr('id');
			id_chainesc = $('#id_chainesc').attr('id_chainesc');
			// console.log('1- id chaine escalade: '+id_chainesc);

			//parcours des diff gourpes de soutiens dans la liste de selection des groupes
			$(this).children().each(function () {

				// console.log(this);

				//en parcourant, on recherche dans la liste, l'option dont la valeur est equal to la valeur de la box de selection
				//cet à dire celle sélectionnée
				if ($(this).attr('value') == $('select[name=select_groupe_sout_to_update]').val()) {

					$('#groupe_localisation').val($(this).attr('pays'));
					$('#groupe_disponibility').val($(this).attr('disponibilite'));
					$('#groupe_other_info').val($(this).attr('detail'));


					
					id_groupe_selected = $(this).attr('id');
					// console.log('id_groupe_selected: '+id_groupe_selected);
					//support chain displaying request
					$.ajax({
						url: site_url+'/Administration/display_selected_groupesout_chainesc',
						method: "POST",
						data: {id_groupe_selected: id_groupe_selected},
						success:function (data) {

							// console.log(data);
							$('#selected_groupesout').slideDown(300, function () {
								 $('#selected_groupesout').html('<br><br>'+data);
							});
						}
					});
				}
			});
		}));


		/*==========  															========== *\
				Ajax, autocompletion des inputs de modification du groupe de soutien
		\*==========															========== */


		var respnsbl_input_pos;

		//ajax autocompletion responsable name
		$(document).on('click', 'input', function() {

			//autocompletion des responsables dans la chaine d'escalade
			$('.respnble_input').on('keyup', 
				
				function() {

					respnsbl_input_pos = $(this).parent().index();
					// console.log(respnsbl_input_pos);

					var nom_responsable = $(this).val();
					var $div_responsableList_assoc = $(this).parent().parent().siblings().children(':eq('+respnsbl_input_pos+')').children('div');//div correspondant at the cell just under the input field
					// console.log(div_responsableList_assoc);

					if(nom_responsable != ''){

						$.ajax({
							url: '<?= $site_url."/Administration/search_responsable"; ?>',
							//type: 'default GET (Other values: POST)',
							//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
							method: "POST",
							data: {nom_responsable: nom_responsable},
							success:function (data) {

								// console.log(data);
								$div_responsableList_assoc.slideDown(200, function() {
									$div_responsableList_assoc.html(data);
								});
							}
						});
					}
				}
			);
		});
		
		//POUR LES RESPONSABLES DANS LES CHAINES D'ESCALADE
		var responsable_id_obj = {
									groupe_nom: "",
									responsables_list: {}
								};

		// alert(typeof(responsable_id_obj));

		//event on the responsableList li, fill the input textbox
		$(document).on('mouseup', '[id*="responsable_list"] li', function() {

			// console.log('li for input: '+respnsbl_input_pos);

			var $body_for_this_li = $(this).parent().parent().parent().parent().parent();
			// console.log($body_for_this_li);

			//remplacement du texte dans l'input par celui selected dans la liste des responsables, when clicked
			// console.log(
				$body_for_this_li.children(':first-child')
					.children().eq(respnsbl_input_pos)
						.children('input').val($(this).text());//);

			//retrieving of the li id
			//l'index de l'id d'un responsable est le same than his input position in the responsable list
			responsable_id = $(this).attr('id');
			// console.log(responsable_id);

			//hide de responsable list dropped down
			var $div_responsableList_assoc = $(this).parent().parent();
			$div_responsableList_assoc.slideUp(150);
			
			var resp_id_string = 'responsable'+respnsbl_input_pos+'_id';
			
			responsable_id_obj.responsables_list[resp_id_string] = responsable_id;

			// console.log('chaine non vide');
			//activation du boutton de modification de chaine d'escalade si l'object recieve des données
			$('#bouton_confirmtn_modification_chainesc_groupe_de_sout').prop('disabled', false).css({cursor: 'default'});
			// console.log(responsable_id_obj);
			
		});


		//hide the responsable list when the input loses focus 
		$(document).on('click', '*', 
			function() {
				$('[id*=responsable_esc]').on('focusout', 
					(function() {
						// console.log('@b\s');
						$('[id*=responsable_list]').slideUp(150);
					})
				);
			}
		); 



		/*==========  												========== *\
					Ajax, write in database info update of groupe 
		\*==========												========== */

		$('#modifier_groupe_de_sout').on('click', function(event) {

			//retrieving informations sur le groupe de soutien
			var update_groupe_sout_obj = {
				"groupe_de_soutien_nom": $('#groupe_nom').val(),
				"groupe_de_soutien_pays": $('#groupe_localisation').val(),
				"groupe_de_soutien_disponibility": $('#groupe_disponibility').val(),
				"groupe_de_soutien_details": $('#groupe_other_info').val()
			}

			//var groupe_de_soutien_id = //id du groupe de soutien to update

			// responsable_id_obj.groupe_nom = $('#desc_chainesc').val();

			// console.log(responsable_id_obj);

			//in javascript, array index starts to 1
			//test if the responsable array list isn't empty
			/*if(Object.keys(responsable_id_obj.responsables_list).length != 0){*/

				$.ajax({
					url: site_url+'/Administration/update_groupe_de_sout',
					method: "POST",
					data: {
						id_groupe_selected: id_groupe_selected,
						update_groupe_sout_obj: update_groupe_sout_obj
					},
					success:function (data) {

						// console.log(data);
						$('#groupe_nom').val()
						$('#groupe_localisation').val('');
						$('#groupe_disponibility').val('');
						$('#groupe_other_info').val('');

						$('#selected_groupesout').slideDown(300, function () {
							 $('#selected_groupesout').html('');
						});

						$('select[name=select_groupe_sout_to_update]').children().eq(1).prop('selected', 'selected');

						// alert('Groupe de soutien modifié avec succès !!');
						$('.success_operation').modal();//text('Groupe de soutien modifié avec succès');

						location.reload(true);
					},
	                error: function() {
	                    // alert('Echec de modification du groupe de soutien !!');
	                    $('.error_event').text('de la  modification du groupe de soutien.');
	                    $('.erro_message').text(error);
	                    $('#error_dialog_window').modal();
	                }
				});
			/*}else
				console.log('Objet vide');*/

			$('#groupe_nom, #groupe_localisation, #groupe_disponibility, #groupe_other_info').val('');
			// console.log(//val('');
			//resetting the fields
			// console.log(JSON.parse(responsables_array));	
		});



		/*==========  															========== *\
					Ajax, write in database escalation matrix of groupe info update
		\*==========															========== */



		//if inputs are empty, deactivate the button
		/*if($('input[id^="responsable_esc"]').val() == "")
			$('#bouton_confirmtn_modification_chainesc_groupe_de_sout').prop('disabled', true).css({cursor: 'not-allowed'});
		else
			$('#bouton_confirmtn_modification_chainesc_groupe_de_sout').prop('disabled', false).css({cursor: 'default'});*/

		//validation of the update
		$('#modifier_chainesc_groupe_de_sout').on('click', function(event) {

			// var groupe_de_soutien_id = //id du groupe de soutien to update

			responsable_id_obj.groupe_nom = $('#desc_chainesc').val();

			id_chainesc = $('#id_chainesc').attr('id_chainesc');
			// console.log('2- id chaine escalade: '+id_chainesc);

			//in javascript, array index starts to 1
			//test if the responsable array list isn't empty
			if(Object.keys(responsable_id_obj.responsables_list).length != 0){

				$.ajax({
					url: site_url+'/Administration/update_chainesc_groupe_de_sout',
					method: "POST",
					data: {
						id_groupe_selected: id_groupe_selected,
						id_chainesc: id_chainesc,
						responsable_id_obj: responsable_id_obj
					},
					success:function (data) {

						// console.log(data);
						$('#selected_groupesout').slideDown(300, function () {
							 $('#selected_groupesout').html('');
						});

						$('select[name=select_groupe_sout_to_update]').children().eq(1).prop('selected', 'selected');

						$('#esc_nouvelle_chaine').show('500', function () {
							 $('#chainesc_chainesout_id').attr('value', data);
						});
						// alert('Chaine d\'escalade modifiée avec succès !!');

						// location.reload(true);
						nouvelle_chainesc();
					},
	                error: function(error) {
	                    // alert('Echec de modification de la chaine d\'escalade du groupe!!'+error);
	                    $('.error_event').text('de la modification de la chaine d\'escalade du groupe.');
	                    $('.erro_message').text(error);
	                    $('#error_dialog_window').modal();
	                }
				});
			}else
				console.log('Objet vide');


			//fonction pour demander s'il y a besoin de créer une nouvelle chaine d'escalade
			function nouvelle_chainesc () {
				
				//affichage boite de dialogue de choix de creation d'une nouvelle chaine d'escalade
				$('#nouvelle_chainesc_modal_dialog_window').modal();

				//si le user choisi d'en créer une autre
				$('#create_new_chainesc_ok').on('click', function() {
					// event.preventDefault();
					/* Act on the event */

					// last_group_created_id ();

					//reinitialisation de l'objet des ids des responsables
					responsable_id_obj = {
										nom_chaine: "",
										responsables_list: {}
									};

					//réinitialisation de la fenêtre modale d'édition d'une nouvelle chaine d'escalade
					$('.ext_modal_chainesc_table').html('<thead><tr><th id="1">Niveau 1 <span class="required_field" title="champ obligatoire">*</span></th></tr></thead><tbody class="list_respsbl_input esc"><tr><td ><br><input autocomplete="off" type="text" id="Ext_responsable_esc1" name="Ext_responsable_esc1" clas="form-control respnble_input" ><!-- onkeyUp="autocomplet()" --></td></tr><tr><td><div id="Ext_responsable_list1"></div></tbody>');
					//('<tr><td ><br><input autocomplete="off" type="text" id="Ext_responsable_esc1" name="Ext_responsable_esc1" class="form-control respnble_input" ><!-- onkeyUp="autocomplet()" --></td></tr><tr><td><div id="Ext_responsable_list1"></div></tr>');

					//affichage de la fenêtre d'édition d'une nouvelle chaine d'escalade
					$('#extended_chain').modal();//or make an append
				});

				//si le user ne veut plus en créer
				$('#discard_create_new_chainesc').on('click', function() {
					// event.preventDefault();
					/* Act on the event */
					location.reload(true);
				});
			}
			
			//bonton terminé pour l'ajout d'une nouvelle chaine d'escalde.
			$('#Ext_chaine_esc_termine').on('click', function(event) {

				console.log('click sur bouton termine: ');
				responsable_id_obj.groupe_nom = $('#Ext_desc_chainesc').val();
				
				$.ajax({
						url: '<?= $site_url."/Administration/add_new_matrix_to_groupe_de_sout"; ?>',
						method: "POST",
						data: {
							last_group_id: id_groupe_selected,
							responsable_id_obj: responsable_id_obj
						},
						success:function (data) {

							// alert('Nouvelle chaine crée avec succès !!');
							console.log('data group update new: '+data);

							//nouvelle chaine d'escalade ?
							nouvelle_chainesc();
						},
		                error: function(error) {
		                    // alert('Echec de céation d\'un nouvelle chaine du groupe de soutien !!'+error);
		                    $('.error_event').text('de la céation d\'un nouvelle chaine de contact du groupe de soutien.');
		                    $('.erro_message').text(error);
		                    $('#error_dialog_window').modal();
		                }
					});		
				// location.reload(true);
			});



			$('#groupe_nom, #groupe_localisation, #groupe_disponibility, #groupe_other_info, #desc_chainesc, input[id*="responsable_esc"').val('');
			// console.log($('select[name=select_groupe_sout_to_update]').children().eq(1).prop('selected', 'selected'));//val('');
			//resetting the fields
			// console.log(JSON.parse(responsables_array));	
		});

		//astuce pour appliquer le jquery sur les elements ajoutés dynamiquement
		$(document).on('click', 'span[id^="modif_chainesc"]', function() {
			// event.preventDefault();
			/* Act on the event */
			console.log($(this));
			
		});


		var id_of_chainesc_to_delete;

		$(document).on('click', 'span[id^="suppr_chainesc"]', function() {
			// event.preventDefault();
			/* Act on the event */
			// console.log('bouton de suppression '+this.getAttribute('chainesc_groupsout_id'));
			id_of_chainesc_to_delete = this.getAttribute('chainesc_groupsout_id');
			$('#delete_chain').modal();//or make an append
		});

		$('#delete_chainesc_ok').on('click', function() {
			// event.preventDefault();
			/* Act on the event */

			// console.log('id_of_chainesc_to_delete: '+id_of_chainesc_to_delete);
			$.ajax({
				url: '<?= $site_url."/Administration/delete_matrix_from_groupe_de_sout"; ?>',
				method: "POST",
				data: {
					id_of_chainesc_to_delete: id_of_chainesc_to_delete
				},
				success:function (data) {

					// alert('Nouvelle chaine crée avec succès !!');
					console.log('suppression chaine ok: '+data);
					$('#successul_deletion').modal();
					location.reload(true);
					//nouvelle chaine d'escalade ?
					// nouvelle_chainesc();
				},
                error: function(error) {
                    // alert('Echec de céation d\'un nouvelle chaine du groupe de soutien !!'+error);
                    $('.error_event').text('de la suppression de chaine d\'escalade.');
                    $('.erro_message').text(error);
                    $('#error_dialog_window').modal();
                }
			});
		});







		//actions suivant le clic sur le bouton d'ajout d'une nouvelle chaine d'escalade au groupe
		$(document).on('click', 'span[id^="ajouter_chaine_escalade"]', function() {
			// event.preventDefault();
			/* Act on the event */

			//affichage de la fenêtre d'édition d'une nouvelle chaine d'escalade
			$('#extended_chain').modal();//or make an append
		});

		//action suivant le clic sur le bouton de validation de la nouvelle chaine d'escalade à ajouter au groupe
		$('#Ext_chaine_esc_termine').on('click', function(event) {

			// console.log('click sur bouton termine: ');
			responsable_id_obj.groupe_nom = $('#Ext_desc_chainesc').val();
			
			$.ajax({
					url: '<?= $site_url."/Administration/add_new_matrix_to_groupe_de_sout"; ?>',
					method: "POST",
					data: {
						last_group_id: id_groupe_selected,
						responsable_id_obj: responsable_id_obj
					},
					success:function (data) {

						// alert('Nouvelle chaine crée avec succès !!');
						console.log('data group update new: '+data);
						$('#successul_adding').modal();
						location.reload(true);
						//nouvelle chaine d'escalade ?
						// nouvelle_chainesc();
					},
	                error: function(error) {
	                    // alert('Echec de céation d\'un nouvelle chaine du groupe de soutien !!'+error);
	                    $('.error_event').text('de la céation d\'un nouvelle chaine de contact du groupe de soutien.');
	                    $('.erro_message').text(error);
	                    $('#error_dialog_window').modal();
	                }
				});		
			// location.reload(true);
		});


	});
</script>