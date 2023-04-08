function logout() 
{
  console.log("logout clicked");
  var xhttp = new XMLHttpRequest();
  
  xhttp.open("POST", "../php/cerrarSesion.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
}