<?php
require '../bootloader.php';

$form = [
    'fields' => [
        'pavadinimas' => [
            'name' => 'pavadinimas',
            'label' => 'Iveskite pavadinima ',
            'type' => 'text',
            'placeholder' => 'Gerimo pavadinimas',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'amount_ml' => [
            'name' => 'amount_ml',
            'label' => 'Iveskite kieki ',
            'type' => 'number',
            'placeholder' => 'Gerimo turis',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'abarot' => [
            'name' => 'abarot',
            'label' => 'Iveskite abarota ',
            'type' => 'text',
            'placeholder' => 'Gerimo abarotai',
            'validate' => [
                'validate_not_empty',
            ],
        ],
        'image' => [
            'name' => 'image',
            'label' => 'Iveskite paveiksliuko url ',
            'type' => 'file',
            'placeholder' => '',
          'validate' => [
              'validate_field_file',
              // 'validate_not_empty',
          ],
        ]
    ],
    'buttons' => [
        'submit' => [
            'text' => 'Submit'
        ]
    ],
    'callbacks' => [
        'success' => [
            'form_success'
        ],
        'fail' => []
    ]
];


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

function form_success($safe_input, $form) {
    $db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
    $model_gerimai = new App\model\ModelGerimai($db, 'kokteiliai');
    $gerimas = new \App\Item\Gerimas([
        'name' => $safe_input['pavadinimas'],
        'amount_ml' => $safe_input['amount_ml'],
        'abarot' => $safe_input['abarot'],
        'image' => $safe_input['image'],
    ]);
    $id = time() . '_' . rand(0, 10000);
    $model_gerimai->insert($id, $gerimas);
}

function validate_form_img(&$safe_input, &$form) {
    $file_saved_url = save_file($safe_input['img']);
    if ($file_saved_url) {
        $safe_input['img'] = $file_saved_url;
        return true;
    } else {
        $form['error_msg'] = 'blogas failas';
    }
}
function save_file($file, $dir = 'uploads', $allowed_types = ['image/png', 'image/jpeg', 'image/gif']) {
    
    if ($file['error'] == 0 && in_array($file['type'], $allowed_types)) {
        $target_file_name = microtime() . '-' . strtolower($file['name']);
        $target_path = $dir . '/' . $target_file_name;
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            return $target_file_name;
        }
    }
    return false;
}

$model_gerimai = new App\model\ModelGerimai($db, 'Gerimai');

if (!empty($_POST)) {
    $safe_input = get_safe_input($form);
    $success = validate_form($safe_input, $form);
}

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
                <p>Kiekis: <?php print $gerimas->getAmount(); ?></p>
                <p>Abarotai: <?php print $gerimas->getAbarot(); ?></p>
                <p><img src="<?php print $gerimas->getImage(); ?>"></p>
            <?php endforeach; ?>
        </div>
        <div>
            <?php require ROOT_DIR . '/core/views/form.php'; ?>
        </div>
    </body>
</html>