<?php
$pageid = $_GET['task'];
try {
    //code...
    $dbh = new PDO('mysql:host=myapp;dbname=todo_app', 'root', 'root');
    $dbh->query('SET NAMES utf8;');

    $sth = $dbh->query('SELECT * FROM todos WHERE id=' . $pageid . '');
    $sth->execute();
    $task = $sth->fetch();
    unset($dbh);
} catch (\Throwable $th) {
    //throw $th;
    echo '捕捉した例外: ',  $th->getMessage(), "\n";
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク詳細</title>
    <style>
        h1 {
            text-align: center;
            padding: 30px;
        }

        .container {
            width: 60%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        table th,
        table td {
            padding: 10px 0;
            text-align: center;
        }

        table tr:nth-child(odd) {
            background-color: #eee
        }

        .link {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <h1>タスク詳細</h1>
    <div class="container">
        <table>
            <tr>
                <th>ID</th>
                <td><?php echo $_GET['task']; ?></td>
            </tr>
            <tr>
                <th>タスク</th>
                <td><?php echo htmlspecialchars($task['name']) ?></td>
            </tr>
            <tr>
                <th>タスク内容</th>
                <td><?php echo htmlspecialchars($task['content']) ?></td>
            </tr>
            <tr>
                <th>作成日時</th>
                <td><?php echo htmlspecialchars($task['created']) ?></td>
            </tr>
            <tr>
                <th>更新日時</th>
                <td><?php echo htmlspecialchars($task['updated']) ?></td>
            </tr>
        </table>
        <div class="link">
            <div class="link__back">
                <a href="/index.php">戻る</a>
            </div>
            <div class="link__edit">
                <a href="">編集する</a>
            </div>
            <div class="link__delete">
                <form action="./tasks/delete.php" method="post">
                    <input type="hidden" name="id" value="<?= $pageid; ?>">
                    <input type="submit" value="削除する">
                </form>
            </div>
        </div>
    </div>

</body>

</html>