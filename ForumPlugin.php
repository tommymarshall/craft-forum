<?php
namespace Craft;

class ForumPlugin extends BasePlugin
{
    function getName()
    {
         return Craft::t('Forum');
    }

    function getVersion()
    {
        return '0.1.0';
    }

    function getDeveloper()
    {
        return 'Tommy Marshall';
    }

    function getDeveloperUrl()
    {
        return 'http://viget.com';
    }

    public function hasCpSection()
    {
        return true;
    }

    public function registerSiteRoutes()
    {
        return [
            'forum'                                => 'forum/index',
            'forum/threads/(?P<threadId>\d+)'      => 'forum/threads/show',
            'forum/categories/(?P<categoryId>\d+)' => 'forum/categories/show',
        ];
    }

    public function registerCpRoutes()
    {
        return [
            'forum'                                => 'forum/settings',
            'forum/threads'                        => 'forum/threads',
            'forum/categories'                     => 'forum/categories',
            'forum/threads/(?P<threadId>\d+)'      => 'forum/_edit',
            'forum/categories/(?P<categoryId>\d+)' => 'forum/_edit',
        ];
    }

    public function getSettingsUrl()
    {
        return 'forum/settings';
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('forum/settings',[
            'settings' => $this->getSettings()
        ]);
    }

    protected function defineSettings()
    {
        return [
            'settings' => [
                AttributeType::Mixed,
                'default' => ['Sours', 'Fizzes', 'Juleps'],
            ]
        ];
    }
}