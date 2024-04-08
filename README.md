# persian-captcha
This is a captcha generator for persian (farsi) projects which includes 4 different types of captcha.
# How it works
To use requested captcha you should create an object of related class at the top of your file.
Then you should add these three methods to generate your captcha:
+ create()
+ show() - this method has to be written in src attribute of an <img> tag
+ generateId( a number between 1 to 4 to specify which kind of captcha you're using )
## An example :
```php
<?php $complicatedMathCap->create(); ?>
<img id="complex_captcha" src="data:image/jpeg;base64,<?php $complicatedMathCap->show(); ?>" alt="captcha">
<?php $complicatedMathCap->generateId(2); ?>
```