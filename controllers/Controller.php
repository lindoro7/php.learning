<?php

namespace app\controllers;

use app\services\RenderInterface;

abstract class Controller 
{
  protected $defaultAction = 'all';
  /**
   * @var RenderSevices
   */
  protected $renderer;

  /**
   * Controller constructor
   */

  public function __construct(RenderInterface $renderer)
  {
    $this->renderer = $renderer;
  }
  
  public function run($action)
  {
    if(empty($action))
    {
      $action = $this->defaultAction;
    }

    $action .= "Action";

    if(!method_exists($this, $action))
    {
      return '404';
    }
    return $this->$action();
  }

  protected function getId()
  {
    if(empty($_GET['id']))
    {
      return 0;
    }
    return (int)$_GET['id'];
  }
}