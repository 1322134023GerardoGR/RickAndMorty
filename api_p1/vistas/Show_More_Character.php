<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mas info personajes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="align-items-center">
<h1>Mas informacion del personaje</h1>
<div id="more_info align-items-center">
    <div class="card" style="width: 18rem;">
        <?php
        try {
            $ch = curl_init();
            $id=$_GET['id'];
            $url = "https://rickandmortyapi.com/api/character/".$id;
            $response = ApiConnect($ch, $url);
            if (curl_errno($ch)) {
                $error_MSG = 'Error:'.curl_error($ch);
                echo "error al conectarse a la api: ".$error_MSG;
            } else {
                $result = json_decode($response, true);
                $character = $result;
            }
            printHTMl($character);
            curl_close($ch);

            //printJson($locations);
        } catch (Exception $e) {
            echo "error al conectarse a la api: ".$e;
        }

        ?>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</html>
<?php
function ApiConnect($ch, $url): bool|string
{
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    return $response;
}
function printHTML($character): void
{
    try{
        echo '<img src="'.$character["image"].'" id="img" class="card-img-top" alt="Imagen de '.$character["name"].'">';
        echo '<div class="card-body">';
        echo '<h2 class="card-title" id="nombre">Nombre: '.$character["name"].'</h2>';
        echo '<p class="card-text" id="especie">Especie: '.$character["species"].'</p>';
        echo '<p class="card-text" id="genero">Genero: '.$character["gender"].'</p>';
        echo '<p class="card-text" id="estado">Estado: '.$character["status"].'</p>';
        echo '<p class="card-text" id="origen">Lugar de origen: '.$character["origin"]["name"].'</p>';
        echo '<p class="card-text" id="ubicacion">Visto por ultima vez en: '.$character["location"]["name"].'</p>';
        echo '</div>';
    }catch (Exception $e){
        echo "error al imprimir el html: ".$e;
    }

}