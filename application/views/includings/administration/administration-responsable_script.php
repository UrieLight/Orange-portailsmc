<!-- 
	Script Creation of support group
-->

<script type="text/javascript" src="<?= $root_path; ?>/js/chaines_script.js"></script>


<script type="text/javascript" >

	$(document).ready(function() {


		/*==========  								========== *\
				Création d'un nouveau groupe de soutien
		\*==========								========== */


			//désactivation du bouton de modification lorsqu'aucune information princicpale n'a été renseignée
			$('#bouton_confirmtn_creation_groupe_de_sout, #bouton_confirmtn_creation_responsable').prop('disabled', true).css({
				cursor: 'not-allowed'
			});

			//activation lors de la réception des informations minimales
			$('#groupe_nom, input[name^=responsable_esc]').on('keyup', function() {
			
				if ($('#groupe_nom').val() != "" && $('input[name^=responsable_esc]').val() != "") {

					// console.log('pas de groupe de soutien');

					$('#bouton_confirmtn_creation_groupe_de_sout').prop('disabled', false).css({
						cursor: 'default'
					});
				}else{

					$('#bouton_confirmtn_creation_groupe_de_sout').prop('disabled', true).css({
						cursor: 'not-allowed'
					});
				}
			});



			/*==========  															========== *\
					Ajax, autocompletion des inputs de creation du groupe de soutien
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

			//event on the responsableList li, fill the input textbox
			/*$(document).on('mouseup', '[id*="groupesout_list"] li', function() {

				// console.log('li for groupe de soutien input: '+groupesout_input_pos);

				var $body_for_this_li = $(this).parent().parent().parent().parent().parent();
				console.log($body_for_this_li);

				//remplacement du texte dans l'input par celui selected dans la liste des responsables, when clicked
				console.log($body_for_this_li.children(':first-child')
						.children().eq(groupesout_input_pos)
							.children('input').val($(this).text()));

				//retrieving of the li id
				//l'index de l'id d'un responsable est le same than his input position in the responsable list
				groupe_sout_id = $(this).attr('id');
				// console.log('groupe_sout_id: '+groupe_sout_id);

				//hide de responsable list dropped down
				var $div_groupes_sout_List_assoc = $(this).parent().parent();
				$div_groupes_sout_List_assoc.slideUp(150);
				
				var groupe_sout_id_string = 'groupsout'+groupesout_input_pos+'_id';
				// console.log('groupe_sout_id_string: '+groupe_sout_id_string);

				groupesout_id_obj.groupsout_list[groupe_sout_id_string] = groupe_sout_id;

				console.log('groupesout_id_obj on mouseup: '+groupesout_id_obj.groupsout_list[groupe_sout_id_string]);
				
			});*/

			//POUR LES RESPONSABLES DANS LES CHAINES D'ESCALADE
			var responsable_id_obj = {
										nom_chaine: "",
										responsables_list: {}
									};

			var resp_id_obj_new_one = {};

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
							.children('input').val($(this).text());
							// );

				//retrieving of the li id
				//l'index de l'id d'un responsable est le same than his input position in the responsable list
				responsable_id = $(this).attr('id');
				// console.log('id responsable clicked: '+responsable_id);



				//hide de responsable list dropped down
				var $div_responsableList_assoc = $(this).parent().parent();
				$div_responsableList_assoc.slideUp(150);
				
				var resp_id_string = 'responsable'+respnsbl_input_pos+'_id';
				
				responsable_id_obj.responsables_list[resp_id_string] = responsable_id;

				//affichage
				/*resp_id_obj_new_one[resp_id_string] = responsable_id;//object of resp id
				for (i in resp_id_obj_new_one) {
					// statement
					console.log('new resp obj: '+resp_id_obj_new_one[i]);
				}*/
				

				//LA GALERE
				// console.log('responsable_id_obj: '+responsable_id_obj);//[object ] [object]

				/*for (i in responsable_id_obj.responsables_list) {
					
					for (id in i) {
						// statement
						console.log('resp_ob_first_displ: '+i[id]);
					}					
				}*/
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



			/*==========  															========== *\
						Ajax, write in database nouveau groupe with its escalation matrix
			\*==========															========== */

			$('#creer_groupe_de_sout').on('click', function(event) {

				//retrieving informations sur le groupe de soutien
				var new_groupe_sout_obj = {
					"groupe_de_soutien_nom": $('#groupe_nom').val(),
					"groupe_de_soutien_pays": $('#groupe_localisation').val(),
					"groupe_de_soutien_disponibility": $('#groupe_disponibility').val(),
					"groupe_de_soutien_details": $('#groupe_other_info').val()
				}

				responsable_id_obj.nom_chaine = $('#desc_chainesc').val();

				/*for(var id in resp_id_obj_new_one){

					console.log('id: '+id);
				}*/

				// console.log(responsable_id_obj);

				//in javascript, array index starts to 1
				//test if the responsable array list isn't empty
				if(Object.keys(responsable_id_obj.responsables_list).length != 0){

					$.ajax({
						url: '<?= $site_url."/Administration/save_new_groupe_de_sout"; ?>',
						method: "POST",
						data: {
							new_groupe_sout_obj: new_groupe_sout_obj,
							responsable_id_obj: responsable_id_obj
						},
						success:function (data) {

							// console.log(data);
							/*$('#groupe_nom').val()
							$('#groupe_localisation').val('');
							$('#groupe_disponibility').val('');
							$('#groupe_other_info').val('');*/

							/*$('#esc_nouvelle_chaine').show('500', function () {
								 $('#chainesc_chainesout_id').attr('value', data);
							});*/


							//alert('Nouveau groupe de soutien crée avec succès !!');
							$('.success_event').text('Nouveau groupe de soutien créé avec succès');

							//nouvelle chaine d'escalade ?
							nouvelle_chainesc();
						},
		                error: function(error) {
		                    // alert('Echec de céation d\'un nouveau groupe de soutien !!'+error);
		                    $('.error_event').text('de la création du nouveau groupe de soutien');
		                    $('.erro_message').text(error);
		                    $('#error_dialog_window').modal();
		                }
					});
				}else
					console.log('Objet vide');

				//$('#groupe_nom, #groupe_localisation, #groupe_disponibility, #groupe_other_info, #desc_chainesc, input[id*="responsable_esc"').val('');
				//resetting the fields
				// console.log(JSON.parse(responsables_array));	
			});

			var id_last_group_created;

			//fonction pour le choix de création une nouvelle chaine d'escalade ou non
			function nouvelle_chainesc () {
				// body... 
				/*if (confirm('Voulez-vous créer une autre chaine d\'escalade pour ce groupe ?')) {

					last_group_created_id ();
					$('#extended_chain').modal();
				} else {

					location.reload(true);
				}*/

				//affichage boite de dialogue de choix de creation d'une nouvelle chaine d'escalade
				$('#nouvelle_chainesc_modal_dialog_window').modal();

				//si le user choisi d'en créer une autre
				$('#create_new_chainesc_ok').on('click', function() {
					// event.preventDefault();
					/* Act on the event */

					last_group_created_id ();

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


			//retriving the id of the last goup created
			function last_group_created_id () {

				$.ajax({
					url: '<?= $site_url."/Administration/controller_last_created_group_id"; ?>',
					type: 'POST',
					data: {},
					success: function (data) {
						
						id_last_group_created = data;
						console.log('id_last_group_created: '+id_last_group_created);

						// return data;
					}
				});

				/*console.log('again: '+id_last_group_created);*/
				// return id_last_group_created;				
			}

			//activation lors de la réception des informations minimales
			/*$('input[name*=Ext_responsable_esc]').on('keyup', function() {
			
				if ($('input[name*=Ext_responsable_esc]').val() != "") {

					// console.log('pas de groupe de soutien');

					$('#Ext_chaine_esc_termine').prop('disabled', false).css({
						cursor: 'default'
					});
				}else{

					$('#Ext_chaine_esc_termine').prop('disabled', true).css({
						cursor: 'not-allowed'
					});
				}
			});*/

			//
			/*$('#Ext_ajoute_col_esc').on('click', function(event) {
				
				$('#Ext_chaine_esc_termine').prop('disabled', true).css({
					cursor: 'not-allowed'
				});
			});*/

			//bonton terminé pour la création d'une nouvelle chaine d'escalde.
			$('#Ext_chaine_esc_termine').on('click', function(event) {
				// event.preventDefault();
				/* Act on the event */

				responsable_id_obj.nom_chaine = $('#Ext_desc_chainesc').val();
				
				var last_group_id;
				// last_group_created_id();
				last_group_id = id_last_group_created;
				console.log('Ext: '+last_group_id);

				/*for (var i in responsable_id_obj.responsables_list) {
					
					for (var id in i) {
						// statement
						console.log('resp_ob: '+Object.values(id));
					}
					
				}*/
				$.ajax({
						url: '<?= $site_url."/Administration/add_new_matrix_to_groupe_de_sout"; ?>',
						method: "POST",
						data: {
							last_group_id: last_group_id,
							responsable_id_obj: responsable_id_obj
						},
						success:function (data) {

							// alert('Nouvelle chaine crée avec succès !!');
							$('.success_event').text('Nouvelle chaine d\'escalade créée avec succès');

							//nouvelle chaine d'escalade ?
							nouvelle_chainesc();
						},
		                error: function(error) {
		                    // alert('Echec de céation d\'un nouveau groupe de soutien !!'+error);
		                    $('.error_event').text('de la création de la nouvelle chaine d\'escalade');
		                    $('.erro_message').text(error);
		                    $('#error_dialog_window').modal();
		                }
					});		
				// location.reload(true);
			});


		/*==========  								========== *\
					Création d'un nouveau responsable
		\*==========								========== */
		

			//verification que les champs obligatoires sont remplis
			$('#membre_nom_prenom, #membre_fonction, #membre_email, #membre_tel1').on('keyup', function() {
			
				if ($('#membre_nom_prenom').val() != "" && $('#membre_fonction').val() != "" && $('#membre_email').val() != "" && $('#membre_tel1').val() != "") {

					// console.log('pas de groupe de soutien');

					$('#bouton_confirmtn_creation_responsable').prop('disabled', false).css({
						cursor: 'default'
					});
				}else{

					$('#bouton_confirmtn_creation_responsable').prop('disabled', true).css({
						cursor: 'not-allowed'
					});
				}
			});



			//action de creation d'un nouveau responsable
			$('#creer_responsable').on('click', function(event) {

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

				// responsable_id_obj.nom_chaine = $('#desc_chainesc').val();

				// console.log(responsable_id_obj);

				//in javascript, array index starts to 1
				//test if the responsable array list isn't empty
				if(Object.keys(new_resp_obj).length != 0){

					$.ajax({
						url: '<?= $site_url."/Administration/save_new_responsable"; ?>',
						method: "POST",
						data: {
							new_resp_obj: new_resp_obj
						},
						success:function (data) {

							console.log(data);
							// alert('Nouveau membre créée avec succès !!');
							$('.success_event').text('Nouveau contact créé avec succès.');
							
							//emptying the inputs 
							$('#membre_nom_prenom').val('');
							$('#membre_fonction').val('');
							$('#membre_email').val('');
							$('#membre_tel1').val('');
							$('#membre_tel2').val('');
							$('#membre_eds').val('');
							$('#membre_disponibility').val('');

							// location.reload(true);
						},
		                error: function(error) {
		                    // alert('Echec de céation du nouveau membre !!');
		                    $('.error_event').text('de la création d\'un nouveau membre');
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