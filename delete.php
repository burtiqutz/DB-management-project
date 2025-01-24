<?php
include("database.php");

$table = isset($_POST['table']) ? $_POST['table'] : '';
$condition = isset($_POST['condition']) ? $_POST['condition'] : '';
$delete_result = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($table) && !empty($condition)) {
    // Constructing the delete query
    $sql = "DELETE FROM $table WHERE $condition";

    // Executing the query
    if ($conn->query($sql) === TRUE) {
        $delete_result = "Intrare stearsa cu succes.";
    } else {
        $delete_result = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Data</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Delete Data from Table</h1>
    </header>

    <div id="welcome">
        <!-- HTML Form for Table Selection and Condition -->
        <form action="delete.php" method="POST">
            <label for="table">Selecteaza tabela:</label>
            <select id="table" name="table" required>
                <option value="">--Choose Table--</option>
                <option value="apartament">Apartament</option>
                <option value="chitanta">Chitanta</option>
                <option value="consum">Consum</option>
                <option value="consum_ap_turda">Consum Ap Turda</option>
                <option value="exceptii">Exceptii</option>
                <option value="proprietar">Proprietar</option>
            </select><br><br>

            <label for="condition">Introdu Conditie (Obligatoriu):</label>
            <input type="text" id="condition" name="condition" placeholder="e.g., id_ap = 1" required><br><br>

            <button type="submit">Delete</button>
        </form>
    </div>

    <div id="back-button">
        <a href="index.php">Inapoi la meniul principal</a>
    </div>

    <?php if ($delete_result !== null) : ?>
        <!-- Displaying the result of the delete operation -->
        <div id="welcome">
            <p><?= $delete_result ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
