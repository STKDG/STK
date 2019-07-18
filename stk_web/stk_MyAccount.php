<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STK - 계정설정</title>
    <?php
        function checkLogin($mysqli){
            $sql = 'select *from STK_SIGNED_IN';
            $name = $mysqli->query($sql);
            if(!($row = mysqli_fetch_array($name))){
            echo "<script>location.href='stk_main.php';</script>";
            }
        }
        $host = 'localhost';
        $user = 'root';
        $pw = 'dpcmysql';
        $dbName = 'STK_ACCOUNT_DB';
        $mysqli = new mysqli($host, $user, $pw, $dbName);
        checkLogin($mysqli);
    ?>
</head>
<body>
    <button onclick="location.href='stk_ChangePW.html'">
        비밀번호 변경</button>
    <button onclick="location.href='stk_main.php'">메인 화면</button>
</body>
</html>