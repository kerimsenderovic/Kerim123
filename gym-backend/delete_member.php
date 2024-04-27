<?php

require_once __DIR__ . '/rest/services/MemberService.class.php';
$member_id=$_REQUEST['id'];
if($member_id == NULL || $member_id == '') {
    header('HTTP/1.1 500 Bad Request');
    die(json_encode(['error' => "You have to provide valid member id!"]));
}
$member_service=new MemberService();
$member_service->delete_member_by_id($member_id);
echo json_encode(['message' => 'You have successfully deleted the member!']);