<?php
namespace Craft;

class Forum_ThreadsController extends BaseController
{
    public function actionSaveThread()
    {
        $this->requirePostRequest();

        $thread = new Forum_ThreadModel();

        if (craft()->forum_thread->saveThread($thread))
        {
            craft()->userSession->setNotice(Craft::t('Thread saved.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            craft()->userSession->setError(Craft::t('Couldn’t save thread.'));

            craft()->urlManager->setRouteVariables([
               'thread' => $thread
            ]);
        }
    }

    public function actionDeleteThread()
    {

    }
}