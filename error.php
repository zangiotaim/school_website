<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Error - Page Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #ff6347;
        }
        p {
            line-height: 1.6;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        #timer {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
    <script>
        var count = 10;
        var timer = setInterval(function() {
            document.getElementById("timer").innerText = count;
            count--;
            if (count === 0) {
                clearInterval(timer);
                window.location.href = "index.php";
            }
        }, 1000); // Update every second
    </script>
</head>
<body>
    <div class="container">
        <h1>404 - Page Not Found</h1>
        <p>The page you were looking for is unavailable or may have been moved.</p>
        <p>Please take a moment to return to the homepage and continue exploring the school website.</p>
        <p>If you were trying to reach a specific section, the main menu is the quickest place to start.</p>
        <p>You will be redirected to the homepage in <span id="timer">10</span> seconds.</p>
        <p><a href="index.php">Go back to the homepage now</a></p>
    </div>
</body>
</html>
