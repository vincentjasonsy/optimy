<?php

require_once(ROOT . '/class/News.php');

class NewsMapper
{
	public function map($obj = []): array
	{
		$ret = [];

		foreach ($obj as $row) {
			$news = new News();
			$ret[] = $news->setId($row['id'])
			->setTitle($row['title'])
			->setBody($row['body'])
			->setCreatedAt($row['created_at']);
		}

		return $ret;
	}
}