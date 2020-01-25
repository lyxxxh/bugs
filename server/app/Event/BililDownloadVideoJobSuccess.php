<?php

namespace App\Event;


/*
 *哔哩哔哩视频下载完成事件
 */
class BililDownloadVideoJobSuccess
{

    public $page;
    public function __construct($page)
    {
        $this->page = $page;
    }


}