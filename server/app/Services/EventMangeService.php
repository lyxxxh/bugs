<?php

namespace App\Services;


use App\Event\BilibiliDownloadVideoJoinJob;
use App\Event\BililDownloadVideoJobSuccess;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Context;
use Psr\EventDispatcher\EventDispatcherInterface;

class EventMangeService
{


    private $eventDispatcher;
    public function __construct()
    {
        $this->eventDispatcher = make(EventDispatcherInterface::class);
    }

    //触发哔哩哔哩下载完成事件
    public function triggerBililDownloadVideoJobSuccess($page)
    {
        $this->eventDispatcher->dispatch(new BililDownloadVideoJobSuccess($page));
    }

    //触发哔哩哔哩加入队列事件
    public function triggerBilibiliDownloadVideoJoinJob($page)
    {
        $this->eventDispatcher->dispatch(new BilibiliDownloadVideoJoinJob($page));
    }




}