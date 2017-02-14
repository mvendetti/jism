<?php
    // This file is designed to be run in the console or in something like
    // coderunner. Place the raw markdown for the status/settings keys into
    // the $raw variable below. It will spit out JSON of our data. This json
    // can then be used to seed our DB. You will get the raw markdown for these
    // from: https://raw.githubusercontent.com/KonradIT/goprowifihack/master/HERO4/CameraStatus.md
    // Note:
    // You will want to use this at the sub-section of the markdown level. For
    // example, go with the H3/H4 sections (with no deeper H section).
    // Note that you will need to replace "    * " with "    | " to make the
    // Key and it's values discernable.
	$raw = "";

	function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '_', $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '_');

		// remove duplicate -
		$text = preg_replace('~_+~', '_', $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}

	function splitOnLastChar($string, $char, $trimChars = '')
	{
		$arr = preg_split('~'.$char.'(?=[^'.$char.']*$)~', $string);
		foreach($arr as &$elem)
		{
			$elem = trim($elem);
			$elem = rtrim($elem, $trimChars);
		}
		return $arr;
	}

	$cats = explode('*', trim($raw));

	foreach($cats as $cat)
	{
		$parts = explode('|', $cat);
		if(is_array($parts) && count($parts) > 1)
		{
			$nid = splitOnLastChar($parts[0], '-', ':');
			$opts = "";
			foreach($parts as $index => $part)
			{
				if($index === 0) continue;
				$subpart = splitOnLastChar($part, '-');
				if(strlen($opts) > 0) $opts .= ',';
				$opts .= ' "' . $subpart[1] . '":"' . $subpart[0] . '"';

			}
			$data[] = [
				'model_number' => 13,
				'keytype' => 'settings',
				'slug' => slugify($nid[0]),
				'value' => $nid[0],
				'gopro_id' => $nid[1],
				'datatype' => 'opts',
				'opts' => '{' . $opts . ' }',
			];
		}
	}

	echo json_encode($data);
