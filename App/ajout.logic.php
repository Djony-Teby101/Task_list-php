<?php
if (isset($_POST["title"])) {
    $title = $_POST["title"];

    require_once("../config.db.php");

    if (empty($title)) header("location: ../index.php?mess=error");


    $sql = "INSERT INTO tasklist (title)VALUE(?)";
    $addItem = $conn->prepare($sql);

    $response = $addItem->execute(array($title));
    $errormsg = "erreur lors de l'ajout";
    if (!$response) header("location: ../index.php?mess=$errormsg");
    else {
        header("location: ../index.php?mess=succes");
    }
    $conn = null;
    exit();
}else{
    header("location: ../index.php?mess=error");
}
