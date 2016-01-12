<?php
namespace Craft;

class Forum_ThreadRecord extends BaseRecord
{
    public function getTableName()
    {
        return 'forum_threads';
    }

    public function defineAttributes()
    {
        return [
            'title'      => AttributeType::String,
            'body'       => AttributeType::String,
            'categoryId' => AttributeType::Number,
            'parentId'   => AttributeType::Number,
            'userId'     => AttributeType::Number,
        ];
    }

    public function defineRelations()
    {
        return [
            'category' => [static::BELONGS_TO, 'Forum_CategoryRecord', 'categoryId'],
            'replies'  => [static::HAS_MANY, 'Forum_ThreadRecord', 'parentId'],
            'user'     => [static::HAS_ONE, 'UserRecord', 'id'],
        ];
    }

}
