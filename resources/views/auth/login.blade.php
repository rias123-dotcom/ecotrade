<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrade - Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        :root {
            --header-green: #38a169; /* Darker green strip at the top */
            --bg-green: #60a566;     /* Main background olive/moss green */
            --card-green: #598a63;   /* Card background slightly darker green */
            --text-color: #f7f9f7;   /* Light text color */
            --input-bg: #e2e8f0;     /* Light gray/beige input background */
            --button-light: #52c286; /* Light green button gradient start */
            --button-dark: #38a169;  /* Dark green button gradient end */
            --logo-light: #9fecb3;   /* Lighter shade in logo */
            --logo-dark: #ffffff;    /* White shade in logo */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-green);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .header-strip {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: var(--header-green);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .logo-container {
            position: absolute;
            top: 15px;
            left: 50px;
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: var(--logo-dark);
            z-index: 10;
        }

        .logo-container span:first-child {
            color: var(--logo-light);
            margin-right: 2px;
        }
        
        .logo-container::before {
            content: '♦'; /* Placeholder for diamond icon/shape */
            color: var(--logo-light);
            font-size: 1.2em;
            margin-right: 5px;
            line-height: 1;
        }


        .login-card {
            background-color: var(--card-green);
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 350px;
            text-align: center;
            position: relative;
        }

        .card-logo {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: var(--logo-dark);
            margin-bottom: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .card-logo span:first-child {
            color: var(--logo-light);
            margin-right: 2px;
        }
        
        .card-logo::before {
            content: '♦';
            color: var(--logo-light);
            font-size: 1.2em;
            margin-right: 5px;
            line-height: 1;
        }

        .form-group {
            text-align: left;
            margin-bottom: 25px;
        }

        .form-group label {
            color: var(--text-color);
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 6px;
            background-color: var(--input-bg);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            color: #333;
            box-sizing: border-box;
            transition: background-color 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 0 0 2px rgba(255, 255, 255, 0.5);
        }


        .forgot-password {
            text-align: left;
            margin-bottom: 30px;
        }

        .forgot-password a {
            color: var(--text-color);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .forgot-password a:hover {
            color: var(--logo-light);
        }

        .login-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: linear-gradient(to bottom, var(--button-light), var(--button-dark));
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .login-button:hover {
            background: linear-gradient(to top, var(--button-light), var(--button-dark));
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
        }

        .register-text {
            margin-top: 30px;
            color: var(--text-color);
            font-size: 16px;
        }

        .register-text a {
            color: var(--button-light);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }
        
        .register-text a:hover {
            color: white;
        }

    </style>
</head>
<body>

    <div class="header-strip"></div>
    <div class="logo-container">
        <a href="{{route('landing')}}"><span>ECO</span><span>TRADE</span></a>
    </div>

    <div class="login-card">
        <div class="card-logo">
            <span>ECO</span><span>TRADE</span>
        </div>

        <form method="POST" action="{{route('login.post')}}">
            @csrf
            <div class="form-group">
                <label for="username">Email Address</label>
                <input type="email" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="forgot-password">
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>

        <div class="register-text">
            Do you have an account? <a href="{{route('register')}}">Register</a>
        </div>
    </div>

</body>
</html>