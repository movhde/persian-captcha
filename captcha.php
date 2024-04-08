<?php
$complexCaptcha = require_once "./ComplicatedMathCaptcha.php";
$simpleCaptcha = require_once "./MathCaptcha.php";
$charCaptcha = require_once "./CharactersCaptcha.php";
$translateCaptcha = require_once "./TranslateCaptcha.php";

$id = $_GET['id'];

if ($id == '1') {
  $simpleCaptcha->create();
  $simpleCaptcha->show();
} else if ($id == '2') {
  $complexCaptcha->create();
  $complexCaptcha->show();
} else if ($id == '3') {
  $charCaptcha->create();
  $charCaptcha->show();
} else if ($id == '4') {
  $translateCaptcha->create();
  $translateCaptcha->show();
} else {
  throw new Error("Failed to load captcha image.");
}
