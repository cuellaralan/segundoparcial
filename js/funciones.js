function Enunciado() {

    var pagina = "./enunciado.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        async: true
    })
    .done(function (grilla) {

        $("#divGrilla").html(grilla);

        var pagina = "./puntaje.php";

        $.ajax({
            type: 'POST',
            url: pagina,
            dataType: "html",
            async: true
        })
        .done(function (grilla) {

            $("#divAbm").html(grilla);

        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}


function MostrarGrilla() {
    var pagina = "./administracion.php";

    $.ajax(
        {
            url:pagina,
            type:"POST",data:{queMuestro:"MostrarGrilla"}
    }).then(
        function (exito)
        {
            $("#divGrilla").html(exito);
            console.log("exitos");
        },
        function (error)
    {
       console.log("error");
    }
    );
}




function CargarFormUsuario() {

    var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "FORM"
        },
        async: true
    })
    .done(function (html) {

        $("#divAbm").html(html);
        $('#cboPerfiles > option[value="usuario"]').attr('selected', 'selected');
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}

function CargarFormProd()
{
        var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "PROD"
        },
        async: true
    })
    .done(function (html) {

        $("#divAbm").html(html);
        //$('#cboPerfiles > option[value="usuario"]').attr('selected', 'selected');
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
} 

function AgregarUsuario() //agrega pero devuelve null en vez de id
{
    alert("llego");

        
        var id=document.getElementById("hdnIdUsuario").value;
        var nombre=document.getElementById("txtNombre").value;
        var email=document.getElementById("txtEmail").value;
        var password=document.getElementById("txtPassword").value;
        var perfil =document.getElementById("cboPerfiles").value;
        if (id == "") 
        {
            id=0;
        }
        //********DATOS TOMADOS BIEN**************
   $.ajax({
        url:"./administracion.php",
        type:"post",
        data:{
            queMuestro:"GuardarUsuario",
            id:id,
            nombre:nombre,
            email:email,
            password:password,
            perfil:perfil   
        }
    }).then(function exito(retorno){
        $("#divAbm").html(retorno);
        alert("ok");
        MostrarGrilla();
        console.log(retorno);
        //$("#divAbm").html("cantidad de agregados "+ retorno);  
    },function error(retorno){
        alert("error");
        console.log("error");
        $("#informe").html(retorno.responseText);   
          console.log("error");
    });

}

function BorrarUsuario(idParametro)//funciona
{
    alert(idParametro);

    $.ajax({
        url:"administracion.php",
        type:"post",
        data:{
            queMuestro:"BorrarUsuario",
            id:idParametro  
        }
    }).then(function exito(retorno){
        alert("exito"+retorno);
        MostrarGrilla();
        $("#divAb").html("cantidad de eliminados "+ retorno); 
    },function error(retorno){
         $("#informe").html(retorno.responseText);   
    });
}


function EditarUsuario(id) {//#sin case
    alert(id);//recibo id por parametro
    console.log(id);
    var pagina = "./administracion.php";

    $.ajax({
         type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "TraerUsuario",
            id: id
        }
    }).then(function exito(retorno){
        CargarFormUsuario();
        window.setTimeout(function(){
            var us =JSON.parse(retorno);
            alert(us.password);    
            $("#hdnIdUsuario").val(us.id);
            $("#txtNombre").val(us.nombre);
            $("#txtEmail").val(us.email);
            $("#txtPassword").val(us.password);
            $("#cboPerfiles").val(us.perfil);
            }, 5000);
        
    },function error(jqXHR, textStatus, errorThrown){

        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function ModificarUsuario() {//#3a

    if (!confirm("Modificar USUARIO?")) {
        return;
    }
//implementar...

}

function Logout() {//#5

    var pagina = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
            queMuestro: "LOGOUT"
        },
        async: true
    })
    .done(function (html) {

        window.location.href = "login.php?uss=1";

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });

}
function traerCdsConWS(){
    
//implementar...

}

//**************producto***************

function AgregarProducto() //agrega pero devuelve null en vez de id
{
    alert("llego");

        
        var id=document.getElementById("hdnIdUsuario").value;
        var nombre=document.getElementById("nombre").value;
        var porcentaje=document.getElementById("porcentaje").value;
    
        if (id == "") 
        {
            id=0;
        }
        //********DATOS TOMADOS BIEN**************
   $.ajax({
        url:"./administracion.php",
        type:"post",
        data:{
            queMuestro:"GuardarProducto",
            id:id,
            nombre:nombre,
            porcentaje:porcentaje  
        }
    }).then(function exito(retorno){
        $("#divAbm").html(retorno);
        alert("ok");
        //MostrarGrilla();
        console.log(retorno);
        //$("#divAbm").html("cantidad de agregados "+ retorno);  
    },function error(retorno){
        alert("error");
        console.log("error");
        $("#informe").html(retorno.responseText);   
          console.log("error");
    });

}

