<?php

namespace KRG\SeoBundle\Util;

use Symfony\Component\BrowserKit\Request;
use Symfony\Component\EventDispatcher\GenericEvent;

class Redirector
{
    /**
     * @param $basePath /admin
     * @param $entityName
     * @param $action
     * @param null $id
     * @return string
     */
    public static function getEasyAdminUrl($basePath, $entityName, $action, $id = null)
    {
        $url = $basePath;
        $url .= '?action='.$action;
        $url .= '&entity='.$entityName;
        if ($id) {
            $url .= '&id='.$id;
        }

        return $url;
    }

    /**
     * @param GenericEvent $event
     * @param $basePath
     * @param $entityName
     * @param $action
     * @param null $id
     * @return Request
     */
    public static function redirector(GenericEvent $event, $basePath, $entityName, $action, $id = null)
    {
        $url = self::getEasyAdminUrl($basePath, $entityName, $action, $id);

        /* @var $request Request */
        $request = $event->getArgument('request');
        $request->request->set('referer', $url);
        $request->query->set('referer', $url);

        return $request;
    }

}
