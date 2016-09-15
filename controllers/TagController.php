<?php

namespace app\controllers;

use app\models\Music;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TagController extends Controller
{
    public function actionShow($tag)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Music::find()->joinWith('tag')->where(['tag' => $tag]),
            'sort' => [
                'defaultOrder' => [
                    'updated_at' => SORT_DESC,
                    'song_author' => SORT_ASC,
                    'name' => SORT_ASC
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('/music/list', [
            'title' => '标签：' . $tag,
            'dataProvider' => $dataProvider
        ]);
    }
}