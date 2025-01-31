<?php

if (isset($id) && !empty($id)) {

	$field = c9_user::returnOneField($id);

	if (isset($_POST["submit"])) {
		if (c9_user::updateField(
			$_POST["name"],
			$_POST["value"],
			$_POST["placeholder"],
			$_POST["sort"],
			(isset($_POST["required"])) ? TRUE : FALSE,
			(isset($_POST["status"])) ? TRUE : FALSE,
			$id)
		) {
			$message = $mdl_lang["fields"]["success"];
			$status = TRUE;
		} else {
			$message = $mdl_lang["fields"]["failure"];
			$status = FALSE;
		}

		$mdl = bo3::c2r([
			"content" => $message,
			"back-list" => $mdl_lang["result"]["back-list"],
			"new-user" => $mdl_lang["result"]["new-user"],
			"edit-mode" => $mdl_lang["result"]["edit-mode"],
			"add-active" => $a != "add" ? "d-none" : "",
			"edit-active" => $a != "edit" ? "d-none" : "",
			"status" => ($status == TRUE) ? "success" : "danger"
		], bo3::mdl_load("templates/result.tpl"));

	} else {
		$mdl = bo3::c2r([
			"name" => $mdl_lang["fields"]["name"],
			"value" => $mdl_lang["fields"]["value"],
			"placeholder" => $mdl_lang["fields"]["placeholder"],
			"type" => $mdl_lang["fields"]["type"],
			"required" => $mdl_lang["fields"]["required"],
			"sort" => $mdl_lang["fields"]["sort"],
			"status" => $mdl_lang["fields"]["status"],
			"but-submit" => $mdl_lang["fields"]["but-submit"],

			//values
			"id" => $field->id,
			"name-val" => $field->name,
			"value-val" => $field->value,
			"placeholder-val" => $field->placeholder,
			"type-val" => $field->type,
			"required-val" => ($field->required) ? "checked" : "",
			"sort-val" => $field->sort,
			"status-val" => ($field->status) ? "checked" : ""

		], bo3::mdl_load("templates/fields-edit.tpl"));
	}
} else {
	header("Location: {$cfg->system->path_bo}/{$lg_s}/9-users/fields/");
}

include CONTROLLERS . "module-core.php";
