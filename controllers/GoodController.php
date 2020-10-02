<?php

namespace app\controllers;
use app\models\Good;
use app\services\DB;

class GoodController
{
  protected $defaultAction = 'all';
  
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

  public function addAction()
  {
    return $this->render('goodAdd');
  }

  public function oneAction()
  {
    $id = $this->getId();
    $good =(new Good(DB::getInstance()))->getOne($id);
    return $this->render('goodOne', ['good' => $good]);
  }

  public function allAction()
  {
    $goods =(new Good(DB::getInstance()))->getAll();
    return $this->render('goodAll', ['goods' => $goods]);
  }

  public function render($template, $params = [])
  {
    $content = $this->renderTemplate($template, $params);
    return $this->renderTemplate(
      'layouts/main', 
      [
        'content' => $content
      ]
    );
  }

  public function renderTemplate($template, $params = [])
  {
    ob_start();
    extract($params);
    include dirname(__DIR__) . '/views/' . $template . '.php';
    return ob_get_clean();
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