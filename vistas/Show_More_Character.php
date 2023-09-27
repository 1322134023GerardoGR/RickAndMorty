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
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">RICK AND MORTY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Characters.php">PERSONAJES</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="Locations.php">LUGARES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Episodes.php">EPISODIOS</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</header>
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
        echo '<div class="container">';
        echo '<img src="'.$character["image"].'" id="img" class="card-img-top" alt="Imagen de '.$character["name"].'">';
        echo '<div class="card-body">';
        echo '<h2 class="card-title" id="nombre">Nombre: '.$character["name"].'</h2>';
        echo '<p class="card-text" id="especie">Especie: '.$character["species"].'</p>';
        echo '<p class="card-text" id="genero">Genero: '.$character["gender"].'</p>';
        echo '<p class="card-text" id="estado">Estado: '.$character["status"].'</p>';
        echo '<p class="card-text" id="origen">Lugar de origen: '.$character["origin"]["name"].'</p>';
        echo '<p class="card-text" id="ubicacion">Visto por ultima vez en: '.$character["location"]["name"].'</p>';
        echo '</div>';
        echo '</div>';
    }catch (Exception $e){
        echo "error al imprimir el html: ".$e;
    }

}