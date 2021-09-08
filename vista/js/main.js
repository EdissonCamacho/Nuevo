$(document).ready(function() {

    cargarTablaCarros();

    $("#btnGuardar").click(function() {
        var marca = $("#txtMarca").val();
        var color = $("#txtColor").val();
        var tipo = $("#txtTipo").val();



        var objDatos = new FormData();
        objDatos.append("marca", marca);
        objDatos.append("color", color);
        objDatos.append("tipo", tipo);






        $.ajax({
            url: "controladores/carrosControlador.php",
            type: "post",
            dataType: "json",
            data: objDatos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                alert(respuesta);
                cargarTablaCarros();

            }
        })







    })

    function cargarTablaCarros() {

        $("#datosCarros").html("");

        var objDatos = new FormData();
        objDatos.append("listarCarros", "ok");


        $.ajax({
            url: "controladores/carrosControlador.php",
            type: "post",
            dataType: "json",
            data: objDatos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                console.log(respuesta);
                respuesta.forEach(cargarDatos);



                function cargarDatos(item, index) {

                    var interface = "";

                    interface += '<tr>';
                    interface += '<td>' + item.marca + '</td>';
                    interface += '<td>' + item.color + '</td>';
                    interface += '<td>' + item.tipo + '</td>';

                    interface += '<td>';
                    interface += '<button type="button" id="btnEditar" idCarro="' + item.idcarro + '" marca="' + item.marca + '" color="' + item.color + '" tipo="' + item.tipo + '"  data-toggle="modal" data-target="#ventanaEditar" class="btn btn-primary"> <span class="glyphicon glyphicon-search"></span></button>';
                    interface += '<button type="button" id="btnEliminar" idCarro="' + item.idcarro + '" class="btn btn-danger">Eliminar</button>';
                    interface += '</td>';
                    interface += '</tr>';

                    $("#datosCarros").append(interface);


                }

            }
        })


    }


    $("#tablaCarros").on("click", "#btnEditar", function() {
        var idCarro = $(this).attr("idCarro");
        var marca = $(this).attr("marca");
        var color = $(this).attr("color");
        var tipo = $(this).attr("tipo");

        $("#txtEditMarca").val(marca);
        $("#txtEditColor").val(color);
        $("#txtEditTipo").val(tipo);
        $("#btnEditarCarro").attr("idCarro", idCarro);

    })

    $("#btnEditarCarro").click(function() {
        var idCarro = $(this).attr("idCarro");
        var marca = $("#txtEditMarca").val();
        var color = $("#txtEditColor").val();
        var tipo = $("#txtEditTipo").val();

        var objDatos = new FormData();
        objDatos.append("modIdCarro", idCarro);
        objDatos.append("modMarca", marca);
        objDatos.append("modColor", color);
        objDatos.append("modTipo", tipo);

        $.ajax({
            url: "controladores/carrosControlador.php",
            type: "post",
            dataType: "json",
            data: objDatos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                if (respuesta == "ok") {
                    alert("Datos modificados correctamente");
                    $("#ventanaEditar").modal('toggle');
                    cargarTablaCarros();
                }
            }
        })


    })


    $("#tablaCarros").on("click", "#btnEliminar", function() {
        var idCarro = $(this).attr("idCarro");
        var objData = new FormData();
        objData.append("idEliminarCarro", idCarro);

        $.ajax({
            url: "controladores/carrosControlador.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                if (respuesta == "Ok") {
                    alert("Datos Eliminados correctamente");
                    cargarTablaCarros();
                }
            }
        })





    })

})