<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personajes</title>
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
    <h1>Personajes de Rick and Morty</h1>
</header>
<h2 >Personajes aleatorios</h2>
<main class="align-items-center">
    <?php
    try {
        $ch = curl_init();
        $cant = infoApi($ch);
        $ids = stringIds($cant);
        $url = "https://rickandmortyapi.com/api/character/".$ids;
        $response = ApiConnect($ch, $url);
        if (curl_errno($ch)) {
            $error_MSG = 'Error:'.curl_error($ch);
            echo "error al conectarse a la api: ".$error_MSG;
        } else {
            $result = json_decode($response, true);
            $characters = array_values($result);
        }
        $characters = orderArray($characters, 'species');
        $randomCharacters=printRandom($characters);
        printHTMl($randomCharacters);
        echo '<br>';
        printHTMl($characters);
        curl_close($ch);

        //printJson($locations);
    } catch (Exception $e) {
        echo "error al conectarse a la api: ".$e;
    }


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

function infoApi($ch)
{
    $cant = 0;
    $url = "https://rickandmortyapi.com/api/character/";
    $response = ApiConnect($ch, $url);
    if (curl_errno($ch)) {
        $error_MSG = 'Error:'.curl_error($ch);
        echo "error al conectarse a la api: ".$error_MSG;
    } else {
        $result = json_decode($response, true);
        $info = $result['info'];
        $cant = $info['count'];
        return $cant;
    }

    return $cant;
}

function stringIds($cant): string
{
    $ids = "";
    for ($i = 1; $i <= $cant; $i++) {
        $ids .= $i.",";
    }
    return $ids;
}

function printJson($array): void
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
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

function printRandom($characters): array
{
    $temp = [];
    for ($i = 0; $i < 5; $i++) {
        $random = randomNumber($characters);
        $temp[] = $characters[$random];
    }
    return $temp;
}

function randomNumber($array): int
{
    $random = rand(0, count($array));
    return $random;
}

function orderArray($array, $filter): array
{
    $temp = [];
    foreach ($array as $key => $value)
        $temp[$value[$filter]."oldkey".$key] = $value;
    ksort($temp);
    $array = array_values($temp);
    unset($temp);
    return $array;
}



/*
echo "<article>";
echo '<div class="image-container">';
    echo '<img src="'.$result['image'].'" alt="imagen personaje">';
    echo "</div>";
echo "<h2>Nombre: ".$result['name']."</h2>";
echo "<h4>Estado: ".$result['status']."</h4>";
echo "<h4>Especie: ".$result['species']."</h4>";
echo "</article>";
*/
?>