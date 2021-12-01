<?php

require_once 'polacz_studenci.php';

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);

    $sql = "DELETE FROM studenci WHERE student_id='$id'";

    if (mysqli_query($polaczenie, $sql)) {
        echo "<script>alert('Wiersz został pomyślnie usunięty');</script>";
        header('Location: edytowanie.php');
        exit();
    }
    mysqli_close($polaczenie);
} else {
    echo "<script>alert('Wybierz wiersz do usunięcia');</script>";
    header('Location: edytowanie.php');
}
