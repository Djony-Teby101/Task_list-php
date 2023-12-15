<?php
if (isset($_POST["id"])) {
    $id = $_POST["id"];

    require_once("../config.db.php");

    if (empty($id)) echo"Erreur";


    $sql = "SELECT id, checked FROM tasklist WHERE id=?";
    $checkItem = $conn->prepare($sql);

    $checkItem->execute(array($id));

    $itemcheck=$checkItem->fetch();
    $uId=$itemcheck['id'];
    $check=$itemcheck['checked'];

    $uChecked=$check ? 0 : 1;
    
    $res=$conn->query("UPDATE `tasklist` SET `checked` = $uChecked WHERE `id` = $uId");

    if ($res) $check;
    else {
        echo "Error";
    }
    $conn = null;
    exit();
}else{
    header("location: ../index.php?mess=error");
}
