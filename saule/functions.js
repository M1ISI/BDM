function handleFacebook() {
 
    FB.init({appId: '1449580138609793', xfbml: true, cookie: true});
    FB.getLoginStatus(function(response) {
        onStatus(response); // once on page load
        FB.Event.subscribe('auth.statusChange', onStatus); // every status change
    });
 
}

function getFBFriendList(session){
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
