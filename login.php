<?php
session_start();
$message = "";

if(isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

if(isset($_POST["submit"])) {
    $con = mysqli_connect('localhost', 'root', '', 'taikhoan') or die('Unable To connect');
    $result = mysqli_query($con,"SELECT * FROM login_user WHERE user_name='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['user_name'];
        header("Location: index.php");
        exit();
    } else {
        $message = "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <form name="frmUser" method="post" action="">
        <div id="wrapper">
            <div id="form-login">
            <center><h1>Đăng Nhập</h1></center>
                <?php if(!empty($message)): ?>
                    <p><?php echo $message; ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <input type="text" name="user_name" class="form-input" placeholder="Tên người dùng">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="Mật khẩu">
                </div>
                <input type="submit" name="submit" class="form-submit" value="Đăng Nhập">
                <input type="button" onclick="register.php" value="Đăng Ký" class="form-lognup" id="dangky">
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="js.js"></script>
</body>
</html>
