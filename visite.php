<?php
require_once('./liblayout.php');
// includere il file di configurazione del database
include 'config.php';
$title = 'Animali';


// seleziona gli animali ed il nome ed il cognome del padrone  ------
// $sql = "SELECT az_animali.*, 
// az_clienti.nome_cliente, az_clienti.cognome_cliente 
// FROM az_animali 
// LEFT JOIN az_clienti 
// ON az_animali.id_cliente = az_clienti.id_cliente";

$sql = "SELECT az_visite.*, az_animali.nome_animale FROM az_visite 
LEFT JOIN az_animali ON az_visite.id_animale = az_animali.id_animale";

$result = $conn->query($sql);

// verificare se ci sono risultati
if ($result->num_rows > 0) {

    // visualizzare l'elenco dei clienti
?>
    <div id="message"></div>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <div class="text-center align-middle">
                        <i class="bi bi-bell menu-icon mr-3 d-inline"> </i>
                        <h4 class="card-title d-inline">Visite</h4>
                    </div>
                    <div class="table-responsive table-hover">
                        <table id="myTable" class="table " cellspacing="0" width="100%">
                            <!-- class= -->
                            <!-- table-striped table-bordered display nowrap -->
                            <thead>
                                <th data-field="id">ID</th>
                                <th data-field="data">Data</th>
                                <th data-field="dataNascita">Orario</th>
                                <th data-field="referto">Referto</th>
                                <th data-field="id_animale">Animale</th>
                                <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {

                                    $id_animale = $row['id_animale'];
                                    $nome_animale = $row['nome_animale'];
                                    $id_appuntamento = $row['id_appuntamento'];
                                    $data = $row['data_appuntamento'];
                                    $ora = $row['ora_appuntamento'];
                                    $referto = $row['referto_appuntamento'];

                                ?>
                                    <tr>
                                        <td><?php echo $id_appuntamento ?></td>
                                        <td><?php echo $data ?></td>
                                        <td><?php echo $ora ?></td>
                                        <td><?php echo $referto ?></td>
                                        <td title="<?php echo 'ID: ' . $id_animale ?>"><?php echo $nome_animale ?></td>
                                        <td>
                                            <button id="myBtnY" class="btn btn-danger ml-4myBtnY" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id_appuntamento  ?>" title="Elimina">
                                                <i class="bi bi-trash3 myIcon ml-1"></i></button>
                                            <button id="myBtnR" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?php echo $id_appuntamento ?>" title="Modifica">
                                                <i class="bi bi-pencil myIcon ml-1"></i></button>
                                        </td>
                                        <td>
                                            <form method="get" action="visita-detail.php">
                                                <button id="myBtnR" class="btn" style="background-color: #ef92ef;" title="Storico">
                                                    <i class="bi bi-clock-history myIcon ml-1"></i></button>
                                                <input type="hidden" name="id_visita" value="<?php echo $id_appuntamento ?>">
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $id_appuntamento; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fs-5" id="staticBackdropLabel">Elimina</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Sei sicur* di voler Cancellare <?php echo $nome ?>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-danger" onclick="deleteVisita(<?php echo $id_appuntamento ?>)">Elimina</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fine delete modal -->
                                    <!-- myModal -->
                                    <div class="modal" id="editModal<?php echo $id_appuntamento ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modificare appuntamento ?</h1>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" action="./crud/modifica_visita.php" method="post">
                                                        <div class="form-group mt-1">
                                                            <label>Data: </label>
                                                            <input type="date" class="form-control" name="data" value="<?php echo $data ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Ora: </label>
                                                            <input type="time" class="form-control" name="ora" value="<?php echo $ora ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="reperto">Reperto</label>
                                                            <textarea name="referto" class="form-control" id="reperto" rows="3"><?php echo $referto ?></textarea>
                                                        </div>
                                                        <input type="hidden" name="id" value="<?php echo $id_appuntamento ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Modifica</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                </div>
            </div>
        <?php
                                }
        ?>
        </tbody>
        </table>
        </div>
    </div>
    <div>
    </div>
<?php
} else {
    // nessun animale trovato
    echo "Nessun animale trovato";
}


// chiudere la connessione al database
$conn->close();
?>


<script>
    $.extend($.fn.dataTable.defaults, {
        responsive: true
    });

    function deleteVisita(id) {
        var id_appuntamento = id;

        $.ajax({
            type: "POST",
            url: "./crud/elimina_visita.php",
            data: {
                id_appuntamento: id_appuntamento
            },
            cache: false,
            success: function() {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
    };

    $(document).ready(function() {
        $('#myTable').DataTable({
            responsive: true
        });
    });
</script>