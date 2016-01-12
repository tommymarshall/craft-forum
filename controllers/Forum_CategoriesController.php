<?php
namespace Craft;

class Forum_CategoriesController extends BaseController
{
    public function actionSaveCategory()
    {
        $this->requirePostRequest();

        $category = new Forum_CategoryModel();

        if (craft()->forumCategories->saveCategory($category))
        {
            craft()->userSession->setNotice(Craft::t('Category saved.'));
            $this->redirectToPostedUrl();
        }
        else
        {
            craft()->userSession->setError(Craft::t('Couldn’t save category.'));

            craft()->urlManager->setRouteVariables([
               'category' => $category
            ]);
        }
    }

    public function actionDeleteCategory()
    {

    }
}