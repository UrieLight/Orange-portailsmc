$(document).ready(function($) {
	
	// var servic_nam = "";
	// var count_srvc_nm_disp = 0;
	$('.info_content').hide();

	//affichage des infos d'un service
	$('body').on('click','.plateforme_name, .plateforme_img img', function () {

		//div service_head parente du lien cliqué
		var $plateforme = $(this).parent().parent().parent();//Bloc d'un service dans le catalogue
		var $contenu = $plateforme.children('.service_info').children('.navs_content');//informations de chaque onglet

		$plateforme.children('.service_info').toggle(function () {
			//lorsque le contenu informatif s'affiche
			//recuperation de l'ancre du lien actif
			var tab_id = $plateforme.children('.service_info').children().children('.onglets_info').children('.active').children().attr('href');	
			$contenu.children(tab_id).show(500);	
		});
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


	//scroll de la page vers le haut
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
});