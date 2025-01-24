<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_proprietar = $_POST['id_proprietar'];
    $nume = $conn->real_escape_string($_POST['nume']);
    $email = $conn->real_escape_string($_POST['email']);
    $id_ap = $_POST['id_ap'];
    $adresa = $conn->real_escape_string($_POST['adresa']);
    $nr_ap = $_POST['nr_ap'];
    $suprafata = $_POST['suprafata'];
    $an = $_POST['an'];
    $luna = $_POST['luna'];
    $nr_pers = $_POST['nr_pers'];
    $cantitate = $_POST['cantitate'];
    $valoare = $_POST['valoare'];
    $pret_apa = $_POST['pret_apa'];

    $sql = "INSERT INTO consum_ap_turda (id_proprietar, nume, email, id_ap, adresa, nr_ap, suprafata, an, luna, nr_pers, cantitate, valoare, pret_apa) 
            VALUES ($id_proprietar, '$nume', '$email', $id_ap, '$adresa', $nr_ap, $suprafata, $an, $luna, $nr_pers, $cantitate, $valoare, $pret_apa)";

    if ($conn->query($sql) === TRUE) {
        echo "<div id='welcome'><p>Record inserted successfully!</p></div>";
    } else {
        echo "<div id='welcome'><p>Error: " . $conn->error . "</p></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert into Consum Ap Turda</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Insert into Consum Ap Turda</h1>
    </header>
    <div id="welcome">
        <form action="insert_consum_ap_turda.php" method="POST">
            <label for="id_proprietar">ID Proprietar:</label>
            <input type="number" id="id_proprietar" name="id_proprietar" required><br><br>

            <label for="nume">Nume:</label>
            <input type="text" id="nume" name="nume" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="id_ap">ID Apartament:</label>
            <input type="number" id="id_ap" name="id_ap" required><br><br>

            <label for="adresa">Adresa:</label>
            <input type="text" id="adresa" name="adresa" required><br><br>

            <label for="nr_ap">Nr. Apartament:</label>
            <input type="number" id="nr_ap" name="nr_ap" required><br><br>

            <label for="suprafata">Suprafata:</label>
            <input type="number" id="suprafata" name="suprafata" required><br><br>

            <label for="an">An:</label>
            <input type="number" id="an" name="an" required><br><br>

            <label for="luna">Luna:</label>
            <input type="number" id="luna" name="luna" required><br><br>

            <label for="nr_pers">Nr. Persoane:</label>
            <input type="number" id="nr_pers" name="nr_pers" required><br><br>

            <label for="cantitate">Cantitate:</label>
            <input type="number" id="cantitate" name="cantitate" required><br><br>

            <label for="valoare">Valoare:</label>
            <input type="number" id="valoare" name="valoare" required><br><br>

            <label for="pret_apa">Pret Apa:</label>
            <input type="number" id="pret_apa" name="pret_apa" required><br><br>

            <button type="submit">Insert</button>
        </form>
    </div>

    <div id="back-button">
        <a href="insert.php">Inapoi la meniul de inserare</a>
    </div>
</body>
</html>
