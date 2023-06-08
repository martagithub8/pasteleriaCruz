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
