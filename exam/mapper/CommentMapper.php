<?php

require_once(ROOT . '/class/Comment.php');

class CommentMapper
{
	public function map($obj = []): array
	{
		$ret = [];

		foreach ($obj as $row) {
			$c = new Comment();
			$ret[] = $c->setId($row['id'])
			  ->setBody($row['body'])
			  ->setCreatedAt($row['created_at'])
			  ->setNewsId($row['news_id']);
		}

		return $ret;
	}
}