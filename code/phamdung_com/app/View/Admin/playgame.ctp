<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>
            <?php
            echo $this->Html->charset();
            echo $data['title_page']; /* Tiêu đề của trang web */
            ?>
        </title>
    </head>
    <body>
    <?php
        echo "Ban dang choi tro choi thu ".$data['id'];
    ?>
    </body>
</html>