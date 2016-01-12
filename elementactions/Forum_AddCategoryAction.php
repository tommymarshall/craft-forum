<?php
namespace Craft;

class Forum_AddCategoryAction extends BaseElementAction
{
    public function getName()
    {
        return Craft::t('Add Category');
    }

    public function getTriggerHtml()
    {
        // Render the trigger menu template with all the available categories
        $categories = craft()->forumCategories->getAllCategories();

        return craft()->templates->render('forumCategories/_addCategorysTrigger', [
            'categories' => $categories
        ]);
    }

    public function performAction(ElementCriteriaModel $criteria)
    {
        // Get the selected category
        $categoryId = $this->getParams()->category;
        $category = craft()->forumCategories->getCategoryById($categoryId);

        // Make sure it's a valid one
        if (!$category)
        {
            $this->setMessage(Craft::t('The selected category could not be found.'));
            return false;
        }

        // Add the category to the selected elements
        $elements = $criteria->find();

        foreach ($elements as $element)
        {
            craft()->forumCategories->addCategoryToElement($element, $category);
        }

        // Success!
        $this->setMessage(Craft::t('Category added successfully.'));
        return true;
    }

    protected function defineParams()
    {
        return [
            'category' => [AttributeType::Number, 'required' => true],
        ];
    }
}