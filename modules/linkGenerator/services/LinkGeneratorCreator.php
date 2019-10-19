<?php

namespace app\modules\linkGenerator\services;

use app\modules\linkGenerator\models\LinkGenerator;
use app\modules\linkGenerator\models\LinksArticlesRelations;
use Yii;

class LinkGeneratorCreator
{
    /**
     * @param MailingList $model
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function create($model)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $post = Yii::$app->request->post();

        $model->load($post);

        $model->user_created = Yii::$app->user->identity->id;

       //$model->save();
        if (!$model->save()) {
            $entry_arr = $this->getEntryArr($post, $model);
            return $this->returnError($transaction, $model, $entry_arr);
        }

        $entry_arr = $this->getEntryArr($post, $model);

        LinksArticlesRelations::deleteAll(['link_id' => $model->id]);

        $error = false;
        foreach ($entry_arr as $item) {
            if (!$item->save()) {
                $error = true;
            }
        }
        if ($error) {
            return $this->returnError($transaction, $model, $entry_arr);
        }

        $transaction->commit();
        $model->title = $model->linksArticlesRelationses[0]->article->articlesCategories->title. " " . date_create('now')->format('d-m-Y');
        $model->save();
        return [
            'error' => $error
        ];
    }

    /**
     * @param LinksArticlesRelations[] $entry_arr
     * @return LinksArticlesRelations[]|array
     */
    public function setEntryArr(array $entry_arr)
    {
        foreach ($entry_arr as $entry_model) {
            if (!empty($entry_model->article_id)) {
                $entry_model->article_arr[$entry_model->article_id] = $entry_model->article->title;
            }
        }
        return $entry_arr;
    }

    /**
     * @param \yii\db\Transaction $transaction
     * @param MailingList $model
     * @param MailingListEntry[] $entry_arr
     * @return array
     */
    private function returnError($transaction, $model, $entry_arr)
    {
        $transaction->rollBack();
        return [
            'error' => true,
            'model' => $model,
            'entries' => $this->setEntryArr($entry_arr)
        ];
    }

    /**
     * @param array $post
     * @param LinkGenerator $model
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    private function getEntryArr($post, $model)
    {
        $entry_form_name = (new LinksArticlesRelations())->formName();
        $entry_arr = [];
        $keys = array_keys($post[$entry_form_name]);
        foreach ($keys as $key) {
            $entry = new LinksArticlesRelations();
            $entry->link_id = $model->id;
            $entry_arr[$key] = $entry;
        }
        LinksArticlesRelations::loadMultiple($entry_arr, $post);
        return $entry_arr;
    }
}
