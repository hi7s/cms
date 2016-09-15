<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class MusicTag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%music_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['music_id', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['no', 'tag'], 'string', 'max' => 20],
            [['music_name'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 200],
            [['music_id'], 'exist', 'skipOnError' => true, 'targetClass' => Music::className(), 'targetAttribute' => ['music_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMusic()
    {
        return $this->hasOne(Music::className(), ['id' => 'music_id']);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }
}
