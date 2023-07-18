<?php
require_once('./liblayout.php');
include 'config.php';
$title = 'Visite Detail';

$id_appuntamento = $_GET['id_visita'];

$sql = 'SELECT az_visite.*, az_animali.id_animale, az_animali.nome_animale ,az_clienti.id_cliente, az_clienti.nome_cliente 
FROM az_visite LEFT JOIN az_animali ON  az_animali.id_animale = az_visite.id_animale
LEFT JOIN az_clienti ON az_clienti.id_cliente = az_animali.id_cliente
WHERE id_appuntamento =' . $id_appuntamento;

// $sql = "SELECT az_visite.*, 
// az_animali.id_animale, az_animali.nome_animale 
// FROM az_visite 
// LEFT JOIN az_animali 
// ON az_visite.id_animale = az_animali.id_animale
// WHERE az_visite.id_appuntamento =' . $id_appuntamento;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_visita = $row['id_appuntamento'];
        $data = $row['data_appuntamento'];
        $id_animale = $row['id_animale'];
        $nome_animale = $row['nome_animale'];
        $id_cliente = $row['id_cliente'];
        $nome_cliente = $row['nome_cliente'];
?>
        <div id="message"></div>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-inline text-secondary"><i class="bi bi-bell menu-icon mr-3 d-inline"> </i>Visita di: </h5>
                        <h3 class="d-inline"><?php echo $nome_animale ?></h3>
                        <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#last">Ultima visita</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#list">Static</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane active" id="last">
                    <?php



                    echo 'ID' . $id_animale . '<br>';
                    echo 'Data: ' . $data . '<br>';
                    echo 'Id animale ' . $id_animale . '<br>';
                    echo 'Nome animale ' . $nome_animale . '<br>';
                    echo 'Id cliente ' . $id_cliente . '<br>';
                    echo 'Nome cliente ' . $nome_cliente . '<br><br>';
                }
            }

                    ?>
                        </div>
                        <div class="tab-pane" id="list">
                            <?php
                            $sql = "SELECT * FROM az_visite WHERE id_animale = " . $id_animale;
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {


                            ?>
                                    <ul class="myMenu">
                                        <li>
                                            <a href="#" class="shadow-sm list-group-item list-group-item-action d-flex gap-3 py-3 hover-effect hover-overlay" aria-current="true">
                                                <i class="bi bi-clipboard2-pulse bi-10x text-success" style="font-size: 50px"></i>
                                                <!-- <img src="https://github.com/twbs.png" alt="twbs" class="rounded-circle flex-shrink-0" width="32" height="32"> -->
                                                <div class="d-flex gap-2 w-100 justify-content-between hover-effect hover-overlay" bis_skin_checked="1">
                                                    <div bis_skin_checked="1">
                                                        <p class="mb-0 opacity-75">Visita del:</p>
                                                        <h6 class="mb-0 d-inline"><i class="bi bi-calendar2-date-fill text-secondary hover-effect"> </i><?php echo $row['data_appuntamento'] ?> </h6>
                                                        <p>
                                                            <i class="bi bi-clock-fill text-secondary"> </i><?php echo $row['ora_appuntamento'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <ul>
                                            <li><a>OOOOSJOIDAJOWIJ</a></li>
                                        </ul>
                                    </ul>
                                <?php
                                }
                            }
                                ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>