<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property string $aid 
 * @property string $cid 
 * @property string $part 
 * @property int $status 
 * @property int $duration 
 * @property string $save_url 
 */
class BilibiliVideoPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bilibili_video_pages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['aid', 'cid', 'part', 'duration'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['status' => 'integer', 'duration' => 'integer'];
    public static function videoExist($aid, $cid)
    {
        return self::where('aid', $aid)->where('cid', $cid)->first() == null ? false : true;
    }
}