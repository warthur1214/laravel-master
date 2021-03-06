<?php
/**
 * Created by PhpStorm.
 * User: warthur
 * Date: 17/2/19
 * Time: 下午3:12
 */

namespace App\Http\common;


use Log;

class ReturnUtil
{

    public static function success($msg = null, $data = null)
    {
        $result = ['msg' => $msg ? $msg : '处理成功！', 'status' => 1];
        if ($data) {
            $result['data'] = $data;
        }
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public static function error($msg = null)
    {
        return response()->json(['msg' => $msg ? $msg : "处理失败", 'status' => 0], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public static function json($info)
    {
        return json_encode($info, JSON_UNESCAPED_UNICODE);
    }
}