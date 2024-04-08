<?php

require_once "CaptchaImage.php";
require_once "resources/lib/farsiGD.php";

class TranslateCaptcha implements CaptchaImage
{
  private $image;
  private $numbers = array(
    'یک', 'دو', 'سه', 'چهار', 'پنج', 'شش', 'هفت', 'هشت', 'نه', 'ده',
    'یازده', 'دوازده', 'سیزده', 'چهارده', 'پانزده', 'شانزده', 'هفده', 'هجده', 'نوزده', 'بیست',
    'بیست و یک', 'بیست و دو', 'بیست و سه', 'بیست و چهار', 'بیست و پنج', 'بیست و شش', 'بیست و هفت', 'بیست و هشت', 'بیست و نه', 'سی',
    'سی و یک', 'سی و دو', 'سی و سه', 'سی و چهار', 'سی و پنچ', 'سی و شش', 'سی و هفت', 'سی و هشت', 'سی و نه', 'چهل',
    'چهل و یک', 'چهل و دو', 'چهل و سه', 'چهل و چهار', 'چهل و پنج', 'چهل و شش', 'چهل و هفت', 'چهل و هشت', 'چهل و نه', 'پنجاه'
  );

  public function create()
  {
    $gd = new FarsiGD();
    $randNum = array_rand($this->numbers);
    $finalNum = $this->numbers[$randNum];
    $_SESSION['translate_num'] = $finalNum;
    $x = rand(1, 120);
    $y = rand(1, 35);
    $x2 = rand(1, 120);
    $y2 = rand(1, 35);
    $txtAngle = rand(-5, 5);
    $txtFont = "./resources/fonts/IRANYekanX-Regular.ttf";
    $txt = $gd->persianText($finalNum, 'fa', 'normal');

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

return new TranslateCaptcha();
