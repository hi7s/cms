<?php

namespace app\controllers;

use app\models\Music;
use app\models\MusicTag;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class MusicController extends Controller
{
    public function actionList()
    {
        $key = Yii::$app->request->get('key');
        $time = Yii::$app->request->get('time');
        $keywords = Yii::$app->request->get('keywords');
        // 标题
        if (!empty($keywords)) {
            $title = '搜索：' . $keywords;
        } else if (!empty($key)) {
            $title = '调号：' . $key;
        } else if (!empty($time)) {
            $title = '拍号：' . $time;
        } else {
            $title = '所有曲目';
        }
        // 数据
        $query = Music::find()
            ->andFilterWhere(['key' => $key])
            ->andFilterWhere(['time' => $time])
            ->andFilterWhere(['like', 'name', $keywords])
            ->orFilterWhere(['like', 'song_author', $keywords]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
        return $this->render('list', [
            'title' => $title,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionShow($id)
    {
        $music = Music::findOne($id);
        return $this->render('show', [
            'music' => $music
        ]);
    }

    public function actionEdit($id)
    {
        $request = Yii::$app->request;
        $music = Music::findOne($id);
        if ($music->load($request->post())) {
            // 标签
            $tags_json = json_encode($request->post()['Music']['tags']);
            if ($tags_json != $music->tags_json) {
                $music->tags_json = $tags_json;
                // 删除
                MusicTag::deleteAll(['music_id' => $music->id]);
                // 重新添加
                foreach ($request->post()['Music']['tags'] as $tag) {
                    $musicTag = new MusicTag();
                    $musicTag['music_id'] = $music->id;
                    $musicTag['music_name'] = $music->name;
                    $musicTag['tag'] = $tag;
                    $musicTag->save();
                }
            }
            // 基础数据
            if ($music->save()) {
                return $this->redirect(['music/show', 'id' => $music->id]);
            } else {
                var_dump($music->getErrors());
                die();
            }
        } else {
            return $this->render('edit', ['music' => $music]);
        }
    }
}
