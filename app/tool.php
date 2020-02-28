<?php

class tool {
    public static function number_format($n) {
		return number_format($n, 2, ".", " ");
    }
    
    public static function generateRandomString($length = 10) {
		// work 100%
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		// in beta testing
		$characters = '!#$%&()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_abcdefghijklmnopqrstuvwxyz{|}~';

		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}

		return $randomString;
    }
    
    public static function clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		$string =  str_replace('--', '-', $string);
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    
    public static function convertNumberToHours ($number = 0) {
		if ($number !== 0) {
			$minutes = $number - floor($number);

			$minutes = $minutes * 0.6;

			return str_replace(".", ":", number_format((floor( $number ) + $minutes),2));
		} else {
			return str_replace(".", ":", number_format((0.0),2));
		}
    }
    
    public static function dump($args = null) {
		print "<!--\n";
		var_dump($args);
		print "\n-->";
    }
    
    public static function breadcrumb ($breadcrumb = []) {
		$toReturn = "";

		if (is_array($breadcrumb) && count($breadcrumb) > 0) {
			foreach ($breadcrumb as $key => $item) {
				if (empty($toRetun)) {
					$item_tpl = bo3::loade("breadcrumb-item.tpl");
				}

				$toReturn .= "&nbsp;/&nbsp;";

				$toReturn .= bo3::c2r([
					"link" => $item["link"],
					"name" => $item["name"]
				], $item_tpl);
			}
		}

		return $toReturn;
	}
}