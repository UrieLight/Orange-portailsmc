$(document).ready(function($) {
	//choix de chaine nouvelle à créer./existance à sélectionner
	/*$('.radiobtn_chaine').change(function () {

		// console.log($(this).val());

		switch ($(this).val()) {//la variable de test contien le contenu de "value" de l'element

		 	case "nouvelle_chaine":
		 		$('.chaine_select_pane').hide(300, function () {
		 			 $('.nouvelle_chaine_pane').show(300);
		 			 $('.esc_chaine_select_pane').hide(300);
		 		});
		 		break;
		 	case "selection_chaine":
		 		$('.nouvelle_chaine_pane').hide(300, function () {
		 			 $('#esc_nouvelle_chaine').hide(300);
		 			 $('.chaine_select_pane').show(300);
		 		});
		 		break;
		 	default:
		 		// statements_def
		 		break;
		} 
	});*/


	//ajout dynamique de colonne au tableau de chaine de soutien
	$('#ajoute_col').click(function () {

		var $last_th = $(this).siblings('div').children('table').children('thead').children().children(':last-child');
		var $num_col = parseInt($last_th.attr("id"));
		/*
			var $last_th = $(this).siblings('.table_bloc').children('table').children('thead').children().children(':last-child');
			console.log($last_th);
			var $num_col = parseInt($last_th.attr("id"));
		*/

		if($num_col<7){

			$(this).siblings('.btn').removeClass('disabled');

			$num_col+=1;
			$last_th.after('<th id="'+$num_col+'">Niveau '+$num_col+' <span class="required_field" title="champ obligatoire">*</span></th>');
	
			var $last_td = $(this).siblings('div').children('table').children('tbody').children(':first-child').children(':last-child');
			$last_td.after('<td><br><input type="text" required="required" id="groupesout_sout'+$num_col+'" name="groupesout_sout'+$num_col+'" class="form-control groupesout_input"></td>');
			$last_td.parent().siblings().children().after('<td><div id="groupesout_list'+$num_col+'"></div></td>');

			//ajout d'une nouvelle chaine de'escalade pour un niveau de plus
			var content = $('.chaine_escalade .service_info_content').children(':last-child');
			// console.log(content);
			// ajoute_nouvelle_chaine_esc (content, $num_col);
		}else {
			// alert('nombre maximal de colonnes autorisées, atteint !!');
			$(this).addClass('disabled');
		}
	});


	//ajout dynamique de colonne au tableau de chaine d'escalade
	$('span[id^=ajoute_col_esc]').click(function () {
		// alert('Abs');

		var $last_th = $(this).siblings('div').children('table').children('thead').children().children(':last-child');
		var $num_col = parseInt($last_th.attr("id"));

		console.log('ajout_norm; ');

		if($num_col<7){

			$(this).siblings('.btn').removeClass('disabled');

			$num_col+=1;
			$last_th.after('<th id="'+$num_col+'">Niveau '+$num_col+' <span class="required_field" title="champ obligatoire">*</span></th>');
	
			/*var $last_td = $(this).siblings('div').children('table').children('tbody').children().children(':last-child');
			$last_td.after('<td><input type="text" name="responsable_esc'+$num_col+'" class="form-control"></td>');*/

			var $last_td = $(this).siblings('div').children('table').children('tbody').children(':first-child').children(':last-child');
			$last_td.after('<td><br><input autocomplete="off"  type="text" required="required" id="responsable_esc'+$num_col+'" name="responsable_esc'+$num_col+'" class="form-control respnble_input"></td>');
			$last_td.parent().siblings().children().after('<td><div id="responsable_list'+$num_col+'"></div></td>');

		}else {
			// alert('nombre maximal de colonnes autorisées, atteint !!');
			$(this).addClass('disabled');
		}
	});


	//suppression dynamique de colonne au tableau de chaine de soutien et d'escalade
	$('#sup_col, #sup_col_esc, #Ext_sup_col_esc').click(function () {

		var $last_th = $(this).siblings('div').children('table').children('thead').children().children(':last-child');//ici on recupere la derniere entete de colonne
		var $num_col = parseInt($last_th.attr("id"));//on utilise l'id pour definir le nombre de colonnes.

		if($num_col>1){

			$(this).siblings('.btn').removeClass('disabled');//il n'y a que 2 btn dans ce bloc, donc l'autre est actif, on le deactive donc.

			$last_th.remove();
	
			var $last_td = $(this).siblings('div').children('table').children('tbody').children().children(':last-child');
			$last_td.remove();
		}else {
			// alert('nombre maximal de colonnes autorisées, atteint !!');
			$(this).addClass('disabled');
		}
	});



	/*==========  															========== *\
				Script for the behaving of the extended escalation chain
	\*==========															========== */

		//ajout dynamique de colonne au tableau de chaine d'escalade d'extension
		$('#Ext_ajoute_col_esc').click(function () {
			// alert('Abs');

			var $last_th = $(this).siblings('div').children('table').children('thead').children().children(':last-child');
			var $num_col = parseInt($last_th.attr("id"));

			console.log('ajout_ext; ');

			if($num_col<7){

				$(this).siblings('.btn').removeClass('disabled');

				$num_col+=1;
				$last_th.after('<th id="'+$num_col+'">Niveau '+$num_col+' <span class="required_field" title="champ obligatoire">*</span></th>');
		
				/*var $last_td = $(this).siblings('div').children('table').children('tbody').children().children(':last-child');
				$last_td.after('<td><input type="text" name="responsable_esc'+$num_col+'" class="form-control"></td>');*/

				var $last_td = $(this).siblings('div').children('table').children('tbody').children(':first-child').children(':last-child');
				$last_td.after('<td><br><input autocomplete="off"  type="text" required="required" id="Ext_responsable_esc'+$num_col+'" name="Ext_responsable_esc'+$num_col+'" class="form-control respnble_input"></td>');
				$last_td.parent().siblings().children().after('<td><div id="Ext_responsable_list'+$num_col+'"></div></td>');

			}else {
				// alert('nombre maximal de colonnes autorisées, atteint !!');
				$(this).addClass('disabled');
			}
		});

});