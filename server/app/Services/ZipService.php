<?php

namespace App\Services;

class ZipService
{
    public function addFileToZip($path, $zip)
    {
        $handler = opendir($path); //打开当前文件夹由$path指定。
        while (($filename = readdir($handler)) !== false) {
            if ($filename != "." && $filename != "..") {
                if (is_dir($path . "/" . $filename)) {
                    $this->addFileToZip($path . "/" . $filename, $zip);
                } else {
                    $zip->addFile($path . "/" . $filename);
                }
            }
        }
        closedir($path);
    }


    



}

