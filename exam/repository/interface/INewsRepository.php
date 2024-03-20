<?php

interface INewsRepository 
{
    function all();

    function get(int $id);

    function add(News $news);

    function delete(int $id);
    
}