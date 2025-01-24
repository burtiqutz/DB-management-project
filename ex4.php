<?php include ("database.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercitiu 4</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Exercitiu 4 a & b</h1>
    </header>
    <div id="welcome">
        <form method="POST">
            <h3>Query 1: Lista de cheltuieli dupa adresa, an, luna</h3>
            <label>Address:</label>
            <input type="text" name="address" placeholder="e.g., Cluj-Napoca strada Observatorului nr.9" required>
            <label>Year:</label>
            <input type="number" name="year" placeholder="e.g., 2024" required>
            <label>Month:</label>
            <input type="number" name="month" placeholder="e.g., 1" required>
            <button type="submit" name="query1">Run Query 1</button>
        </form>

        <form method="POST">
            <h3>Query 2: Apartamente cu acelasi consum</h3>
            <button type="submit" name="query2">Run Query 2</button>
        </form>
    </div>    
    <div id="back-button">
        <a href="index.php">Inapoi la meniul principal</a>
    </div>
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['query1'])) {
        $address = $conn->real_escape_string($_POST['address']);
        $year = (int)$_POST['year'];
        $month = (int)$_POST['month'];

        $query1 = "SELECT a.nr_ap, p.nume, p.prenume, c.valoare
                   FROM Consum c
                   JOIN Apartament a ON c.id_ap = a.id_ap
                   JOIN Proprietar p ON a.id_proprietar = p.id_proprietar
                   WHERE a.adresa = '$address'
                     AND c.an = $year
                     AND c.luna = $month";
        $result1 = $conn->query($query1);

        echo "<h3>Query 1 rezultate:</h3>";
        if ($result1->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Apartment No.</th><th>Owner Name</th><th>Owner Surname</th><th>Value</th></tr>";
            while ($row = $result1->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nr_ap']}</td>
                        <td>{$row['nume']}</td>
                        <td>{$row['prenume']}</td>
                        <td>{$row['valoare']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found.</p>";
        }
    }

    if (isset($_POST['query2'])) {
        $query2 = "SELECT c1.id_ap AS AP1, c2.id_ap AS AP2
                   FROM Consum c1
                   JOIN Consum c2 ON c1.an = c2.an
                                 AND c1.luna = c2.luna
                                 AND c1.cantitate = c2.cantitate
                                 AND c1.id_ap < c2.id_ap";
        $result2 = $conn->query($query2);

        echo "<h3>Query 2 rezultate:</h3>";
        if ($result2->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Apartment 1</th><th>Apartment 2</th></tr>";
            while ($row = $result2->fetch_assoc()) {
                echo "<tr><td>{$row['AP1']}</td><td>{$row['AP2']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found.</p>";
        }
    }
}
?>
</body>
</html>