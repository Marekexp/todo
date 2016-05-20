<?php
require_once 'app/init.php';

if (isset($_GET['isdone'], $_GET['itemid'])) {
    switch($_GET['isdone']) {
        case 'done':
            $done = $db->prepare("
            UPDATE items
            SET done = 1
            WHERE id = :id
            AND user = :user
             ");

            $done->execute([
                'id' => $_GET['itemid'],
                'user' => $_SESSION['user_id']
            ]);
            break;

        case 'undone':
            $done = $db->prepare("
            UPDATE items
            SET done = 0
            WHERE id = :id
            AND user = :user
            ");

            $done->execute([
                'id' => $_GET['itemid'],
                'user' => $_SESSION['user_id']
            ]);
            break;

        }
}
header('Location: index.php')

?>

