<!-- 
	
	Script de la page de connexion
 -->

<!-- Script communs que j'mets ici par ce que j'pouvais pas inclure le body_footer dans la page de connexion, puisqu'il inclue le footer -->
<script type="text/javascript" src="<?= $root_path; ?>/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="<?= $root_path; ?>/js/bootstrap.min.js"></script>


<!-- <script type="text/javascript" src="<= $root_path; ?>/js/connexion_script.js"></script> -->

<script src="<?= $root_path; ?>/assets/js/prefixfree.min.js"></script>

<!-- <script src="<= $root_path; ?>/assets/js/index.js"></script> -->


<script>
	
	$(document).ready(function() {
		

		var working = false;
		var site_url = $('#site_url').attr('site_url');
		// console.log('site_url: '+site_url);

		var $name1 = "";

		$('.login').on('submit', function(e) {

		    e.preventDefault();

		    // User credentials
		    var cuid = $('#cuid').val();
		    var password = $('#password').val();


		    

	    	// Ajax function to send user credentials to the controler
		    $.ajax({

		        url: site_url+'/Welcome/verify_user_credentials',
		        method: 'POST',
		        data: {
		            cuid: cuid,
		            password: password
		        },
		        success: function (data) {
		            /* body... */
		            // console.log('data: '+data);

		            if (data) {

		                // get user informations 
		                // get_user_name (cuid);//
		                
		                //user_name = 
		                get_user_name (cuid);

		                //je commente ceci, par ce la condition est déjà vérifiée
		                // if (working) return;

		                // working = true;

		                var $this = $('.login'),
		                    $state = $this.find('button > .state');

		                $this.addClass('loading');
		                $state.html('Chargement');

		                setTimeout(function() {

		                    $this.addClass('ok');

		                    $state.html('Welcome <br />'+$name1+' !!');
		                    console.log('window.location...');
		                    //Redirection vers la page d'accueil des services
		                    window.location.assign(site_url+'/Services/services_homepage');//
		                    console.log('window.location...');
		                    
		                    //vidage des champs
		                    $('#cuid').val('');
		                    $('#password').val('');

		                    setTimeout(function() {

		                        $state.html('Connexion');
		                        $this.removeClass('ok loading');
		                        working = false;
		                    }, 5000);
		                }, 2000);
		                
		            } else {

		                $('#cuid').val('');
		                $('#password').val('');

		                $('.error_message').text('Invalid username or password');
		                // console.log('Authentication failed');
		                // location.reload(true);
		            }
		        },
		        error: function() {
		            /* Act on the event */

		            
		        }
		    });
		    // }
		    
		    

		    //fonction de recuperation des donnes d'utilisateur
		    function get_user_name (cuid_good) {
		        // body... 
		        //var name = 'User';

		        $.ajax({
		            url: site_url+'/Welcome/get_user_credentials',
		            method: 'POST',
		            data: {
		                cuid_good: cuid_good,
		            },
		            success: function (data) {
		                /* body... */
		                // console.log(data);
		                $name1 = data;
		            }
		        })
		        .fail(function() {
		            console.log("error");
		        });
		        
		        //return name;
		    }

		});


	});


</script>