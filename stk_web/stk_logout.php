<?php
    $host = 'localhost';
    $user = 'root';
    $pw = 'dpcmysql';
    $dbName = 'STK_ACCOUNT_DB';
    $mysqli = new mysqli($host, $user, $pw, $dbName);

    $user_ip = $_SERVER['REMOTE_ADDR'];
    $sql = 'select *from STK_SIGNED_IN';
    $name = $mysqli->query($sql);
    while($row = mysqli_fetch_array($name)){
        if($user_ip == $row['user_ip']){
            $id = $row['id'];
            $sql = "delete from stk_signed_in where id=($id)";
            $mysqli->query($sql);
        }
    }
    echo "<script>location.href='stk_main.php'</script>";
?>