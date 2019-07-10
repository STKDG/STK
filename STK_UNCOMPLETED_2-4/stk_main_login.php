<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STK-로그인</title>
    <?php
        function check_id($mysqli, $user_id){
            if($user_id === NULL||$user_id===''){
                echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 아이디가 입력되지 않았습니다.';</script>";
                echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
                return 0;
            }
            $sql = 'select *from STK_ACCOUNT';
            $name = $mysqli->query($sql);
            while($row = mysqli_fetch_array($name)){
                if($row['user_id'] == $user_id){
                    return $row['user_pw'];
                }
            }
            echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 해당 아이디가 존재하지 않습니다.';</script>";
            echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
            return 0;
        }
        function check_password($user_pw, $user_pw2){
            if($user_pw === NULL||$user_pw===''){
                echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 비밀번호가 입력되지 않았습니다.';</script>";
                echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
                return 0;
            }
            if($user_pw == $user_pw2)return 1;
            else{
                echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 비밀번호가 일치하지 않습니다.';</script>";
                echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
                return 0;
            } 
        }
        function getUserName($mysqli, $user_id){
            $sql = 'select *from STK_ACCOUNT';
            $name = $mysqli->query($sql);
            while($row = mysqli_fetch_array($name)){
                if($row['user_id'] == $user_id){
                    return $row['user_name'];
                }
            }
        }

        function getUserType($mysqli, $user_id){
            $sql = 'select *from STK_ACCOUNT';
            $name = $mysqli->query($sql);
            while($row = mysqli_fetch_array($name)){
                if($row['user_id'] == $user_id){
                    return $row['user_type'];
                }
            }
        }
        $host = 'localhost';
        $user = 'root';
        $pw = 'dpcmysql';
        $dbName = 'STK_ACCOUNT_DB';
        $mysqli = new mysqli($host, $user, $pw, $dbName);
        if($mysqli){
            echo "<script>console.log( 'PHP_Console: 계정 데이터베이스 접근 성공' );</script>";
        }
    ?>
</head>
<body>
    <div style="text-align:center">
        <img id="errorImg" src="images/signing_in.png">
        <p id="errorLog">로그인 중........</p>
        <button onclick="location.href='stk_main.php'">메인화면</button>
    </div>
    <?php 
        $user_id = $_POST['user_id'];
        $user_pw = $_POST['user_pw'];
        $real_pw = check_id($mysqli, $user_id);
        if(!($real_pw === 0) && check_password($user_pw, $real_pw)){
            $user_name = getUserName($mysqli, $user_id);
            $user_type = getUserType($mysqli, $user_id);
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $sql = "INSERT INTO STK_SIGNED_IN(";
            $sql = $sql."user_id, user_pw, user_type, user_name, user_warning, user_ip) values(";
            $sql = $sql."'$user_id', '$user_pw', '$user_type', '$user_name', '0', '$user_ip')";
            if($mysqli->query($sql)){
                echo "<script>console.log( 'PHP_Console: 로그인 성공' );</script>";
                echo "<script>location.href='stk_main.php';</script>";
            }
        }
        echo "<script>console.log( 'PHP_Console: " . $user_id . "' );</script>";
        echo "<script>console.log( 'PHP_Console: " . $user_pw . "' );</script>";
    ?>
</body>
</html>

