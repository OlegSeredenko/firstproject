<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';

function getMessages()
{
	global $pdo;
	$stmt = $pdo->query('SELECT posts.id,posts.title,posts.text,posts.insertedOn,posts.userId,posts.img, users.fullname 
	FROM posts LEFT JOIN users ON posts.userId = users.id ORDER BY id DESC LIMIT 10');
	$arr = [];
    while ($row = $stmt->fetch())
	{
		$arr[] = $row;
	}
	unset($stmt);
    return $arr;
}


function redirect()
{
    header('Location: /feedback');
    exit;
}

function getMessageBlogForEdit($postId)
{	
	global $pdo;
	$postId = (int)$postId;
	$stmt = $pdo->prepare('SELECT posts.id,posts.title,posts.text,posts.insertedOn,posts.userId,posts.img, users.fullname 
	FROM posts LEFT JOIN users ON posts.userId = users.id WHERE posts.id = ?');
	$stmt->execute([$postId]);
	$arr = [];
	while ($row = $stmt->fetch())
	{
		$arr[] = $row;
	}
	unset($stmt);
	unset($postId);
    return $arr;
}

function blogDelete($postId) {
	$postId = (int)$postId;
	try {
		global $pdo;
		$sql = "DELETE FROM posts WHERE id = $postId";
		$affectedRowsNumber = $pdo->exec($sql);
		unset($sql);
		unset($postId);
		echo "Удалено строк: $affectedRowsNumber";
	}
	catch (PDOException $e) {
		echo "Database error: " . $e->getMessage();
	}
}
