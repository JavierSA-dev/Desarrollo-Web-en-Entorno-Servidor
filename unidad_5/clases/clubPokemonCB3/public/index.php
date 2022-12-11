<?php
include '../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Models\Equipo;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();


define('DBHOST', $_ENV['DB_HOST']);
define('DBNAME', $_ENV['DB_NAME']);
define('DBUSER', $_ENV['DB_USER']);
define('DBPASS', $_ENV['DB_PASS']);
define('DBPORT', $_ENV['DB_PORT']);


$equipo = Equipo::getInstancia();

$equipo->setNombre('Equipo 5');
// $equipo->setUpdatedAt("hola");

print_r($equipo->get(33));
// get mensaje
print_r($equipo->getMensaje());
// $equipo->guardarenBD();

$equipo->edit(33);


