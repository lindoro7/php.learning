<?php

namespace app\services;

class RenderServices implements RenderInterface
{
  public function render($template, $params = [])
  {
    $content = $this->renderTemplate($template, $params);

    $title = 'Мой магазин';
    if(!empty($params['title']))
    {
      $title = $params['title'];
    }

    return $this->renderTemplate(
      'layouts/main', 
      [
        'content' => $content,
        'title' => $title
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
}
