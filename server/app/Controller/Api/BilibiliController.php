<?php
declare(strict_types=1);
namespace App\Controller\Api;

use App\Exception\BusinessException;
use App\Exception\ErrorMessageException;
use App\Request\DownloadVideoRequest;
use App\Request\getBilibiliRequest;
use App\Services\httpRequestService;

use App\Services\QueueManageService;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Di\Annotation\Inject;
/**
 * @AutoController()
 */
class BilibiliController extends ApiController
{

    /**
     * @Inject
     * @var httpRequestService
     */
    private $httpRequest;


    /**
     * @Inject
     * @var QueueManageService
     */
    private $queueManageService;


    const BILIBILI_VIDEO_API = 'https://api.bilibili.com/x/web-interface/view?aid=';

    public function getVideoInfo(GetBilibiliRequest $request)
    {
        $aid = $this->getAid( $request->input('href'));

        if (! $aid)
        throw new ErrorMessageException('未匹配到av号　请手动输入av号试试吧');

        $content = $this->httpRequest->httpGet(self::BILIBILI_VIDEO_API.$aid)->getBody()->getContents();
        $content = json_decode($content);

        if( $content->code != 0)
        throw new ErrorMessageException('获取视频信息失败');

        $content->data->aid = $aid;
        return $this->ok(
            $content->data
        );
    }

    protected function getAid($href)
    {
        if( is_numeric($href))
        return $href;

        $res = preg_match('/av(\d*)/',  $href, $matches);
        if( $res)
        return $matches[1];

        return false;
    }


    /*
     *@下载bilibili视频
     */
    public function downloadVideo(DownloadVideoRequest $request)
    {
        $pages = is_array($request->input('pages')) ? $request->input('pages')
            : json_decode($request->input('pages'));

        foreach ($pages as $page){
            $page->aid = $request->input('aid');
            $this->queueManageService->pushBilibiliVideoDownload($page);
        }


        return $this->ok('已加入队列下载');
    }





}

