<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personajes de lugares</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Personajes de lugares individuales</h1>
</header>
<main class="align-items-center">
    <?php
    $ch = curl_init();
    $id=$_GET['id_location'];
    $char=infoApi($ch, $id);
    if($char==0){
        echo "<h2>No hay personajes en este lugar</h2>";
    }else{

        $ids=stringIds($char);
        $characters=[];
        $url = "https://rickandmortyapi.com/api/character/".$ids;
        $response = ApiConnect($ch, $url);
        if (curl_errno($ch)) {
            $error_MSG = 'Error:'.curl_error($ch);
            echo "error al conectarse a la api: ".$error_MSG;
        } else {
            $result = json_decode($response, true);
            $characters = array_values($result);
        }
        printHTMl($characters);
    }
    curl_close($ch);
    ?>
</main>
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
function infoApi($ch, $id):array|int
{
    $info = 0;
    $url = "https://rickandmortyapi.com/api/location/".$id;
    $response = ApiConnect($ch, $url);
    if (curl_errno($ch)) {
        $error_MSG = 'Error:'.curl_error($ch);
        echo "error al conectarse a la api: ".$error_MSG;
    } else {
        $result = json_decode($response, true);
        if($result['residents']!=null){
            return $result['residents'];
        }
    }
    return $info;
}
function stringIds($array): string
{
    $cadena= "";
    for ($i = 0; $i < count($array); $i++) {
        $cap = (int) filter_var($array[$i], FILTER_SANITIZE_NUMBER_INT);
        $cadena .= $cap.",";
    }
    return $cadena;
}
function printHTMl($characters): void
{
    foreach ($characters as $character) {
        echo '<article class="align-items-center" >';
        echo '<div class="image-container align-items-center">';
        echo '<img src="'.$character['image'].'" alt="imagen personaje">';
        echo "</div>";
        echo "<h2>Nombre: ".$character['name']."</h2>";
        echo "<h4>Estado: ".$character['status']."</h4>";
        echo "<h4>Especie: ".$character['species']."</h4>";
        echo '<a href="Show_More_Character.php?id='.$character["id"].'" type="button" class="btn btn-outline-info" id="'.$character['id'].'">Info</a>';

        echo "</article>";
    }
}
?>