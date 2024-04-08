<?php
session_start();
if ($_SESSION["id"] == 0)
{
    $_SESSION["vaitro"] = "ADMIN";
}
else
{
    $_SESSION["vaitro"] = "Học Sinh";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trang Chính</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
</head>
<body>
        <header class="header">
            <form>
                <left>DỰ ÁN STG</left>
                <?php
                // Kiểm tra xem người dùng đã đăng nhập chưa
                if(isset($_SESSION["id"])) {
                    // Nếu rồi thì chào
                    echo "Chào mừng : " . $_SESSION["name"] . " Tham Gia Với Vai Trò Là " . $_SESSION["vaitro"] . " "; echo "<a href='logout.php'>Đăng Xuất</a>";
                } else {
                    
                    // Nếu chưa thì đá khỏi trang và yêu cầu đăng nhập
                    echo '<meta http-equiv="refresh" content="0;url=login.php">';
                }
                ?>
            </form>
        </header>
        <form class="menu">
            <input type="button" onclick="window.location.href='index.php'" class="button-menu" value="Trang Chủ">
            <input type="button" onclick="window.location.href='nopbai.php'" class="button-menu" value="Nộp Bài Tập">
            <input type="button" onclick="window.location.href='tailieu.php'" class="button-menu" value="Tài Liệu - Bài Tập">
            <input type="button" onclick="window.location.href='videos.php'" class="button-menu" value="Videos">
            <input type="button" onclick="window.location.href='chat.php'" class="button-menu" value="Chat">
        </form>
        <input type="text" placeholder="Name">
        <input type="text" placeholder="C++">
</body>
</html>