<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tani Makmur</title>
    <style>
        /* CSS - FLOATING CARD LAYOUT */
        * { 
            box-sizing: border-box; 
            font-family: Arial, Helvetica, sans-serif; 
        }
        body, html { 
            height: 100%; 
            margin: 0; 
            background-color: #f8f9fc; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }
        
        /* Kontainer*/
        .main-wrapper { 
            display: flex; 
            width: 100%; 
            max-width: 1300px; 
            height: 90vh; 
            min-height: 600px; 
            gap: 60px; 
            padding: 0 40px; 
        }

        /* Panel Kiri*/
        .left-panel {
            background-color: #386641;
            color: white;
            flex: 1.1; 
            border-radius: 24px; 
            padding: 50px;
            margin: 20px 0; 
            display: flex;
            flex-direction: column;
            box-shadow: 0 10px 30px rgba(56, 102, 65, 0.15); 
        }
        .header-title { 
            font-size: 1.2rem; 
            font-weight: bold; 
            margin-bottom: 20px; 
        }
        .hero-img { 
            width: 270px; 
            height: auto; 
            margin: auto; 
            display: block; 
            filter: drop-shadow(0px 15px 15px rgba(0,0,0,0.3));
            transform: rotate(-25deg); 
        }
        .welcome-text { 
            margin-top: auto; 
        }
        .welcome-text h1 { 
            font-size: 2.5rem; 
            margin: 0 0 10px 0; 
            line-height: 1.2; 
        }
        .welcome-text p { 
            color: #c9dfce; 
            margin: 0; 
            line-height: 1.4; 
            font-size: 1.05rem; 
        }

        /* Panel Kanan*/
        .right-panel { 
            flex: 1; 
            display: flex; 
            align-items: center; 
            justify-content: flex-end; 
            padding: 40px 0; 
        }
        .login-form { 
            width: 100%; 
            max-width: 420px; 
        }
        .login-form h2 { 
            font-size: 2.6rem; 
            margin: 0 0 40px 0; 
            color: #000; 
            font-weight: 800; 
        }
        .form-group { 
            margin-bottom: 25px; 
        }
        .form-group label { 
            display: block; 
            margin-bottom: 10px; 
            color: #333; 
            font-weight: 600; 
            font-size: 0.9rem; 
        }
        .form-group input { 
            width: 100%; 
            padding: 14px; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            font-size: 1rem; 
            outline: none; 
            background-color: #fff; 
        }
        .form-group input:focus { 
            border-color: #386641; 
        }
        .btn-login { 
            width: 100%; 
            background-color: #386641; 
            color: white; 
            padding: 15px; 
            border: none; 
            border-radius: 8px; 
            font-size: 1rem; 
            font-weight: bold; 
            cursor: pointer; 
            margin-top: 10px; 
            letter-spacing: 0.5px; 
        }
        .btn-login:hover { 
            background-color: #2c5232; 
        }
        .forgot-link { 
            display: block; 
            margin-top: 15px; 
            color: #555; 
            text-decoration: underline; 
            font-size: 0.9rem; 
        }

        @media (max-width: 900px) {
            .left-panel { display: none; }
            .main-wrapper { height: 100vh; padding: 0 20px; }
            .right-panel { justify-content: center; }
        }
    </style>
</head>
<body>

    <div class="main-wrapper">
        <div class="left-panel">
            <div class="header-title">🌱 Tani Makmur</div>
            <img src="assets/img/jagung.png" alt="Jagung" class="hero-img">
            <div class="welcome-text">
                <h1>Selamat datang di<br>Tani Makmur!</h1>
                <p>Sistem Informasi Logistik Pasca-Panen<br>Komoditas Pertanian Multi Grade</p>
            </div>
        </div>

        <div class="right-panel">
            <div class="login-form">
                <h2>Login ke Akun<br>Anda</h2>
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <button type="submit" class="btn-login">LOGIN</button>
                    <a href="#" class="forgot-link">Lupa Password?</a>
                </form>
            </div>
        </div>
    </div>

</body>
</html>