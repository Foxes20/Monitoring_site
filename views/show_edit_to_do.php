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
        <div>
            <form action="/update_to_do" method="POST" name="">
                <?if (isset($message_ok)) :?>
                    <span><?=$message_ok?></span>
                <?endif;?><br>
                <input type="hidden" name="record_id" value="<?=$dataTitle['id']?>">
                <input type="text" name="title_upd" value="<?=$dataTitle['title']?>">
                <input type="submit" value="Изменить"><br>
                <?if (isset($errors)) :?>
                    <span><?=$errors?></span>
                <?endif;?>
            </form>
        </div>
    </body>
</html>
