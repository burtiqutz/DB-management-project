<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adresa = $conn->real_escape_string($_POST['adresa']);
    $nr_ap = $_POST['nr_ap'];
    $suprafata = $_POST['suprafata'];
    $id_proprietar = $_POST['id_proprietar'];

    $sql = "INSERT INTO apartament (adresa, nr_ap, suprafata, id_proprietar) 
            VALUES ('$adresa', $nr_ap, $suprafata, $id_proprietar)";

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
    <title>Insert into Apartament</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Insert into Apartament</h1>
    </header>
    <div id="welcome">
        <form action="insert_apartament.php" method="POST">
            <label for="adresa">Adresa:</label>
            <input type="text" id="adresa" name="adresa" required><br><br>

            <label for="nr_ap">Nr. Apartament:</label>
            <input type="number" id="nr_ap" name="nr_ap" required><br><br>

            <label for="suprafata">Suprafata:</label>
            <input type="number" id="suprafata" name="suprafata" required><br><br>

            <label for="id_proprietar">ID Proprietar:</label>
            <input type="number" id="id_proprietar" name="id_proprietar" required><br><br>

            <button type="submit">Insert</button>
        </form>
    </div>

    <div id="back-button">
    <a href="insert.php">Inapoi la meniul de inserare</a>
    </div>
</body>
</html>
