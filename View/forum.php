<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="View/forum.css">
</head>

<body>
    <div class="post-list">
        <div class="post">
            <h1><div class="post-name"><?= $post->name; ?></div></h1>
            <p><div class="creatorPost-email">Createur : <?= $creatorPost->email; ?></div></p>
            <p><div class="post-content"><?= $post->content; ?></div></p>
            <p><div class="post-date"><?= $post->date; ?></div></p>
            </div>
            <?php foreach ($listCommentaires as $commentaire) { ?>
                <p><div class="creatorComment-email"><?= $creatorComment->email?></div></p>
                <p><div class="commentaire-content"><?= $commentaire->content?></div></p>
            <?php } ?>
    </div>
</body>

</html>