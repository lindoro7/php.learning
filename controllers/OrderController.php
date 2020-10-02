<?php

namespace app\controllers;
use app\models\Order;
use app\services\DB;

class OrderController extends Controller
{
  public function addAction()
  {
    return $this->renderer->render('orderAdd');
  }

  public function oneAction()
  {
    $id = $this->getId();
    $order =(new Order(DB::getInstance()))->getOne($id);
    return $this->renderer->render('orderOne', ['order' => $order]);
  }

  public function allAction()
  {
    $orders =(new Order(DB::getInstance()))->getAll();
    return $this->renderer->render('orderAll', ['orders' => $orders]);
  }
}