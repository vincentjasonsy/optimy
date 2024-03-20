<?php

interface ICommentRepository 
{
    function all();

    function get(int $id);

    function getByNewsId(int $newsId);

    function add(int $newsId, Comment $comment);

    function delete(int $id);

}