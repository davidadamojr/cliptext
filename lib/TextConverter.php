<?php
function convert_to_image($text){
	$text = trim($text);
	$images_directory = "clips/";
	$words = preg_split('#\s+#', $text, null, PREG_SPLIT_NO_EMPTY);
	$text_lines = array();
	$number_of_words = count($words);
	$characters = str_split($text);
	$number_of_characters = count($characters);
	$characters_per_line = 63;
	$words_per_line = 16;
	$total_word_count = 0;
	$current_word_index = 0;
	while ($total_word_count < $number_of_words){		
		$line_array = array();
		$line_character_count = 0;
		while ($current_word_index < $number_of_words){
			$word_character_count = strlen($words[$current_word_index]);
			if ($word_character_count + $line_character_count + 1 > $characters_per_line){ //plus 1 for a space character
				//if adding the next word is gonna exceed the line limit, don't add it, start a new line
				break;
			} else {
				$line_array[] = $words[$current_word_index];
				$line_character_count = $line_character_count + $word_character_count + 1; //plus 1 for a space character
				$current_word_index = $current_word_index + 1;
				$total_word_count = $total_word_count + 1;
			}
		}
		$text_lines[] = implode(' ', $line_array);
	}

	//determine the width and height of the image
	if ($number_of_characters < $characters_per_line - 7){ //the average length of an english word is 5.1 characters according to Wolfram Alpha
		//efficiency may take a hit here
		$image_width = 0;
		$thin_characters = [',','\'','"','.',':',';','*',' '];
		foreach ($characters as $character){
			if (!in_array($character, $thin_characters)){
				$image_width = $image_width + 19; //approximate width of each letter and single space is 23px, ignore tiny characters
			}
		}
	} else {
		$image_width = 640;
	}

	$number_of_lines = count($text_lines);
	$image_height = 26 * $number_of_lines + 68; //each line is approximately 26px high, add 68px for extra text (share with clipr)

	// Create the image
	$image = imagecreatetruecolor($image_width, $image_height);
	$white = imagecolorallocate($image, 255, 255, 255);
	imagefill($image, 0, 0, $white);

	// Create some colors
	$black = imagecolorallocate($image, 0, 0, 0);

	// Replace path by your own font path
	//$font = './lib/Raleway-Regular.ttf';
	//$font = './lib/Raleway-Light.ttf';
	//$font = "TitilliumWeb-Light.ttf";
	$font = './lib/NotoSans-Regular.ttf';

	// Write text for each line
	$x = 10;
	$y = 30;
	foreach ($text_lines as $line){
		imagettftext($image, 15, 0, $x, $y, $black, $font, $line);
		$y = $y + 26;
	}
	
	/**
	//Write "shared with clipr at the bottom"
	$y = $y + 30;
	$clipr_text = 'Shared with cliptext.co';
	$clipr_font_size = 10;
	imagettftext($image, $clipr_font_size, 0, $x, $y, $black, $font, $clipr_text);
	**/

	// Using imagepng() results in clearer text compared with imagejpeg()
	$filename = $images_directory . md5(uniqid(rand(), true)) . '.png';
	
	//create the actual file
	$file_handle = fopen($filename, 'w');
	fclose($file_handle);
	
	imagepng($image, $filename);
	imagedestroy($image);
	return $filename;
}

?>