<!DOCTYPE html>
<html lang="lv" dir="ltr">

  <head>
    <meta charset="utf-16">
    <title>Test home page</title>

    <link rel="stylesheet" href="views/assets/css/style.css">
    <link rel="stylesheet" href="views/assets/css/button_style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,900" rel="stylesheet">

  </head>

  <body>
        <div class="container">
                <div class="final-main">

                          <?php
                                //prints username
                                echo "<h1>Paldies, ".$this->res["user"]." !</h1>";

                                //prints correct answers
                                echo "<p>Esi ispildījis testu ar ".$this->res["correct_answers"][0][0]." pareizām atbildēm no ".$this->res["total_number_of_quest"]." jautājumiem</p>";
                          ?>

                </div> <!-- end of final-main -->


                  <!-- Redirects to home page -->
                  <form action="/" method="get">
                        <div class="submit-container">
                              <button id="submit">
                                Mēģināt citu testu
                              </button>
                        </div>
                  </form>

        </div><!-- end of container -->

  </body>
</html>
