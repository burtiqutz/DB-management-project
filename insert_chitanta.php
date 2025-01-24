<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $id_ap = $_POST['id_ap'];
    $valoare = $_POST['valoare'];

    $sql = "INSERT INTO chitanta (data, id_ap, valoare) 
            VALUES ('$data', $id_ap, $valoare)";

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
    <title>Insert into Chitanta</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Insert into Chitanta</h1>
    </header>
    <div id="welcome">
        <form action="insert_chitanta.php" method="POST">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required><br><br>

            <label for="id_ap">ID Apartament:</label>
            <input type="number" id="id_ap" name="id_ap" required><br><br>

            <label for="valoare">Valoare:</label>
            <input type="number" id="valoare" name="valoare" required><br><br>

            <button type="submit">Insert</button>
        </form>
    </div>

    <div id="back-button">
    <a href="insert.php">Inapoi la meniul de inserare</a>
    </div>
</body>
</html>
