
		<!-- script pour le bouton de log_out -->
		<script>
	
			$(document).ready(function() {

				/*
				var today = new Date();
				if(today.getDate() >= 1 && today.getDate() <= 31 && today.getMonth() == 11){
					$('#id_favicon').attr('href', '../../img/logo_end_noel_favico.png');
					$('#body_logo').attr('src', '../../img/logo_end_noel.png');
				}
				else
					$('Link').attr('href', '../../../logo.png');
				*/
				
				$('#bouton_confirmtn_deconnexion').on('click', function(event) {
					event.preventDefault();
					/* Act on the event */
				});

				$('#log_out').on('click', function() {
					// event.preventDefault();
					/* Act on the event */
					<?php //session_destroy(); ?>

					window.location.assign('<?= $site_url ?>/Welcome/authentify_log_out');
				});

			});
		</script>
		
	</body>
</html>