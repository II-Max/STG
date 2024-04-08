<?php
session_start();
// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "taikhoan");
$conn = mysqli_connect("localhost", "root", "", "luutru");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file_name = $_FILES["file"]["name"];
    $file_type = $_FILES["file"]["type"];
    $file_size = $_FILES["file"]["size"];

    // Di chuyển tệp tải lên vào thư mục lưu trữ
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file_name);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // Lưu thông tin về tệp tải lên vào cơ sở dữ liệu
        $query = "INSERT INTO files (file_name, file_type, file_size) VALUES ('$file_name', '$file_type', '$file_size')";
        mysqli_query($conn, $query);
        
        // Chuyển hướng người dùng sau khi tải lên thành công
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Đã xảy ra lỗi khi tải lên tệp.";
    }
}
// Hiển thị danh sách các tệp đã tải lên
$result = mysqli_query($conn, "SELECT DISTINCT file_name FROM files"); // Thêm DISTINCT để chỉ lấy các tên tệp duy nhất
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
        <?php if ($_SESSION["id"] == 0): ?>
            <!-- Nếu là admin, hiển thị phần tải lên tệp -->
            <h2>Tải lên tệp</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <button type="submit" name="submit">Tải lên</button>
            </form>
        <?php endif; ?>
        <h2>Danh sách các tệp đã tải lên</h2>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <li><a href="uploads/<?php echo $row["file_name"]; ?>" download><?php echo $row["file_name"]; ?></a></li>
            <?php } ?>
        </ul>
</body>
</html>
