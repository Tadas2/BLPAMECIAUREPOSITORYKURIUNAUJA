<?php

require '../bootloader.php';

define('USERS', 'users');
define('DRINKS', 'input_drinks');

$db = new \Core\FileDB(ROOT_DIR . '/app/files/db.txt');
$model_user = new \App\Model\ModelUser($db, USERS);
$users = $model_user->loadAll();

$model_gerimai = new \App\Model\ModelGerimai($db, DRINKS);
$gerimai = $model_gerimai->loadAll();

$total_users = count($users);
$total_spirit = null;

if (count($gerimai) > 0) {
    foreach ($gerimai as $data) {
        $total_spirit += ($data->getAmount() / 100 * $data->getAbarot());
    }
}

if (count($gerimai) > 0 && $total_users > 0) {
    $ant_galvos = $total_spirit / $total_users;
}

if (isset($ant_galvos)) {

    if ($ant_galvos <= 100) {
        $bg_num = '1.jpg';
        $party_status = 'poop';
    } elseif ($ant_galvos > 100 && $ant_galvos <= 300) {
        $bg_num = '2.gif';
        $party_status = 'kablys';
    } elseif ($ant_galvos > 300 && $ant_galvos <= 500) {
        $bg_num = '3.gif';
        $party_status = 'good';
    } elseif ($ant_galvos > 500 && $ant_galvos <= 700) {
        $bg_num = '4.gif';
        $party_status = 'fire';
    } elseif ($ant_galvos > 700) {
        $bg_num = '5.jpg';
        $party_status = 'vomitron';
    }

    $bg_to_use = '../images/index-bg' . $bg_num;
}
?>
<html>
    <head>
        <title>CAhub Index</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
              integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
              crossorigin="anonymous"/>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="index" style="background-image: url('<?php print $bg_to_use ?? '../images/index-bg1.jpg'; ?>');">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="index.php">CAhub</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.php">Index</a>
                    <a class="nav-item nav-link" href="bring-it.php">Bring It</a>
                    <a class="nav-item nav-link" href="join-it.php">Join It</a>
                </div>
            </div>
        </nav>

        <h1>P-OOPARTY is On</h1>
        <h2>party status: <?php print $party_status ?? 'baliaus nėr'; ?></h2>

        <div class="container-fluid members">
            <h2>Baliaus dalyviai:</h2>
            <div class="container-fluid">
                <?php foreach ($users as $user): ?>
                    <div>
                        <h3>Username: <?php print $user->getUsername(); ?></h3>
                        <h3>Email: <?php print $user->getEmail(); ?></h3>
                        <h3>Full name: <?php print $user->getFullName(); ?></h3>
                        <h3>Age: <?php print $user->getAge(); ?></h3>
                        <h3>Gender: <?php print $user->getGenderOptions()[$user->getGender()]; ?></h3>
                        <h3>Orientation: <?php print $user->getOrientationOptions()[$user->getOrientation()]; ?></h3>
                        <img src="<?php print $user->getPhoto(); ?>" alt="<?php print $user->getUsername(); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="container-fluid drinks">
            <h2>Gėrimai:</h2>
            <div class="container-fluid">
                <?php foreach ($gerimai as $gerimas): ?>
                    <div>
                        <h3>Name: <?php print $gerimas->getName(); ?></h3>
                        <h3>Abarot: <?php print $gerimas->getAbarot(); ?></h3>
                        <h3>Amount: <?php print $gerimas->getAmount(); ?></h3>
                        <img src="<?php print $gerimas->getPhoto(); ?>" alt="<?php print $gerimas->getName(); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <section class="">

        </section>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
                crossorigin="anonymous"></script>
    </body>
</html>