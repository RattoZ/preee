<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // recuperare i dati del form
    $nome = $_POST["nomeAnimale"];
    $specie = $_POST["specie"];
    $razza = $_POST["razza"];
    $data_nascita = $_POST["nascita"];
    $cliente_id = $_POST["id_cliente"];

    // validare i dati del form
    if (empty($cliente_id) || empty($nome) || empty($specie)) {
        echo "Cliente, nome e specie sono obbligatori";
    } else {
        if(empty($data_nascita)) {
            // inserire il nuovo animale nella tabella "az_animali"
            $sql = "INSERT INTO az_animali (nome_animale, specie_animale, razza_animale, data_nascita_animale, id_cliente) VALUES ('$nome', '$specie', '$razza', null, '$cliente_id')";
        } else {
            $sql = "INSERT INTO az_animali (nome_animale, specie_animale, razza_animale, data_nascita_animale, id_cliente) VALUES ('$nome', '$specie', '$razza', '$data_nascita', '$cliente_id')";
        }
        if ($conn->query($sql) === TRUE) {
            $sql = 'SELECT id_animale, nome_animale FROM `az_animali` ORDER BY id_animale DESC LIMIT 1';
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $id_animale = $row['id_animale'];
                $nome_animale = $row['nome_animale'];
            }

            $sql = 'SELECT nome_cliente FROM az_clienti WHERE id_cliente = ' . $cliente_id;
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $nome_cliente = $row['nome_cliente'];
            }
?>
            <form id="myForm" method="post" action="../inserisci-visita.php">
                <input type="hidden" name="id_animale" value="<?php echo $id_animale ?>">
                <input type="hidden" name="nome_animale" value="<?php echo $nome_animale ?>">
                <input type="hidden" name="id_cliente" value="<?php echo $cliente_id ?>">
                <input type="hidden" name="nome_cliente" value="<?php echo $nome_cliente ?>">
            </form>
<?php
            // }
            echo "Animale aggiunto con successo";
        }
    }
}

?>

<script type="text/javascript">
    window.onload = function() {
        document.getElementById("myForm").submit();
    };
</script>