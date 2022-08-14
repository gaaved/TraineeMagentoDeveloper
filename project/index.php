<?php

require_once 'Controller.php';
require_once 'Posts.php';

$postsClass = new Posts();

$posts = $postsClass->getAllPost();
$posts_count = $postsClass->getPostsCount();
$comments = $postsClass->getComments();
$post_rating_positive = $postsClass->getPostRatingPositive();
$post_rating_negative = $postsClass->getPostRatingNegative();

?>

<!doctype html>
<html lang="en">
<head>
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css.css">
    <script src="js.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col p-5 m-5 order-last bg-info text-light">
                <div><?= $post_rating_positive['post_count'] ?><br>Positive Posts</div>
            </div>
            <div class="col p-5 m-5 text-center bg-info text-light">
                <div><?= $posts_count["post_count"] ?><br>All Posts</div>
            </div>
            <div class="col p-5 m-5 order-first bg-info text-light">
                <div><?= $post_rating_negative['post_count'] ?><br>Negative Posts</div>
            </div>
        </div>
    </div>
    <div class="container-md mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Add Post
        </button>
    </div>

    <div class="container">

        <?php foreach ($posts as $post) {?>

            <div class="row mb-3 border border-primary" id="<?= $post['id'] ?>">
                <div class="row mb-3 mt-3">
                    <div class="col-md-4">by <?= $post['name'] ?></div>
                    <div class="col-md d-grid gap-2 d-md-flex justify-content-md-end">
                        <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropCom" onclick="getId(<?= $post['id'] ?>)">Add Comment</button>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="mb-3"><?= $post['post'] ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <form>
                            <div class="star-rating" id="<?= $post['id'] ?>star-rating" style="">
                                <div class="star-rating__wrap">
                                    <input class="star-rating__input" id="<?= $post['id'] ?>star-rating-5" type="radio" name="rating" value="5" onclick="getStar(<?= $post['id'] ?>, 5)">
                                    <label class="star-rating__ico fa fa-star-o fa-lg" for="<?= $post['id'] ?>star-rating-5" title="5 out of 5 stars"></label>
                                    <input class="star-rating__input" id="<?= $post['id'] ?>star-rating-4" type="radio" name="rating" value="4" onclick="getStar(<?= $post['id'] ?>, 4)">
                                    <label class="star-rating__ico fa fa-star-o fa-lg" for="<?= $post['id'] ?>star-rating-4" title="4 out of 5 stars"></label>
                                    <input class="star-rating__input" id="<?= $post['id'] ?>star-rating-3" type="radio" name="rating" value="3" onclick="getStar(<?= $post['id'] ?>, 3)">
                                    <label class="star-rating__ico fa fa-star-o fa-lg" for="<?= $post['id'] ?>star-rating-3" title="3 out of 5 stars"></label>
                                    <input class="star-rating__input" id="<?= $post['id'] ?>star-rating-2" type="radio" name="rating" value="2" onclick="getStar(<?= $post['id'] ?>, 2)">
                                    <label class="star-rating__ico fa fa-star-o fa-lg" for="<?= $post['id'] ?>star-rating-2" title="2 out of 5 stars"></label>
                                    <input class="star-rating__input" id="<?= $post['id'] ?>star-rating-1" type="radio" name="rating" value="1" onclick="getStar(<?= $post['id'] ?>, 1)">
                                    <label class="star-rating__ico fa fa-star-o fa-lg" for="<?= $post['id'] ?>star-rating-1" title="1 out of 5 stars"></label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md d-grid gap-2 d-md-flex justify-content-md-end"><?= $post['created_at'] ?></div>
                </div>
            </div>

            <?php foreach ($comments as $comment) {
                if($comment['post_id'] == $post['id']){
                ?>

            <div class="row justify-content-md-end">
                    <div class="col-md-10 mb-3 border border-primary">
                            <div class="row mb-3 mt-3">
                                <div class="col-md-4">by <?= $comment['name'] ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="mb-3"><?= $comment['comment'] ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md d-grid gap-2 d-md-flex justify-content-md-end"><?= $comment['created_at'] ?></div>
                            </div>
                    </div>
            </div>
                <?php
                }
            }
            ?>
            <?php
        }
        ?>
    </div>

    <div class="modal fade" id="staticBackdropCom"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-md">
                        <form action="Controller.php" method="post">
                            <div class="mb-3">
                                <input type="hidden" id="getId" name="id" value="1">
                                <input type="hidden" name="action_type" class="form-control" value="addComment">
                                <label for="exampleFormControlInput1" class="form-label">Name<label class="text-danger">*</label></label>
                                <input name="name" class="form-control" id="exampleFormControlInput1" aria-describedby="exampleFormControlInput1" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Comment<label class="text-danger">*</label></label>
                                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3" aria-describedby="exampleFormControlTextarea1" required></textarea>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-md">
                        <form action="Controller.php" method="post">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name<label class="text-danger">*</label></label>
                                <input hidden name="action_type" class="form-control" value="addPost">
                                <input name="name" class="form-control" id="exampleFormControlInput1" aria-describedby="exampleFormControlInput1" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Post<label class="text-danger">*</label></label>
                                <textarea name="post" class="form-control" id="exampleFormControlTextarea1" rows="3" aria-describedby="exampleFormControlTextarea1" required></textarea>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Post</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
