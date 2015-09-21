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
	 * @param string $stringToSantize
	 * @return string
	 * @throws CException
	 */
	private function sanitize($stringToSantize)
	{

		$slug = Transliterator::create($this->rules)->transliterate($stringToSantize);

		if (empty($slug)) {
			throw new CException("Empty santized result. Check input string for encoding, UTF-8 is required.");
		}

		return trim(preg_replace('/[-\s]+/', $this->delimiter, $slug), $this->delimiter);
	}

	public function getSantized($stringToSantize)
	{
		if (empty($stringToSantize)) {
			throw new CException("Empty string for santize");
		}

		return $this->sanitize($stringToSantize);
	}

}
