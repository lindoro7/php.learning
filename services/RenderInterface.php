<?php
namespace app\services;

interface RenderInterface
{
  public function render($template, $params=[]);
}