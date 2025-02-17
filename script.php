<?php 
$host = 'mysql-8.2.local';
$dbname = 'test';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$postsJson = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$commentsJson = file_get_contents('https://jsonplaceholder.typicode.com/comments');

$posts = json_decode($postsJson, true);
$comments = json_decode($commentsJson, true);

$postStmt = $pdo->prepare("INSERT INTO posts (id, userId, title, body) VALUES (:id, :user_id, :title, :body)");
foreach ($posts as $post) {
    $postStmt->execute([
        ':id' => $post['id'],
        ':user_id' => $post['userId'],
        ':title' => $post['title'],
        ':body' => $post['body']
    ]);
}

$commentStmt = $pdo->prepare("INSERT INTO comments (id, postId, name, email, body) VALUES (:id, :post_id, :name, :email, :body)");
foreach ($comments as $comment) {
    $commentStmt->execute([
        ':id' => $comment['id'],
        ':post_id' => $comment['postId'],
        ':name' => $comment['name'],
        ':email' => $comment['email'],
        ':body' => $comment['body']
    ]);
}

echo "Загружено " . count($posts) . " записей и " . count($comments) . " комментариев\n";

?>