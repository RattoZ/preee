<?php
require_once('./liblayout.php');
include 'config.php';
$title = 'index';

$id_animale = $_POST['id_animale'];
$nome_animale = $_POST['nome_animale'];
$id_cliente = $_POST['id_cliente'];
$nome_cliente = $_POST['nome_cliente'];

?>
<div id="message"></div>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Inserisci visita</h4>
                    <form method="post" action="./crud/crea_visita.php">
                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="selectProprietario">Proprietario</label>
                                <select name="id_cliente" id="selectProprietario" class="form-control" required>
                                    <option value="">Seleziona un proprietario</option>
                                    <?php
                                    if (isset($id_cliente)) {
                                        echo '<option value="' . $id_cliente . '" selected>' . $nome_cliente . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="selectAnimali">Animale</label>
                                <select name="id_animale" id="selectAnimali" class="form-control" required>
                                    <option value="">Seleziona un animale</option>
                                    <?php
                                    if (isset($id_animale)) {
                                        echo '<option id="firstAnimali" value="' . $id_animale . '" selected>' . $nome_animale . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputNascita">Data appuntamento:</label>
                                <input name="data" type="date" class="form-control" id="nascita" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputTelefono">Ora:</label>
                                <input type="time" class="form-control" name="ora_inizio" min="09:00" max="18:00" step="900" value="13:30" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reperto">Reperto</label>
                            <textarea name="referto" class="form-control" id="reperto" rows="3"></textarea>
                        </div>
                        <button id="submitCliente" type="submit" class="btn btn-primary">Salva</button>
                        <div class="mt-4" id="error_message" class="ajax_response" style="float:center"></div>
                        <div class="mt-4" id="success_message" class="ajax_response" style="float:center"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#selectProprietario").on('focus', function() {
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
    });



    $('#selectProprietario').on('change', function() {
        id = $('#selectProprietario').val();
        console.log(id);
        $.ajax({
            url: "./crud/get_animali.php",
            type: "post",
            dataType: "json",
            data: {
                id_cliente: id
            },
            success: function(data) {
                console.log('Esti cazzissimi??');
                console.log(data);
                $('#selectAnimali').empty();
                $.each(data, function(i, item) {
                    $('#selectAnimali').append($('<option>', {
                        value: item.id_animale,
                        text: item.nome_animale
                    }));
                });
            }

        })
    });
</script>