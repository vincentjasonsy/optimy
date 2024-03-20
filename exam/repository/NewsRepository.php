<?php
		
require_once(ROOT . '/repository/interface/INewsRepository.php');
require_once(ROOT . '/class/News.php');
require_once(ROOT . '/mapper/NewsMapper.php');

class NewsRepository implements INewsRepository 
{
    protected NewsMapper $mapper;

    public function __construct(protected DbManager $dbManager) 
    {
        $this->mapper = new NewsMapper();
    }

    public function all() 
    {
        return $this->mapper->map($this->dbManager->select('SELECT * FROM `news`'));
    }

    public function get(int $id)
    {
        return $this->mapper->map($this->dbManager->select("SELECT * FROM `news` n WHERE n.id = '$id'"));
    }

    public function add(News $news)
    {
		$this->dbManager
            ->exec("INSERT INTO `news` (`title`, `body`, `created_at`) VALUES('". $news->getTitle() . "','" . $news->getBody() . "','" . date('Y-m-d') . "')");
    }

    function delete(int $id)
    {
		$this->dbManager
            ->exec("DELETE FROM `news` WHERE id = '$id'");

        $this->dbManager
            ->exec("DELETE FROM `comment` WHERE news_id = '$id'");
    }
}