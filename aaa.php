<?php
require_once('./liblayout.php');
include 'config.php';
?>
<div>
    <select id="selectProprietario">
        <option value="">Uno</option>
        <option value="2">Due</option>
        <option value="3">Tre</option>
        <option value="4">Quattro</option>
        <option value="109">Centonove</option>
    </select>
</div>
<div>
    <label for="selectAnimali">Animale</label>
    <select name="id_animale" id="selectAnimali" class="form-control">
        <option value="">Seleziona un animale</option>
    </select>
</div>

<script>
    $('#selectAnimali').on('focus', function() {
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