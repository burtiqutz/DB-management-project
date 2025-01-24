<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nume = $conn->real_escape_string($_POST['nume']);
    $prenume = $conn->real_escape_string($_POST['prenume']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "INSERT INTO proprietar (nume, prenume, email) 
            VALUES ('$nume', '$prenume', '$email')";

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
    <title>Insert into Proprietar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Insert into Proprietar</h1>
    </header>
    <div id="welcome">
        <form action="insert_proprietar.php" method="POST">
            <label for="nume">Nume:</label>
            <input type="text" id="nume" name="nume" required><br><br>

            <label for="prenume">Prenume:</label>
            <input type="text" id="prenume" name="prenume" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <button type="submit">Insert</button>
        </form>
    </div>

    <div id="back-button">
    <a href="insert.php">Inapoi la meniul de inserare</a>
    </div>
</body>
</html>
