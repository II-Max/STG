<?php
$conn = mysqli_connect('localhost', 'root', '', 'taikhoan') or die('Unable To connect');
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$sql_check_username = "SELECT * FROM login_user WHERE user_name='$username'";
$result_check_username = mysqli_query($conn, $sql_check_username);

if (!$result_check_username) {
    echo "Error: " . mysqli_error($conn);
} else {
    if (mysqli_num_rows($result_check_username) > 0) {
        echo "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.";
    } else {
        $sql = "INSERT INTO login_user (email, user_name, password) VALUES ('$email', '$username', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "Đăng ký thành công.";
            header("Location: login.php");
            exit();
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }
}
mysqli_close($conn);
?>