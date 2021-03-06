<?php
/**
 * Created by PhpStorm.
 * User: warthur
 * Date: 17/2/19
 * Time: 下午2:37
 */

namespace App\Http\Dao;


use App\Http\Model\BatchModel;
use MoenSun\MSLaravelExtension\MSLaravelDB;

class BatchDao
{

    public static function getBatchList(BatchModel $model, $where = null)
    {
        try {
            $sql = $model->where($where)->find();
            return MSLaravelDB::queryAll($sql);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public static function getBatchInfoById(BatchModel $model, $where=null)
    {
        try {
            $sql = $model->where($where)->find();
            return MSLaravelDB::queryRow($sql);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public static function insertBatchInfo(BatchModel $model, $where=null)
    {
        try {
            $sql = $model->where($where)->save();
            return MSLaravelDB::insert($sql);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public static function updateBatchById(BatchModel $model, $where = null)
    {
        try {
            $sql = $model->where($where)->update();
            return MSLaravelDB::update($sql);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public static function deleteBatchById(BatchModel $model, $where=null)
    {
        try {
            $sql = $model->where($where)->delete();
            return MSLaravelDB::delete($sql);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}