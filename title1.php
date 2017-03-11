<?php
    $connect = mysql_connect("localhost","root","") or die(mysql_error());   
    mysql_select_db("blog_text");
    
    $db = mysql_connect("localhost","root",""); 
                mysql_select_db("baza",$db);
?>

<? $put = $_SERVER['PHP_SELF'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog.ru</title>

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/mystyle.css" rel="stylesheet">
        <link href="bootstrap/css/style.css" rel="stylesheet" type="text/css" media="screen, projection"/>

          <script type="text/javascript" src="bootstrap/js/jquery.js"></script>

          <script type="text/javascript" src="bootstrap/js/changevalue.js"></script>

          <script type="text/javascript" src="bootstrap/js/comments.js"></script>

          <script type="text/javascript" src="bootstrap/js/search.js"></script>

    </head>
    
    <body>
	  <nav class="navbar navbar-inverse">
          
      <h1 style="font-size:60px" align="center" ><a href="index.php"><img src="imag.png" width="100" height="100"/> <b style="color:#80a"> БЛОГ  <br>* * * * * * </b> </a> </h1>
	  </nav>
	  
        <div class="wrapper">    
            <div class="content">
                <?php
                    if(!isset($_GET["ID"])) {
                        $ID = 1;
                    }else
                    {
                        $ID = $_GET["ID"];
                    }

                    $result = mysql_query("SELECT * FROM articles WHERE ID='$ID'")  or die(mysql_error()); 
                    $data = mysql_fetch_array($result);
                    do{
                       printf('
                           <div>
                                <h1>%s</h1>
                                <p align=justify>%s</p>
                                <p align="right">%s</p>
                           </div>
                          ', $data["Title"],$data["Text"],$data["Data"]);

                    }
                    while($data = mysql_fetch_array($result));
                $put=$put.'?'.$ID;
                
                ?>
                
                

                <h3>Добавить комментарий:</h3>
                      <form action='http://blog1.ru/add_comments.php' method='post'>
                      <p> Имя: <br>
                      <input name='author' type='text' size='20' maxlength='20'></p>
                      <p> Комментарий:<br> <textarea name='text' cols='40' rows='5'></textarea></p>
                      <p><input name='ch' type='checkbox' value='yes'> 
                      Я не робот!</p>

                     <input name='put' type='hidden' value='<?php echo $put ?>'>
                      <p><input name='sub_com' type='submit' value='Добавить'></p>

                      </form>

                <?php

        $result3 = mysql_query("SELECT * FROM baza WHERE url='$put' ORDER BY id DESC ",$db) or die(mysql_error());

        if (mysql_num_rows($result3)>0)  
        {
        $myrow3 = mysql_fetch_array($result3);
        do
        {
        printf('<h4 >%s</h4>%s<br>%s<hr>',$myrow3["author"], $myrow3["data"], $myrow3["text"]);
        }

        while ($myrow3 = mysql_fetch_array($result3));
            $im = imagecreatetruecolor(150, 100);
            imageline($im, 10, 70, 140, 10, $red);
        } 
        ?>

            </div>

            <div class="footer"><h5>@Vologda_2017</h5></div>
        </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>