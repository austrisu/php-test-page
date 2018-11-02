<?php

class router
{
  public $req = [];
  public $res;
  public $url;
  public $method;
  public $db;
  public $validate;

  //prevents mis-redirection
  private $url_found = false;

  //resolves url and seperates url route and parameters
  public function resolve($url)
  {

    //if _SERVER key exists save url path and method
    if ( (array_key_exists( "_SERVER" ,$url ) ) ) {

        //if page is in route page save "/" to url
        if (!(array_key_exists( "REDIRECT_URL" ,$url["_SERVER"] ))) {
            $this->url = "/";
        } else{
            $this->url = $url["_SERVER"]["REDIRECT_URL"];
        }
        $this->req = $url;
        $this->method = $url["_SERVER"]["REQUEST_METHOD"];
    }
  }

  //GET route
  public function get($route, $callback)
  {
          //check type request, route and if route have been found beffore
          if ($this->method == "GET" && $this->url == $route && $this->url_found == false) {

                    //if route is found change to true;
                    $this->url_found = true;

                    //gets arry from callback function
                    $tmp = $callback($this->req, $this->db, $this->validate);

                    //saves callback response
                    $this->res = $tmp[1];

                    //displays page
                    require $tmp[0];
          }
  }

  //POST route
  public function post($route, $callback)
  {
          //check type request, route and if route have been found beffore
          if ($this->method == "POST" && $this->url == $route && $this->url_found == false) {

            //if route is found change to true;
            $this->url_found = true;

            //gets arry from callback function
            $tmp = $callback($this->req, $this->db, $this->validate);

            //saves callback response
            $this->res = $tmp[1];

            //displays page
            require $tmp[0];
          }
  }

  public function __set($value_name, $value)
  {
      $this->$value_name = $value;
  }


}
