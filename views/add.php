<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>You have landed in ADD page</h1>
    <?php


    for ($i=0; $i<2 ; $i++) {
      echo $this->val_pass[$i]["id"]."<br/>";
      echo $this->val_pass[$i]["Name"]."<br/>";
      echo $this->val_pass[$i]["Date"]."<br/>";
    }



     ?>
  </body>
</html>
