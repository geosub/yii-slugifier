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
	public $rules = 'Any-Latin; NFD; [\u0000-\u001f\u0021-\u002d\u003a-\u0040\u005e\u0060\u007a-\u7fff] Remove; [:Nonspacing Mark:] Remove; [:Punctuation:] Remove; NFC; Lower();';

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
			throw new CException("Empty string for slugging");
		}
		$t12r = Transliterator::create($this->rules);
		if (is_null($t12r)) {
			throw new CException("Incorrect rules for transliterating.\nRules: [ {$this->rules} ]");
		}

		$slug = $t12r->transliterate($stringToSlug);

		if (empty($slug)) {
			throw new CException("Empty slug in result. Check Slugged string. UTF-8 required encoding.");
		}

		return trim(preg_replace('/[-\s]+/', $this->delimiter, $slug), $this->delimiter);
	}
}
