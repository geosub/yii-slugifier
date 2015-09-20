<?php
/**
 * Yii-Slugifier
 * Translate unsafe string to save for URL and FILENAME
 *
 * @author geosub <geosub@gmail.com>
 * @version 1.0
 */

/**
 * Class ESligifier
 *
 * @property string $delimiter
 * @property string $rules
 */
class ESligifier extends CApplicationComponent
{
	public $delimiter = "-";
	public $rules = "Any-Latin; NFD; [\\u0100-\\u7fff] remove; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();";

	public function init()
	{
		return parent::init();
	}

	/**
	 * @param string $stringToSlug
	 * @return string
	 * @throws CException
	 */
	public function getSlug($stringToSlug)
	{
		if (empty($stringToSlug)) {
			throw new CException(500, "Empty string for slugging");
		}

		$slug = Transliterator::create($this->rules)->transliterate($stringToSlug);

		if (empty($slug)) {
			throw new CException(500, "Empty slug in result. Check Slugged string. UTF-8 required encoding.");
		}

		return trim(preg_replace('/[-\s]+/', $this->delimiter, $slug), $this->delimiter);
	}
}
