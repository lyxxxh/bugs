<?php

namespace App\Services;

use Hyperf\Di\Annotation\Inject;

class BiliBiliFlvService
{


    protected $url = 'https://api.bilibili.com/x/player/playurl?avid=%s&cid=%s&qn=%s&otype=json';

    private $httpRequest;

    public function __construct()
    {
        $this->httpRequest = new httpRequestService();
    }

    protected $accpet_quality = [];
    public function getFlvUrl($aid,$cid)
    {
        $data = $this->getFlvData($aid,$cid);

        $qn = $this->getMaxAcceptQuality($data);
        $data = $this->getFlvData($aid,$cid,$qn);
        return $data->durl[0]->url;
    }



    //最高画质
    public function getMaxAcceptQuality($data)
    {

        $accept_quality =  $data->accept_quality;
        return $accept_quality[0];
    }


    public function getFlvData($aid,$cid,$qn=74)
    {
        $url = sprintf($this->url,
            $aid,
            $cid,
            $qn
        );

        $response = $this->httpRequest->httpGet($url);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);

        return $data->data;
    }


}