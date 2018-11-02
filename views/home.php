<!DOCTYPE html>
<html lang="lv" dir="ltr">
  <head>
            <meta charset="utf-16">

            <title>Test home page</title>

            <link rel="stylesheet" href="views/assets/css/style.css">
            <link rel="stylesheet" href="views/assets/css/input_style.css">
            <link rel="stylesheet" href="views/assets/css/button_style.css">
            <link rel="stylesheet" href="views/assets/css/select_style.css">
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,900" rel="stylesheet">

  </head>

  <body>

    <div class="container">

              <h1>Izvēlieties testu</h1>

              <form id="test-form" class="test-form" onsubmit="return validate();" action="/" method="post">

                          <div class="error-msg hidden"><p>Here goes error msg</p></div>

                          <input class="effect-1" id="test-form-name" type="text" name="name" placeholder="Lūdzu ievadiet savu vārdu">
                          <div class="focus-border-container-1">
                                    <span class="focus-border-1"></span>
                          </div>

                          <!-- Start of select box -->
                          <select class="effect-2" id="select" name="test-option" form="test-form">
                                    <?php
                                          for ($i=0; $i < sizeof($this->res); $i++) {
                                                  echo '<option value="'.$this->res[$i][0].'">'.$this->res[$i][0].'</option>';
                                          }
                                     ?>
                          </select>
                          <div class="focus-border-container-2">
                                      <span class="focus-border-2"></span>
                          </div>
                          <!-- End of select box-->

                          <div class="submit-container">
                                      <button id="submit"> Sākt testu </button>
                          </div>

              </form>

    </div> <!-- end of container -->

    <script type="text/javascript">

      //regex expresion to look for special chars in input
      let regex = `/[~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi`

      //validates if name field is empty or contains special characters
      let validate = () => {
              let nameField = document.querySelector("#test-form-name")

                if (nameField.value == "") {

                          let errorMsg = document.querySelector(".error-msg");

                          //adds error messages
                          errorMsg.innerHTML = "<p>Vārda lauks nedrīkst būt tukšs!</p>"
                          errorMsg.style.opacity = 1;


                          //denies form submission
                          return false;

                } else if (nameField.value.match(/[~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi)) {

                          let errorMsg = document.querySelector(".error-msg");

                          //adds erro messages
                          errorMsg.innerHTML = "<p>Lieottāja vārds nevar saturēt speciālās zīmes!</p>"
                          errorMsg.style.opacity = 1;

                          //denies form submisison
                          return false
                }else {
                          //allows form submission
                          return true;
                }
      }

    </script>

  </body>
</html>
