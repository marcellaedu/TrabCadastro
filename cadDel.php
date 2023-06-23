<?php
    require_once("Connection.php");
    $id = isset($_GET['id'])? $_GET['id']: null;

    if($id){
        $conn = Connection::getConnection();

        $sql = "DELETE FROM jogadores WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        header("location: cad.php");
    }else{
        echo "Id não informado" . "<br>";
        echo "<a href='cad.php'</a>";
    }
?>