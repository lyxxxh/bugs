<?php

declare(strict_types=1);

namespace App\Job;

use App\Model\BilibiliVideoPage;
use App\Services\BiliBiliFlvService;
use App\Services\EventMangeService;
use Hyperf\AsyncQueue\Job;

class BilibiliVideoDownloadJob extends Job
{
    protected $page;
    public function __construct($page)
    {
        $this->page = $page;
        //video exist
        if( BilibiliVideoPage::videoExist($this->page->aid,$this->page->cid)){
            return true;
        }
        eventMange()->triggerBilibiliDownloadVideoJoinJob($this->page);
    }


    //下载哔哩哔哩视频
    public function handle()
    {


        $flv_service = new BiliBiliFlvService();
        $flv_url = $flv_service->getFlvUrl($this->page->aid,$this->page->cid);

        //保存的文件夹
        $savePath = SAVE_PATH.$this->page->aid.'/';
        $saveFilePath = $savePath.$this->page->part.'.flv';

        if( file_exists($saveFilePath)) //文件存在
        return true;

        if(! is_dir($savePath))
        mkdir($savePath,0700,true);

        $param = parse_url($flv_url);
        $host = $param['host'];
        $cli = new \Swoole\Coroutine\Http\Client($host, 80, $param['scheme'] == 'https');
        $cli->set(['timeout' => -1]);
        $cli->setHeaders([
            'Host' => $host,
            "User-Agent" => 'Chrome/49.0.2587.3',
            'Accept' => '*',
            'Accept-Encoding' => 'gzip',
            'Referer' => 'http://www.bilibili.com/video/'.$this->page->aid,
            'Origin' => 'https://www.bilibili.com'
        ]);
        $cli->download($param['path'].'?'.$param['query'],   $saveFilePath);

        eventMange()->triggerBililDownloadVideoJobSuccess($this->page);
        return true;
    }

}
