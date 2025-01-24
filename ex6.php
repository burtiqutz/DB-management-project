<?php include ("database.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercitiu 6</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Exercitiu 6 a & b</h1>
    </header>
    <div id="welcome">
        <form method="POST">
        <h3>Query 1: Analiza a consumului trimestrial</h3>
        <label>Anul:</label>
        <input type="number" name="year" placeholder="e.g., 2024" required>
        <button type="submit" name="query1">Run Query 1</button>
    </form>

    <form method="POST">
        <h3>Query 2: Plati restante</h3>
        <label>Adresa:</label>
        <input type="text" name="address" placeholder="e.g., Turda strada Baladei nr.3" required>
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

            $query1 = "SELECT
                           CASE
                               WHEN c.luna BETWEEN 1 AND 4 THEN 'T1'
                               WHEN c.luna BETWEEN 5 AND 8 THEN 'T2'
                               WHEN c.luna BETWEEN 9 AND 12 THEN 'T3'
                           END AS trimestru,
                           c.id_ap,
                           MIN(ch.valoare) AS minim,
                           AVG(ch.valoare) AS mediu,
                           MAX(ch.valoare) AS maxim
                       FROM Consum c
                       JOIN Chitanta ch ON c.id_ap = ch.id_ap
                       WHERE c.an = $year
                       GROUP BY trimestru, c.id_ap
                       ORDER BY c.id_ap, trimestru";
            $result1 = $conn->query($query1);

            echo "<h3>Query 1 Rezultate:</h3>";
            if ($result1->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Trimestru</th><th>ID apartament</th><th>Minimum</th><th>Average</th><th>Maximum</th></tr>";
                while ($row = $result1->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['trimestru']}</td>
                            <td>{$row['id_ap']}</td>
                            <td>{$row['minim']}</td>
                            <td>{$row['mediu']}</td>
                            <td>{$row['maxim']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No results found.</p>";
            }
        }

        if (isset($_POST['query2'])) {
            $address = $conn->real_escape_string($_POST['address']);

            $query2 = "SELECT p.nume, p.prenume
                       FROM Apartament a
                       JOIN Proprietar p ON a.id_proprietar = p.id_proprietar
                       JOIN Consum co ON a.id_ap = co.id_ap
                       LEFT JOIN Chitanta ch ON a.id_ap = ch.id_ap 
                           AND ch.data <= STR_TO_DATE('2024-10-01', '%Y-%m-%d')
                       WHERE a.adresa = '$address'
                       GROUP BY p.nume, p.prenume, a.id_ap
                       HAVING SUM(IFNULL(ch.valoare, 0)) < SUM(CASE 
                           WHEN co.an < 2024 OR (co.an = 2024 AND co.luna < 10) THEN co.valoare 
                           ELSE 0 
                       END)";
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