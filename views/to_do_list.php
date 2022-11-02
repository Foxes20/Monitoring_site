<?php
/**
 * @var array $outputData
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <body>
        <h3>To-Do List</h3>
            <form action="/write_to_do" method="post" >
                <input type="text" name="title" placeholder="Добавьте запись"><br>
                <input type="submit" value="Добавить">
                <? if (isset($errors['errorMessage'])): ?>
                    <p><?= $errors['errorMessage'];?></p>
                <? endif; ?>

                <? if (isset($errorsMessage)): ?>
                    <p><?= $errorsMessage;?></p>
                <? endif; ?>
                <?if (isset($message_added)) :?>
                    <p><?=$message_added?></p>
                <?endif;?>

            </form>
            <? foreach ($outputData as $key):?>
                    <p><?= $key['title'] ?> -
                    <form action="/delete_to_do" method="post">
                        <input type="hidden" name="id" value="<?=$key['id']?>">
                        <input type="hidden" value="<?=$key['title']?>">
                        <a href="/preparing_to_edit_to_do?id=<?=$key['id']?>" class="link">редактировать</a>
                        <input type="submit"  value="Удалить">
                    </form> </p>
            <? endforeach;?>
    </body>
</html>
