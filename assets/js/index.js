
var working = false;
var site_url = $('#site_url').attr('site_url');

$('.login').on('submit', function(e) {

    e.preventDefault();

    /*if (working) return;

    working = true;

    var $this = $(this),
      $state = $this.find('button > .state');

    $this.addClass('loading');
    $state.html('Authenticating');*/

    /*setTimeout(function() {

        $this.addClass('ok');

        $state.html('Welcome!');

        setTimeout(function() {

            $state.html('Log in');
            $this.removeClass('ok loading');
            working = false;
        }, 4000);
    }, 3000);*/


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
            console.log('data: '+data);

            if (data) {

                // get user informations 
                get_user_name (cuid);

                //je commente ceci, par ce la condition est déjà vérifiée
                // if (working) return;

                // working = true;

                var $this = $('.login'),
                    $state = $this.find('button > .state');

                $this.addClass('loading');
                $state.html('Authentification');

                setTimeout(function() {

                    $this.addClass('ok');

                    $state.html('Welcome!');
                    
                    //Redirection vers la page d'accueil des services
                    window.location.assign(site_url+'/Services/services_homepage');
                    
                    //vidage des champs
                    $('#cuid').val('');
                    $('#password').val('');

                    setTimeout(function() {

                        $state.html('Log in');
                        $this.removeClass('ok loading');
                        working = false;
                    }, 3000);
                }, 1000);
                
            } else {

                $('#cuid').val('');
                $('#password').val('');

                $('.error_message').text('Invalid username or password')
                // console.log('Authentication failed');
                // location.reload(true);
            }
        },
        error: function() {
            /* Act on the event */
            
        }
    });
    

    //fonction de recuperation des donnes d'utilisateur
    function get_user_name (cuid_good) {
        // body... 

        $.ajax({
            url: site_url+'/Welcome/get_user_credentials',
            method: 'POST',
            data: {
                cuid_good: cuid_good,
            },
            success: function (data) {
                /* body... */
                console.log(data);
            }
        })
        .fail(function() {
            console.log("error");
        });
        
    }

});