<?php

namespace Src;

class Http
{
  public $path = null;
  public $query = null;

  public function __get($properyName)
  {
    $this->$properyName = null;
  }

  public function __construct()
  {
    $requestURI = urldecode($_SERVER["REQUEST_URI"]);
    $pos = strpos($requestURI, "?");
    $this->query = $pos ? substr($requestURI, $pos + 1) : '';
    $this->path =  $requestURI;

    if ($pos) {
      $this->url = substr($requestURI, 0, $pos);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      foreach ($_GET as $propery => $val) {
        $this->$propery = $val;
      }
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      foreach ($_POST as $propery => $val) {
        $this->$propery = $val;
      }
    }
  }

  public function getMethotType()
  {
    return $this->methodName;
  }

  public function isMethod($methodType)
  {
    if ($methodType == 'get') {
      return true;
    } else if ($methodType == 'post') {
      return true;
    } else {
      return null;
    }
  }

  public function get($item)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $val = isset($_GET[$item]) ? $_GET[$item] : 0;
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $val = isset($_POST[$item]) ? $_POST[$item] : 0;
    }

    if ($val) {
      return $val;
    } else {
      return null;
    }
  }
}
