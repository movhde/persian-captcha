<?php
$mathCaptcha = include "./MathCaptcha.php";
$complicatedMathCap = include "./ComplicatedMathCaptcha.php";
$charactersCaptcha = include "./CharactersCaptcha.php";
$translateCaptcha = include "./TranslateCaptcha.php";

if (isset($_SESSION['previous'])) {
  if (basename($_SERVER['PHP_SELF']) != $_SESSION['previous']) {
    session_destroy();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./resources/styles/output.css" rel="stylesheet" />
  <title>Captcha</title>
</head>

<body dir="rtl" class="bg-[#f0fbea] font-yekan">
  <div class="container mx-auto px-4 mt-12 flex flex-col gap-4 justify-center items-center p-4">
    <div class="flex flex-col gap-4 w-full bg-[#4F6F52] max-w-md md:max-w-lg p-7 rounded-2xl">
      <h3 class="text-white text-center text-xl">کپچای مدنظر خود را انتخاب کنید:</h3>
      <div class="flex flex-col md:flex-row justify-between gap-4">
        <a href="simpleMathCaptchaPage.php">
          <div class="flex flex-col justify-center items-center gap-2 p-4 md:w-52 border border-[#f0fbea] hover:bg-[#f0fbea64] rounded-2xl transition duration-300">
            <span class="text-white text-sm">کپچای ریاضی - ساده</span>
            <?php
            $mathCaptcha->create();
            ?>
            <img src="data:image/jpeg;base64,<?php $mathCaptcha->show(); ?>" alt="captcha">
          </div>
        </a>
        <a href="complexMathCaptchaPage.php">
          <div class="flex flex-col justify-center items-center gap-2 p-4 md:w-52 border border-[#f0fbea] hover:bg-[#f0fbea64] rounded-2xl transition duration-300">
            <span class="text-white text-sm">کپچای ریاضی - دشوار</span>
            <?php
            $complicatedMathCap->create();
            ?>
            <img src="data:image/jpeg;base64,<?php $complicatedMathCap->show(); ?>" alt="captcha">
          </div>
        </a>
      </div>
      <div class="flex flex-col md:flex-row justify-between gap-4">
        <a href="charCaptchaPage.php">
          <div class="flex flex-col justify-center items-center gap-2 p-4 md:w-52 border border-[#f0fbea] hover:bg-[#f0fbea64] rounded-2xl transition duration-300">
            <span class="text-white text-sm">کپچای حروف - ساده</span>
            <?php
            $charactersCaptcha->create();
            ?>
            <img src="data:image/jpeg;base64,<?php $charactersCaptcha->show(); ?>" alt="captcha">
          </div>
        </a>
        <a href="translateCaptchaPage.php">
          <div class="flex flex-col justify-center items-center gap-2 p-4 md:w-52 border border-[#f0fbea] hover:bg-[#f0fbea64] rounded-2xl transition duration-300">
            <span class="text-white text-sm">کپچای تشخیص عدد - ساده</span>
            <?php
            $translateCaptcha->create();
            ?>
            <img src="data:image/jpeg;base64,<?php $translateCaptcha->show(); ?>" alt="captcha">
          </div>
        </a>
      </div>
    </div>
  </div>
</body>

</html>