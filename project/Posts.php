<?php

Class Posts
{
    private $connect;

    public function __construct()
    {
        $this->connect = new mysqli("localhost", "root", "", "project");

        if ($this->connect->connect_error) {
            die("Connection failed: " . $this->connect->connect_error);
        }
    }

    public function createPost()
    {
        $name = $_POST['name'];
        $post = $_POST['post'];
        $date = date("Y-m-d");

        $this->connect->query("INSERT INTO `posts` (`id`, `name`, `post`, `created_at`) VALUES (NULL, '$name', '$post', '$date' )");

        header('Location: /project');
    }

    public function createComment()
    {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $id = $_POST['id'];
        $date = date("Y-m-d");

        $this->connect->query("INSERT INTO `comments` (`id`, `name`, `comment`, `post_id`, `created_at`) VALUES (NULL, '$name', '$comment', '$id', '$date' )");

        header('Location: /project');
    }

    public function createRating()
    {
        $id = $_POST['id'];
        $star = $_POST['star'];
        $date = date("Y-m-d");

        $this->connect->query("INSERT INTO `post_rating` (`id`, `post_id`, `star`, `created_at`) VALUES (NULL, '$id', '$star', '$date' )");
    }

    public function getAllPost()
    {
       return $this->connect->query( "SELECT * FROM `posts`")->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostsCount()
    {
        return $this->connect->query("SELECT COUNT(`id`) `post_count` FROM `posts`")->fetch_assoc();
    }

    public function getComments()
    {
        return $this->connect->query("SELECT * FROM `comments`")->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostRatingPositive()
    {
        return $this->connect->query("SELECT COUNT(DISTINCT `post_id`) `post_count` FROM 
        (SELECT `post_id`, AVG(`star`) as `totalstar` FROM `post_rating` GROUP BY `post_id`) `avg_count`
        WHERE `totalstar` >= 4")->fetch_assoc();
    }

    public function getPostRatingNegative()
    {
        return $this->connect->query( "SELECT COUNT(DISTINCT `post_id`)  `post_count` FROM 
        (SELECT `post_id`, AVG(`star`) as `totalstar` FROM `post_rating` GROUP BY `post_id`) `avg_count`
        WHERE `totalstar` <= 2")->fetch_assoc();
    }

}