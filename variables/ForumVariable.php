<?php
namespace Craft;

class ForumVariable
{
    public function getThreadById($id)
    {
        $record = craft()->forum_thread->getThreadById($id);

        $record->replies = array_map(function($reply)
        {
            $reply->user = UserRecord::model()->findById($reply->userId);

            return $reply;
        }, $record->replies);

        return $record;
    }

    public function getAllThreads()
    {
        return craft()->forum_thread->getAllThreads();
    }

    public function getCategoryById($id)
    {
        return craft()->forum_category->getCategory($id);
    }

    public function getAllCategories()
    {
        return craft()->forum_category->getAllCategories();
    }
}