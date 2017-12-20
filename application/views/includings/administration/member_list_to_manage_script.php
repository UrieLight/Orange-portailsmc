<!-- 
	Script de gestion de la liste des membres
-->

<script type="text/javascript" src="<?= $root_path; ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= $root_path; ?>/js/dataTables.bootstrap.min.js"></script>


<script>

	$(document).ready(function($) {
		
		$('#tab_list_membres').DataTable();

		$('button[id^="delete"').on('click', function(event) {
			event.preventDefault();

			var site_url = $('#site_url').attr('class');

			// preventDefault
			/* Act on the event */
			var id_responsable_to_delete = $(this).parent().siblings('input[name^="responsable_id"]').attr('value');
			// console.log(id_responsable_to_delete);
			var ligne_to_hide = $(this).parent().parent().parent();

			$.ajax({
				url: site_url+'/administration/',
				method: 'POST',
				data: {id_responsable_to_delete: id_responsable_to_delete},
				success: function (argument) {
					/* body... */
					ligne_to_hide.fadeOut('300', function() {
						
						location.reload();
					});
				}
			});
		});
	});
</script>