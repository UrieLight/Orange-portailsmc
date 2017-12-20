
<script type="text/javascript" src="<?= $root_path; ?>/js/bootstrap-multiselect.js"></script>

<script >
	/*
	$('.searchable').multiSelect({
	    selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
	    selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"4\"'>",
	    afterInit: function(ms){
	    var that = this,
	        $selectableSearch = that.$selectableUl.prev(),
	        $selectionSearch = that.$selectionUl.prev(),
	        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
	        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

	    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	    .on('keydown', function(e){
	        if (e.which === 40){
		        that.$selectableUl.focus();
		        return false;
	        }
	    });

	    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	    .on('keydown', function(e){
		        if (e.which == 40){
		        that.$selectionUl.focus();
		        return false;
	        }
	    });
	    },
	    afterSelect: function(){
	    	this.qs1.cache();
	    	this.qs2.cache();
	    },
	    afterDeselect: function(){
		    this.qs1.cache();
		    this.qs2.cache();
	    }
	});*/

	$(document).ready(function() {

		var site_url = $('#site_url').text();
		//console.log(site_url);

		/*==========  									========== *\
				Etapes d'association d'un service à une famille
		\*==========									========== */

			
			/*défnintion de la liste déroulante avec multiselection, s'affichant dans le html dynamiquement*/

	        $('#select_liste_des_services').multiselect({

	            enableFiltering: true,
	            includeSelectAllOption: true,
	            selectAllJustVisible: false
	        });


	        $('#liste_des_services').on('click', function() {
	        	//event.preventDefault();
		        /* Act on the event */

				//console.log('Les services selected sont: '+services_selected);
	        });

	        //evenement de click sur le bouton pour afficher les familles (to be associated to the selected services)
			$('#btn_for_modal_window_services_families_list').on('click', function(event) {
				/*
				$.ajax({
					url: '<= $site_url."/Administration/refresh_services_family_list"; ?>',
					method: "POST",
					success:function (data) {

						// console.log(data);
						$('.family_checkbox').html(data);
					}
				});
				*/
				//return false;
			});


			$('#btn_terminer_associer_services_familles').on('click', function() {
				// event.preventDefault();
				/* Act on the event */
		        var services_selected_id = new Array();
				//services_selected_id = $('#select_liste_des_services').val();

				//console.log(': '+$('.family_checkbox').prop('checked'));//each

				var liste_services = $('#select_liste_des_services');
				//console.log('family_checkbo: '+liste_services);//.children());
				
				$('.family_checkbox').children().each(function () {

					
					if ($(this).prop('checked')) {
						
						console.log('checked_out: '+$(this).next().attr('family_caracter'));
						services_selected_id.push($(this).next().attr('famille_id'));
						//console.log('checked: '+$(this).next());//.val());//.attr('family_caracter'));
					}

					console.log('services_checked: '+services_selected_id);
				});

				/*
				$.ajax({
					url: '<= $site_url."/Administration/add_family_to_service"; ?>',
					method: "POST",
					data: {
						service_name: service_name,
					},
					success:function (data) {

						$('#select_chaine_sout').html(data);
					},error: function() {
						/* Act on the event *
						$('.error_event').text('de la création du service');
						$('.erro_message').text(error);
						$('#error_dialog_window').modal();
					}
				});
				//*/

				//return false;
			});


		/*==========  									========== *\
				Etapes de création d'une nouvelle famille
		\*==========									========== */

			//Affiche le nom de famille saisi dans la boite de dialogue
	        $('#btn_confirmtn_creation_famille_service').on('click', function(event) {
	        	// event.preventDefault();
	        	/* Act on the event */

				$('#id_nom_creation_famille_de_service_boite_dialog').html($('#nom_famille').val());
	        });

			//Tests préalables de vérification du champ du nom de famille.
			//s'il est non vide, on ouvre la fenêtre modale pour valider la création
			//sinon, on affiche le message d'indication de champ vide

			$('#btn_confirmtn_creation_famille_service').on('click', function(event) {

				var nom_famille_typed = $('#nom_famille').val();
				
				if (nom_famille_typed !=  '' && nom_famille_typed !=  ' ' && nom_famille_typed !=  '   ') {
					
					$('#next').html("");
					$('#safe_service_validation_famille_service').modal();
				}else {
					$('#next').html("Le champ ne peut être vide.")
					.css({
						color: 'red',
						"font-style": 'italic'
					});
				}
			});

			//Validation de création de la famille, écriture en BD
			$('#creer_famille_de_service').on('click', function(event) {
				// event.preventDefault();
				/* Act on the event */
				//console.log('nom famille test: '+$('#nom_famille').val());
				var nom_famille_typed = $('#nom_famille').val();

				//console.log("vide");
				$.ajax({
					url: '<?= $site_url."/Administration/ctrl_insert_new_family_into_db"; ?>',
					method: "POST",
					data: {
						nom_famille_typed: nom_famille_typed
					},
					success:function (data) {

						console.log(data);
						$('#nom_famille').val('');
						
						// alert('Service crée avec succès !!');
						$('#success_operation').modal();

						//location.reload(true);
					},error: function() {
						/* Act on the event */
						$('.error_event').text('de la création de la famille de service');
						//$('.error_message').text(error);
						$('#error_dialog_window').modal();
					}
				});
			});
    });


</script>