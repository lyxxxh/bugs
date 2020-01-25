<?php

namespace App\Controller\Api;

use App\Controller\AbstractController;

class ApiController extends AbstractController
{

    protected function ok($data)
    {
        return $this->response->json([
            'data' => $data,
            'code' => 200,
        ]);
    }


}