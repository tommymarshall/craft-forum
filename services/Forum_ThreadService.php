<?php
namespace Craft;

class Forum_ThreadService extends BaseApplicationComponent
{
    protected $threadRecord;

    public function __construct($threadRecord = null)
    {
        $this->threadRecord = $threadRecord;
        if (is_null($this->threadRecord)) {
            $this->threadRecord = Forum_ThreadRecord::model();
        }
    }

    public function newThread($attributes = [])
    {
        $model = new Forum_ThreadModel();
        $model->setAttributes($attributes);
        return $model;
    }

    public function getAllThreads()
    {
        $records = $this->threadRecord->findAll(['order'=>'t.name']);
        return Forum_ThreadModel::populateModels($records, 'id');
    }

    public function getThreadById($id)
    {
        if ($record = $this->threadRecord->with('user', 'category', 'replies')->findByPk($id)) {
            return Forum_ThreadModel::populateModel($record);
        }
    }

    public function saveThread(Forum_ThreadModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->threadRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find thread with ID "{id}"', ['id' => $id]));
            }
        } else {
            $record = $this->threadRecord->create();
        }
        $record->setAttributes($model->getAttributes());
        if ($record->save()) {
            // update id on model (for new records)
            $model->setAttribute('id', $record->getAttribute('id'));
            return true;
        } else {
            $model->addErrors($record->getErrors());
            return false;
        }
    }

    public function deleteThreadById($id)
    {
        return $this->threadRecord->deleteByPk($id);
    }
}