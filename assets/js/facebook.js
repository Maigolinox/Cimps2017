$(function() {
//app_id es de facebook de cimps
  var app_id = '1903043489935181';
  var scopes = 'email, user_friends, user_online_presence';

  var btn_login = '<a href="#" id="login" class="btn btn-primary">Iniciar sesión</a>';

  var div_session = "<div id='facebook-session'>"+
            "<strong></strong>"+
            "<img>"+
            "<a href='#' id='logout' class='btn btn-danger'>Cerrar sesión</a>"+
            "</div>";

  window.fbAsyncInit = function() {

      FB.init({
        appId      : app_id,
        status     : true,
        cookie     : true, 
        xfbml      : true, 
        version    : 'v2.9'
      });


      FB.getLoginStatus(function(response) {
        statusChangeCallback(response, function() {});
      });


      facebookLogin();

      facebookLogout();


    };

    var statusChangeCallback = function(response, callback) {
      
      
      if (response.status === 'connected') {
          getFacebookData();
      } else {
        callback(false);
      }
    }

    var checkLoginState = function(callback) {
      FB.getLoginStatus(function(response) {
          callback(response);
      });
    }

    var getFacebookData =  function() {
       FB.api('/me', {fields: 'name, email, gender'}, function(response) {
        
          NombreFB.value=response.name;
        EmailFB.value=response.email;

       if (response.gender === 'male'){
          $("#maleFB").prop("checked", true);
       }else{
          $("#femaleFB").prop("checked", true);
       }
       alert("¡¡Bienvenido!! \n \n Por favor de completar los campos requeridos. \n \n *Nota: si se queda la ventana de Facebook abierta, favor de cerrar y refrescar la pagina (F5).");
      });
    }

    var facebookLogin = function() {
      checkLoginState(function(data) {
        if (data.status !== 'connected') {
          FB.login(function(response) {
            if (response.status === 'connected')
              getFacebookData();
          }, {scope: scopes});
        }
      })
    }

    var facebookLogout = function() {
      checkLoginState(function(data) {
        if (data.status === 'connected') {
        FB.logout(function(response) {
          $('#facebook-session').before(btn_login);
          $('#facebook-session').remove();
        })
      }
      })

    }



    $(document).on('click', '#login', function(e) {
      e.preventDefault();

      facebookLogin();
    })

    $(document).on('click', '#logout', function(e) {
      e.preventDefault();

      if (confirm("¿Está seguro?"))
        facebookLogout();
      else 
        return false;
    })

})
