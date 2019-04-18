<?php
require_once '../bootloader.php';

$connection = new Core\Database\Connection(
        [
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'domas123'
        ]);

$pdo = $connection->getPDO();
$sql = strtr("UPDATE @db . @table SET @gender = @gender_value, @age = @age_value", [
  '@db' => Core\Database\SQLBuilder::schema('my_db'),
  '@table' => Core\Database\SQLBuilder::table('users'),
  '@gender' => Core\Database\SQLBuilder::column('gender'),
  '@age' => Core\Database\SQLBuilder::column('age'),
  '@gender_value' => Core\Database\SQLBuilder::value('m'),
  '@age_value' => Core\Database\SQLBuilder::value(rand(0, 100))
]);

$query = $pdo->exec($sql);
//$users = [];
//$last_gender = '';
//while ($row = $query->fetch(PDO::FETCH_LAZY)) {
//    $gender = $row['gender'];
//    if ($gender == $last_gender && $gender == 'm') {
//        break;
//    } else {
//        $last_gender = $gender;
//        $users[] = [
//            'email' => $row['email']
//        ];
//    }
//}
//
//
//$sudas = 'sudas';
//$builder = new Core\Database\SQLBuilder();
//
//print $builder->column($sudas);
//
//

?>
<html>
    <head>
        <title>Fetch</title>
    </head>
    <body>
    </body>
</html>
