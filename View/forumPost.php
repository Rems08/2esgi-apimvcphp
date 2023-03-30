<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="View/listPost.css">
</head>

<body>
    <div class="post-list">
        <?php foreach ($posts as $post) { ?>
            <div class="post">
                <h1><div class="post-name"><?= $post->name; ?></div></h1>
                <p><div class="post-content"><?= $post->content; ?></div></p>
                <p><div class="post-date"><?= $post->date; ?></div></p>
            </div>
        <?php } ?>
    </div>
</body>

</html>