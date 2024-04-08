<?php
session_start();

function generateRandomAlphabetNum()
{
  $stringNumberArray = ['یک', 'دو', 'سه', 'چهار', 'پنج', 'شش', 'هفت', 'هشت', 'نه', 'ده'];
  $randNum = array_rand($stringNumberArray);
  return $stringNumberArray[$randNum];
}

function convertPersianNumbersToEnglish($input)
{
  $persian = array('۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۱۰');
  $english = range(1, 10);
  return (int)str_replace($persian, $english, $input);
}

function convertEnglishToPersian($input)
{
  $persian = array('۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۱۰');
  $english = range(1, 10);
  return str_replace($english, $persian, $input);
}

function convertPersianCharToEnglishNumber($input)
{
  $persian = array(
    'یک', 'دو', 'سه', 'چهار', 'پنج', 'شش', 'هفت', 'هشت', 'نه', 'ده',
    'یازده', 'دوازده', 'سیزده', 'چهارده', 'پانزده', 'شانزده', 'هفده', 'هجده', 'نوزده', 'بیست',
    'بیست و یک', 'بیست و دو', 'بیست و سه', 'بیست و چهار', 'بیست و پنج', 'بیست و شش', 'بیست و هفت', 'بیست و هشت', 'بیست و نه', 'سی',
    'سی و یک', 'سی و دو', 'سی و سه', 'سی و چهار', 'سی و پنچ', 'سی و شش', 'سی و هفت', 'سی و هشت', 'سی و نه', 'چهل',
    'چهل و یک', 'چهل و دو', 'چهل و سه', 'چهل و چهار', 'چهل و پنج', 'چهل و شش', 'چهل و هفت', 'چهل و هشت', 'چهل و نه', 'پنجاه'
  );
  $english = range(1, 50);
  $persianKey = null;
  foreach ($persian as $key => $value) {
    if ($input === $value) {
      $persianKey = $key;
    }
  }

  return $english[$persianKey] ?? $input;
}
