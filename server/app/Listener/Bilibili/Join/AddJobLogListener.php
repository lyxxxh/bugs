<?php

namespace App\Listener\Bilibili\Join;


use App\Event\BilibiliDownloadVideoJoinJob;
use App\Model\BilibiliVideoPage;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Event\Annotation\Listener;



/**
 *哔哩哔哩视频加入下载事件的监听
 * @Listener
 */
class AddJobLogListener implements ListenerInterface
{

    public function listen(): array
    {
        return [
          BilibiliDownloadVideoJoinJob::class
        ];
    }

    public function process(object $event)
    {


        BilibiliVideoPage::create([
            'part' => $event->page->part,
            'cid' => $event->page->cid,
            'aid' => $event->page->aid,
            'duration' => $event->page->duration
        ]);
    }

}