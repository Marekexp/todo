<?php
require_once 'app/init.php';

$itemsQuery = $db->prepare("
    SELECT id, name, done 
    FROM items
    WHERE user = :user");

$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TO DO</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"/>﻿
    <link rel="stylesheet" href="css/main.css"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="list">
    <h1 class="header">To do.</h1>

    <?php if(!empty($itemsQuery)): ?>
    <ul class="items">
        <?php foreach ($itemsQuery as $item): ?>
        <li>
            <a href="done.php?isdone=<?php echo $item['done'] ? 'un' : '' ?>done&itemid=<?php echo $item['id']?>" class="done<?php echo $item['done'] ? '_box' : '' ?>"></a><span class="item<?php echo $item['done'] ? '_done' : '' ?>"><?php echo $item['name']; ?></span>
        </li>
        <?php endforeach; ?>
<!--        <li>
            <a href="undone.php" class="done_box"></a><span class="item_done">Learn PHP</span>
        </li>-->
    </ul>
    <?php else: ?>
        <p>No items added.</p>
    <?php endif; ?>

    <form class="item_add" action="add.php" method="post">
            <input type="text" name="name" placeholder="Input text" autocomplete="off" class="input">
            <input type="submit" name="submit" value="Add" class="submit">
    </form>

</div>

</body>
</html>
