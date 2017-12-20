
<script>

	$(document).ready(function() {		

		/*==========  									========== *\					
					Ajax, creation d'un nouvel outil
		\*==========									========== */

		var $site_url = $('#site_url').attr('class');

		$('#save_outil').on('click', function(event) {
			
			var outil_nom = $('#outil_nom').val();
        	var outil_desc = $('#outil_desc').val();
			
			$.ajax({
                url: $site_url+'/Outil/save_new_outil',
                method: "POST",
                data: {
                    outil_nom: outil_nom,
                    outil_desc: outil_desc
                },
                success:function (data) {

                    // console.log(data);
                    // $('#id_architecture').attr('value', data);
                    /*$('#outil_nom').val('');
                    $('#outil_desc').val('');*/
                    alert('Outil créé avec succès');

                    location.reload(true);
                },
                error: function() {
                    alert('Echec de céation d\'un nouvel outil !!');
                }
        	});

		});

	});


</script>