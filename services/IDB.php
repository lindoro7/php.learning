<?php
namespace app\services;

interface IDB
{
  const TEST_ERROR = 'Error';
  const TEST_ERRORS = ['1', '2'];

  public function find($sql);
  public function findAll($sql);
}