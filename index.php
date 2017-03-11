<?php
   $connect = mysql_connect("localhost","root","") or die(mysql_error());   
    mysql_select_db("blog_text")
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <title>Blog.ru</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/mystyle.css" rel="stylesheet">
	  
  </head>
  <body>
	  <nav class="navbar navbar-inverse">
          
      <h1 style="font-size:60px" align="center" ><a href="index.php"><img src="imag.png" width="100" height="100"/> <b style="color:#80a"> БЛОГ  <br>* * * * * * </b> </a> </h1>
	  </nav>
	  
<div class="wrapper">
    
	<div class="content">
       <?php
        $num = 10;
        $page = $_GET['page'];
        $result00 = mysql_query("SELECT COUNT(*) FROM articles");
        $temp = mysql_fetch_array($result00);
        $posts = $temp[0];
        $total = (($posts - 1) / $num) + 1;
        $total =  intval($total);
        $page = intval($page);
        if(empty($page) or $page < 0) $page = 1;
        if($page > $total) $page = $total;
        $start = $page * $num - $num;        

            $result = mysql_query("SELECT * FROM articles ORDER By id DESC LIMIT $start, $num")  or die(mysql_error()); 
            $data = mysql_fetch_array($result);
                
            do{
                $string = $data["Text"]; 
                $string = mb_substr($string, 0, 400,'UTF-8');
                $t='...';
                $string=$string.$t;
               // echo $string."...";
                printf('
                    <div class="article">
                        <img src="images_f.jpg"/>
                        <a  style="color:#200" href="title1.php?ID=%s"><h1 align="center">%s</h1></a>
                        <p align="justify"> %s</p>
                        <p  class="data">%s</p>
                        <div style="clear:both;"></div>
                    </div>
               
               ',$data["ID"], $data["Title"],$string,$data["Data"]); 
            }
            while($data = mysql_fetch_array($result));


                if ($page != 1) $pervpage = '<a href=index.php?page=1>Первая</a> | <a href=index.php?page='. ($page - 1) .'>Предыдущая</a> | ';
            
                if ($page != $total) $nextpage = ' | <a style align="left" href=index.php?page='. ($page + 1) .'>Следующая</a> | <a href=index.php?page=' .$total. '>Последняя</a>';
 
                if($page - 5 > 0) $page5left = ' <a href=index.php?page='. ($page - 5) .'>'. ($page - 5) .'</a> | ';
                if($page - 4 > 0) $page4left = ' <a href=index.php?page='. ($page - 4) .'>'. ($page - 4) .'</a> | ';
                if($page - 3 > 0) $page3left = ' <a href=index.php?page='. ($page - 3) .'>'. ($page - 3) .'</a> | ';
                if($page - 2 > 0) $page2left = ' <a href=index.php?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
                if($page - 1 > 0) $page1left = ' <a href=index.php?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';
 
                if($page + 5 <= $total) $page5right = ' | <a href=index.php?page='. ($page + 5) .'>'. ($page + 5) .'</a>';
                if($page + 4 <= $total) $page4right = ' | <a href=index.php?page='. ($page + 4) .'>'. ($page + 4) .'</a>';
                if($page + 3 <= $total) $page3right = ' | <a href=index.php?page='. ($page + 3) .'>'. ($page + 3) .'</a>';
                if($page + 2 <= $total) $page2right = ' | <a href=index.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
                if($page + 1 <= $total) $page1right = ' | <a href=index.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>';
 
                if ($total > 1)
                {
                Error_Reporting(E_ALL & ~E_NOTICE);
                echo "<div class=\"pstrnav\">";
                echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
                echo "</div>";
                }
        ?>
        
	</div>
	
	<div class="footer"><h5>@Vologda_2017</h5></div>
</div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>