<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STK-가입</title>
    <?php
    function check_password($user_pw, $user_pw2){
        if($user_pw === NULL||$user_pw===''){
            echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 비밀번호가 입력되지 않았습니다.';</script>";
            echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
            return 0;
        }
        if($user_pw === $user_pw2)return 1;
        else{
            echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 비밀번호와 확인 비밀번호가 일치하지 않습니다.';</script>";
            echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
            return 0;
        } 
    }
    function check_id($mysqli, $user_id){
        if($user_id === NULL||$user_id===''){
            echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 아이디가 입력되지 않았습니다.';</script>";
            echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
            return 0;
        }
        $sql = 'select *from STK_ACCOUNT';
        $name = $mysqli->query($sql);
        while($row = mysqli_fetch_array($name)){
            if($row['user_id'] === $user_id){
                echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 이미 해당 아이디가 존재합니다.';</script>";
                echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
                return 0;
            }
        }
        return 1;
    }
    $host = 'localhost';
    $user = 'root';
    $pw = 'dpcmysql';
    $dbName = 'STK_ACCOUNT_DB';
    $mysqli = new mysqli($host, $user, $pw, $dbName);
    ?>
</head>
<body>
    <div style="text-align:center;">
        <img src="images/무제31-3.png" id="errorImg" style="width:150px; height:150px;"><!--A팀 화이팅!!!-->
        <p id="errorLog">STK에 가입해 주셔서 감사합니다. 많은 참여를 부탁드립니다.</p>
        <button onclick="self.close();">창닫기</button>
        <button onclick="location.href='stk_join.html'">가입 화면</button>
    </div>
    <?php
    $user_id = $_POST['user_id'];
    $user_pw = $_POST['user_pw'];
    $user_pw2 = $_POST['user_pw2'];
    $user_name = $_POST['user_name'];
    $user_type = $_POST['user_type'];

    $sql = "insert into STK_ACCOUNT (";
    $sql = $sql."user_id, user_pw, user_type, user_name, user_warning)";
    $sql = $sql."values ('$user_id', '$user_pw', '$user_type', '$user_name', '0')";
    if(check_id($mysqli, $user_id) && check_password($user_pw, $user_pw2)){
        if($mysqli->query($sql)){
            echo "<script>document.getElementById('errorLog').innerText = 'STK에 가입해 주셔서 감사합니다. 많은 참여를 부탁드립니다.';</script>";
        }
    }
    else{
        echo "<script>document.getElementById('errorLog').innerText = 'STK가입에 실패하였습니다.';</script>";
        echo "<script>document.getElementById('errorImg').src = 'images/error.png';</script>";
    }
    ?>
</body>
</html>