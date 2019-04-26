<?php
require_once '../bootloader.php';

$connection = new \Core\Database\Connection(DB_CREDENTIALS);
$schema = new \Core\Database\Schema($connection, DB_NAME);

$repository = new \Core\User\Repository($connection);

//READY

$user = new \Core\User\User([
    'email' => 'valdau@nxxsda.comm',
    'password' => 'bbd',
    'full_name' => 'Zanas Vandamas',
    'account_type' => \Core\User\User::ACCOUNT_TYPE_USER,
    'is_active' => true,
    'age' => 26,
    'gender' => 'm'
        ]);

$success = $repository->insert($user);
var_dump('success', $success);
$users = $repository->loadAll();
?>
<html>
    <head>
        <title>Tyler`s Framework</title>
    </head>
    <body>
        <?php foreach ($users as $user): ?>
            <ul>
                <li>
                    <b>Email:</b>
                    <i><?php print $user->getEmail(); ?></i>
                </li>
            </ul>
        <?php endforeach; ?>
    </body>
</html>
