<?php
require_once __DIR__ . '/rest/services/MemberService.class.php';

error_reporting(E_ERROR);

$payload = $_REQUEST;

if ($payload['firstName'] ==NULL) {
  header('HTTP/1.1 500 Bad Request');
  die(json_encode(['error' => "First name field is missing"]));
}

$member_service = new MemberService();


if($payload['id'] != NULL && $payload['id'] != ''){
    $member = $member_service->edit_member($payload);
} else {
    unset($payload['id']);
    $member = $member_service->add_member($payload);
}
echo json_encode(['message' => "You have successfully added the patient", 'data' => $member]);