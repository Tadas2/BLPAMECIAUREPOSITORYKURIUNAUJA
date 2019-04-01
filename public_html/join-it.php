<?php

require '../bootloader.php';

define('USERS', 'users');

$form = [
    'fields' => [
        'user_username' => [
            'label' => 'Username',
            'type' => 'text',
            'placeholder' => 'Your username',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'user_email' => [
            'label' => 'Email',
            'type' => 'text',
            'placeholder' => 'Your email',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'user_full_name' => [
            'label' => 'Full name',
            'type' => 'text',
            'placeholder' => 'Your full name',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'user_age' => [
            'label' => 'Age',
            'type' => 'number',
            'placeholder' => 'Your age',
            'validate' => [
                'validate_not_empty',
                'validate_is_number'
            ]
        ],
        'user_gender' => [
            'label' => 'Choose gender',
            'type' => 'select',
            'validate' => [
                'validate_not_empty'
            ],
            'options' => \App\User::getGenderOptions()
        ],
        'user_orientation' => [
            'label' => 'Choose orientation',
            'type' => 'select',
            'validate' => [
                'validate_not_empty',
            ],
            'options' => \App\User::getOrientationOptions()
        ],
        'user_photo' => [
            'label' => 'Photo',
            'placeholder' => 'file',
            'type' => 'file',
            'validate' => [
                'validate_file'
            ]
        ]
    ],
    'validate' => [
        'validate_form_file'
    ],
    'buttons' => [
        'submit' => [
            'text' => 'Registruoti'
        ]
    ],
    'callbacks' => [
        'success' => [
            'form_success'
        ],
        'fail' => []
    ]
];

function validate_form_file(&$safe_input, &$form) {
    $file_saved_url = save_file($safe_input['user_photo']);

    if ($file_saved_url) {
        $safe_input['user_photo'] = 'uploads/' . $file_saved_url;

        return true;
    } else {
        $form['error_msg'] = 'Jobans/a tu buhurs/gazele nes failas supistas!';
    }
}

function form_success($safe_input, $form) {
    $user = new \App\User([
        'username' => $safe_input['user_username'],
        'email' => $safe_input['user_email'],
        'full_name' => $safe_input['user_full_name'],
        'age' => $safe_input['user_age'],
        'gender' => $safe_input['user_gender'],
        'orientation' => $safe_input['user_orientation'],
        'photo' => $safe_input['user_photo']
    ]);

    $db = new \Core\FileDB(ROOT_DIR . '/app/files/db.txt');
    $model_user = new \App\Model\ModelUser($db, USERS);
    $model_user->insert(microtime(), $user);
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

$show_form = true;

if (!empty($_POST)) {
    $safe_input = get_safe_input($form);
    $form_success = validate_form($safe_input, $form);

    if ($form_success) {
        $success_msg = strtr('User "@user_username" sėkmingai sukurtas!', [
            '@user_username' => $safe_input['user_username']
        ]);
        $show_form = false;
    }
}

?>
<html>
    <head>
        <title>CAhub Join It</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
              integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
              crossorigin="anonymous"/>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="container-fluid">
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

        <h1>Join the P-OOPARTY</h1>

        <section class="form">
            <!-- Content -->
            <?php if ($show_form): ?>
                <!-- Form -->
                <?php require '../core/objects/form.php'; ?>
            <?php else: ?>
                <h3><?php print $success_msg; ?></h3>
            <?php endif; ?>
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