<?php
//In the root of your project, create a .htaccess file that will redirect all requests to index.php.
require './router.php';
require './db.php';

$app = new router();

//connects to mysql server
//need to be replaced accordingly to your DB configuration
$mysql = new mysqli("localhost", "root", "", "test_final");

//selects encoding
$mysql->set_charset("utf8");

//initiates db handler
$db =new db($mysql);

//send db object to router object
$app->__set("db", $db);

//resolves request
$app -> resolve($GLOBALS);

//-----------------------------------------------------
// ROOT GET route
//-----------------------------------------------------
$app -> get("/", function ($req, $db, $validate)
{
          //get test names from server
          $data = $db->get_field_from_table("test_name", "tests");

          //returning page to display and data to display
          return ['views/home.php', $data];
});

//--------------------------------------------------------------
// ROOT POST route
//-------------------------------------------------------------
$app -> post("/", function ($req, $db, $validate)
{
            //create var to check if last question
            $last_question = FALSE;

            //inserts username in DB and return username ID
            //validates by striping SQL strings from input
            $user_id = $db->insert_user($req["_POST"]["name"]);

            //gets user name from DB
            $user = $db->get_user_name($user_id)[0][0];

            //saves test nema in var
            $test_name = $req["_POST"]["test-option"];

            //question starts with numnber 1
            $quest_num = 1;

            // get totl number of qustions for progres bar
            $total_num_of_questions = $db->total_num_of_questions($test_name);

            //calculate progres
            $progres = ($quest_num/$total_num_of_questions[0][0])*100;

            //gets next question name, question answeer options and adds boolien
            //to know if it is last question
            $data = array($db->get_next_question_name($test_name, $quest_num),
                    $db->get_next_question_answers($test_name, $quest_num),
                    "progres"=>$progres, "last_question"=>$last_question);

            //Sets cookies
            setcookie("user", $user , 0, "/");
            setcookie("user_id", $user_id , 0, "/");
            setcookie("test_name", $test_name , 0, "/");
            setcookie("quest_num", $quest_num , 0, "/");

            //returning page to display and data to display
            $res = ["views/test.php", $data];
            return $res;

});

//--------------------------------------------------------------------------
//POST /test route
//--------------------------------------------------------------------------
$app -> post("/test", function ($req, $db, $validate)
{
            //create var to check if last question
            $last_question = FALSE;

            //gets username from cookie
            $user = $req["_COOKIE"]["user"];

            //gets user ID from cookie
            $user_id = $req["_COOKIE"]["user_id"];

            //gets question number from cookie
            $quest_num = $req["_COOKIE"]["quest_num"] + 1;

            //gets test name from cookie
            $test_name = $req["_COOKIE"]["test_name"];

            //gets submited answer
            $answer = $req["_POST"]["answer"];

            //gets total number of questions from DB
            $total_num_of_questions = $db->total_num_of_questions($test_name);

            //calculates progres
            $progres = ($quest_num/$total_num_of_questions[0][0])*100;


            //sets cookie vith new question number
          setcookie("quest_num", $quest_num , 0, "/");

          //save answer to DB
          $db->save_answer($user_id, $req["_COOKIE"]["quest_num"], $answer, $test_name);

          // checks if last question
          if ($progres >= 100 ) {
            $last_question = TRUE;
          }

          //gets next question name, question answeer options and adds boolien
          //to know if it is last question
          $data = array($db->get_next_question_name($test_name, $quest_num),
                        $db->get_next_question_answers($test_name, $quest_num),
                        "progres"=>$progres, "last_question"=>$last_question);

            //returning page to display and data to display
            $res = ["views/test.php", $data];
            return $res;

});


// -----------------------------------------------------------------------------
// POST /final route
// -----------------------------------------------------------------------------
$app -> post("/final", function ($req, $db, $validate){

            //gets username from cookie
            $user = $req["_COOKIE"]["user"];

            //gets user ID from cookie
            $user_id = $req["_COOKIE"]["user_id"];

            //gets question number from cookie
            $quest_num = $req["_COOKIE"]["quest_num"];

            //gets test_name from cookie
            $test_name = $req["_COOKIE"]["test_name"];

            //gets answr
            $answer = $req["_POST"]["answer"];

            //save last answer
            $db->save_answer($user_id, $quest_num, $answer, $test_name);

            //saves finished test
            $db->save_finished_test($user_id, $quest_num, $answer, $test_name);

            //sum of correct answers
            $data = ["correct_answers"=>$db -> get_num_of_correct_asvers($user_id),
                      "user"=>$user,
                      "total_number_of_quest"=>$quest_num];

            //returning page to display and data to display
            $res = ["views/final.php", $data];
            return $res;
});
