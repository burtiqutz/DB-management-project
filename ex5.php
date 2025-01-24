<?php include ("database.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercitiu 5</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <h1>Exercitiu 5 a & b</h1>
    </header>
    <div id="welcome">
        <form method="POST">
        <h3>Query 1: Cauta Cel Mai Mare Consum</h3>
        <label>An:</label>
        <input type="number" name="year" placeholder="e.g., 2024" required>
        <label>Luna:</label>
        <input type="number" name="month" placeholder="e.g., 1" required>
        <button type="submit" name="query1">Run Query 1</button>
    </form>

    <form method="POST">
        <h3>Query 2: Cauta Proprietar Pe Consum Specific</h3>
        <label>An:</label>
        <input type="number" name="year" placeholder="e.g., 2024" required>
        <label>Luna:</label>
        <input type="number" name="month" placeholder="e.g., 1" required>
        <label>ID apartament:</label>
        <input type="number" name="id_ap" placeholder="e.g., 1" required>
        <button type="submit" name="query2">Run Query 2</button>
    </form>
    </div>
    <div id="back-button">
        <a href="index.php">Inapoi la meniul principal</a>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['query1'])) {
            $year = (int)$_POST['year'];
            $month = (int)$_POST['month'];

            $query1 = "SELECT id_ap, an, luna, nr_pers, cantitate, valoare, pret_apa
                       FROM Consum c1
                       WHERE c1.an = $year
                         AND c1.luna = $month
                         AND c1.valoare >= ALL (
                             SELECT c2.valoare
                             FROM Consum c2
                             WHERE c2.an = $year
                               AND c2.luna = $month
                         )";
            $result1 = $conn->query($query1);

            echo "<h3>Query 1 Rezultate:</h3>";
            if ($result1->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Nr apt</th><th>An</th><th>Luna</th><th>Nr. locatari</th><th>Cantitate</th><th>Valoare</th><th>Pret Apa</th></tr>";
                while ($row = $result1->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_ap']}</td>
                            <td>{$row['an']}</td>
                            <td>{$row['luna']}</td>
                            <td>{$row['nr_pers']}</td>
                            <td>{$row['cantitate']}</td>
                            <td>{$row['valoare']}</td>
                            <td>{$row['pret_apa']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No results found.</p>";
            }
        }

        if (isset($_POST['query2'])) {
            $id_ap = (int)$_POST['id_ap'];
            $year = (int)$_POST['year'];
            $month = (int)$_POST['month'];

            $query2 = "SELECT p.nume, p.prenume
                       FROM Proprietar p
                       WHERE p.id_proprietar IN (
                           SELECT a.id_proprietar
                           FROM Apartament a
                           JOIN Consum c ON a.id_ap = c.id_ap
                           WHERE c.an = $year
                             AND c.luna = $month
                             AND c.valoare = (
                                 SELECT valoare
                                 FROM Consum
                                 WHERE id_ap = $id_ap
                                   AND an = $year
                                   AND luna = $month
                             )
                       )";
            $result2 = $conn->query($query2);

            echo "<h3>Query 2 Rezultate:</h3>";
            if ($result2->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Nume</th><th>Prenume</th></tr>";
                while ($row = $result2->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['nume']}</td>
                            <td>{$row['prenume']}</td>
                          </tr>";
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
