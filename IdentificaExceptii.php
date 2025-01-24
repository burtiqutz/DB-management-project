<!DOCTYPE html>
<html>
<head>
    <title>Identifica Exceptii</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Apeleaza procedura: IdentificaExceptii</h1>
    </header>
    <div id="welcome">
        <form method="POST">
            <button type="submit" name="callProcedure">Apeleaza Procedura</button>
            <button type="submit" name="showTable">Afiseaza tabela</button>
            <button type="submit" name="deleteData">Goleste tabela</button>
        </form>
    </div>
    <div id="back-button">
        <a href="index.php">Inapoi la meniul principal</a>
    </div>

    <?php
    include("database.php");
    // Call Procedure
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['callProcedure'])) {
        $query = "CALL IdentificaExceptii()";

        if ($conn->query($query)) {
            echo "<p>Procedura executata cu succes.</p>";
        } else {
            echo "<p>Eroare la apelare: " . $conn->error . "</p>";
        }
    }

    // Show Table
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['showTable'])) {
        $query = "SELECT * FROM Exceptii";

        if ($result = $conn->query($query)) {
            echo "<h3>Continutul tabelei exceptii:</h3>";
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>";
                while ($field = $result->fetch_field()) {
                    echo "<th>{$field->name}</th>";
                }
                echo "</tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Tabela este goala.</p>";
            }
            $result->close();
        } else {
            echo "<p>Eroare la citirea datelor: " . $conn->error . "</p>";
        }
    }

    // Delete Data
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteData'])) {
        $query = "DELETE FROM Exceptii";

        if ($conn->query($query)) {
            echo "<p>Toata informatia a fost stearsa din tabela.</p>";
        } else {
            echo "<p>Eroare la stergere: " . $conn->error . "</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
