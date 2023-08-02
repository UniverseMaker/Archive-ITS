<?php
//System
$sitetitle = "Archive";

//Security
$cryptocontrol = "false";

//Theme
$theme = "inspinia";
$theme_login = "inspinia_login";

//Project
$project_default_security_level = "5";
$project_default_status = "project_status_open";

//Issue
$issue_default_security_level = "";
$issue_default_status = "issue_status_assign";
$issue_default_priority = "issue_priority_medium";
$issue_default_type = "issue_type_task";

//Space
$space_default_status = "space_status_open";
$space_default_security_level = "5";

//Document
$document_default_security_level = "";
$document_default_status = "document_status_assign";
$document_default_priority = "document_priority_medium";

//Database
$db_pre = "archive_";

$db_account = $db_pre . "account";
$db_document = $db_pre . "document";
$db_encryption_key = $db_pre . "encryption_key";
$db_global_config = $db_pre . "global_config";
$db_issue = $db_pre . "issue";

$db_issue_activity = $db_pre . "issue_activity";
$db_log = $db_pre . "log";
$db_project = $db_pre . "project";
$db_space = $db_pre . "space";
$db_status = $db_pre . "status";

$db_template = $db_pre . "template";
$db_openview = $db_pre . "openview";
$db_accesscontrol = $db_pre . "accesscontrol";
$db_translation = $db_pre . "translation";
$db_sms = $db_pre . "sms";
$db_customer = $db_pre . "customer";

?>