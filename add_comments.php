<?php
    $db = mysql_connect("localhost","root",""); 
                 mysql_select_db("blog_text");
 
    $db = mysql_connect("localhost","root",""); 
                mysql_select_db("baza",$db);

    if (isset($_POST['author']))
    {
        $author = $_POST['author'];
    }
    if (isset($_POST['ch']))
    {
        $ch = $_POST['ch'];
    }
    if (isset($_POST['put']))
    {
        $put = $_POST['put'];
    }
    if (isset($_POST['text']))
    {
         $text = $_POST['text'];
    }
    if (isset($_POST['sub_com']))
    {
        $sub_com = $_POST['sub_com'];
    }
    if (isset($sub_com))
    {
        if (isset($author))
        {
            trim($author);
        }
            else {$author ="";}
        if (isset($text))
        {
            trim($text);
        }
        else {$text ="";}

        if (empty($author) or empty($text))
        {
            exit("<p> Вы ввели не всю информацию, вернитесь назад и введите все поля</p><br><input name='back' type='button' value='Вернуться' onclick= 'javascript:history.back()'>");
        }

        $author = stripslashes($author);
        $text = stripslashes($text);
        $author = htmlspecialchars($author);
        $text = htmlspecialchars($text);

        $text = preg_replace("/[ ]+/", " ", $text);//убираем лишние пробелы если есть 
        $drop=explode(" ", $text);//разбиваем сообщение в массив по  строкам

        for ($i = 0; $i < count($drop); $i++) 
        {
           $tmp = $drop[$i];
           $strlen = strlen($tmp);

           if ($strlen > 30)
           {
             exit("<p> Слишком длинное слово!</p><br><input name='back' type='button' value='Вернуться' onclick= 'javascript:history.back()'> ");
           }
        }
        if ($ch=="yes") 
        {
            $date=date("d.m.y");
            $data=date("d.m.y");
            $result2 = mysql_query("INSERT baza (url,author,text,data) VALUES ('$put','$author','$text','$data')",$db);
        }
        else 
        { 
            exit("<p> Поставьте галочку в соответствующей графе! Докажите что Вы не робот!</p><br><input name='back' type='button' value='Вернуться' onclick = 'javascript: history.back();'> ");
        }
        echo "<html><head><meta http-equiv='Refresh' content='0; URL=$put'></head></html>";
        exit();
    }    

?> 