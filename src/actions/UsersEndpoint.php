<?php


namespace tomasz\legacy\actions;


use Zend\Diactoros\Response\JsonResponse;

class UsersEndpoint
{
    public function getUser($id)
    {
        $user = [
            'id' => $id,
        ];
        return new JsonResponse($user, 200);
    }
}