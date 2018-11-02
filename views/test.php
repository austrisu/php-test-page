<!DOCTYPE html>
<html lang="lv" dir="ltr">
  <head>
              <meta charset="utf-16">

              <title>Test home page</title>

              <link rel="stylesheet" href="views/assets/css/style.css">
              <link rel="stylesheet" href="views/assets/css/button_style.css">
              <link rel="stylesheet" href="views/assets/css/radio_style.css">
              <link rel="stylesheet" href="views/assets/css/modal_style.css">
              <link href="https://fonts.googleapis.com/css?family=Roboto:400,900" rel="stylesheet">
  </head>
  <body>
    <div class="container">

        <h1><?php echo $this->res[0][0][0];?></h1>

              <div class="answers">
                    <?php
                            // print first form tag depending if it is last question or not
                              if ( $this->res["last_question"] == TRUE ) {
                                        echo '<form id="answer-form" onsubmit="return validate();" class="answer-form" action="/final" method="post">';
                              }else{
                                          echo '<form id="answer-form" onsubmit="return validate();" class="answer-form" action="/test" method="post">';
                              }
                    ?>

                    <?php
                            //prints all the answers
                            for ( $i=0; $i < sizeof($this->res[1]); $i++ ) {
                                            echo '<div class="answer-container">
                                                       <input id="radio'.$i.'" type="radio" name="answer" value="'.$this->res[1][$i][0].'">
                                                       <label class = "label" for="radio'.$i.'">'.$this->res[1][$i][0].'</label>
                                                   </div>';
                            }
                     ?>

                    <?php
                            //prints different content in submit button if it is last question or not
                            if ( $this->res["last_question"] == TRUE ) {
                                            echo '<div class="submit-container">
                                              <button id="submit">
                                                Pabeigt testu
                                              </button>
                                            </div>';
                            } else{
                                          echo '<div class="submit-container">
                                            <button id="submit">
                                              Nākamais jautājums
                                            </button>
                                          </div>';
                            }
                    ?>

                </form>

              </div> <!-- end of answers -->

              <!-- progres bar -->
              <div class="progress"><div class="finished"></div></div>

        </div> <!-- end of container -->


        <!-- MODAL -->
        <div id="modal" class="modal">

          <!-- Modal content -->
                <div class="modal-content">
                        <p>Lūdzu izvēlieties atbildi</p>
                        <span class="close">&times;</span>
                </div>
        </div>

    <script type="text/javascript">
              <?php
              //controls progress bar
              echo 'document.querySelector(".finished").style.width = "'.$this->res["progres"].'%"';
               ?>

              //validates if radio button is pressed
               let validate = () => {

                 //gets array of checked radio buttons
                 let radion_buttons = document.querySelectorAll("input[type=radio]:checked")

                  //if nothing is selected
                   if (radion_buttons.length < 1) {

                            //gets modal elemnt
                            let modal = document.getElementById('modal');


                            // get the span to close modal
                            var span = document.getElementsByClassName("close")[0];

                            // click o span X closes modal
                            span.onclick = function() {
                                      modal.style.display = "none";
                            }

                            // when click outside of modal closes modal
                            window.onclick = function(event) {
                                        if (event.target == modal) {
                                              modal.style.display = "none";
                                          }
                            }

                            //displays modal
                             modal.style.display = "block";

                    //prevents submission
                     return false;
                   } else {

                     //allows submission
                     return true;
                   }
               }

    </script>


  </body>
</html>
