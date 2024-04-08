// Đợi cho tài liệu được tải hoàn toàn trước khi thêm sự kiện cho nút "Đăng Ký"
$(document).ready(function() {
    // Thêm sự kiện click cho nút "Đăng Ký"
    $("#dangky").click(function(e) {
        // Ngăn chặn hành động mặc định của form
        e.preventDefault();
        
        // Chuyển hướng đến trang logup.php
        window.location.href = "register.php";
    });
});