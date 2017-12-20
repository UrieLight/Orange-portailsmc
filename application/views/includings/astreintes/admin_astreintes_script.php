
<script type="text/javascript" src="<?= $root_path ?>/js/jquery-ui.min.js"></script>

<!-- script de la page des astreintes -->
<script rel="text/javascript" src="<?= $root_path ?>/js/admin_astreintes_script.js" /></script>

<script>
	
	$(document).ready(function($) {
		
		var site_url = $('#site_url').text();
		//au chargement de la page
		var mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
		var date = new Date();
		var current_year;
		var month_rang;
		var date_lundi;
		var date_dimanche;
		var month_chevauche_arriere
		var month_chevauche_arriere_rang;
		var month_chevauche_avant;
		var month_chevauche_avant_rang;
		var month_chevauche;
		var month_chevauche_rang;

		var semaine_nav = 0;

		date_displaying(date);

		//au chargement de la page, affichage du titre correspondant to the select tag value
		var select_service_displayed = $('#service_name').val();
		// console.log(select_service_displayed);
		$('#info_planning_title').text(select_service_displayed);

		// var rang_semaine = $('#calendar_select').datepicker( "option", "rang_semaine" );
		// console.log(rang_semaine);

		$.datepicker.setDefaults($.datepicker.regional['fr']);

		/*function function_name (argument) {
			 // body...  
		}*/
		$('input[id^="calendar_select_semaine"').datepicker({
			showOn: "button",
			buttonImage: "../../img/b_calendar.png",
			buttonImageOnly: true,
			/*showWeek: true,
			showOtherMonths: true,
	      	selectOtherMonths: true,*/
	      	onSelect: function () {
	      		// var dat = getDate();
	      		
			 	var showWeek = $( "#calendar_select" ).datepicker( "option", "showWeek" );
		  		var datepicked = $( "#calendar_select" ).datepicker( "getDate");

	      		//date_displaying(datepicked);
	    	}

		});

		function date_displaying (datepicked) {

			// console.log('function date_displaying called...');
	  		// console.log('datepicked: '+datepicked+' position dans la semaine: '+datepicked.getDay()+' Date: '+datepicked.getDate());
	  		//1,3,5,7,8,10,12//

	  		
	  		var mois_court_rang_array = [2,4,6,9,11];
	  		var test_mois_court = false;//initialisation du test de la longeur du mois
	  		var test_mois_prec_long = true;
			var current_day = datepicked.getDay();
			current_year = datepicked.getFullYear();
			// console.log('current_day: '+current_day);

			if(current_day == 0) 
				current_day = 7; 

			var current_date = datepicked.getDate();
			// console.log('current_date: '+current_date);
			month_chevauche_arriere = mois[datepicked.getMonth() - 1];

			month_chevauche_arriere_rang = datepicked.getMonth();
			if (month_chevauche_arriere_rang<10 && month_chevauche_arriere_rang>0)//pour gerer le format d'affichage 
				month_chevauche_arriere_rang = '0'+month_chevauche_arriere_rang;
			if (month_chevauche_arriere_rang == 0){//pour le mois de decembre 
				month_chevauche_arriere_rang = 12;
				// current_year = current_year - 1;
			} 

			if (datepicked.getMonth()==0) {month_chevauche_arriere = mois[11];}

			month_chevauche_avant = mois[datepicked.getMonth() + 1];

			month_chevauche_avant_rang = datepicked.getMonth() + 2;
			// console.log('month_chevauche_avant_rang: '+month_chevauche_avant_rang);

			if (month_chevauche_avant_rang == 13){//pour le mois de decembre 
				month_chevauche_avant_rang = 1;
				// current_year = current_year + 1;
			} 
			if (month_chevauche_avant_rang<10) {
				month_chevauche_avant_rang = '0'+month_chevauche_avant_rang;
			}
			// console.log('month_chevauche_avant_rang1: '+month_chevauche_avant_rang);

			if (datepicked.getMonth()==11) {month_chevauche_avant = mois[0];}

			month = mois[datepicked.getMonth()];
			month_chevauche = month;
			month_chevauche_rang = datepicked.getMonth()+1;

			month_rang = datepicked.getMonth() + 1;//console.log('month_rang: '+month_rang);
			if (month_rang<10 && month_rang>0) {
				month_rang = '0'+month_rang;
			}/*if (month_rang == 0){//pour le mois de decembre 
				month_rang = 12;
				current_year = current_year - 1;
			}*/

			date_lundi = current_date - current_day + 1; 
			date_dimanche = current_date + 7 - current_day;
			var mois_annee = month+' '+current_year;


			for (var i = 0; i < mois_court_rang_array.length; i++) {

				if (month_rang === mois_court_rang_array[i]) {//si ce mois est un mois court

					// console.log('mois_court_rang_array['+i+']: '+mois_court_rang_array[i]);
					test_mois_court = true;
						// console.log('mois court!!'+month_rang);

		      		break;//une fois les operations finished, on brise la boucle
				}
			}

			// console.log('mont_rang: '+month_chevauche_rang);
			// console.log('just before: '+month_chevauche_rang);
			// console.log('current_date: '+current_date+' date_dimanche: '+date_dimanche);
			if (current_date < 7 && date_lundi < 1) {
					
				// console.log('condition verified');
				var date_lundi_bad = date_lundi;

				month_chevauche = month_chevauche_arriere;

				// console.log('after: ');
				month_chevauche_rang = month_chevauche_arriere_rang;
				// console.log(month_chevauche_rang);
				

				if (!test_mois_court) {//si c'est un mois  de 31 jours

					// console.log(' ce mois est long');
					// console.log('month_rang = '+month_rang);
					for (var i = 0; i < mois_court_rang_array.length; i++) {

						if (month_rang-1 == mois_court_rang_array[i]) {//si ce mois est précédé par un mois de 30 jours
							
							// console.log('test_mois_prec = -31');
							test_mois_prec_long = false;
							break;
						}

					}

					//gestion des mois coming before...pouvant être des mois de 28 à 30 jours
			  		if (month_rang-1 == 2) {//si c'est le mois de février qui précède 

			  			// console.log(' mois prec = fevrier');
			      		//annee bisextile
			      		if ((current_year%4) == 0) {//si c'est une annee where fevrier has 29 jours  

			      			// console.log(' de 29 jours ');
			  	  			date_lundi = 29 + date_lundi_bad;

			  	  			if (date_dimanche>3) {

								month_chevauche = month_chevauche_avant;//_chevauche_arriere;
							}

			  	  			mois_annee = month_chevauche+' '+current_year; 
								
							change_date_arriere(date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang);
			      			display_by_the_server(date_lundi, month_rang, current_year);
			      			// console.log('bisextil year !!');
			      		}else {//si c'est une annee where February has 28 days 
			      			
			      			// console.log(' de 28 jours ');
			  	  			date_lundi = 28 + date_lundi_bad;

			  	  			if (date_dimanche>3) {

								month_chevauche = month_chevauche_avant;//_chevauche_arriere;
							}

			  	  			mois_annee = month_chevauche+' '+current_year; 
									
							change_date_arriere(date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang);
							display_by_the_server(date_lundi, month_rang, current_year);
			      		}
			  		}else {//si c'est un mois de 30 jours  qui précède 
			  			 
			  			// console.log(' mois qui precede a 30 jours ');
			  	  		date_lundi = 30 + date_lundi_bad;

			  	  		if (date_dimanche>3) {

							month_chevauche = month_chevauche_avant;//_chevauche_arriere;
						}

			  	  		mois_annee = month_chevauche+' '+current_year; 
						
						change_date_arriere(date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang);
						display_by_the_server(date_lundi, month_rang, current_year);
			  		}
			  		if (test_mois_prec_long) {

			  			// console.log(' mois qui precede a 31 jours ');
			  	  		date_lundi = 31 + date_lundi_bad;


						if (month_chevauche_rang == 12){//pour le mois de decembre 

				  	  		if (date_dimanche>3) {

								month_chevauche = month;
							}

				  	  		if (date_dimanche<4) {

								// month_chevauche = month;
								current_year = current_year - 1;
							}

						}

			  	  		mois_annee = month_chevauche+' '+current_year; 
						// console.log('alors, mois_annee: '+mois_annee);
						
						change_date_arriere(date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang);
						display_by_the_server(date_lundi, month_rang, current_year);
			  		}

				}else {//si c'est either un mois de 30 jours 
					
					// console.log(' ce mois est court');
			  	  	date_lundi = 31 + date_lundi_bad; 

			  	  	if (date_dimanche>3) {

						month_chevauche = month_chevauche_avant;//_chevauche_arriere;
					}

			  	  	mois_annee = month_chevauche+' '+current_year;
					// console.log(' mois_annee = '+mois_annee+' month_chevauche = '+month_chevauche);

					change_date_arriere (date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang);
					display_by_the_server(date_lundi, month_rang, current_year);
				}

			}else if (current_date > 22 && date_dimanche > 31) {//((current_date == 28 || current_date == 29 ||current_date == 30 || current_date == 31) && current_day < 7) 

				// console.log('condition verified');
				date_dimanche = 7 - current_day;

				month_chevauche = month_chevauche_avant;

				// console.log('after: ');
				month_chevauche_rang = month_chevauche_avant_rang
				// console.log(month_chevauche_rang);

				if (test_mois_court) {//si ce mois a moins de 31 jours

			  		if (month_rang == 2) {//si ce mois est celui de février 

			  			// console.log(' mois prec = fevrier');
			      		//annee bisextile
			      		if ((current_year%4) == 0) {//si c'est une annee where fevrier has 29 jours  

							// console.log('mois de 29 jours: ');
							if ((current_date > 23)) {

								// console.log('current_date > 23');
								date_dimanche = current_date - 22 - current_day;//7 - (29 - current_date) - current_day
								date_dimanche = '0'+date_dimanche;

								if (date_dimanche<4) {

									month_chevauche = month_chevauche_arriere;//_chevauche_arriere;
								}

					  	  		mois_annee = month_chevauche+' '+current_year;

					  	  		change_date_avant (date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang);
								display_by_the_server(date_lundi, month_rang, current_year);
							}
			      			// console.log('bisextil year !!');
			      		}else {//si c'est une annee where February has 28 days 

			  	  			// console.log('mois de 28 jours: ');
							if ((current_date > 22)) {

								// console.log('current_date > 22');
								date_dimanche = current_date - 21 - current_day;//7 - (28 - current_date) - current_day
								date_dimanche = '0'+date_dimanche;
					  	  		mois_annee = month_chevauche+' '+current_year;

					  	  		change_date_avant (date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang);
								display_by_the_server(date_lundi, month_rang, current_year);
							}
			      		}
			  		}else {//si c'est un mois de 30 jours   

			  			// console.log('mois de 30 jours: ');
						if ((current_date > 24)) {

							// console.log('current_date > 24');
							date_dimanche = current_date - 23 - current_day;//7 - (30 - current_date) - current_day
							date_dimanche = '0'+date_dimanche;
				  	  		mois_annee = month_chevauche+' '+current_year;

				  	  		change_date_avant (date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang);
							display_by_the_server(date_lundi, month_rang, current_year);
						}
			  		// }
			  		}
			  		

			  		// console.log('mois de moins de 31 jours: ');
				}else {//si c'est either un mois de 31 jours 
					
					// console.log('mois de 31 jours: ');
					if ((current_date > 25)) {

						// console.log('current_date > 25');
						date_dimanche = current_date - 24 - current_day;//7 - (31 - current_date) - current_day
						date_dimanche = '0'+date_dimanche;

						

						if (month_chevauche_rang == 01){//pour le mois de decembre 

							if (date_dimanche<4) {

								month_chevauche = month;//_chevauche_arriere;
							}

							if (date_dimanche>3) {

								//_chevauche_arriere;
								current_year = current_year + 1;
							}

						}

			  	  		mois_annee = month_chevauche+' '+current_year;

			  	  		change_date_avant (date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang);
						display_by_the_server(date_lundi, month_rang, current_year);
					}
					
				}
			}else {
				
				display_normal_date (date_lundi, month_rang, mois_annee, date_dimanche);
				display_by_the_server(date_lundi, month_rang, current_year);
			}  
		}

		//passage à la semaine précédente
		$('#semaine_prec').on('click', function() {
			// event.preventDefault();
			semaine_nav = 1;
			date_displaying (date);
			semaine_nav = 0;
		});

		//passage à la semaine précédente
		$('#semaine_suiv').on('click', function() {
			// event.preventDefault();
			semaine_nav = 2;
			date_displaying (date);
			semaine_nav = 0;
		});

		function change_date_arriere (date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang) {

			$('#mois_annee').html('<b>'+mois_annee+'</b>');
			$('#date_debut').html('<b>'+date_lundi+'/'+month_chevauche_rang+'</b> ');
			$('#date_fin').html('<b>'+date_dimanche+'/'+month_rang+'</b> ');
		}

		function change_date_avant (date_lundi, date_dimanche, month_chevauche_rang, mois_annee, month_rang) {

			$('#mois_annee').html('<b>'+mois_annee+'</b>');
			$('#date_debut').html('<b>'+date_lundi+'/'+month_rang+'</b> ');
			$('#date_fin').html('<b>'+date_dimanche+'/'+month_chevauche_rang+'</b> ');
		}

		function display_normal_date (date_lundi, month_rang, mois_annee, date_dimanche) {

			$('#mois_annee').html('<b>'+mois_annee+'</b>');
			$('#date_debut').html('<b>'+date_lundi+'/'+month_rang+'</b> ');
			$('#date_fin').html('<b>'+date_dimanche+'/'+month_rang+'</b> ');
		}

		//envoie des parameters de la period pour que le serveur la cherche dans la BD
		//et affiche les informations dans la page
		function display_by_the_server(date_lundi, month_rang, year) {
			
			var active_service = $('div .active').attr('id');
			// console.log(active_service);

			/*$.ajax({
				url: site_url+'/Astreintes/display_astreintes_'+active_service,
				method: 'POST',
				data: {
					date_lundi: date_lundi,
					month: month_rang,
					year: year
				},
				success: function (data) {

					console.log('server response: '+data);
					$('div #'+active_service).html(data);
					// console.log('End: ');
				}
			}); */
		}

		//masquage automatique de tous les plannings des services
		$('.service_planning').slideUp();

		//si un service a la classe active, il devient visible
		$('.active').slideDown();

		//changement du titre du planning-box
		//et affichage des informations sur le planning du service selected
		$('#service_name').on('change', function() {

			// console.log(' date_lundi = '+date_lundi+'. month = '+month+'. year'+current_year);

			var current_active_id = $('.active').attr('id');//taking the id of the current active bloc, to put hide it, on change
			// console.log('current_active_id: '+current_active_id);
			var id_service_selected;

			// event.preventDefault();
			var selected_service = $(this).val();
			// console.log('selected service: '+selected_service);

			//changement du titre du planning box
			$('#info_planning_title').text(selected_service);


			//hidding the current active div
			// $('div #'+current_active_id).removeClass('active');

			//parcours des diff chaines de soutiens dans la liste de selection des chaines
			$(this).children().each(function (index) {

				var this_option_selected = $(this).val();
				// console.log('option: '+this_option_selected);
				//récupérationi de l'id de l'option sélectionnée

				//en parcourant, on recherche dans la liste, l'option dont la valeur est equal to la valeur de la box de selection
				//cet à dire celle sélectionnée
				if ($(this).attr('value') == $('select[name=service_name').val()) {

					// id_service_selected = $(this).attr('id');
					var service_id = $(this).attr('class');
					


					//displaying the planning of the selected service
					/*$.ajax({
						url: site_url+'/Astreintes/display_astreintes_'+service_id,
						method: 'POST',
						data: {
							date_lundi: date_lundi,
							month: month_rang,
							year: current_year
						},
						success:function (data) {

							// console.log(data);
							$('div #'+service_id).slideDown(200, function() {

								$('div #'+service_id).html(data);
								console.log(data);
							});
						}
					});*/

					/*console.log('current_active_id onchange: '+current_active_id);
					console.log('service_id onchange: '+service_id);*/

					$('div #'+current_active_id).slideUp('200');
					$('div #'+current_active_id).removeClass('active');
					$('div #'+service_id).addClass('active');
					$('div #'+service_id).slideDown('200');
				}
			});		
			
		});
	});

</script>