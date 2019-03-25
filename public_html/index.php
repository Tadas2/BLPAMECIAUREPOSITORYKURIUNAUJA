<?php

require '../bootloader.php';

$db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
$db->save();

$kokteilis = new \App\Item\Gerimas([
    'name' => 'draugas imete lsd',
    'amount_ml' => 600,
    'abarot' => 00.00,
    'image' => 'images/random.png'
    ]);

$vynas = new \App\Item\Gerimas([
    'name' => 'x-failai',
    'amount_ml' => 300,
    'abarot' => 13.00,
    'image' => 'images/xfailai.jpg'
    ]);

$dege = new \App\Item\Gerimas([
    'name' => 'MILK',
    'amount_ml' => 500,
    'abarot' => 00.00,
    'image' => 'images/milk.jpg'
    ]);

$pinakolada = new \App\Item\Gerimas([
    'name' => 'Peni kolada',
    'amount_ml' => 200,
    'abarot' => 15.00,
    'image' => 'images/pina.jpg'
    ]);

$model_gerimai = new App\model\ModelGerimai($db, 'kokteiliai');
$model_gerimai->insert('kokteilis', $kokteilis);
$model_gerimai->insert('vynas', $vynas);
$model_gerimai->insert('dege', $dege);
$model_gerimai->insert('pinakolada', $pinakolada);
?>
<html>
    <head>
        <title>Kokteiliu meniu</title>
    </head>
    <body>
        <?php foreach ($model_gerimai->loadAll() as $gerimas): ?>
        <div>
            <p>Pavadinimas: <?php print $gerimas->getName(); ?></p>
            <p>Kiekis: <?php print $gerimas->getAmount();?></p>
            <p>Abarotai: <?php print $gerimas->getAbarot();?></p>
            <p><img src="<?php print $gerimas->getImage();?>"></p>
            <?php endforeach; ?>
        </div>
    </body>
</html>