<?php

include "utilities.php";

interface CaptchaImage
{
  public function create();
  public function show();
  public function generateId(int $id);
}
