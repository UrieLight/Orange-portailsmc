
<!-- <script type="text/javascript" src="<= $root_path; ?>/js/administration-update_service_script.js"></script> -->

<script>

	$(document).ready(function($) {
		
		//désactivation du bouton de modification lorsqu'aucune chaine n'a été sélectionnée
		$('#bouton_confirmtn_modification_chainesout').prop('disabled', true).css({
				cursor: 'not-allowed'
		});

		/*$('select[name=select_chaine_sout]').on('change', function() {
			
			// event.preventDefault();
			if ($('select[name=select_chaine_sout]').val() != "") {

				$('#bouton_confirmtn_modification_chainesout').prop('disabled', false).css({
					cursor: 'default'
				});
			}else
				$('#bouton_confirmtn_modification_chainesout').prop('disabled', true).css({
						cursor: 'not-allowed'
				});
		});*/

		$('#nom_chaine, input[name^=groupesout_sout]').on('keyup', function() {
		
			if ($('#nom_chaine').val() != "" && $('input[name^=groupesout_sout]').val() != "") {

				console.log('pas de groupe de soutien');

				$('#bouton_confirmtn_modification_chainesout').prop('disabled', false).css({
					cursor: 'default'
				});
			}else{

				$('#bouton_confirmtn_modification_chainesout').prop('disabled', true).css({
					cursor: 'not-allowed'
				});
			}
		});


		
		

		
		var site_url = $('#site_url').attr('class');

		$('#nom_chaine').val($('select[name=select_chaine_sout]').val());//puting the name of the selected chainsout inside the chainsout name input field

		var id_chaineselected;

		//initialisation de l'id de la chaine de soutien sélectionnée
		$('select[name=select_chaine_sout]').children().each(function (index) {

			if ($(this).attr('value') == $('select[name=select_chaine_sout').val()) {

				id_chaineselected = $(this).attr('id');
			}
		});
		

		//affichage de la chaine de support selected //et de ses chaines d'escalades
		$('select[name=select_chaine_sout]').on('change', (function(){

			$('#nom_chaine').val($(this).val());//puting the name of the selected chainsout in the chainsout name input field

			//parcours des diff chaines de soutiens dans la liste de selection des chaines
			$(this).children().each(function () {

				// console.log(this);
				//récupérationi de l'id de l'option sélectionnée

				//en parcourant, on recherche dans la liste, l'option dont la valeur est equal to la valeur de la box de selection
				//cet à dire celle sélectionnée
				if ($(this).attr('value') == $('select[name=select_chaine_sout').val()) {

					id_chaineselected = $(this).attr('id');
					// console.log('id_chaineselected: '+id_chaineselected);
					//support chain displaying request
					$.ajax({
						url: site_url+'/Administration/display_selected_chainsout',
						method: "POST",
						data: {id_chaineselected: id_chaineselected},
						success:function (data) {

							// console.log(data);
							$('#selected_chainsout').slideDown(300, function () {
								 $('#selected_chainsout').html('<br>'+data);
							});
							// alert('Chaine de soutien crée avec succès !!');
						}
					});
				}
			});
		}));


		/*==========  															========== *\
					Ajax, autocompletion des inputs de creation de chaine de soutien
		\*==========															========== */


		var groupesout_input_pos;
		
		//listening to the DOM, when clicked in an input, 
		//for the groups list, seacrch in DB on keyup event 
		$(document).on('click', 'input', function() {

			//recherche des groupes de soutien
			$('.groupesout_input').on('keyup', 
				
				function() {

					groupesout_input_pos = $(this).parent().index();
					// console.log(groupesout_input_pos);

					var nom_groupesout = $(this).val();
					var $div_groupesoutList_assoc = $(this).parent().parent().siblings().children(':eq('+groupesout_input_pos+')').children('div');//div correspondant at the cell just under the input field
					// console.log(div_groupesoutList_assoc);

					if(nom_groupesout != ''){

						$.ajax({
							url: '<?= $site_url."/Administration/search_group_de_soutien"; ?>',
							//type: 'default GET (Other values: POST)',
							//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
							method: "POST",
							data: {nom_groupesout: nom_groupesout},
							success:function (data) {

								// console.log(data);
								$div_groupesoutList_assoc.slideDown(200, function() {
									$div_groupesoutList_assoc.html(data);
								});
							}
						});
					}
				}
			);
		});


		var groupesout_id_obj = {
									nom_chaine: "",
									groupsout_list: {}
								};
		//event on the GroupList li, fill the input textbox
		$(document).on('mouseup', '[id*="groupesout_list"] li', function() {

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

			//hide the responsable list dropped down
			var $div_groupes_sout_List_assoc = $(this).parent().parent();
			$div_groupes_sout_List_assoc.slideUp(150);
			
			var groupe_sout_id_string = 'groupsout'+groupesout_input_pos+'_id';
			// console.log('groupe_sout_id_string: '+groupe_sout_id_string);

			groupesout_id_obj.groupsout_list[groupe_sout_id_string] = groupe_sout_id;

			console.log('groupesout_id_obj on mouseup: '+groupesout_id_obj.groupsout_list[groupe_sout_id_string]);
			
		});




		/*==========  													========== *\
				action sur le bouton de modification d'une chaine de soutien
		\*==========													========== */
		

		$('#update_chaine_sout').on('click', function(event) {

			groupesout_id_obj.nom_chaine = $('#nom_chaine').val();
			console.log('groupesout_id_obj.nom_chaine onCreate: '+groupesout_id_obj.nom_chaine);

			//in javascript, array index starts to 1
			//test if the responsable array list isn't empty
			if((Object.keys(groupesout_id_obj.groupsout_list).length != 0) && (groupesout_id_obj.nom_chaine != "")){

				$.ajax({
					url: site_url+'/Administration/update_chainsout',
					method: "POST",
					data: {
						id_chaineselected: id_chaineselected,
						groupesout_id_obj: groupesout_id_obj
					},
					success:function (data) {

						console.log(data);

						$('#nom_chaine').val('');

						alert('Chaine de soutien modifiée avec succès !!');

						location.reload(true);
					},
	                error: function() {
	                    alert('Echec de modification de la chaine de soutien !!');
	                }
				});
			}else{
				console.log('Chaine vide.');
				alert('Veuillez remplir tous les champs !');
			}

			/*$('#nom_chaine, input[id*="groupesout_sout"').val('');
			$('select[name=select_chaine_sout').val('');*/
			// console.log(JSON.parse(responsables_array));	
		});
	});

</script>

