<?php
namespace Craft;

class Forum_CategoryModel extends BaseModel
{
    protected function defineAttributes()
    {
        return [
            'id'          => AttributeType::Number,
            'title'       => AttributeType::String,
            'slug'        => AttributeType::String,
            'description' => AttributeType::String,
            'threads'     => AttributeType::Mixed,
        ];
    }
}