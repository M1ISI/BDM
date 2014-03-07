/*function loginFbApi(d, s, id){
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=1449580138609793";

  fjs.parentNode.insertBefore(js, fjs);
}*/

function getFBFriendList(){
  FB.getLoginStatus(function(response) {
    if (response.status === 'connected') {
      FB.api('/me/friends', function(response){
        if (response && response.data){
          var divTarget=document.getElementById("friends-list-container");
          var data=response.data;
          for (var friendIndex=0; friendIndex<data.length; friendIndex++)
          {
            var divContainer = document.createElement("div");
           divContainer.innerHTML="<b>" + data[friendIndex].name + "</b>";
           divTarget.appendChild(divContainer);
          }
        } else {
          console.log('Something goes wrong', response);
        }
      });
    }
  });
}
/*
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=1449580138609793";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
*/


$(document).ready(function() {

FB.Event.subscribe('auth.login', function(response) {

    FB.api('/me', function(response) { 

        var url = 'http://graph.facebook.com/' + response.id + '/picture';

        $('#facebook_profile_image').html('<img src="' + url + '" alt="#" />');
        $('#facebook_profile_text').html('<p><a href="' + response.link + '"><strong>' + response.name + '</strong></a><br /><a href="#" id="facebook_logout">Deconnexion</a>');

        var user_data = '<ul><li>Votre date de naissance : ' + response.birthday + '</li><li>Votre adresse email : ' + response.email + '</li><li>Votre bio : ' + response.bio + '</li>';
        $('#facebook_user_data').html(user_data);

        FB.api('/me/posts', function(response) {

            var messages = '<li>Vos 3 derniers statuts : <ul>';

            $.each(response.data, function(key, value) {

                messages += '<li>' + value.message + '</li>';                           
                return (key != 2);

            }); 

            messages += '</ul></li></ul>';

            $('#facebook_user_data').append(messages);
        });

    });

});

FB.getLoginStatus(function(response) {

        if (response.session) {

            FB.api('/me', function(response) { 

                var url = 'http://graph.facebook.com/' + response.id + '/picture';

                $('#facebook_profile_image').html('<img src="' + url + '" alt="#" />');
                $('#facebook_profile_text').html('<p><a href="' + response.link + '"><strong>' + response.name + '</strong></a><br /><a href="#" id="facebook_logout">Deconnexion</a>');

                var user_data = '<li>Votre date de naissance : ' + response.birthday + '</li><li>Votre adresse email : ' + response.email + '</li><li>Votre bio : ' + response.bio + '</li>';
                $('#facebook_user_data').html(user_data);

                FB.api('/me/posts', function(response) {

                    var messages = '<li>Vos 3 derniers statuts : <ul>';

                    $.each(response.data, function(key, value) {

                        messages += '<li>' + value.message + '</li>';                           
                        return (key != 2);

                    }); 

                    messages += '</ul></li>';

                    $('#facebook_user_data').append(messages);

                });

            });

            $('#facebook_button_box').hide();
            $('#facebook_profile').show();
        }
    });

});


