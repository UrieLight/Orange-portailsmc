$(document).ready(function($) {
	
	var site_url = $('#site_url').attr('class');


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
						url: site_url+'/Administration/search_group_de_soutien',
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

		//hide de responsable list dropped down
		var $div_groupes_sout_List_assoc = $(this).parent().parent();
		$div_groupes_sout_List_assoc.slideUp(150);
		
		var groupe_sout_id_string = 'groupsout'+groupesout_input_pos+'_id';
		// console.log('groupe_sout_id_string: '+groupe_sout_id_string);

		groupesout_id_obj.groupsout_list[groupe_sout_id_string] = groupe_sout_id;

		console.log('groupesout_id_obj on mouseup: '+groupesout_id_obj.groupsout_list[groupe_sout_id_string]);
		
	});
});