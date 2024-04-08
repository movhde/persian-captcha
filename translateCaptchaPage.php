<?php
$translateCaptcha = include "./TranslateCaptcha.php";

$_SESSION['previous'] = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./resources/styles/output.css" rel="stylesheet" />
  <title>Captcha</title>
</head>

<body dir="rtl" class="bg-[#f0fbea] font-yekan">
  <div id="modal" class="items-center fixed left-0 top-0 z-1 px-8 w-full h-full bg-opacity-60 bg-black <?php if (isset($_SESSION['incorrect_info']) && $_SESSION['incorrect_info'] == 0) : ?> flex <?php else : ?> hidden <?php endif; ?>">
    <div class="flex flex-col gap-4 container mx-auto max-w-2xl h-auto p-5 shadow-xl bg-[#8fd396] rounded-2xl">
      <div class="w-full flex justify-between items-center">
        <h3 class="text-center text-base sm:text-xl text-black z-30">عبارت را به درستی وارد کردید.</h3>
        <div class="hover:cursor-pointer" onclick="closeModal()">
          <svg class="w-4 h-4 sm:w-6 sm:h-6" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 30 30">
            <path d="M 7 4 C 6.744125 4 6.4879687 4.0974687 6.2929688 4.2929688 L 4.2929688 6.2929688 C 3.9019687 6.6839688 3.9019687 7.3170313 4.2929688 7.7070312 L 11.585938 15 L 4.2929688 22.292969 C 3.9019687 22.683969 3.9019687 23.317031 4.2929688 23.707031 L 6.2929688 25.707031 C 6.6839688 26.098031 7.3170313 26.098031 7.7070312 25.707031 L 15 18.414062 L 22.292969 25.707031 C 22.682969 26.098031 23.317031 26.098031 23.707031 25.707031 L 25.707031 23.707031 C 26.098031 23.316031 26.098031 22.682969 25.707031 22.292969 L 18.414062 15 L 25.707031 7.7070312 C 26.098031 7.3170312 26.098031 6.6829688 25.707031 6.2929688 L 23.707031 4.2929688 C 23.316031 3.9019687 22.682969 3.9019687 22.292969 4.2929688 L 15 11.585938 L 7.7070312 4.2929688 C 7.5115312 4.0974687 7.255875 4 7 4 z"></path>
          </svg>
        </div>
      </div>
      <a class="w-fit" href="index.php">
        <button class="p-2 sm:p-3 text-xs sm:text-sm bg-[#4F6F52] text-[#e3fee6] focus:shadow-lg focus:shadow-[#f0fbea]-500/40 border-2 border-transparent focus:outline-none hover:bg-[#638666] hover:opacity-65 hover:cursor-pointer hover:text-black transition duration-300 rounded-xl">
          بازگشت به صفحه اول
        </button>
      </a>
    </div>
  </div>
  <div class="container mx-auto px-4 h-auto min-h-screen flex justify-center items-center">
    <div class="shadow-xl bg-[#4F6F52] w-full max-w-lg h-auto p-7  rounded-2xl">
      <form action="postedData.php" method="POST">
        <div class="flex flex-col gap-2">
          <label class="text-sm text-white">عبارت درون کادر زیر را به عدد بنویسید.</label>
          <div class="flex gap-2">
            <input name="translate" type="text" placeholder="برای مثال :‌ ۳۰" class="w-full text-sm focus:shadow-lg focus:shadow-[#f0fbea]-500/40 border-2 focus:outline-none p-1 sm:p-1.5 rounded-xl 
            <?php if (isset($_SESSION['incorrect_info']) && $_SESSION['incorrect_info'] == 1) : ?> bg-red-200 border-red-200 <?php else : ?> bg-white border-transparent <?php endif; ?>
            <?php if (isset($_SESSION['incorrect_info']) && $_SESSION['incorrect_info'] == 0) : ?> bg-green-200 border-green-200 <?php endif; ?>">

            <?php
            $translateCaptcha->create();
            ?>
            <img class="m-auto w-17 h-7 sm:w-auto sm:h-auto" id="translate_captcha" src="data:image/jpeg;base64,<?php $translateCaptcha->show(); ?>" alt="captcha">
            <?php
            $translateCaptcha->generateId(4);
            ?>

            <div class="flex justify-center items-center hover:cursor-pointer" onclick="refreshCaptcha()">
              <svg class="fill-white w-6 h-6 active:animate-[spin_0.5s_ease-in-out]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
                <path d="M 15 3 C 12.031398 3 9.3028202 4.0834384 7.2070312 5.875 A 1.0001 1.0001 0 1 0 8.5058594 7.3945312 C 10.25407 5.9000929 12.516602 5 15 5 C 20.19656 5 24.450989 8.9379267 24.951172 14 L 22 14 L 26 20 L 30 14 L 26.949219 14 C 26.437925 7.8516588 21.277839 3 15 3 z M 4 10 L 0 16 L 3.0507812 16 C 3.562075 22.148341 8.7221607 27 15 27 C 17.968602 27 20.69718 25.916562 22.792969 24.125 A 1.0001 1.0001 0 1 0 21.494141 22.605469 C 19.74593 24.099907 17.483398 25 15 25 C 9.80344 25 5.5490109 21.062074 5.0488281 16 L 8 16 L 4 10 z"></path>
              </svg>
            </div>
          </div>
          <?php if (isset($_SESSION['incorrect_info']) && $_SESSION['incorrect_info'] == 1) : ?> <span class="text-sm text-red-400 -mt-2">عدد را اشتباه نوشته اید.</span> <?php endif; ?>
          <div class="flex flex-col gap-3">
            <input type="submit" value="ثبت" class="w-full text-sm bg-white focus:shadow-lg focus:shadow-[#f0fbea]-500/40 border-2 border-transparent focus:outline-none hover:bg-[#f0fbea] hover:opacity-65 hover:cursor-pointer transition duration-300 p-1 sm:p-1.5 rounded-xl">
          </div>
      </form>
    </div>
  </div>
</body>

<script>
  modal = document.getElementById('modal');
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.className = 'hidden';
    }
  }

  function closeModal() {
    modal.className = 'hidden';
  }

  function refreshCaptcha() {
    fetch("./captcha.php?id=4")
      .then(response => {
        if (response.ok) {
          return response.text()
        }
        throw new Error('Network response was not ok.');
      })
      .then(data => {
        const captchaImage = document.querySelector('#translate_captcha');
        captchaImage.src = 'data:image/jpeg;base64,' + data;
      })
      .catch(error => {
        console.error('Error refreshing captcha:', error);
      });

  }
</script>

</html>