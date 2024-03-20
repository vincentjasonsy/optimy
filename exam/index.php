<?php

require_once('config.php');

require_once(ROOT . '/repository/NewsRepository.php');
require_once(ROOT . '/repository/CommentRepository.php');
require_once(ROOT . '/utils/DbManager.php');

$db = new DbManager();
$news = new NewsRepository($db);
$comment = new CommentRepository($db);

// FIRST APPROACH
// Instead of looping through all the news comments and looking of their corresponding news item,
// we will load up the news comments per news item
echo("############ FIRST APPROACH ############\n");
foreach ($news->all() as $newsItem) {
	echo("############ NEWS " . $newsItem->getTitle() . " ############\n");
	echo($newsItem->getBody() . "\n");
	foreach ($comment->getByNewsId($newsItem->getId()) as $commentItem) {
		echo("Comment " . $commentItem->getId() . " : " . $commentItem->getBody() . "\n");
	}
}

// SECOND APPROACH
// This eliminates fetching of news comments per news item
echo("############ SECOND APPROACH ############\n");
$newsComments = $comment->all();
foreach ($news->all() as $newsItem) {
	echo("############ NEWS " . $newsItem->getTitle() . " ############\n");
	echo($newsItem->getBody() . "\n");
	foreach ($newsComments as $index => $commentItem) {
		if ($commentItem->getNewsId() === $newsItem->getId()) {
			echo("Comment " . $commentItem->getId() . " : " . $commentItem->getBody() . "\n");
			unset($newsComments[$index]);
		}
	}
}