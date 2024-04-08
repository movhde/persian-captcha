<?php
include "utilities.php";

// echo (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]/" . basename(__DIR__) . "/complexMathCaptchaPage.php";

function utf8_strrev($str)
{
  preg_match_all('/./us', $str, $ar);
  return join('', array_reverse($ar[0]));
}


if ($_SESSION['captcha_ID'] === 1) {
  $simpleSumInput = convertPersianNumbersToEnglish($_POST['sum']);
  $simpleSum = convertPersianCharToEnglishNumber($_SESSION['number1']) + convertPersianCharToEnglishNumber($_SESSION['number2']);

  if ($simpleSumInput === $simpleSum) {
    $_SESSION['incorrect_info'] = false;
    header("Location: simpleMathCaptchaPage.php");
  } else {
    $_SESSION['incorrect_info'] = true;
    header("Location: simpleMathCaptchaPage.php");
  }
} else if ($_SESSION['captcha_ID'] === 2) {
  $complexSumInput = convertPersianNumbersToEnglish($_POST['complexSum']);
  $complexSum = (convertPersianCharToEnglishNumber($_SESSION['complexNumber1']) * convertPersianCharToEnglishNumber($_SESSION['complexNumber2'])) + convertPersianCharToEnglishNumber($_SESSION['complexNumber3']);

  if ($complexSumInput === $complexSum) {
    $_SESSION['incorrect_info'] = false;
    header(
      "Location: complexMathCaptchaPage.php"
    );
  } else {
    $_SESSION['incorrect_info'] = true;
    header(
      "Location: complexMathCaptchaPage.php"
    );
  }
} else if ($_SESSION['captcha_ID'] === 3) {
  $charSession = $_SESSION['characters'];
  $characters = utf8_strrev($_POST['letters']);
  $characters = str_replace(" ", "", $characters);
  $charSession = str_replace(" ", "", $charSession);

  if (strcmp($charSession, $characters) === 0) {
    $_SESSION['incorrect_info'] = false;
    header("Location: charCaptchaPage.php");
  } else {
    $_SESSION['incorrect_info'] = true;
    header("Location: charCaptchaPage.php");
  }
} else if ($_SESSION['captcha_ID'] === 4) {
  $translateSession = convertPersianCharToEnglishNumber($_SESSION['translate_num']);
  $translateInput = convertPersianNumbersToEnglish($_POST['translate']);

  if ($translateSession === $translateInput) {
    $_SESSION['incorrect_info'] = false;
    header("Location: translateCaptchaPage.php");
  } else {
    $_SESSION['incorrect_info'] = true;
    header("Location: translateCaptchaPage.php");
  }
}
