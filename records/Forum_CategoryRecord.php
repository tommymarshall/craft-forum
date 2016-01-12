<?php
namespace Craft;

class Forum_CategoryRecord extends BaseRecord
{
    public function getTableName()
    {
        return 'forum_categories';
    }

    public function defineAttributes()
    {
        return [
            'title'       => AttributeType::String,
            'description' => AttributeType::String,
        ];
    }

    public function defineRelations()
    {
        return [
            'threads' => [static::HAS_MANY, 'Forum_ThreadRecord', 'categoryId'],
        ];
    }
}
