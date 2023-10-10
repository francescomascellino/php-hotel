<!-- 
Descrizione
Partiamo da questo array di hotel. https://www.codepile.net/pile/OEWY7Q1G
Stampare tutti i nostri hotel con tutti i dati disponibili.
Iniziate in modo graduale. Prima stampate in pagina i dati, senza preoccuparvi dello stile. Dopo aggiungete Bootstrap e mostrate le informazioni con una tabella.

Bonus:
Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)
NOTA: deve essere possibile utilizzare entrambi i filtri contemporaneamente (es. ottenere una lista con hotel che dispongono di parcheggio e che hanno un voto di tre stelle o superiore) Se non viene specificato nessun filtro, visualizzare come in precedenza tutti gli hotel.
-->

<?php


$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

// Receuperiamo i dati della richiesta
$park_check = false;

if (isset($_GET['parking'])) {
    $park_check = true;

    // echo 'checked';
    var_dump($park_check);
}

var_dump("PARKING: $_GET[parking] - PARKCHECK: $park_check, VOTE: $_GET[vote]");



foreach ($hotels as $hotel) {
    // se il checkbox è stato spuntato...
    if ($park_check) {
        var_dump('1');

        // se $hotel['parking'] è true && è stato cercato un voto
        if ($hotel['parking'] && isset($_GET['vote']) && $_GET['vote'] > 0 && $hotel['vote'] >= $_GET['vote']) {
            var_dump('2');

            // gli hotel trovati vengono aggiunti all'array degli hotels filtrati
            $filteredHotels[] = $hotel;

            // altrimenti se cerchiamo solo hotel con parcheggio
        } elseif ($hotel['parking']) {
            var_dump('3');

            // gli hotel trovati vengono aggiunti all'array degli hotels filtrati
            $filteredHotels[] = $hotel;
        }

        // altrimenti...
    } else {
        var_dump('4');

        // se non cerchiamo parcheggi ma solo voti
        if (isset($_GET['vote']) && $_GET['vote'] > 0) {

            // se il voto è uguale o maggiore al valore del form
            if ($hotel['vote'] >= $_GET['vote']) {
                var_dump('5');

                // gli hotel trovati vengono aggiunti all'array degli hotels filtrati
                $filteredHotels[] = $hotel;
            }
        } else {
            var_dump('6');

            //se non cerchiamo voti o
            $filteredHotels[] = $hotel;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP HOTELS</title>

    <!-- BS5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <div class="row">
            <h1 class="text-center my-3">Hotels</h1>

            <form action="" method="GET" class="my-3">

                <div class="row g-3 align-items-center">

                    <div class="form-check col-auto">

                        <input class="form-check-input" type="checkbox" value="true" name="parking" id="parking">
                        <label class="form-check-label" for="parking">
                            Parcheggio
                        </label>

                    </div>

                    <div class="col-auto">

                        <label for="vote" class="col-form-label">Voto</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" id="vote" name="vote" class="form-control" min="1" max="5" aria-describedby="voteHelp">
                    </div>
                    <div class="col-auto">
                        <span id="voteHelp" class="form-text">
                            (il voto deve essere un valore compreso tra 1 e 5)
                        </span>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: fit-content;">Cerca</button>
                </div>

            </form>

            <table class="table my-3">
                <thead>
                    <tr>
                        <th scope="col" class="text-uppercase">Nome</th>
                        <th scope="col" class="text-uppercase">Descrizione</th>
                        <th scope="col" class="text-uppercase">Parcheggio</th>
                        <th scope="col" class="text-uppercase">Voto</th>
                        <th scope="col" class="text-uppercase">Distanza dal centro</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Stampare tutti i nostri hotel con tutti i dati disponibili. -->

                    <?php foreach ($filteredHotels as $hotel) : ?>

                        <tr>

                            <th scope="row"><?= $hotel["name"] ?></th>

                            <td><?= $hotel["description"] ?></td>

                            <td>
                                <?= $hotel["parking"] ? "Si" : "No" ?>
                            </td>

                            <td><?= $hotel["vote"] ?></td>

                            <td><?= $hotel["distance_to_center"] ?></td>

                        </tr>

                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>

</body>

</html>