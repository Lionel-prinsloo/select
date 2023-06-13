<?php



$host = 'localhost:3307';
$db   = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected to $db";
} 
    catch (\PDOException $e) 
{
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>


<form method="POST" action="Toets-PDO.php">


product_naam: <input type="text" name="product_naam"><br>
prijs_per_stuck: <input type="float" name="prijs_per_stuck"><br>
omscrijving: <input type="text" name="omschrijving"><br>

<input type="submit" value="Sturen" name="Sturen">

</form>


<?php

//deel 1

 if (isset($_POST["Sturen"])) {
    $sql = "INSERT INTO `producten` (`product_code`, `product_naam`, `prijs_per_stuck`, `omschrijving`) VALUES (NULL, :product_naam, :prijs_per_stuck, :omschrijving)";
    $stmt = $pdo->prepare($sql);
    
    $data = [
        "product_naam" => $_POST['product_naam'],
        "prijs_per_stuck" => $_POST['prijs_per_stuck'],
        "omschrijving" => $_POST['omschrijving']
    ];
    $stmt->execute($data);
}

//Hoe je alles selecteert in een query zonder variabele"
$stmt = $pdo->query("SELECT * FROM winkel.producten");
$result = $stmt->fetchAll();

foreach ($result as $row) {
    echo $row['product_code'] . " " .$row['product_naam'] . " " . $row['prijs_per_stuck'] . $row['omschrijving'] . "<br>";
}


//Deel2

//Hoe je een single row selecteert met placeholders
$stmt = $pdo->query("SELECT * FROM winkel.producten WHERE product_code = 1");
$resultaat = $stmt->fetchAll();

foreach ($resultaat as $roww) {
    echo $roww['product_code'] . " " .$roww['product_naam'] . " " . $roww['prijs_per_stuck'] . $roww['omschrijving'] . "<br>";
}

//Deel3


//Hoe je een single row selecteert met named parameters
$stmt = $pdo->query("SELECT * FROM winkel.producten WHERE product_code = 2");
$resultaat = $stmt->fetchAll();

foreach ($resultaat as $roww) {
    echo $roww['product_code'] . " " .$roww['product_naam'] . " " . $roww['prijs_per_stuck'] . $roww['omschrijving'] . "<br>";
}


?>

