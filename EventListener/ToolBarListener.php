<?php

namespace ElsassSeeraiwer\ESBarBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
*
* @author Kevin Eyermann <kevin.eyermann@gmail.com>
*/
class ToolBarListener implements EventSubscriberInterface
{
    const DISABLED  = 1;
    const ENABLED   = 2;
    const version   = 'dev';

    protected $twig;
    protected $position;
    protected $templates;

    public function __construct(\Twig_Environment $twig, $position = 'top', array $templates)
    {
        $this->twig = $twig;
        $this->position = $position;
        $this->templates = $templates;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        $response = $event->getResponse();
        $request = $event->getRequest();

        // do not capture redirects or modify XML HTTP Requests
        if ($request->isXmlHttpRequest()) {
            return;
        }

        if ($response->isRedirection()
            || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
            || 'html' !== $request->getRequestFormat()
        ) {
            return;
        }

        $this->injectToolbar($response);
    }

    /**
     * @param Response $response A Response instance
     */
    protected function injectToolbar(Response $response)
    {
        if (function_exists('mb_stripos')) {
            $posrFunction   = 'mb_strripos';
            $substrFunction = 'mb_substr';
        } else {
            $posrFunction   = 'strripos';
            $substrFunction = 'substr';
        }

        $content = $response->getContent();
        $pos = $posrFunction($content, '</body>');

        if (false !== $pos) {
            $toolbar = "\n".str_replace("\n", '', $this->twig->render(
                'ElsassSeeraiwerESBarBundle:Toolbar:toolbar.html.twig',
                array(
                    'position'  => $this->position,
                    'templates' => $this->templates,
                    'version'   => self::version
                )
            ))."\n";
            $content = $substrFunction($content, 0, $pos).$toolbar.$substrFunction($content, $pos);
            $response->setContent($content);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::RESPONSE => array('onKernelResponse', 50),
        );
    }
}