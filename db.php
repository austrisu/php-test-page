<?php

class db
{

  //mysql object goes here
  public $mysql;


  //saves mysql object
  function __construct($val)
  {
    $this->mysql = $val;
  }

    //gets any field from any table
    public function get_field_from_table($field, $table)
    {
      $query_string = "SELECT ". $field ." FROM ". $table .";";
      // echo $query_string;
      return $this->mysql->query($query_string)->fetch_all();
    }

    //creates nev user in DB
    public function insert_user($user)
    {
      //user input data validation
      $validated_user = $this->mysql->real_escape_string($user);
      $query_string = 'INSERT INTO users (user_name) VALUES("'. $validated_user .'")';

      $this->mysql->query($query_string);

      //returns ID of newly created user
      return $this->mysql->insert_id;
    }

    //gets username
    public function get_user_name($user_id)
    {
      return $this->mysql->query('SELECT user_name FROM users WHERE user_id = "'.$user_id.'";')->fetch_all();
    }

    //gets next question
    public function get_next_question_name($test_option, $quest_num)
    {
      $query_string = 'SELECT quest_name FROM questions WHERE test_id=(SELECT test_id FROM tests WHERE test_name="' . $test_option . '") AND quest_num= ' . $quest_num . ' ;';
      return $this->mysql->query($query_string)->fetch_all();
    }

    //gets answers for next question
    public function get_next_question_answers($test_name, $quest_num)
    {
     $query_string = 'SELECT answer_name FROM answers WHERE quest_id=( SELECT quest_id FROM questions WHERE test_id=(SELECT test_id FROM tests WHERE test_name="' . $test_name . '") AND quest_num= ' . $quest_num . ' );';
     return $this->mysql->query($query_string)->fetch_all();
    }

    //gets total number of questions for progres bar and final page
    public function total_num_of_questions($test_name)
    {
      $query_string = 'SELECT COUNT(quest_num) FROM questions WHERE test_id=(SELECT test_id FROM tests WHERE test_name = "' . $test_name . '");';
      return $this->mysql->query($query_string)->fetch_all();
    }

    //saves user answer in to DB
    public function save_answer($user_id, $quest_num, $answer, $test_name)
    {
      $query_string = <<<SQL
      INSERT INTO user_answers (`user_id`, `test_id`, `quest_id`, `answer_id`)
      VALUES($user_id,
             (SELECT test_id FROM tests WHERE test_name = "$test_name"),
              (SELECT quest_id FROM questions WHERE test_id=(SELECT test_id FROM tests WHERE test_name = "$test_name") AND quest_num= $quest_num),
             (SELECT answer_id FROM answers WHERE quest_id=(SELECT quest_id FROM questions WHERE test_id=(SELECT test_id FROM tests WHERE test_name = "$test_name") AND quest_num= $quest_num) AND answer_name= "$answer")
            );
SQL;

    $this->mysql->query($query_string);
    }

    //saves finished test date to DB
    public function save_finished_test($user_id, $quest_num, $answer, $test_name)
    {

          $query_string = <<<SQL
          INSERT INTO finished_tests (user_id, test_id, total_quest_num, correct_quest_num)
          VALUE (
            $user_id,
            (SELECT test_id FROM tests WHERE test_name = "$test_name"),
            $quest_num,
            (
              SELECT SUM(a.correct_answer)
      				FROM answers AS a
      				JOIN user_answers AS u
      				ON a.answer_id=u.answer_id
      				WHERE user_id=$user_id
            ));
SQL;

          $this->mysql->query($query_string);
          return $query_string;

    }

    //gets number of correct aswers form final_answer table
    public function get_num_of_correct_asvers($user_id)
    {
            $query_string = <<<SQL
            SELECT correct_quest_num FROM finished_tests WHERE user_id=$user_id;
SQL;
            return $this->mysql->query($query_string)->fetch_all();
    }
}


 ?>
