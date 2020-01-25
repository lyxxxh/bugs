<?php

if(! function_exists('eventMange'))
{
    function eventMange()
    {
        return new \App\Services\EventMangeService();
    }
}