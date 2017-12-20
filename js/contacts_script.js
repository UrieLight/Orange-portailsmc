$(document).ready(function($) {
	
	var servic_nam = "";
	var count_srvc_nm_disp = 0;

	//affichage des infos d'un service
	$('body').on('click','.contact_name, .contact_img img', function () {

		//div service_head parente du lien cliqué
		var $contact = $(this).parent().parent().parent();//Bloc d'un service dans le catalogue
		var $contenu = $contact.children('.service_info').children('.navs_content');//informations de chaque onglet

		$contact.children('.service_info').toggle(function () {
			//lorsque le contenu informatif s'affiche
			//recuperation de l'ancre du lien actif
			var tab_id = $contact.children('.service_info').children().children('.onglets_info').children('.active').children().attr('href');	
			$contenu.children(tab_id).show(500);	
		});
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