# Yii Slugifier component
Translate unsafe string to save for URL and FILENAME

## Requirements
* Yii 1.1.x or above
* PHP 5.4 or above
* php5-intl extention

## Install
* config/main.php
```php
	'components' => [
		'slug' => [
            'class' => 'path.to.ESligifier',
		],
	],
```
or
* config/main.php
```php
	'components' => [
		'slug' => [
            'class' => 'path.to.ESligifier',
			'rules'     => "Any-Latin; NFD; [\\u0100-\\u7fff] remove; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();",
			'delimiter' => "-",
		],
	],
```


## Usage
```php
echo Yii::app()->slug->getSlug("Прове р каСл агифа^^ера");
```
