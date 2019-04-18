<?php
require_once '../bootloader.php';

$connection = new Core\Database\Connection(
        [
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'domas123'
        ]);

$pdo = $connection->getPDO();
$sql = strtr("SELECT * FROM @db . @table WHERE (@gender = @gender_value) AND (@age = @age_value)", [
  '@db' => Core\Database\SQLBuilder::schema('my_db'),
  '@table' => Core\Database\SQLBuilder::table('users'),
  '@gender' => Core\Database\SQLBuilder::column('gender'),
  '@age' => Core\Database\SQLBuilder::column('age'),
  '@gender_value' => Core\Database\SQLBuilder::value('f'),
  '@age_value' => Core\Database\SQLBuilder::value(16)
]);

$query = $pdo->query($sql);
$data = $query->fetchALL(PDO::FETCH_ASSOC);
var_dump($data);
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
