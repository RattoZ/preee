<?php
require_once('./liblayout.php');
$title = 'Animali';

?>
<div class="main-panel">
    <div class="card-wrapper">
        <div class="card-background"></div>
        <div class="myCard rounded" style="height: 200px;">
            <h2>Inserisci visita</h2>
            <p>Contenuto dell'elemento card</p>
            <div class="main-panel">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
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
    </div>
</div>
</div>


<style>
    .body {
        background-color: red;
    }
    .card-wrapper {
        position: relative;
        display: inline-block;
        margin: 0 10px;
    }

    .card-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #F5F7FF;
        opacity: 0.5;
        z-index: -1;
    }

    .myCard {
        position: relative;
        z-index: 1;
        background: linear-gradient(to right, rgba(63, 81, 181, 1) 0%, rgba(63, 81, 181, 0.5) 50%, rgba(63, 81, 181, 0) 100%);
        padding: 20px;
        border-radius: 5px;
        color: #ffffff;
    }
</style>