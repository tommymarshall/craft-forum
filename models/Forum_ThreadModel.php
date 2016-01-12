<?php
namespace Craft;

class Forum_ThreadModel extends BaseModel
{
    protected function defineAttributes()
    {
        return [
            'id'         => AttributeType::Number,
            'title'      => AttributeType::String,
            'slug'       => AttributeType::String,
            'body'       => AttributeType::String,
            'categoryId' => AttributeType::Number,
            'parentId'   => AttributeType::Number,
            'userId'     => AttributeType::Number,
            'user'       => AttributeType::Mixed,
            'category'   => AttributeType::Mixed,
            'replies'    => AttributeType::Mixed,
        ];
    }
}