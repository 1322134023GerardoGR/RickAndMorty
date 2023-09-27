<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
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
<br>
<div class="container">
    <div class="row align-items-start">
        <div class="col">
            <img src="https://m.media-amazon.com/images/I/91MteSqsrJL._AC_UF894,1000_QL80_.jpg" alt="Rick and Morty">
        </div>
        <div class="col">
            <a href="Characters.php" class="btn btn-info">Personajes</a>
            <a href="Locations.php" class="btn btn-info">Lugares</a>
            <a href="Episodes.php" class="btn btn-info">Episodios</a>
        </div>

    </div>
</div>
</body>
</html>
