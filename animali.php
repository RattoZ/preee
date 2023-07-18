<?php
require_once('./liblayout.php');
// includere il file di configurazione del database
include 'config.php';
include('./lib/phpqrcode/qrlib.php');
$title = 'Animali';
$tempDir = './tmp/';

// seleziona gli animali ed il nome ed il cognome del padrone  ------
$sql = "SELECT az_animali.*, 
az_clienti.nome_cliente, az_clienti.cognome_cliente 
FROM az_animali 
LEFT JOIN az_clienti 
ON az_animali.id_cliente = az_clienti.id_cliente";

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
            <i class="bi bi-heart-pulse menu-icon mr-3 d-inline"> </i>
            <h4 class="card-title d-inline">Animali</h4>
          </div>
          <div class="table-responsive table-hover">
            <table id="myTable" class="table " cellspacing="0" width="100%">
              <!-- class= -->
              <!-- table-striped table-bordered display nowrap -->
              <thead>
                <th data-field="id">ID</th>
                <th data-field="nome">Nome</th>
                <th data-field="specie">Specie</th>
                <th data-field="razza">Razza</th>
                <th data-field="dataNascita">Data di nascita</th>
                <th data-field="clienteId">Cliente</th>
                <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
                <th>QR-Code</th>
              </thead>
              <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {

                  $animale_id = $row['id_animale'];
                  $nome = $row['nome_animale'];
                  $nomeAnimale = $row['nome_animale'];
                  $cliente = $row['cognome_cliente'] . ' ' . $row['nome_cliente'];
                  $specieAnimale = $row['specie_animale'];
                  $razzaAnimale = $row['razza_animale'];
                  $nascita = $row['data_nascita_animale'];
                  $clienteId = $row['id_cliente'];
                  $clienteNome = $row['nome_cliente'];
                  $clienteCognome = $row['cognome_cliente'];
                  $codeText = "Paziente: ;" . 'Nome : ' . $row['nome_animale']
                    . ";" . 'Specie:  ' . $row['specie_animale'] . ";" . 'Razza : ' . $row['razza_animale']
                    . ";;" . "Cliente : ;" . 'Nome: ' . $row['nome_cliente'] . ";" . 'Cognome: ' . $row['cognome_cliente'];
                  // outputs image directly into browser, as PNG stream
                  QRcode::png($codeText, $tempDir . $animale_id . 'qr.png', QR_ECLEVEL_M, 16, 4);
                ?>
                  <tr>
                    <td><?php echo $row['id_animale'] ?></td>
                    <td><?php echo $row['nome_animale'] ?></td>
                    <td><?php echo $row['specie_animale'] ?></td>
                    <td><?php echo $row['razza_animale'] ?></td>
                    <td><?php echo $row['data_nascita_animale'] ?></td>
                    <td title="ID: <?php echo $clienteId ?>"><?php echo $cliente ?></td>
                    <td>
                      <button id="myBtnY" class="btn btn-danger ml-4myBtnY" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $animale_id  ?>" title="Elimina">
                        <i class="bi bi-trash3 myIcon ml-1"></i></button>
                      <button id="myBtnR" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?php echo $animale_id ?>" title="Modifica">
                        <i class="bi bi-pencil myIcon ml-1"></i></button>
                    </td>
                    <td>
                      <form class="inner" method="get" action="./pdf_animale.php">
                        <input type="hidden" name="nome" value="<?php echo $nome ?>">
                        <input type="hidden" name="text" value="<?php echo $codeText ?>">
                        <input type="hidden" name="id" value="<?php echo $animale_id ?>">
                        <button id="myBtnG" class="btn btn-success" type="submit"><i class="bi bi-qr-code myIcon ml-1" title="PDF - Qrcode"></i></button>
                      </form>
                    </td>
                  </tr>
                  <!-- Delete Modal -->
                  <div class="modal fade" id="deleteModal<?php echo $animale_id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                          <button type="button" class="btn btn-danger" onclick="deleteAnimal(<?php echo $animale_id ?>)">Elimina</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Fine delete modal -->
                  <!-- myModal -->
                  <div class="modal" id="editModal<?php echo $animale_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Modificare <?php echo $nomeAnimale ?> ?</h1>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form" action="./crud/modifica_animale.php" method="post">
                            <div class="text-danger font-weight-bold">
                              ID : <?php echo $animale_id ?>
                              <input type="hidden" name="id" value="<?php echo $animale_id ?>">
                            </div>
                            <div class="form-group mt-1">
                              <label>Nome: </label>
                              <input class="form-control" name="nome_animale" value="<?php echo $nomeAnimale ?>">
                            </div>
                            <div class="form-group">
                              <label>Specie: </label>
                              <input class="form-control" name="specie_animale" value="<?php echo $specieAnimale ?>">
                            </div>
                            <div class="form-group">
                              <label>Razza: </label>
                              <input class="form-control" name="razza_animale" value="<?php echo $razzaAnimale ?>">
                            </div>
                            <div class="form-group">
                              <label>Data di nascita: </label>
                              <input type="date" class="form-control" name="nascita" value="<?php echo $nascita ?>">
                            </div>
                            <div class="form-group">
                              <label for="selectProprietario">Proprietario</label>
                              <select name="id_cliente" id="selectProprietario" class="form-control">
                                <option value="<?php echo $clienteId ?>"><?php echo $clienteNome ?></option>
                              </select>
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

  function deleteAnimal(id) {
    var idAnimale = id;

    $.ajax({
      type: "POST",
      url: "./crud/elimina_animale.php",
      data: {
        id_animale: idAnimale
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