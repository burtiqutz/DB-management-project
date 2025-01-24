<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $id_ap = $_POST['id_ap'];
    $valoare = $_POST['valoare'];
    $detalii_exceptie = $conn->real_escape_string($_POST['detalii_exceptie']);

    $sql = "INSERT INTO exceptii (data, id_ap, valoare, detalii_exceptie) 
            VALUES ('$data', $id_ap, $valoare, '$detalii_exceptie')";

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
    <title>Insert into Exceptii</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Insert into Exceptii</h1>
    </header>
    <div id="welcome">
        <form action="insert_exceptii.php" method="POST">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required><br><br>

            <label for="id_ap">ID Apartament:</label>
            <input type="number" id="id_ap" name="id_ap" required><br><br>

            <label for="valoare">Valoare:</label>
            <input type="number" id="valoare" name="valoare" required><br><br>

            <label for="detalii_exceptie">Detalii Exceptie:</label>
            <input type="text" id="detalii_exceptie" name="detalii_exceptie" required><br><br>

            <button type="submit">Insert</button>
        </form>
    </div>

    <div id="back-button">
    <a href="insert.php">Inapoi la meniul de inserare</a>
    </div>
</body>
</html>
