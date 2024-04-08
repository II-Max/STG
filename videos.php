<?php
session_start();
function getSrcYoutube($url) {
    $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/';
    preg_match($regExp, $url, $match);
    $ID = (isset($match[2]) && strlen($match[2]) === 11) ? $match[2] : null;
    return ($ID !== null) ? 'https://www.youtube.com/embed/' . $ID : null;
}
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
    <link rel="stylesheet" href="videos.css">
    <link rel="stylesheet" href="index.css">
    <style>
        .hienthi {
            display: flex;
            flex-wrap: wrap; /* Cho phép tự động xuống dòng khi không đủ chỗ */
            justify-content: space-around; /* Canh các video ở giữa */
        }
        .hienthi div {
            margin: 0px; /* Khoảng cách giữa các video */
        }
        .hienthi iframe {
            width: 400px; /* Độ rộng của mỗi video */
            height: 225px; /* Độ cao của mỗi video */
        }
        .nhap {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .nhap input[type="text"] {
            width: 80%;
            margin-right: 0px; /* Khoảng cách giữa các input */
        }
        .nhap button {
            width: auto;
        }
    </style>
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
    <div class="container">
        <h1>Chia Sẻ Liên Kết YouTube</h1>
        <?php if ($_SESSION["id"] == 0): ?>
            <form action="videos_input.php" method="post">
            <div class="nhap">
                    <input type="text" name="youtube_link" placeholder="Dán liên kết YouTube ở đây...">
                    <button type="submit">Chia Sẻ</button>
            </div>
        </form>
        <?php endif ?>
        <center><h2>Danh Sách Video</h2></center>
    </div>
            <form class="hienthi">
                <?php
                // Kết nối đến cơ sở dữ liệu
                $conn = mysqli_connect('localhost', 'root', '', 'luutru');

                if (!$conn) {
                    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
                }

                // Truy vấn SQL để lấy danh sách các video từ bảng "videos"
                $sql = "SELECT * FROM videos";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Hiển thị các video trong một danh sách
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div>";
                        // Chuyển đổi liên kết YouTube thành URL nhúng
                        $embedURL = getSrcYoutube($row['youtube_link']);
                        
                        // Hiển thị video trong thẻ iframe
                        echo "<iframe width='560' height='315' src='" . $embedURL . "' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Không có video nào được tìm thấy.</p>";
                }
                // Đóng kết nối
                mysqli_close($conn);
                ?>
            </form>
    </div>
</body>
</html>
