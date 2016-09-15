<?php

namespace app\models;

use yii\db\ActiveRecord;

class Config extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%config}}';
    }

    // 调号
    public static function keys()
    {
        return Config::find()->andWhere(['parent_id' => '1'])->orderBy(['no' => SORT_ASC, 'id' => SORT_ASC])->all();
    }

    // 拍号
    public static function times()
    {
        return Config::find()->andWhere(['parent_id' => '2'])->orderBy(['no' => SORT_ASC, 'id' => SORT_ASC])->all();
    }

    // 速度
    public static function tempos()
    {
        return Config::find()->andWhere(['parent_id' => '3'])->orderBy(['no' => SORT_ASC, 'id' => SORT_ASC])->all();
    }

    // 标签
    public static function tags()
    {
        return Config::find()->andWhere(['parent_id' => '4'])->orderBy(['no' => SORT_ASC, 'id' => SORT_ASC])->all();
    }
}