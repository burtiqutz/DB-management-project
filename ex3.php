<?php include ("database.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercitiu 3</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Exercitiu 3 a & b</h1>
    </header>
    <div id = "welcome">
        <form method="POST">
            <h3>Query 1 (subpunct a): Cauta proprietari dupa litere din nume</h3>
            <label>Litera 1:</label>
            <input type="text" name="letter1" maxlength="1" placeholder="e.g., p" required>
            <label>Litera 2:</label>
            <input type="text" name="letter2" maxlength="1" placeholder="e.g., e" required>
            <button type="submit" name="query1">Run Query 1</button>
        </form>

        <form method="POST">
            <h3>Query 2 (subpunct b): Cauta chitante intr-un anumit an</h3>
            <label>An:</label>
            <input type="number" name="year" placeholder="e.g., 2024" required>
            <button type="submit" name="query2">Run Query 2</button>
        </form>
    </div>
    <div id="back-button">
        <a href="index.php">Inapoi la meniul principal</a>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['query1'])) {
            $letter1 = strtolower($conn->real_escape_string($_POST['letter1']));
            $letter2 = strtolower($conn->real_escape_string($_POST['letter2']));

            $query1 = "SELECT * 
                       FROM Proprietar 
                       WHERE LOWER(nume) LIKE '%$letter1%' OR LOWER(nume) LIKE '%$letter2%'
                       ORDER BY nume DESC, prenume ASC";
            $result1 = $conn->query($query1);

            echo "<h3>Rezultate subpunct a:</h3>";
            if ($result1->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Name</th><th>Surname</th></tr>";
                while ($row = $result1->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_proprietar']}</td>
                            <td>{$row['nume']}</td>
                            <td>{$row['prenume']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No results found.</p>";
            }
        }

        if (isset($_POST['query2'])) {
            $year = (int)$_POST['year'];

            $query2 = "SELECT * 
                       FROM Chitanta 
                       WHERE YEAR(data) = $year
                       ORDER BY valoare DESC";
            $result2 = $conn->query($query2);

            echo "<h3>Rezultate subpunct b:</h3>";
            if ($result2->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>NR</th><th>ID ap.</th><th>Data</th><th>Valoare</th></tr>";
                while ($row = $result2->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['nr']}</td>
                            <td>{$row['id_ap']}</td>
                            <td>{$row['data']}</td>
                            <td>{$row['valoare']}</td>
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