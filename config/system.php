<?php

$cfg->system = new stdClass();

$cfg->system->minify = TRUE;
$cfg->system->pub = FALSE;
$cfg->system->restricted = TRUE;
$cfg->system->timezone = "Europe/Lisbon"; // to disable set with FALSE

$cfg->system->sitename = "Powered by BOzon3";
$cfg->system->owner = "";

$cfg->system->protocol = "https"; // you can use http instead
$cfg->system->domain = "your domain here";
$cfg->system->path = "/BO3-CMS";
$cfg->system->path_bo = "{$cfg->system->path}";

$cfg->system->version = "3.6.0";
$cfg->system->sub_version = "RC";

$cfg->system->key = "GJTBpKregE9WgXc";

$cfg->system->cookie = "cookie";
$cfg->system->cookie_time = 86400; // 86400 represents 1 day, 60 seconds * 60 minutes * 24 hours.

$cfg->system->analytics = "";
