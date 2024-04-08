<?php

require_once "CaptchaImage.php";

class CharactersCaptcha implements CaptchaImage
{
  private $image;

  public function create()
  {

    $charArray = ['ا', 'ب', 'پ', 'ت', 'ث', 'ج', 'چ', 'ح', 'خ', 'د', 'ذ', 'ر', 'ز', 'ژ', 'س', 'ش', 'ص', 'ض', 'ط', 'ظ', 'ع', 'غ', 'ف', 'ق', 'ک', 'گ', 'ل', 'م', 'ن', 'و', 'ه', 'ی'];
    $characters = [];
    for ($i = 0; $i < 5; $i++) {
      $randChar = rand(0, 31);
      array_push($characters, $charArray[$randChar]);
    }

    $x = rand(1, 120);
    $y = rand(1, 35);
    $x2 = rand(1, 120);
    $y2 = rand(1, 35);
    $txtAngle = rand(-5, 5);
    $txtFont = "./resources/fonts/IRANYekanX-Regular.ttf";
    $txt = implode(" ", $characters);
    $_SESSION['characters'] = $txt;

    $this->image = imagecreatetruecolor(120, 35);
    $black = imagecolorallocate($this->image, 0, 0, 0);
    $gray = imagecolorallocate($this->image, 211, 211, 211);
    $randomColor = imagecolorallocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));
    $randomColor2 = imagecolorallocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));

    imagefilledrectangle($this->image, 0, 0, 120, 35, $gray);
    imagettftext($this->image, 12, $txtAngle, 12, 22, $black, $txtFont, $txt);
    imageline($this->image, $x, $y, $x2, $y2, $randomColor);
    imageline($this->image, $y, $y2, $x, $x2, $randomColor2);
    imageline($this->image, $x2, $x2, $y2, $x2, $randomColor2);
  }

  public function show()
  {
    ob_start();

    imagejpeg($this->image, NULL, 100);

    $rawImageBytes = ob_get_clean();

    echo base64_encode($rawImageBytes);
  }

  public function generateId(int $id)
  {
    $_SESSION['captcha_ID'] = $id;
  }
}

return new CharactersCaptcha();
