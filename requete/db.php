<?php
// try {
//     $pdo = new PDO('mysql:host=localhost;dbname=GestionProjetCollaboratif', 'root', '');
//     // Définir le mode d'erreur PDO sur Exception
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Erreur de connexion à la base de données: " . $e->getMessage());
// }



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$username = "dijch2030361_bdimm";
$password = "*Pp.E;TxD^BZ";
$dbname = "dijch2030361_bdimm";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}


?>