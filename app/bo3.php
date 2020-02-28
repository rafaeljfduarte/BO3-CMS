<?php

// version: 4

class bo3 {

	public static function regist($paths = []) {

		if(!empty($paths)) {

			foreach ($paths as $path) {
				spl_autoload_register(function ($class) use ($path) {
					if (file_exists($path. DS . $class . '.php')) {
						require_once $path. DS . $class . '.php';
					} 
				});
			} 
		}
	}

	// Where the magic happens
	public static function c2r ($args = [], $target) {

		$search = [];
		$replace = [];

		foreach ($args as $index => $value) {
			array_push($search, "{c2r-$index}");
			array_push($replace, $value);
		}

		return str_replace(
			$search,
			$replace,
			$target
		);
	}

	public static function load ($path = FALSE) {
		if ($path) {
			if (!file_exists(VIEWS."{$path}")) {
				$target_file = fopen(VIEWS."{$path}", "w") or die("Unable to open file!");
				fclose($target_file);
			}
			return file_get_contents(VIEWS."{$path}");
		} else {
			$stack = debug_backtrace();
			$sorigin_file = basename($stack[0]['file'], '.php');

			if (!file_exists(VIEWS."{$sorigin_file}.tpl")) {
				$target_file = fopen(VIEWS."{$sorigin_file}.tpl", "w") or die("Unable to open file!");
				fclose($target_file);
			}

			return file_get_contents(VIEWS."{$sorigin_file}.tpl");
		}

		return FALSE;
	}

	public static function loade ($path = FALSE) {
		if ($path) {
			if (!file_exists(VIEWS."component" . DS . "{$path}")) {
				$target_file = fopen(VIEWS."component" . DS . "{$path}", "w") or die("Unable to open file!");
				fclose($target_file);
			}
			return file_get_contents(VIEWS."component" . DS . "{$path}");
		}

		return false;
	}

	public static function minifyPage($buffer) {
		/* origin http://jesin.tk/how-to-use-php-to-minify-html-output/ */
		$search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');

		$replace = array('>', '<', '\\1');

		if (preg_match("/\<html/i", $buffer) == 1 && preg_match("/\<\/html\>/i", $buffer) == 1) {
			$buffer = preg_replace($search, $replace, $buffer);
		}

		$buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);

		return $buffer;
	}

	public static function minifyHTML($buffer) {
		$search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');

		$replace = array('>', '<', '\\1');

		$buffer = preg_replace($search, $replace, $buffer);

		$buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);

		return $buffer;
	}

	public static function dbTableExists ($list = []) {
		global $cfg, $db;

		$toReturn = [];

		foreach ($list as $key => $table) {
			$query = sprintf(
				"SELECT * FROM %s_%s LIMIT %s",
				$cfg->db->prefix, $table, 1
			);

			if ($db->query($query) !== FALSE) {
				array_push($toReturn, TRUE);
			} else {
				array_push($toReturn, FALSE);
			}
		}

		foreach ($toReturn as $key => $value) {
			if ($value == FALSE) {
				return FALSE;
			}
		}

		return TRUE;
	}

	public static function mdlInstalled ($folder) {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_modules WHERE folder = '%s' LIMIT %s",
			$cfg->db->prefix, $folder, 1
		);

		$source = $db->query($query);

		if ($source->num_rows > 0) {
			return TRUE;
		}

		return FALSE;
	}

	public static function importPlg ($plg, $args = []) {
		global $cfg, $mdl, $lang;

		include sprintf(MODULES . "plg-%s" . DS . "plg-%s.php", $plg, $plg);
	}

	public static function mdl_load ($path) {
		global $cfg;

		if ($path != null) {
			return file_get_contents(MODULES . "{$cfg->mdl->folder}" . DS . "{$path}");
		}

		return false;
	}

	public static function plg_load ($path) {
		global $cfg;

		if ($path != null) {
			return file_get_contents(MODULES . "{$cfg->plg->folder}" . DS . "{$path}");
		}

		return false;
	}

	public static function updateFile ($file = false, $name = "", $text = "", $result = false) {
		if ($file !== false) {
			$time = date('H:i:s', time());

			$current = file_get_contents($file);
			$current .= "{$time} >> {$name} >> {$text}";
			if ($result !== false) {
				$current .= " >> {$result}";
			}
			$current .= "\n";

			file_put_contents($file, $current);
		}
	}

	public static function get_resources ($lib, $version, $sub_version) {
		$options = ["ssl" => [ "verify_peer" => FALSE, "verify_peer_name" => FALSE ]];

		return file_get_contents("https://bozon3.com/resources/{$version}-{$sub_version}/{$lib}.html", FALSE, stream_context_create($options));
	}
}
