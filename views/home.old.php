<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>You have landed in HOME page</h1>
    <?php


    for ($i=0; $i<2 ; $i++) {
      echo $this->res[$i]["id"]."<br/>";
      echo $this->res[$i]["Name"]."<br/>";
      echo $this->res[$i]["Date"]."<br/>";
    }



     ?>

     
  </body>
</html>
