<?php
// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'luutru');

if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Xử lý dữ liệu được gửi từ biểu mẫu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $youtubeLink = $_POST["youtube_link"];

    // Thực hiện truy vấn SQL để chèn liên kết vào bảng videos
    $sql_insert = "INSERT INTO videos (youtube_link) VALUES ('$youtubeLink')";

    if (mysqli_query($conn, $sql_insert)) {
        header("Location: videos.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối
mysqli_close($conn);
?>
