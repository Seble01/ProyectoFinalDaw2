
// Obtenemos los elementos del DOM que necesitaremos

const toggleButton = document.getElementById('toggle-form');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');

// Agregamos el controlador de eventos al botón de alternar formulario

toggleButton.addEventListener('click', () => 
{
  // Cambiamos las clases CSS para mostrar y ocultar los formularios
  loginForm.classList.toggle('hide-form');
  loginForm.classList.toggle('show-form');
  registerForm.classList.toggle('hide-form');
  registerForm.classList.toggle('show-form');
});