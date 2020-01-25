<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace HyperfTest\Cases;

use App\Job\BilibiliVideoDownloadJob;
use App\Services\BiliBiliFlvService;
use HyperfTest\HttpTestCase;


class BiliBiliTest extends HttpTestCase
{
    //获取哔哩哔哩视频信息
    public function testGetVideoInfo()
    {
        $res = $this->post('/api/bilibili/getVideoInfo',[
            'href' => 'https://www.bilibili.com/video/av59703564?from=search&seid=3924138135120398736'
        ]);

        $this->assertSame($res['code'],200);
        return $res['data'];
    }



    /**
     * @depends testGetVideoInfo
     */
    public function testDownloadVideo(array $data)
    {
        $res = $this->post('/api/bilibili/downloadVideo',[
            'aid' => $data['aid'],
            'pages' => json_encode( $data['pages'])
        ]);
        $this->assertTrue(true);
    }

    /**
     * @depends testGetVideoInfo
     */
    public function testGetFlvUrl(array $data)
    {
        $flv_service = new BiliBiliFlvService();

        foreach ($data['pages'] as $page){
            $flv_url = $flv_service->getFlvUrl($data['aid'],$page['cid']);
            $this->assertNotEmpty($flv_url);
        }
    }


    /**
     * 测试队列的下载
     * @depends testGetVideoInfo
     */
    public function testJobDownload(array $data)
    {
        $page = $data['pages'][0];

        $page['aid'] = $data['aid'];
        $job_service = new BilibiliVideoDownloadJob((object)$page);
        $res = $job_service->handle();
        $this->assertTrue($res);
    }


}
