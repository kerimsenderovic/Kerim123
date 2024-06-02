<?php

require_once __DIR__ . '/../services/MemberService.class.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set('member_service', new MemberService());

Flight::group('/members', function () {

    
    /**
     * @OA\Get(
     *      path="/members/info",
     *      tags={"members"},
     *      summary="Get members details",
     *      security={
     *          {"ApiKey": {}}  
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Member details"
     *      )
     * )
     */
    
    Flight::route('GET /info', function() {
        Flight::json(Flight::get('member_service')->get_member_by_id(Flight::get('user')->id));
    });

    /**
     * @OA\Get(
     *      path="/members/all",
     *      tags={"members"},
     *      summary="Get all members",
     *      @OA\Response(
     *           response=200,
     *           description="Array of all members in the database"
     *      )
     * )
     */
    Flight::route('GET /all',function(){
        $data = Flight::get('member_service')->get_all_members();
        Flight::json($data, 200);
    });
    
    /**
     * @OA\Get(
     *      path="/members/member",
     *      tags={"members"},
     *      summary="Get member by id",
     *      @OA\Response(
     *           response=200,
     *           description="Member data, or false if member does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="member_id", example="1", description="Member ID")
     * )
     */
    Flight::route('GET /member',function(){
        $params = Flight::request()->query;
        $member = Flight::get('member_service')->get_member_by_id($params['member_id']);
        Flight::json($member);
    });

    /**
     * @OA\Get(
     *      path="/members/get/{member_id}",
     *      tags={"members"},
     *      summary="Get member by id",
     *      @OA\Response(
     *           response=200,
     *           description="Member data, or false if member does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="member_id", example="1", description="Member ID")
     * )
     */
    Flight::route('GET /get/@member_id',function($member_id){
        $member = Flight::get('member_service')->get_member_by_id($member_id);
        Flight::json($member);
    });

    Flight::route('GET /', function () {
        $payload = Flight::request()->query;

        $params = [
            'start' => (int)$payload['start'],
            'search' => $payload['search']['value'],
            'draw' => $payload['draw'],
            'limit' => (int)$payload['length'],
            'order_column' => $payload['order'][0]['name'],
            'order_direction' => $payload['order'][0]['dir'],
        ];

        $data = Flight::get('member_service')->get_members_paginated($params['start'], $params['limit'], $params['search'], $params['order_column'], $params['order_direction']);

        foreach ($data['data'] as $id => $member) {
            $data['data'][$id]['action'] = '<div class="btn-group" role="group" aria-label="Actions">' .
                '<button type="button" class="btn btn-warning" onclick="MemberService.open_edit_member_modal(' . $member['id'] . ')">Edit</button>' .
                '<button type="button" class="btn btn-danger" onclick="MemberService.delete_member(' . $member['id'] . ')">Delete</button>' .
                '</div>';
        }

        Flight::json([
            'draw' => $params['draw'],
            'data' => $data['data'],
            'recordsFiltered' => $data['count'],
            'recordsTotal' => $data['count'],
            'end' => $data['count']
        ]);
    });

    /**
     * @OA\Post(
     *      path="/members/add",
     *      tags={"members"},
     *      summary="Add member data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Member data, exception if member is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Member data payload",
     *          @OA\JsonContent(
     *              required={"firstName","lastName","email","password"},
     *              @OA\Property(property="id", type="string", example="1", description="Member ID "),
     *              @OA\Property(property="firstName", type="string", example="Some first name", description="Member first name "),
     *              @OA\Property(property="lastName", type="string", example="Some last name", description="Member last name"),
     *              @OA\Property(property="email", type="string", example="example@example.com", description="Member email"),
     *              @OA\Property(property="password", type="string", example="something", description="Member password")
     *          )
     *      )
     * )
     */
    Flight::route('POST /add', function () {
        $payload = Flight::request()->data->getData();
    
        if ($payload['firstName'] == NULL) {
            Flight::halt(500, "First name field is missing");
        }
    
        if (isset($payload['id']) && $payload['id'] != '') {
            // Pass both $id and $member to the edit_member method
            $member = Flight::get('member_service')->edit_member($payload);
        } else {
            unset($payload['id']);
            $member = Flight::get('member_service')->add_member($payload);
        }
    
        Flight::json(['message' => "You have successfully added the member", 'data' => $member]);
    });

    /**
     * @OA\Delete(
     *      path="/members/delete/{member_id}",
     *      tags={"members"},
     *      summary="Delete member by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted member data or 500 status code otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="member_id", example="1", description="Member ID")
     * )
     */
    Flight::route('DELETE /delete/@member_id', function ($member_id) {
        if ($member_id == NULL || $member_id == '') {
            Flight::halt(500, 'You have to provide a valid ID');
        }

        Flight::get('member_service')->delete_member_by_id($member_id);
        Flight::json(['message' => 'You have successfully deleted the member!']);
    });
    
    /**
     * @OA\Get(
     *      path="/members/{member_id}",
     *      tags={"members"},
     *      summary="Get member by id",
     *      @OA\Response(
     *           response=200,
     *           description="Member data, or false if member does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="member_id", example="1", description="Member ID")
     * )
     */
    Flight::route('GET /@member_id', function ($member_id) {
        $member = Flight::get('member_service')->get_member_by_id($member_id);

        Flight::json($member);
    });



});