<!DOCTYPE html>
<html>
<head>
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <form action="register_process.php" method="post">
        <div id="wrapper">
            <div id="form-login">
                <center><h1>Đăng Ký</h1></center>
                <div class="form-group">
                    <input type="email" id="email" name="email" class="form-input" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="text" id="username" name="username" class="form-input" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-input" placeholder="Password" required>
                </div>
                    <center>
                        <input type="submit" value="Đăng Ký" class="form-submit">
                        <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
                    </center>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
