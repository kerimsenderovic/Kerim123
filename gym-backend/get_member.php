<?php
require_once __DIR__ . '/rest/services/MemberService.class.php';

$member_id = $_REQUEST['id'];

$member_service = new MemberService();
$member = $member_service->get_member_by_id($member_id);

header('Content-Type: application/json');
echo json_encode($member);