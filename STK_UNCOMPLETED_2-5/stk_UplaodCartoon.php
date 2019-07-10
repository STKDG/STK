<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STK-업로드</title>
    <?php
        function check_id($mysqli, $user_id){
            if($user_id === NULL||$user_id===''){
                echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 아이디가 입력되지 않았습니다.'</script>";
                echo "<script>document.getElementById('isUpload').src = 'images/error.png';</script>";
                return 0;
            }
            $sql = 'select *from STK_ACCOUNT';
            $name = $mysqli->query($sql);
            while($row = mysqli_fetch_array($name)){
                if($row['user_id'] == $user_id){
                    return $row['user_pw'];
                }
            }
            
            echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 해당 아이디가 존재하지 않습니다.'</script>";
            echo "<script>document.getElementById('isUpload').src = 'images/error.png';</script>";
            return 0;
        }
        function check_password($user_pw, $user_pw2){
            if($user_pw === NULL||$user_pw===''){
                echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 비밀번호가 입력되지 않았습니다.'</script>";
                echo "<script>document.getElementById('isUpload').src = 'images/error.png';</script>";
                return 0;
            }
            if($user_pw == $user_pw2)return 1;
            else{
                echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 비밀번호가 일치하지 않습니다.'</script>";
                echo "<script>document.getElementById('isUpload').src = 'images/error.png';</script>";
                return 0;
            } 
        }
        function check_type($mysqli, $user_id){
            $sql = 'select *from STK_ACCOUNT';
            $name = $mysqli->query($sql);
            while($row = mysqli_fetch_array($name)){
                
                if($row['user_id'] == $user_id){
                    echo "<script>console.log( 'PHP_Console:  id reached' );</script>";
                    if(!($row['user_type'] == 'Reader')){
                        echo "<script>console.log( 'PHP_Console: " . $row['user_type'] . "' );</script>";
                        return 1;
                    }
                }
            }
            echo "<script>console.log( 'PHP_Console:  even reached' );</script>";
            echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 독자는 업로드 권한이 없습니다.'</script>";
            echo "<script>document.getElementById('isUpload').src = 'images/error.png';</script>";
            return 0;
        }
        function check_title($mysqli, $cartoon_title){
            if($cartoon_title === NULL||$cartoon_title===''||strpos($cartoon_title, ' ') !== false||strpos($cartoon_title, '\\') !== false){
                echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 제목이 입력되지 않았습니다.또는 띄어쓰기, 특수문자 등이 사용되었습니다.'</script>";
                echo "<script>document.getElementById('isUpload').src = 'images/error.png';</script>";
                return 0;
            }
            $sql = 'select *from STK_CARTOON_TITLE';
            $name = $mysqli->query($sql);
            while($row = mysqli_fetch_array($name)){
                if($row['cartoon_title'] === $cartoon_title){
                    echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 이미 해당 제목이 존재합니다.'</script>";
                    echo "<script>document.getElementById('isUpload').src = 'images/error.png';</script>";
                    return 0;
                }
            }
            return 1;
        }
        function check_file($name){
            if($name === NULL||$name == ''){
                echo "<script>document.getElementById('errorLog').innerText = '시스템 에러: 업로드할 이미지가 지정되지 않았습니다.'</script>";
                echo "<script>document.getElementById('isUpload').src = 'images/error.png';</script>";
                return 0;
            }
            return 1;
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
    <div style="text-align:center;">
        <img src="images/무제31-3.png" style="width: 400px; height: 400px;" id="isUpload">
        <br>
        <p id="errorLog">업로드 성공!</p>
        <br>
        <button onclick="window.open('stk_UploadCartoon.html',
        '업로드', 'width=400, height=600, scrollbars= 0, toolbar=0, menubar=no');" >업로드 화면</button>
        <button onclick="self.close();">창닫기</button>
    </div>
    <?php
        $cartoon_title = $_POST['cartoon_title'];

        $user_id = $_POST['user_id'];
        $user_pw = $_POST['user_pw'];
        $real_pw = check_id($mysqli, $user_id);
        echo "<script>console.log( 'PHP_Console: " . $user_id . "' );</script>";
        echo "<script>console.log( 'PHP_Console: " . $user_pw . "' );</script>";
        if(!$real_pw == 0){
            if(check_password($user_pw, $real_pw)&&check_type($mysqli, $user_id)){
                $host = 'localhost';
                $user = 'root';
                $pw = 'dpcmysql';
                $dbName = 'STK_CARTOON_DB';
                $mysqli = new mysqli($host, $user, $pw, $dbName);
                if($mysqli){
                    echo "<script>console.log( 'PHP_Console: 만화 데이터베이스 접근 성공' );</script>";
                }
                if(check_title($mysqli, $cartoon_title)&&check_file($_FILES['Image']['name'][0])){
                    $sql = "CREATE TABLE $cartoon_title (";
                    $sql = $sql."id int unsigned primary key auto_increment,";
                    $sql = $sql."cartoon_image_dir varchar(100) not null)";
                    if($mysqli->query($sql)){
                        echo "<script>console.log( 'PHP_Console: 만화 테이블 생성 성공' );</script>";

                        $dir = mkdir("C:/Bitnami/wampstack-7.1.29-0/apache2/htdocs/STK_UNCOMPLETED_2-4/Uploaded_Images/$cartoon_title",0700,true);

                        $sql = "INSERT INTO STK_CARTOON_TITLE(";
                        $sql = $sql."cartoon_title, user_id) values(";
                        $sql = $sql."'$cartoon_title', '$user_id')";
                        if($mysqli->query($sql)){
                            echo "<script>console.log( 'PHP_Console: 테이블 제목 입력 성공' );</script>";
                        }

                        ini_set("display_errors", "1");
                        
                        foreach ($_FILES['Image']['name'] as $f=>$name) { 
                            $uploaddir = "C:\Bitnami\wampstack-7.1.29-0\apache2\htdocs\STK_UNCOMPLETED_2-4\Uploaded_Images\\$cartoon_title\\";

                            $name = $_FILES['Image']['name'][$f];

                            $uploadfile = $uploaddir.basename($name);
                            if(move_uploaded_file($_FILES['Image']['tmp_name'][$f], $uploadfile)){
                                $sql = "insert into $cartoon_title (";
                                $sql = $sql."cartoon_image_dir) values";
                                $sql = $sql."('$name')";
                                if($mysqli->query($sql)){
                                    echo "<script>console.log( 'PHP_Console: 이미지 디렉토리 입력 성공' );</script>";
                                    echo "파일".$name."가 성공적으로 업로드 되었습니다.</br>";
                                }
                            }
                            else{
                                print "파일이 업로드에 실패하였습니다.</br>";
                            }
                        }
                    }
                }
            }
        }
    ?>
</body>
</html>