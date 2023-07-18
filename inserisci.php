<?php
require_once('./liblayout.php');
include 'config.php';
$title = 'inserisci';


?>

<!-- partial -->
<div id="message"></div>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card" style="width: fit-content; block-size: fit-content;">
                    <div class="card-body">
                        <div style="padding-left: 0px;" class="container ml-0">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">Nuovo Cliente:</h4>
                                </div>
                                <div class="col"><button id="refresh" class="float-right rounded btn btn-outline-danger" title="Azzera i campi"><i class="bi bi-arrow-repeat"></i></button></div>
                            </div>
                        </div>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputNome">Nome*</label>
                                    <input type="text" class="form-control" id="nomeCliente" placeholder="Mario" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputCognome">Cognome*</label>
                                    <input type="text" class="form-control" id="cognomeCliente" placeholder="Rossi" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTelefono">Telefono</label>
                                <input type="text" class="form-control" id="telefono" placeholder="328-37.." value="">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">E-mail*</label>
                                <input pattern="/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/" type="email" class="form-control" id="email" placeholder="nome@mail.it" required>
                            </div>
                            <h6>*Campi obbligatori</h6>
                            <button id="submitCliente" type="submit" class="btn btn-primary">Salva</button>
                            <div class="mt-4" id="error_message" class="ajax_response" style="float:center"></div>
                            <div class="mt-4" id="success_message" class="ajax_response" style="float:center"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Nuovo paziente:</h4>
                        <form method="POST" action="./crud/crea_animale.php">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nomeAnimale">Nome*</label>
                                    <input name="nomeAnimale" type="text" class="form-control" id="nomeAnimale" placeholder="Fido" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputSpecie">Specie*</label>
                                    <input name="specie" type="text" class="form-control" id="specie" placeholder="Cane" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRazza">Razza</label>
                                <input name="razza" type="text" class="form-control" id="razza" placeholder="Labrador">
                            </div>
                            <div class="form-group">
                                <label for="inputNascita">Data di nascita</label>
                                <input name="nascita" type="date" class="form-control" id="nascita">
                            </div>
                            <div class="form-group">
                                <label for="selectProprietario">Proprietario*</label>
                                <select name="id_cliente" id="selectProprietario" class="form-control" required>
                                    <option value="">Seleziona un proprietario</option>
                                </select>
                            </div>
                            <h6>*Campi obbligatori</h6>
                            <button id="submitAnimale" type="submit" class="btn btn-primary">Salva</button>
                            <div class="mt-4" id="error_animale_message" class="ajax_response" style="float:center"></div>
                            <div class="mt-4" id="success_animale_message" class="ajax_response" style="float:center"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#refresh').on('click', function() {
        $("#nomeCliente").attr('disabled', false);
        $("#cognomeCliente").attr('disabled', false);
        $("#telefono").attr('disabled', false);
        $("#email").attr('disabled', false);
        $('#nomeCliente').val("");
        $("#cognomeCliente").val("");
        $("#telefono").val("");
        $("#email").val("");

        $('#success_message').fadeOut("slow");

    });

    function get_proprietari() {
        $.ajax({
            url: "./crud/get_clienti.php",
            type: "GET",
            success: function(data) {
                console.log(data);
                var select = $('#selectProprietario');
                var existingOptions = select.children('option');
                if (existingOptions.length === 1) {
                    $.each(data, function(i, item) {
                        $('#selectProprietario').append($('<option>', {
                            value: item.id_cliente,
                            text: item.nome_cliente + ' ' + item.cognome_cliente
                        }));
                    })
                } else {
                    for (var i = 0; i < data.length; i++) {
                        var optionExists = false;
                        for (var j = 0; j < existingOptions.length; j++) {
                            if (data[i].id_cliente === existingOptions.eq(j).val()) {
                                optionExists = true;
                                break;
                            }
                        }
                        if (!optionExists) {
                            $('#selectProprietario').append($('<option>', {
                                value: data[i].id_cliente,
                                text: data[i].nome_cliente + ' ' + data[i].cognome_cliente
                            }));
                        }
                    }
                }

            },
            error: function(error) {
                console.error(error);
            }
        })
    }

    $("#selectProprietario").on('focus', function() {
        get_proprietari();
    });

    function checkname() {
        var nomeCliente = $("#nomeCliente").val();
        if (nomeCliente == '') {
            return false;
        } else {
            return true;
        }
    }

    function checklastname() {
        var nomeCliente = $("#cognomeCliente").val();
        if (nomeCliente == '') {
            return false;
        } else {
            return true;
        }
    }

    function checkemail() {

        var pattern1 = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
        var email = $('#email').val();
        var validemail = pattern1.test(email);

        if (email == "") {
            $('#error_message').html('<div class="alert alert-warning">Campo obbligatorio</div>');
            $("#email").addClass("border border-danger");
            return false;
        } else if (!validemail) {
            $('#error_message').html('<div class="alert alert-warning">Completa l\'email tipo: \'nome@mail.com\'</div>');
            console.log('Mail non valida');
            $("#email").addClass("border border-danger");
            return false;
        } else {

            $('#error_message').html('');
            console.log('Check email valida!!!!');
            return true;
        }
    }

    function checktelefono() {

        // var pattern1 = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/
        var pattern2 = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/
        var telefono = $('#telefono').val();
        var validtelefono = pattern1.test(telefono);
        var validtelefono = pattern2.test(telefono);

        if (telefono == "") {
            return true;
        } else if (!validtelefono2) {
            $('#error_message').html('<div class="alert alert-warning">Completa il telefono tipo: \'nome@mail.com\'</div>');
            console.log('Mail non valida');
            $("#telefono").addClass("border border-danger");
            return false;
        } else {

            $('#error_message').html('');
            console.log('Check telefono valida!!!!');
            return true;
        }
    }

    function checkfieldnome() {
        var nomeAnimale = $("#nomeAnimale").val();
        if (nomeAnimale == '') {
            return false;
        } else {
            return true;
        }
    }

    function checkfieldspecie() {
        var specieAnimale = $("#specie").val();
        if (specieAnimale == '') {
            return false;
        } else {
            return true;
        }
    }

    $(document).ready(function() {

        $("#submitCliente").click(function() {

            //stop jquery ajax form submit with form data example, we will post it manually.
            event.preventDefault();

            if (!checkname()) {
                $("#nomeCliente").addClass("border border-danger");
                $("#nomeCliente").focus();
                $("#error_message").html('<div class="alert alert-warning">Campo nome obbligatorio</div>');
            } else {
                $("#nomeCliente").removeClass("border border-danger");
                if (!checklastname()) {
                    $("#cognomeCliente").addClass("border border-danger");
                    $("#cognomeCliente").focus();
                    $("#error_message").html('<div class="alert alert-warning">Campo cognome obbligatorio</div>');
                } else {
                    $("#cognomeCliente").removeClass("border border-danger");
                    if (!checkemail()) {
                        console.log("error-email");
                        $("#email").addClass("border border-danger");
                        $("#email").focus();

                    } else {
                        $("#email").removeClass("border border-danger");
                        setTimeout(function() {
                            $("#error_message").fadeOut("slow");
                        }, 1000);
                        var nomeCliente = $("#nomeCliente").val();
                        var cognomeCliente = $("#cognomeCliente").val();
                        var telefono = $("#telefono").val();
                        var email = $("#email").val();
                        if (telefono == "") {
                            var dataArray = {
                                nomeCliente: nomeCliente,
                                cognomeCliente: cognomeCliente,
                                email: email
                            }
                        } else {
                            var dataArray = {
                                nomeCliente: nomeCliente,
                                cognomeCliente: cognomeCliente,
                                telefono: telefono,
                                email: email
                            }
                        }

                        $.ajax({
                            type: "POST",
                            url: "./crud/crea_cliente.php",
                            data: dataArray,
                            cache: false,
                            success: function(data) {
                                if (data.substr(11, 9) == 'Duplicate') {
                                    if (data.indexOf("telefono_cliente") > 0) {
                                        $("#telefono").addClass("border border-danger").focus();
                                        // alert("Duplicato: Numero di telefono già presente nel database.");
                                        $('#error_message').html('<div class="alert alert-warning">Duplicato: Numero di telefono già presente nel database.</div>');
                                        setTimeout(function() {
                                            $('#error_message').fadeOut("slow");
                                        }, 50000);
                                    } else if (data.indexOf("email_cliente") > 0) {
                                        $("#telefono").removeClass("border border-danger");
                                        $("#email").addClass("border border-danger").focus();
                                        // alert("Duplicato: Email di telefono già presente nel database.");
                                        $('#error_message').html('<div class="alert alert-warning">Duplicato: Email già presente nel database.</div>');
                                        setTimeout(function() {
                                            $('#error_message').fadeOut("slow");
                                        }, 50000);
                                    }

                                } else {
                                    var id = data.slice(10, -1);
                                    console.log(id);
                                    $('#selectProprietario').append($('<option>', {
                                        value: id,
                                        text: nomeCliente + ' ' + cognomeCliente
                                    }).attr('selected', 'selected'));
                                    $("#telefono").removeClass("border border-danger");
                                    $("#email").removeClass("border border-danger");
                                    console.log(data);
                                    $("#nomeCliente").attr('disabled', 'disabled');
                                    $("#cognomeCliente").attr('disabled', 'disabled');
                                    $("#telefono").attr('disabled', 'disabled');
                                    $("#email").attr('disabled', 'disabled');

                                    $('#success_message').html('<div class="alert alert-success alert-dismissible fade show">Cliente inserito con successo!</div>');
                                    // setTimeout(function() {
                                    //     $('#success_message').fadeOut("slow");
                                    // }, 30000);
                                    $("#nomeAnimale").focus();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                            }
                        });
                    }
                }
            }

        });

        $("#submitAnimale").click(function() {

            var nomeAnimale = $("#nomeAnimale").val();
            var specie = $("#specie").val();
            var razza = $("#razza").val();
            var nascita = $("#nascita").val;
            var idProprietario = $("#selectProprietario").val();
            var nomeCliente = $("#selectProprietario option:selected").text();

            if (!checkfieldnome()) {
                $("#nomeAnimale").addClass("border border-danger");
                $("#nomeAnimale").focus();
                $("#error_animale_message").html('<div class="alert alert-warning">Campo nome obbligatorio</div>');
            } else {
                $("#nomeAnimale").removeClass("border border-danger");
                if (!checkfieldspecie()) {
                    $("#specie").addClass("border border-danger");
                    $("#specie").focus();
                    $("#error_animale_message").html('<div class="alert alert-warning">Campo specie obbligatorio</div>');
                } else {
                    $("#specie").removeClass("border border-danger");
                    $.ajax({
                        type: "POST",
                        url: "./crud/crea_animale.php",
                        data: {
                            nomeAnimale: nomeAnimale,
                            specie: specie,
                            razza: razza,
                            nascita: nascita,
                            idProprietario: idProprietario,
                            nomeCliente: nomeCliente
                        },
                        cache: false,
                        success: function(data) {
                            console.log("Paziente salvato con successo!")
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr);
                        }
                    });
                }
            }
        });

    });
</script>