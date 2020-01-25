<?php
namespace App\Exception\Handler;

use App\Exception\ErrorMessageException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use App\Exception\FooException;
use Throwable;

class ErrorMessageExceptionHandler extends  ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof ErrorMessageException) {
             $data = json_encode([
                'code' => 201,//$throwable->getCode(),
                'message' => $throwable->getMessage(),
            ], JSON_UNESCAPED_UNICODE);

            // 阻止异常冒泡
            $this->stopPropagation();
            return $response->withStatus(500)->withBody(new SwooleStream($data));
        }

        return $response;
    }


    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}