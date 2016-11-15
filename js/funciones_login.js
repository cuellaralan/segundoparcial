function Login() {

    //var pagina = "./admin_login.php";
    var pagina = "administracion.php";

    var usuario = {Nombre:$("#nombre").val(),Email: $("#email").val(), Password: $("#password").val()};
    alert(usuario.Nombre);
    console.log(usuario);
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
            usuario: usuario,
            queMuestro:"ValidarLogin"
        }
    }).then(function exito(retorno){
        alert("exito"+retorno);
        window.location.href = "index.php";
    },function error(retorno){//jqXHR, textStatus, errorThrown
        //alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        alert("error"+retorno.responseText);
    });

}

function CargarInput(nombre,correo,clave)
{
    alert("llego");
    $("#nombre").val(nombre);
    $("#email").val(correo);
    $("#password").val(clave);

}