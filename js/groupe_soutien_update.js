/*
* Script de mise a jour des chaines d'esccalades 
*des groupes de soutien
*/

$(document).ready(function() {
	
	/*==========  															========== *\
					Ajax, action sur le bouton de suppression de niveau
		\*==========															========== */
			// $('span[id*="suppr_chainesc"]').on('click', function(event) {
			// $('span[id^="modif_chainesc"]').children().on('click', function() {
			$(document).on('click', 'span[id^="modif_chainesc"]', function() {
				// event.preventDefault();
				/* Act on the event */
				console.log($(this));
				console.log('id de la chaine d\'escalade: ');
				console.log($(this).attr('chainesc_groupsout_id'));
			});

			$(document).on('click', 'span[id^="suppr_chainesc"]', function() {
				// event.preventDefault();
				/* Act on the event */
				console.log($(this));
				console.log('id de la chaine d\'escalade: ');
				console.log($(this).attr('chainesc_groupsout_id'));
			});

			$(document).on('click', 'span[id^="ajouter_chaine_escalade"]', function() {
				// event.preventDefault();
				/* Act on the event */
				console.log($(this));
				console.log('id du groupe de soutien: ');
				// console.log($(this).attr('chainesc_groupsout_id'));
			});

			//unicite des id des chaines d'escalades dans les tags.
			//le clic ne marche pas par ce au'il y a plusieurs ids, donc en ajoutant l'id de la chaine, on fait la difference entre eux.
			//


});