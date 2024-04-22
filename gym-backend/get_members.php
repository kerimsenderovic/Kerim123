<?php
require_once __DIR__ . '/rest/services/MemberService.class.php';

$payload = $_REQUEST;

$params = [
    'start' => (int)$payload['start'],
    'search' => $payload['search']['value'],
    'draw' => $payload['draw'],
    'limit' => (int)$payload['length'],
    'order_column' => $payload['order'][0]['name'],
    'order_direction' => $payload['order'][0]['dir'],
];
$member_service = new MemberService();

$data = $member_service->get_members_paginated($params['start'], $params['limit'], $params['search'], $params['order_column'], $params['order_direction']);
foreach($data['data'] as $id => $member) {
    $data['data'][$id]['action'] = '<div class="btn-group" role="group" aria-label="Actions">' .
                                        '<button type="button" class="btn btn-warning" onclick="MemberService.open_edit_member_modal('. $member['id'] .')">Edit</button>' .
                                        '<button type="button" class="btn btn-danger" onclick="MemberService.delete_member('. $member['id'] .')">Delete</button>' .
                                    '</div>';
}
echo json_encode([
    'draw' => $params['draw'],
    'data' => $data['data'],
    'recordsFiltered' => $data['count'],
    'recordsTotal' => $data['count'],
    'end' => $data['count']
]);