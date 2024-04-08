<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

// Kiểm tra xem dữ liệu tin nhắn có được gửi từ biểu mẫu hay không và có giá trị không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"]) && !empty(trim($_POST["message"]))) {
    // Lấy nội dung tin nhắn từ biểu mẫu và loại bỏ ký tự đặc biệt
    $message = htmlspecialchars($_POST["message"]);

    // Lấy tên người dùng từ session
    $username = "";

    // Kết nối đến cơ sở dữ liệu
    $conn = mysqli_connect("localhost", "root", "", "taikhoan");

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

    // Lấy thông tin tên người dùng từ cơ sở dữ liệu
    $user_id = $_SESSION["id"];
    $sql = "SELECT user_name FROM login_user WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $username = $row["user_name"]; // Sử dụng tên cột chính xác
        } else {
            // Xử lý lỗi nếu không tìm thấy thông tin người dùng
            echo "Lỗi: Không tìm thấy thông tin người dùng.";
            exit();
        }
    } else {
        // Xử lý lỗi nếu truy vấn SQL thất bại
        echo "Lỗi: " . mysqli_error($conn);
        exit();
    }

    // Thực hiện truy vấn SQL để chèn tin nhắn vào bảng messages
    $sql_insert = "INSERT INTO messages (user_name, message) VALUES ('$username', '$message')";

    if (mysqli_query($conn, $sql_insert)) {
        echo "Tin nhắn đã được gửi thành công.";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);
    header("Location: chat.php");
    exit();
} else {
    header("Location: chat.php");
    exit();
}
?>
