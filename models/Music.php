<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Music extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%music}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '曲名',
            'key' => '调号',
            'time' => '拍号',
            'tempo' => '速度',
            'original_singer' => '原唱',
            'text_author' => '作词',
            'song_author' => '作曲',
            'tags' => '标签',
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'time', 'tempo'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['no', 'song_author', 'text_author', 'original_singer'], 'string', 'max' => 20],
            [['name', 'remark'], 'string', 'max' => 50],
            [['tags_json'], 'string', 'max' => 100],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMusicTags()
    {
        return $this->hasMany(MusicTag::className(), ['music_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasMany(MusicTag::className(), ['music_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function getTags()
    {
        return json_decode($this['tags_json']);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }
}
