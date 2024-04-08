<?php

require_once "./CaptchaImage.php";
require_once "./resources/lib/farsiGD.php";

class ComplicatedMathCaptcha implements CaptchaImage
{
  private $image;

  public function create()
  {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $num3 = rand(1, 10);
    $randomNumberArr1 = [generateRandomAlphabetNum(), $num1];
    $randomNumberArr2 = [generateRandomAlphabetNum(), $num2];
    $randomNumberArr3 = [generateRandomAlphabetNum(), $num3];
    $number1 = array_rand($randomNumberArr1);
    $number2 = array_rand($randomNumberArr2);
    $number3 = array_rand($randomNumberArr3);

    $_SESSION['complexNumber1'] = $randomNumberArr1[$number1];
    $_SESSION['complexNumber2'] = $randomNumberArr2[$number2];
    $_SESSION['complexNumber3'] = $randomNumberArr2[$number3];
    $gd = new FarsiGD();
    $num1 = $gd->persianText($_SESSION['complexNumber1'], 'fa', 'normal');
    $num2 = $gd->persianText($_SESSION['complexNumber2'], 'fa', 'normal');
    $num3 = $gd->persianText($_SESSION['complexNumber3'], 'fa', 'normal');
    $x = rand(1, 120);
    $y = rand(1, 35);
    $x2 = rand(1, 120);
    $y2 = rand(1, 35);
    $txtAngle = rand(-5, 5);
    $txtFont = "./resources/fonts/IRANYekanX-Regular.ttf";
    $txt = $num1 . " * " . $num2 . " + " . $num3 . " = ";

    $this->image = imagecreatetruecolor(150, 35);
    $black = imagecolorallocate($this->image, 0, 0, 0);
    $gray = imagecolorallocate($this->image, 211, 211, 211);
    $randomColor = imagecolorallocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));
    $randomColor2 = imagecolorallocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));

    imagefilledrectangle($this->image, 0, 0, 150, 35, $gray);
    imagettftext($this->image, 12, $txtAngle, 10, 22, $black, $txtFont, $txt);
    imageline($this->image, $x, $y, $x2, $y2, $randomColor);
    imageline($this->image, $y, $y2, $x, $x2, $randomColor2);
    imageline($this->image, $x2, $x2, $y2, $x2, $randomColor2);
    return $txt;
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

return new ComplicatedMathCaptcha();
