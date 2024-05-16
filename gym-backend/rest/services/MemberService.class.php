<?php

require_once __DIR__ . '/../dao/MemberDao.class.php';

class MemberService {
    private $member_dao;
    public function __construct() {
        $this->member_dao = new MemberDao();
    }
    public function add_member($member){
        $member['password']= password_hash($member['password'],PASSWORD_BCRYPT);
        return $this->member_dao->add_member($member);
    }
    public function get_members_paginated($offset, $limit, $search, $order_column, $order_direction){
        $count = $this->member_dao->count_members_paginated($search)['count'];
        $rows = $this->member_dao->get_members_paginated($offset, $limit, $search, $order_column, $order_direction);

        return [
            'count' => $count,
            'data' => $rows
        ];
    }
    public function delete_member_by_id($member_id){
        $this->member_dao->delete_member_by_id($member_id);
    }
    public function get_member_by_id($member_id) {
        return $this->member_dao->get_member_by_id($member_id);
    }
    public function edit_member($member) {
        $id = $member['id'];
        unset($member['id']);

        $this->member_dao->edit_member($id, $member);
    }
    public function get_all_members(){
        return $this->member_dao->get_all_members();
    }
}