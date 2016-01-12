<?php
namespace Craft;

class Forum_CategoryService extends BaseApplicationComponent
{
    protected $categoryRecord;

    public function __construct($categoryRecord = null)
    {
        $this->categoryRecord = $categoryRecord;
        if (is_null($this->categoryRecord)) {
            $this->categoryRecord = Forum_CategoryRecord::model();
        }
    }

    public function newCategory($attributes = [])
    {
        $model = new Forum_CategoryModel();
        $model->setAttributes($attributes);
        return $model;
    }

    public function getAllCategories()
    {
        $records = $this->categoryRecord->findAll();

        return Forum_CategoryModel::populateModels($records, 'id');
    }

    public function getCategory($id)
    {
        if ($record = $this->categoryRecord->with('threads')->findByPk($id)) {
            return Forum_CategoryModel::populateModel($record);
        }
    }

    public function saveCategory(Forum_CategoryModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->categoryRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find category with ID "{id}"', ['id' => $id]));
            }
        } else {
            $record = $this->categoryRecord->create();
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

    public function deleteCategoryById($id)
    {
        return $this->categoryRecord->deleteByPk($id);
    }
}