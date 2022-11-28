<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "caixa";

$conn = new PDO("mysql:dbname=$db; host=$host; charset=utf8", $user, $pass);
$valor = $_POST["valor"];
$entrada = 0;
$saida = 0;
if($_POST["movimentacao"] == "entrada"){
    $entrada = 1;
}elseif($_POST["movimentacao"] == "saida"){
    $saida = 1;
}
$data = [
    'valor' => $valor,
    'entrada' => $entrada,
    'saida' => $saida,
];
$sql = "INSERT INTO caixa (Valor, Entrada, Saida) VALUES (:valor, :entrada, :saida)";
$stmt= $conn->prepare($sql);
$stmt->execute($data);
?>