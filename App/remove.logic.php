<?php
if (isset($_POST["id"])) {
    $id = $_POST["id"];

    require_once("../config.db.php");

    if (empty($id)) echo(0);


    $sql = "DELETE FROM tasklist WHERE id=?";
    $delItem = $conn->prepare($sql);

    $response = $delItem->execute(array($id));
    $errormsg = "erreur lors de la suppression";
    if (!$response) echo 0;
    else {
        echo 1;
    }
    $conn = null;
    exit();
}else{
    header("location: ../index.php?mess=error");
}
