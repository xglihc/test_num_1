<?php 
$host = 'mysql-8.2.local';
$dbname = 'test';
$username = 'root';
$password = '';
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$search = $_POST['search'] ?? '';

if (strlen($search) < 3) {
    echo "Введите минимум 3 символа для поиска.";
    exit;
}

$stmt = $pdo->prepare("
    SELECT posts.title, comments.body AS comment_body
    FROM comments
    JOIN posts ON comments.postId = posts.id
    WHERE comments.body LIKE :search
");
$stmt->execute([':search' => '%' . $search . '%']);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($results) > 0) {
    echo "<h1>Результаты поиска:</h1>";
    foreach ($results as $result) {
        echo "<h2>Запись: " . htmlspecialchars($result['title']) . "</h2>";
        echo "<p>Комментарий: " . htmlspecialchars($result['comment_body']) . "</p>";
    }
} else {
    echo "Ничего не найдено.";
}


?>