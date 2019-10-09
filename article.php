<?php

require "/includes/config.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $config['title']; ?></title>


    <!-- Bootstrap Grid -->
    <link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>

<body>

    <div id="wrapper">

        <?php include "/includes/header.php"; ?>
        <?php
        $article = mysqli_query($connection, "select * from articles where id = " . $_GET['id']);
        if (mysqli_num_rows($article) <= 0) {
            ?>
            <div id="content">
                <div class="container">
                    <div class="row">
                        <section class="content__left col-md-8">
                            <div class="block">
                                <h3>Статья не найдена!</h3>
                                <div class="block__content">
                                    <div class="full-text">
                                        Запрашиваемая статья не найдена!
                                    </div>
                                </div>
                            </div>

                        </section>
                        <section class="content__right col-md-4">
                            <?php include "/includes/sidebar.php"; ?>
                        </section>
                    </div>
                </div>
            </div>
        <?php
        } else {
            $art = mysqli_fetch_assoc($article);
            mysqli_query($connection, "update articles set views=views+1 where id = " . (int) $art['id'])
            ?>
            <div id="content">
                <div class="container">
                    <div class="row">
                        <section class="content__left col-md-8">
                            <div class="block">
                                <a><?php echo $art['views']; ?> views</a>
                                <h3><?php echo $art['title']; ?></h3>
                                <div class="block__content">
                                    <img src="/static/images/<?php echo $art['image']; ?>" style="max-width: 100%">
                                    <div class="full-text">
                                        <?php echo $art['text']; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="block">
                                <a href="#comment-add-form">Add comment</a>
                                <h3>Комментарии</h3>
                                <div class="block__content">
                                    <div class="articles articles__vertical">

                                        <?php

                                            $comments = mysqli_query($connection, "select * from `comments` where `articles_id` = " . (int) $art['id']);
                                            if (mysqli_num_rows($comments) <= 0) {
                                                echo 'Нет комментариев!';
                                            }
                                            while ($comment = mysqli_fetch_assoc($comments)) {
                                                ?>
                                            <article class="article">
                                                <div class="article__image" style="background-image: url(https://gravatar.com/avatar/<?php echo md5($comment['email']) ?>?s=125);"></div>
                                                <div class="article__info">
                                                    <a href="/article.php?id=<?php echo $comment['articles_id']; ?>"><?php echo $comment['autor']; ?></a>
                                                    <div class="article__info__meta"></div>
                                                    <div class="article__info__preview"><?php echo $comment['text']; ?></div>
                                                </div>
                                            </article>
                                        <?php
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
                            <div class="block" id="comment-add-form">
                                <h3>Добавить комментарий</h3>
                                <div class="block__content">
                                    <form class="form" method="POST" action="/article.php?id=<?php echo $art['id']; ?>">
                                        <?php
                                            if (isset($_POST['do_post'])) {
                                                $errors = array();
                                                if ($_POST['name'] == '') {
                                                    $errors[] = 'Enter name!';
                                                }
                                                if ($_POST['nickname'] == '') {
                                                    $errors[] = 'Enter nickname!';
                                                }
                                                if ($_POST['text'] == '') {
                                                    $errors[] = 'Enter text!';
                                                }
                                                if (empty($errors)) {
                                                    mysqli_query($connection, "insert into `comments` (`autor`, `nickname`, `text`, `pubdate`, `articles_id`) values ('".$_POST['name']."', '".$_POST['nickname']."', '".$_POST['text']."', NOW(),'".$art['id']."')");
                                                } else {
                                                    echo $errors[0];
                                                }
                                            }
                                            ?>
                                        <div class="form__group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form__control" required="" name="name" placeholder="Имя" value="<?php echo $_POST['name'];  ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form__control" required="" name="nickname" placeholder="Никнейм">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form__group">
                                            <textarea name="text" required="" class="form__control" placeholder="Текст комментария ..."></textarea>
                                        </div>
                                        <div class="form__group">
                                            <input type="submit" class="form__control" name="do_post" value="Добавить комментарий">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                        <section class="content__right col-md-4">
                            <?php include "/includes/sidebar.php"; ?>
                        </section>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>



        <?php include "/includes/footer.php"; ?>

    </div>

</body>

</html>