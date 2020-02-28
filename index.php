<?php

require_once "app/bo3.php";
require_once "core/paths.php";

bo3::regist(["app", "src/model"]);

require_once CONFIG."cfg.php";
require_once CORE."database.php";

foreach (glob(CORE."/*.php") as $filename) {
	require_once $filename;
}

$head = bo3::loade("head.tpl");

if ($auth) {
	switch ($pg) {
		case "logout":
			include sprintf(MODULES . "sys-%s" . DS . "sys-%s.php", "logout", "logout");
			break;
		case "404":
			include sprintf(MODULES . "sys-%s" . DS . "sys-%s.php", "404", "404");
			break;
		default:
			if ($pg == "home") { $pg = "5-home"; }

			$mdl_path = sprintf(MODULES . "mod-%s", $pg);

			if (!is_dir($mdl_path)) {
				// if doesn't exist an action response, system sent you to 404
				header("Location: {$cfg->system->path_bo}/{$lg_s}/404/");
			} else {
				// mod load
				include "{$mdl_path}/mod-init.php";
			}
			break;
	}
} else { include sprintf(MODULES . "sys-%s" . DS . "sys-%s.php", "login","login"); }

// print website
$tpl = bo3::c2r([
	"head" => $head,

	"og-title" => (isset($og["title"])) ? $og["title"] : $cfg->system->sitename,
	"og-url" => (isset($og["url"])) ? $og["url"] : "{$cfg->system->protocol}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
	"og-image" => (isset($og["image"])) ? $og["image"] : "{$cfg->system->protocol}://{$_SERVER['HTTP_HOST']}{$cfg->system->path}/src/assets/default-share-image.jpg",
	"og-description" => (isset($og["description"])) ? $og["description"] : $lang["system"]["description"],

	"sitename" => $cfg->system->sitename,
	"keywords" => $lang["system"]["keywords"],
	"description" => $lang["system"]["description"],

	"path" => $cfg->system->path,
	"bo-path" => $cfg->system->path_bo,
	"css" => "{$cfg->system->path_bo}/src/assets/css",
	"js" => "{$cfg->system->path_bo}/src/assets/js",
	"images" => "{$cfg->system->path_bo}/src/assets/images",
	"libs" => "{$cfg->system->path_bo}/src/assets/libs",
	"uploads" => "{$cfg->system->path}/uploads",

	"lg" => $lg_s,
	"cookie" => $cfg->system->cookie,

	"ads-active" => ($cfg->system->pub) ? "d-block" : "d-none"
], isset($tpl) ? $tpl : ".::TPL::.::ERROR::.");

// minify system
if ($cfg->system->minify) {
	echo bo3::minifyPage($tpl);
} else {
	echo $tpl;
}
