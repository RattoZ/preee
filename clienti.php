<?php
require_once('./liblayout.php');
// includere il file di configurazione del database
include 'config.php';

$title = 'Clienti';

// selezionare tutti i clienti dalla tabella "clientizerbo"
$sql = "SELECT * FROM az_clienti";
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
                        <i class="icon-head menu-icon mr-3 d-inline"> </i>
                        <h4 class="card-title d-inline">Proprietari</h4>
                    </div>
                    <div class="table-responsive table-hover">
                        <table id="myTable" class="table " cellspacing="0" width="100%">
                            <thead>
                                <th data-field="id">ID</th>
                                <th data-field="nome">Nome</th>
                                <th data-field="cognome">Cognome</th>
                                <th data-field="telefono">Telefono</th>
                                <th data-field="email">Email</th>
                                <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['id_cliente'];
                                    $nome = $row['nome_cliente'];
                                    $cognome = $row['cognome_cliente'];
                                    $telefono = $row['telefono_cliente'];
                                    $email = $row['email_cliente'];
                                ?>
                                    <tr>
                                        <td><?php echo $row['id_cliente'] ?></td>
                                        <td><?php echo $row['nome_cliente'] ?></td>
                                        <td><?php echo $row['cognome_cliente'] ?></td>
                                        <td><?php echo $row['telefono_cliente'] ?></td>
                                        <td><?php echo $row['email_cliente'] ?></td>
                                        <td>
                                            <button id="myBtnY" class="btn btn-danger ml-4 myBtnY" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id ?>" title="Elimina">
                                                <i class="bi bi-trash3 myIcon ml-1"></i></button>
                                            <button id="myBtnR" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?php echo $id ?>" title="Modeifica">
                                                <i class="bi bi-pencil myIcon ml-1"></i></button>
                                        </td>
                                    </tr>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fs-5" id="staticBackdropLabel">Elimina</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Sei sicur* di voler Cancellare <?php echo $nome ?> <?php echo $cognome ?>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-danger" onclick="deleteClient(<?php echo $id ?>)">Elimina</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fine delete modal -->
                                    <!-- Edit Modal -->
                                    <div class="modal" id="editModal<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modificare <?php echo $nome . ' ' . $cognome ?> ?</h1>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form" action="./crud/modifica_cliente.php" method="post">
                                                        <div class="text-danger font-weight-bold">
                                                            ID : <?php echo $id ?>
                                                            <input type="hidden" name="id" value="<?php echo $id ?>">
                                                        </div>
                                                        <div class="form-group mt-1">
                                                            <label>Nome: </label>
                                                            <input class="form-control" name="nome" value="<?php echo $nome ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Cognome: </label>
                                                            <input class="form-control" name="cognome" value="<?php echo $cognome ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Telefono: </label>
                                                            <input class="form-control" name="telefono" value="<?php echo $telefono ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email: </label>
                                                            <input class="form-control" name="email" value="<?php echo $email ?>">
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Modifica</button>
                                                </div>
                                                </form>
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
            </div>
        </div>
    </div>
<?php
} else {
    // nessun cliente trovato
    echo "Nessun cliente trovato";
}

// chiudere la connessione al database
$conn->close();
?>

<script>
    $.extend($.fn.dataTable.defaults, {
        responsive: true
    });

    function deleteClient(id) {
        var idCliente = id;

        $.ajax({
            type: "POST",
            url: "./crud/elimina_cliente.php",
            data: {
                id_cliente: idCliente
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