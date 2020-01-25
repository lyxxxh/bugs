<?php

namespace App\Listener\Bilibili\Success;


use App\Event\BilibiliDownloadVideoJoinJob;
use App\Event\BililDownloadVideoJobSuccess;
use App\Model\BilibiliVideoPage;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Event\Annotation\Listener;

/**
 * @Listener
 *哔哩哔哩视频下载完成事件的监听
 */
class UpdateJobLogStatusListener implements ListenerInterface
{

    public function listen(): array
    {
        return [
            BililDownloadVideoJobSuccess::class
        ];
    }

    public function process(object $event)
    {
        BilibiliVideoPage::Where('aid',$event->page->aid)
        ->where('cid',$event->page->cid)->update([
           'status' => STATUS_SUCCESS_QUEUE
        ]);



    }


}