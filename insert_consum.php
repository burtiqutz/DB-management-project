<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_ap = $_POST['id_ap'];
    $an = $_POST['an'];
    $luna = $_POST['luna'];
    $nr_pers = $_POST['nr_pers'];
    $cantitate = $_POST['cantitate'];
    $valoare = $_POST['valoare'];
    $pret_apa = $_POST['pret_apa'];

    $sql = "INSERT INTO consum (id_ap, an, luna, nr_pers, cantitate, valoare, pret_apa) 
            VALUES ($id_ap, $an, $luna, $nr_pers, $cantitate, $valoare, $pret_apa)";

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
    <title>Insert into Consum</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Insert into Consum</h1>
    </header>
    <div id="welcome">
        <form action="insert_consum.php" method="POST">
            <label for="id_ap">ID Apartament:</label>
            <input type="number" id="id_ap" name="id_ap" required><br><br>

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
