<?php

require_once 'Posts.php';

$postsClass = new Posts();

if (isset($_POST['action_type'])) {

    switch ($_POST['action_type']){
        case 'addPost':
            $postsClass->createPost();
            break;
        case 'addComment':
            $postsClass->createComment();
            break;
        case 'addRating':
            $postsClass->createRating();
            break;
    }
}



