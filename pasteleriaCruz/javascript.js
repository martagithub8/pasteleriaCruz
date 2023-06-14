document.addEventListener("DOMContentLoaded", () => {
  var btnRegistro = document.getElementById("btnRegistro");
  if (btnRegistro) {
    btnRegistro.addEventListener("click", function () {
      event.preventDefault();

      validarRegistro("usuario");
    });
  }

  var btnLogin = document.getElementById("btnLogin");
  if (btnLogin) {
    btnLogin.addEventListener("click", function () {
      event.preventDefault();

      validarLogin();
    });
  }

  var btnNuevoAdmin = document.getElementById("btnNuevoAdmin");
  if (btnNuevoAdmin) {
    btnNuevoAdmin.addEventListener("click", function () {
      event.preventDefault();

      validarRegistro("admin");
    });
  }

  var btnNuevoProducto = document.getElementById("btnNuevoProducto");
  if (btnNuevoProducto) {
    btnNuevoProducto.addEventListener("click", function () {
      event.preventDefault();

      validarNuevoProducto();
    });
  }

  var btnEditarProducto = document.getElementById("btnEditarProducto");
  if (btnEditarProducto) {
    btnEditarProducto.addEventListener("click", function () {
      event.preventDefault();

      validarEditarProducto();
    });
  }

  var btnEditarUsuario = document.getElementById("btnEditarUsuario");
  if (btnEditarUsuario) {
    btnEditarUsuario.addEventListener("click", function () {
      event.preventDefault();

      validarEditarUsuario();
    });
  }
});

function validarRegistro(tipo) {
  var nombreValido = validarName();
  var correoValido = validarCorreo();
  var usuarioValido = validarUsuario();
  var password1Valido = validarPassword1();
  var password2Valido = validarPassword2();

  if (
    nombreValido &&
    correoValido &&
    usuarioValido &&
    password1Valido &&
    password2Valido
  ) {
    if (tipo == "admin") {
      document.getElementById("formNuevoAdmin").submit();
    } else {
      document.getElementById("formRegistro").submit();
    }
  }
}

function validarEditarProducto() {
  var nombreValido0 = validarName0();
  var saborValido0 = validarSabor0();
  var imagenValida0 = validarImagen0();
  var stockValido0 = validarStock0();

  if (
    nombreValido0 &&
    saborValido0 &&
    imagenValida0 &&
    stockValido0 
  ) {
    
      document.getElementById("formEditarProducto").submit();
    
  }
}

function validarEditarUsuario() {
  var nombreValido0 = validarName0();
  var saborValido0 = validarSabor0();
  var correoValido0 = validarCorreo0();

  if (
    nombreValido0 &&
    saborValido0 &&
    correoValido0 
  ) {
    
      document.getElementById("formEditarUsuario").submit();
    
  }
}

function validarLogin() {
  var usuarioValido = validarUsuario();
  var password1Valido = validarPassword1();

  if (usuarioValido && password1Valido) {
    document.getElementById("formLogin").submit();
  }
}

function validarName() {
  var errorNombre = document.getElementById("errorNombre");
  var nombre = document.getElementById("nombre").value;
  if (nombre == "") {
    errorNombre.innerHTML = "Este campo no puede estar vacío";
    errorNombre.style.display = "block";
    // no valido
    return false;
  } else {
    errorNombre.style.display = "none";
    return true;
  }
}
function validarName0() {
  var errorNombre0 = document.getElementById("errorNombre0");
  var nombre0 = document.getElementById("nombre0").value;
  if (nombre0 == "") {
    errorNombre0.innerHTML = "Este campo no puede estar vacío";
    errorNombre0.style.display = "block";
    // no valido
    return false;
  } else {
    errorNombre0.style.display = "none";
    return true;
  }
}

function validarSabor() {
  var errorSabor = document.getElementById("errorSabor");
  var sabor = document.getElementById("sabor").value;
  if (sabor == "") {
    errorSabor.innerHTML = "Este campo no puede estar vacío";
    errorSabor.style.display = "block";
    // no valido
    return false;
  } else {
    errorSabor.style.display = "none";
    return true;
  }
}
function validarSabor0() {
  var errorSabor0 = document.getElementById("errorSabor0");
  var sabor0 = document.getElementById("sabor0").value;
  if (sabor0 == "") {
    errorSabor0.innerHTML = "Este campo no puede estar vacío";
    errorSabor0.style.display = "block";
    // no valido
    return false;
  } else {
    errorSabor0.style.display = "none";
    return true;
  }
}

function validarNuevoProducto() {
  var nombreValido = validarName();
  var imagenValida = validarImagen();
  var precioValido = validarPrecio();
  var saborValido = validarSabor();
  var stockValido = validarStock();


  if (
    nombreValido && precioValido && imagenValida &&saborValido && stockValido
    
  ) {
    document.getElementById("formNuevoProducto").submit();

  }
}
function validarImagen() {
  var errorImagen = document.getElementById("errorImagen");
  var imagen = document.getElementById("imagen").value;

  if (imagen == "") {
    //Se muestra el mensaje de error
    errorImagen.innerHTML = "Este campo no puede estar vacío";
    errorImagen.style.display = "block";

    //no valido
    return false;
  } else if (
    !imagen.match(/\b\w+\.([pP][nN][gG]|[jJ][pP][eE]?[gG]|gif|bmp)\b/g)
  ) {
    //Se muestra el mensaje de error
    errorImagen.innerHTML = "Ha introducido una imagen incorrecta";
    errorImagen.style.display = "block";
    //no valido
    return false;
  } else {
    errorImagen.style.display = "none";
    return true;
  }
}

function validarImagen0() {
  var errorImagen0 = document.getElementById("errorImagen0");
  var imagen0 = document.getElementById("imagen0").value;

  if (imagen0 == "") {
    //Se muestra el mensaje de error
    errorImagen0.innerHTML = "Este campo no puede estar vacío";
    errorImagen0.style.display = "block";

    //no valido
    return false;
  } else if (
    !imagen0.match(/\b\w+\.([pP][nN][gG]|[jJ][pP][eE]?[gG]|gif|bmp)\b/g)
  ) {
    //Se muestra el mensaje de error
    errorImagen0.innerHTML = "Ha introducido una imagen incorrecta";
    errorImagen0.style.display = "block";
    //no valido
    return false;
  } else {
    errorImagen0.style.display = "none";
    return true;
  }
}
function validarCorreo() {
  var errorCorreo = document.getElementById("errorCorreo");
  var correo = document.getElementById("correo").value;

  if (correo == "") {
    //Se muestra el mensaje de error
    errorCorreo.innerHTML = "Este campo no puede estar vacío";
    errorCorreo.style.display = "block";

    //no valido
    return false;
  } else if (
    !correo.match(
      /[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}/
    )
  ) {
    //Se muestra el mensaje de error
    errorCorreo.innerHTML = "Ha introducido un email incorrecto";
    errorCorreo.style.display = "block";
    //no valido
    return false;
  } else {
    errorCorreo.style.display = "none";
    return true;
  }
}
function validarCorreo0() {
  var errorCorreo0 = document.getElementById("errorCorreo0");
  var correo0 = document.getElementById("correo0").value;

  if (correo0 == "") {
    //Se muestra el mensaje de error
    errorCorreo0.innerHTML = "Este campo no puede estar vacío";
    errorCorreo0.style.display = "block";

    //no valido
    return false;
  } else if (
    !correo0.match(
      /[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}/
    )
  ) {
    //Se muestra el mensaje de error
    errorCorreo0.innerHTML = "Ha introducido un email incorrecto";
    errorCorreo0.style.display = "block";
    //no valido
    return false;
  } else {
    errorCorreo0.style.display = "none";
    return true;
  }
}


function validarUsuario() {
  var errorUsuario = document.getElementById("errorUsuario");
  var usuario = document.getElementById("usuario").value;

  if (usuario == "") {
    errorUsuario.innerHTML = "Este campo no puede estar vacío";
    errorUsuario.style.display = "block";
    // no valido
    return false;
  } else {
    errorUsuario.style.display = "none";
    return true;
  }
}

function validarPrecio() {
  var errorPrecio = document.getElementById("errorPrecio");
  var precio = document.getElementById("precio").value;

  if (precio == "") {
    errorPrecio.innerHTML = "Este campo no puede estar vacío";
    errorPrecio.style.display = "block";
    // no valido
    return false;
  } else if(precio <0 || !precio.match(/^[0-9.]*$/)) {
    errorPrecio.innerHTML = "Introduzca un precio válido";
    errorPrecio.style.display = "block";
    // no valido
    return false;
  } else{
    errorPrecio.style.display = "none";
    return true;
  }
}

function validarStock() {
  var errorStock = document.getElementById("errorStock");
  var stock = document.getElementById("stock").value;

  if (stock == "") {
    errorStock.innerHTML = "Este campo no puede estar vacío";
    errorStock.style.display = "block";
    // no valido
    return false;
  } else if(stock <0 ) {
    errorStock.innerHTML = "Introduzca un stock válido";
    errorStock.style.display = "block";
    // no valido
    return false;
  } else{
    errorStock.style.display = "none";
    return true;
  }
}

function validarStock0() {
  var errorStock0 = document.getElementById("errorStock0");
  var stock0 = document.getElementById("stock0").value;

  if (stock0 == "") {
    errorStock0.innerHTML = "Este campo no puede estar vacío";
    errorStock0.style.display = "block";
    // no valido
    return false;
  } else if(stock0 <0 ) {
    errorStock0.innerHTML = "Introduzca un stock válido";
    errorStock0.style.display = "block";
    // no valido
    return false;
  } else{
    errorStock0.style.display = "none";
    return true;
  }
}
function validarPassword0() {
  var errorPassword0 = document.getElementById("errorPassword0");
  var password0 = document.getElementById("password0").value;

  if (password0 == "") {
    errorPassword0.innerHTML = "Este campo no puede estar vacío";
    errorPassword0.style.display = "block";
    // no valido
    return false;
  } else if (password0.length <= 5) {
    errorPassword0.innerHTML = "La contraseña debe tener al menos 6 caracteres";
    errorPassword0.style.display = "block";
    // no valido
    return false;
  } else {
    errorPassword0.style.display = "none";
    return true;
  }
}

function validarPassword1() {
  var errorPassword1 = document.getElementById("errorPassword1");
  var password1 = document.getElementById("password1").value;

  if (password1 == "") {
    errorPassword1.innerHTML = "Este campo no puede estar vacío";
    errorPassword1.style.display = "block";
    // no valido
    return false;
  } else if (password1.length <= 5) {
    errorPassword1.innerHTML = "La contraseña debe tener al menos 6 caracteres";
    errorPassword1.style.display = "block";
    // no valido
    return false;
  } else {
    errorPassword1.style.display = "none";
    return true;
  }
}
function validarPassword2() {
  var errorPassword2 = document.getElementById("errorPassword2");
  var password2 = document.getElementById("password2").value;

  if (password2 == "") {
    errorPassword2.innerHTML = "Este campo no puede estar vacío";
    errorPassword2.style.display = "block";
    // no valido
    return false;
  } else if (password2.length <= 5) {
    errorPassword2.innerHTML = "La contraseña debe tener al menos 6 caracteres";
    errorPassword2.style.display = "block";
    // no valido
    return false;
  } else {
    errorPassword2.style.display = "none";
    return true;
  }
}
