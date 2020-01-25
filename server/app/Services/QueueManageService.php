<?php

namespace App\Services;

use App\Job\BilibiliVideoDownloadJob;
use Hyperf\AsyncQueue\Driver\DriverFactory;

class QueueManageService
{


    /**
     * @var DriverInterface
     */
    protected $driver;

    public function __construct(DriverFactory $driverFactory)
    {
        $this->driver = $driverFactory->get('default');
    }


    /**
     * 哔哩哔哩视频下载队列
     * @param $page
     * @return boolean
     */
    public function pushBilibiliVideoDownload($page, int $delay = 0): bool
    {
        return $this->driver->push(new BilibiliVideoDownloadJob($page), $delay);
    }





}