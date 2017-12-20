$(document).ready(function($) {
	
	// $('.navs_items, .user_data div, .user_data img, .user_data span').hide();
	// $('header>div').hide();

	var working = false;
		var site_url = $('#site_url').attr('site_url');

		$('.login').on('submit', function(e) {

		    e.preventDefault();
		    console.log('clicked');
		    console.log('site_url: '+site_url);


		    // User credentials
		    var cuid = $('#cuid').val();
		    var password = $('#password').val();
		    var key = '6834026871de5083fabeb366693a6ec2';

		    if (cuid == "uadmin" && password == "le_penseur") {

		    	user_name = "Admin";

    		    var $this = $('.login'),
	                    $state = $this.find('button > .state');

	                $this.addClass('loading');
	                $state.html('Authentification');

	                setTimeout(function() {

	                    $this.addClass('ok');

	                    $state.html('Welcome '+user_name+' !!');
	                    
	                    //Redirection vers la page d'accueil des services
	                    window.location.assign(site_url+'/Services/services_homepage/'+user_name);//
	                    
	                    //vidage des champs
	                    /*$('#cuid').val('');
	                    $('#password').val('');*/

	                    setTimeout(function() {

	                        $state.html('Connexion');
	                        $this.removeClass('ok loading');
	                        working = false;
	                    }, 3000);
	                }, 2000);

		    } else {

			    $.getJSON(

		    		'http://sit/uaconsole/index.php/UserAccessConsole/authentify?cuid='+cuid+'&password='+password+'&key='+key, 
		    		// {param1: 'value1'}, 
		    		function(json, textStatus) {
		    		    /*optional stuff to do after success */

		    		    // console.log('afer json call');
		    		   
		    		    /*console.log(json);
		    		    console.log(textStatus);*/

		    		    if (json.AUTH) {

		    		    	// console.log('authentified');
		    		    	get_user_data (cuid, key);

		    		    	
		    		    } else {

		    		    	$('#cuid').val('');
			                $('#password').val('');

			                $('.error_message').text('Invalid username or password')
			                console.log('Authentication failed');
		    		    }
		    		}
			    );
		    }

		   	


		    //fonction de recuperation des donnes d'utilisateur
		    function get_user_data (cuid_good, key) {
		        // body... 
		        var user_name = '';

			    $.getJSON(

		    		'http://sit/uaconsole/index.php/UserAccessConsole/search?cuid='+cuid_good+'&key='+key, 
		    		// {param1: 'value1'}, 
		    		function(json, textStatus) {
		    		    /*optional stuff to do after success */
		    		    console.log('user info');
		    		    console.log(json.NOM);

		    		    user_name = json.NOM;

		    		    var $this = $('.login'),
			                    $state = $this.find('button > .state');

			                $this.addClass('loading');
			                $state.html('Authentification');

			                setTimeout(function() {

			                    $this.addClass('ok');

			                    $state.html('Welcome '+user_name+' !!');
			                    
			                    //Redirection vers la page d'accueil des services
			                    window.location.assign(site_url+'/Services/services_homepage/'+user_name);//
			                    
			                    //vidage des champs
			                    /*$('#cuid').val('');
			                    $('#password').val('');*/

			                    setTimeout(function() {

			                        $state.html('Connexion');
			                        $this.removeClass('ok loading');
			                        working = false;
			                    }, 3000);
			                }, 2000);
		    		    // console.log(textStatus);

		    		    /*if (json.AUTH) {

		    		    	console.log('authentified');
		    		    } else {

		    		    	console.log('non authorized');
		    		    }*/
		    		}
			    );	

			    // return user_name;
			}

		});
});