document.querySelector('#form-inicio-sesion').addEventListener('submit', function(event) {
  event.preventDefault(); // Evita que el formulario se envíe de forma convencional

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'php/login.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function() 
  {
    if (xhr.status === 200) 
    {
      // El usuario fue encontrado y tiene permisos de acceso adecuados
      window.location.href = xhr.responseText;
    } 
    
      else if (xhr.status === 401) 
      {
        // El usuario no tiene permisos de acceso adecuados
        document.querySelector('#error-message').textContent = 'Usuario o contraseña incorrectos';
        document.querySelector('#error-message').style.display = 'block';
      } 
      
      else if (xhr.status === 404) 
      {
        // El usuario no fue encontrado en la base de datos
        document.querySelector('#error-message').textContent = 'Usuario no existente, por favor, introduzca un usuario correcto';
        document.querySelector('#error-message').style.display = 'block';
      } 

    else if (xhr.status === 400)
    {
      // La petición ha sido mal formada
      document.querySelector('#error-message').textContent = JSON.parse(xhr.responseText).error;
      document.querySelector('#error-message').style.display = 'block';
    }
    
    else
     {
      // Otro error
      console.log('Error: ' + xhr.status);
    }
  };

  var correo = document.querySelector('#correo').value;
  var password = document.querySelector('#password').value;
  var data = 'correo=' + encodeURIComponent(correo) + '&password=' + encodeURIComponent(password);
  xhr.send(data);
});
