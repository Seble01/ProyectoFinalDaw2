function logout() {
  console.log("logout clicked");
  var xhttp = new XMLHttpRequest();
  
  xhttp.open("POST", "php/cerrarSesion.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() 
  {
    console.log("readyState: " + this.readyState + ", status: " + this.status);
    if (this.readyState == 4 && this.status == 200) 
    {
      window.location.href = "index.php";
    }
  };
  xhttp.send();
}

