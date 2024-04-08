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
    <style>
        #head-chat-box {
            background-color: lightgreen;
            color: black;
            font-size: 25px;
            width: auto;
            height: auto;
        }
        #chat-box {
            max-height: 600px; /* Đặt chiều cao tối đa cho mỗi form */
            overflow-y: auto; /* Tạo thanh cuộn dọc khi nội dung vượt quá kích thước */
            margin-bottom: 20px; /* Khoảng cách dưới của mỗi form */
            width: auto;
            height: auto;
        }
        .chat-box input,
        .chat-box {
        display: block; /* Hiển thị mỗi input và label trên một dòng */
        margin-bottom: 10px; /* Khoảng cách dưới của mỗi input và label */
    }
        #chat-input {
            position: absolute;
            bottom: 0;
            width: 100%;
            border-top: 1px solid #ccc;
        }
        #chat-input textarea {
            border: none;
            outline: none;
            font-size: 0.95rem;
            resize: none;
            padding: 16px 15px 16px 0px;
        }
            /* CSS cho input */
    #chat-input input[type="text"] {
        background-color: transparent;
        color: white;
        width: calc(100% - 100px); /* Đảm bảo input không bị chồng lên nút Gửi */
        padding: 10px;
        border: none;
    }
    #chat-input input[type="text"]:focus {
        border: none; /* Loại bỏ border khi input được focus */
        outline: none; /* Loại bỏ đường viền màu xanh khi input được focus */
        color: white;
}
    /* CSS cho nút Gửi */
    #chat-input input[type="submit"] {
        background-color: transparent;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Hover effect cho nút Gửi */
    #chat-input input[type="submit"]:hover {
        background-color: #45a049;
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
        <div id="head-chat-box"><center>Chat Global</center></div>
        <div id="chat-box">
            <?php
            // Kết nối đến cơ sở dữ liệu
            $conn = mysqli_connect("localhost", "root", "", "taikhoan");
            // Truy vấn SQL để lấy danh sách tin nhắn từ bảng messages
            $sql = "SELECT user_name, message, created_at FROM messages ORDER BY created_at ASC";
            $result = mysqli_query($conn, $sql);
            // Kiểm tra kết quả truy vấn
            if ($result && mysqli_num_rows($result) > 0) {
                // Duyệt qua mỗi dòng kết quả và hiển thị thông tin tin nhắn
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div>";
                    echo "⊙" . $row['user_name'] . " [" . $row['created_at'] . "] " . " : " . $row['message'];
                    echo "</div>";
                }
            } else {
                // Hiển thị thông báo nếu không có tin nhắn nào
                echo "<p>Hiện không có tin nhắn nào.</p>";
            }
            // Đóng kết nối
            mysqli_close($conn);
            ?>
        </div>
            <div id="chat-input">
                <form id="send-message-form" action="send_message.php" method="post">
                    <input type="text" name="message" placeholder="Nhập tin nhắn của bạn...">
                    <input type="submit" class="gui" value="Gửi">
                </form>
            </div>
        </div>
    </div>
</body>
</html>