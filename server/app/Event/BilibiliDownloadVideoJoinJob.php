<?php

namespace App\Event;


/*
 *哔哩哔哩视频下载加入队列事件
 */
class BilibiliDownloadVideoJoinJob
{

    public $page;
    public function __construct($page)
    {

        $this->page = $page;
    }



}