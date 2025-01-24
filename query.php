<?php
include("database.php");

$table = isset($_POST['table']) ? $_POST['table'] : '';
$condition = isset($_POST['condition']) ? $_POST['condition'] : '';
$query_result = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($table)) {
    // Constructing the query
    $sql = "SELECT * FROM $table";
    if (!empty($condition)) {
        $sql .= " WHERE $condition";
    }

    $query_result = $conn->query($sql);

    if (!$query_result) {
        $query_result = $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Data</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Interogheaza baza de date</h1>
    </header>

    <div id="welcome">
        <form action="query.php" method="POST">
            <label for="table">Selecteaza Tabela:</label>
            <select id="table" name="table" required>
                <option value="">--Alege Tabela--</option>
                <option value="apartament">Apartament</option>
                <option value="chitanta">Chitanta</option>
                <option value="consum">Consum</option>
                <option value="consum_ap_turda">Consum Ap Turda</option>
                <option value="exceptii">Exceptii</option>
                <option value="proprietar">Proprietar</option>
            </select><br><br>

            <label for="condition">Introdu conditie (optional):</label>
            <input type="text" id="condition" name="condition" placeholder="e.g., id_ap = 1"><br><br>

            <button type="submit">Query</button>
        </form>
    </div>

    <div id="back-button">
        <a href="index.php">Inapoi la meniul principal</a>
    </div>

    <?php if ($query_result !== null) : ?>
        <div id="welcome">
            <h2>Rezultatele Interogarii:</h2>
            <?php if (is_string($query_result)) : ?>
                <p>Error: <?= $query_result ?></p>
            <?php else : ?>
                <table border="1" cellpadding="10">
                    <thead>
                        <tr>
                            <?php
                            // Displaying column headers
                            $columns = $query_result->fetch_fields();
                            foreach ($columns as $column) {
                                echo "<th>" . $column->name . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $query_result->fetch_assoc()) : ?>
                            <tr>
                                <?php foreach ($row as $value) : ?>
                                    <td><?= $value ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>
