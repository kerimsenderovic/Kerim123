<?php

require_once __DIR__ . '/BaseDao.class.php';

class MemberDao extends BaseDao {
    public function __construct() {
        parent::__construct('members');
    }
    
    public function add_member($member){
        return $this->insert('members', $member);
    }
    public function count_members_paginated($search) {
        $query = "SELECT COUNT(*) AS count
                  FROM members
                  WHERE LOWER(firstName) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(lastName) LIKE CONCAT('%', :search, '%') OR
                        LOWER(email) LIKE CONCAT('%', :search, '%');";
        return $this->query_unique($query, [
            'search' => $search
        ]);
    }
    public function get_members_paginated($offset, $limit, $search, $order_column, $order_direction) {
        $query = "SELECT *
                  FROM members
                  WHERE LOWER(firstName) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(lastName) LIKE CONCAT('%', :search, '%') OR
                        LOWER(email) LIKE CONCAT('%', :search, '%')
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
        return $this->query($query, [
            'search' => $search
        ]);
    }
    public function delete_member_by_id($id) {
        $query = "DELETE FROM members WHERE id = :id";
        $this->execute($query, [
            'id' => $id
        ]);
    }
    public function get_member_by_id($member_id){
        return $this->query_unique(
            "SELECT *  FROM members WHERE id = :id", 
            [
                'id' => $member_id
            ]
        );
    }
    public function edit_member($id, $member) {
        $query = "UPDATE members SET firstName = :firstName, lastName = :lastName, email = :email, password=:password
                  WHERE id = :id";
        $this->execute($query, [
            'firstName' => $member['firstName'],
            'lastName' => $member['lastName'],
            'email' => $member['email'],
            'password' => $member['password'],
            'id' => $id
        ]);
    }
    public function get_all_members(){
        $query= "SELECT * 
                FROM members;";
        return $this->query($query,[]);
    }
    
}

