<?php

if (isset($id) && !empty($id)) {
	// Return all category info
	$field = new c9_user();
	$toReturn = "";

	if (isset($_POST["submit"])) {
		if (c9_user::deleteField($id)) {
			$toReturn = $mdl_lang["fields"]["success-del"];
			$status = TRUE;
		} else {
			$toReturn =  $mdl_lang["fields"]["failure-del"];
			$status = FALSE;
		}

		$mdl = bo3::c2r([
			"content" => $toReturn,
			"back-list" => $mdl_lang["result"]["back-list"],
			"new-user" => $mdl_lang["result"]["new-user"],
			"edit-mode" => $mdl_lang["result"]["edit-mode"],
			"add-active" => $a != "add" ? "d-none" : "",
			"edit-active" => $a != "edit" ? "d-none" : "",
			"status" => ($status == TRUE) ? "success" : "danger"
		], bo3::mdl_load("templates/result.tpl"));
	} else {
		$field = $field->returnOneField($id);

		$toReturn = bo3::c2r([
			"id" => $id,

			"phrase" => $mdl_lang["fields"]["phrase"],
			"title" => $field->name,

			"del" => $mdl_lang["fields"]["button-del"],
			"cancel" => $mdl_lang["fields"]["button-cancel"]
		], bo3::mdl_load("templates-e/fields/form.tpl"));

		$mdl = bo3::c2r(["content" => $toReturn], bo3::mdl_load("templates/del.tpl"));
	}

} else {
	// if doesn't exist an action response, system sent you to 404
	header("Location: {$cfg->system->path_bo}/0/{$lg_s}/404/");
}

include "pages/module-core.php";
