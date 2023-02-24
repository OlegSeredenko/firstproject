<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';
function getMessages()
{
	global $connect;
	$query = "SELECT posts.id,posts.title,posts.text,posts.insertedOn,posts.userId,posts.img, users.fullname 
	FROM posts LEFT JOIN users ON posts.userId = users.id ORDER BY id DESC LIMIT 15";
	$res = mysqli_query($connect, $query);
	return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function redirect()
{
    header('Location: /feedback');
    exit;
}

function getMessageBlogForEdit($x)
{	
	global $connect;
	$query = "SELECT posts.id,posts.title,posts.text,posts.insertedOn,posts.userId,posts.img, users.fullname 
	FROM posts LEFT JOIN users ON posts.userId = users.id WHERE posts.id = $x";
	$res = mysqli_query($connect, $query);
	return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function blogDelete($y) {
	global $connect;
	$query = "DELETE FROM posts WHERE id = $y";
	$res = mysqli_query($connect, $query);
}