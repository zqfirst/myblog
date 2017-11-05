<?php

namespace common\libs;

class ArrayHelper extends \yii\helpers\ArrayHelper
{
    /**
     * 数组转换成对象
     * @param array $data
     * @return \StdClass
     */
    static public function ToObject(Array $data = [])
    {
        $emptyObj = new \StdClass;
        foreach ($data as $key => $val) {
            $emptyObj->$key = $val;
        }
        return $emptyObj;
    }

    static public function unLimitLevelTree(&$data, $parent_key = 'parent_id', $parent_id = 0)
    {
        foreach ($data as $key=>$val) {
            if ($val[$parent_key] == $parent_id) {
                $levelData[$val['id']] = $val;unset($data[$key]);
                $childLevel = self::unLimitLevelTree($data, $parent_key, $val['id']);
                if (!empty($childLevel)) $levelData[$val['id']]['childLevel'] = $childLevel;
            }
        }
        return isset($levelData) ? $levelData : [];
    }
}