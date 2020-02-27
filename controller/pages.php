<?php

// controlador de páginas
if (isset($_GET["pg"]) && !empty($_GET["pg"])) {
	$pg = strtolower($_GET["pg"]);
} else {
	$pg = $cfg->system->start;
}
