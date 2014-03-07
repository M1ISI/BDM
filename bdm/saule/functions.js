function loginFbApi(d, s, id){
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=1449580138609793";

  fjs.parentNode.insertBefore(js, fjs);
}

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
