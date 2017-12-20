$(document).ready(function () {

	//hidding all content, by default
	$('.info_content').hide();

	var servic_nam = "";
	var count_srvc_nm_disp = 0;

	//affichage des infos d'un service
	$('body').on('click','.service_name, .service_img img', function () {

		//div service_head parente du lien cliqué
		var $service = $(this).parent().parent().parent();//Bloc d'un service dans le catalogue
		var $contenu = $service.children('.service_info').children('.navs_content');//informations de chaque onglet

		$service.children('.service_info').toggle(function () {
			//lorsque le contenu informatif s'affiche
			//recuperation de l'ancre du lien actif
			var tab_id = $service.children('.service_info').children().children('.onglets_info').children('.active').children().attr('href');	
			$contenu.children(tab_id).show(500);	
		});


		//test retrieve service name in JS
		servic_nam = $(this).text();//lecture du nom du service
		//console.log(servic_nam);

		if (count_srvc_nm_disp === 0 ) {

			var $this_architecture_info = $contenu.children('#architecture span');
			$this_architecture_info.text(servic_nam);

			// console.log(count_srvc_nm_disp);
			count_srvc_nm_disp = 1;//valeur diff de zero pour ne plus rentrer
								   //dans la boucle, et donc n'afficher le nom du service qu'une fois
		}
	});

	//affichage du contenu d'un onglet
	$('body').on('click', '.onglet_info', function () {

	 	var $service =  $(this).parent().parent().parent().parent().parent();
	 	var $onglets_info = $(this).parent().parent();
	 	var li = $(this).parent();
	 	var tab_id = $(this).attr('href');
	 	var $contenu = $service.children('.service_info').children('.navs_content');
	 	// console.log($contenu);

	 	//on n'fait rien si l'onglet est already active; un onglet est actif s'il possess la classe "active", et inactif,
	 	//n'a pas de classe; la seule classe est "active". soit les listes l'ont, soit elles ne l'ont pas.
	 	if(li.attr("class")){
	 		return false;
	 	}

	 	//retriving prev_tab_content id
	 	var prev_active_id = $onglets_info.children('.active').children().attr("href");

	 	//disabling active tab by removing the active class
	 	$onglets_info.children('.active').removeClass('active');

	 	//if this is the tab of escalation, then lets display the level of the escalation
	 	// console.log($contenu.children('.niveau_soutien'));
	 	if (tab_id === "#chainesc") {

	 		$contenu.children('.niveau_soutien').show();//css("display", "none");// show(300);//$('.niveau_soutien')
	 	}else {

	 		$contenu.children('.niveau_soutien').hide();//css("display", "none"); //attr('') //hide();//$('.niveau_soutien')
	 	}

	 	// activating curreint tab
	 	li.addClass('active');
		
		//masquage du contenu actuellement actif	
		$contenu.children(prev_active_id).hide(0);

	 	//affichag du contenu de l'onglet activated
		$contenu.children(tab_id).slideDown(500);
	});


	//affichage informations d'une plate-forme selectionnée en fenêtre modale
	$('.chaines_platesformes').on('click', function () {
		var pltform_name = $(this).html();
			 // alert('Hey, @b\'s');
	});



	//affichage de la chaine d'escalade correspondant au niveau de la chaine de soutien 
	// où on a cliqué (dans) en dessous de la chaine de soutien
	var site_url = $('#site_url').attr('site_url');


	$(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
    
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
	/*$('#chainesout td').on('click', function() {

		var nom_responsable_pour_affich_escalade = $(this).children().children('p').children('.nom_responsable').text();
		var groupe_sout_id = $(this).children().children('p').children('#groupe_sout_id').attr('value');
		var after_chainsout_table = $(this).parent().parent().parent();
		// console.log(groupe_sout_id);

		/*$.ajax({
			url: site_url+'/catalogue/escation_of_chainsout_level_selected/',
			method: 'POST',
			data: {nom_responsable_pour_affich_escalade: nom_responsable_pour_affich_escalade},
			success: function (data) {
				
				$('#chainesc_of_this_level_support_content').html(data); 
				// console.log('level soutien: '+data);
			}
		});*/
		
	//});*/




	//fonctionnalité de Recherche d'un service
	/*$('.groupesout_input').on('keyup', 
				
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
	);*/
});
