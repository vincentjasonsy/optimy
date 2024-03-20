<?php
		
require_once(ROOT . '/repository/interface/ICommentRepository.php');
require_once(ROOT . '/class/Comment.php');
require_once(ROOT . '/mapper/CommentMapper.php');

class CommentRepository implements ICommentRepository 
{
    protected CommentMapper $mapper;

    public function __construct(protected DbManager $dbManager) 
    {
        $this->mapper = new CommentMapper();
    }

    public function all() 
    {
        return $this->mapper->map($this->dbManager->select('SELECT * FROM `comment`'));
    }

    public function get(int $id)
    {
        return $this->mapper->map($this->dbManager->select("SELECT * FROM `comment` n WHERE n.id = '$id'"));
    }

    public function getByNewsId(int $newsId)
    {
        return $this->mapper->map($this->dbManager->select("SELECT * FROM `comment` n WHERE n.news_id = '$newsId'"));
    }

    public function add(int $newsId, Comment $comment)
    {
		$this->dbManager
            ->exec("INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES('". $comment->getBody() . "','" . date('Y-m-d') . "','" . $newsId . "'");
    }

    function delete(int $id)
    {
		$this->dbManager
            ->exec("DELETE FROM `comment` WHERE id = '$id'");
    }
}