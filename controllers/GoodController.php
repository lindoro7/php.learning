<?php

namespace app\controllers;
use app\models\Good;
use app\services\DB;

class GoodController extends Controller
{
  public function addAction()
  {
    return $this->renderer->render('goodAdd');
  }

  public function oneAction()
  {
    $id = $this->getId();
    $good =(new Good(DB::getInstance()))->getOne($id);
    return $this->renderer->render('goodOne', ['good' => $good]);
  }

  public function allAction()
  {
    $goods =(new Good(DB::getInstance()))->getAll();
    return $this->renderer->render('goodAll', ['goods' => $goods]);
  }
}