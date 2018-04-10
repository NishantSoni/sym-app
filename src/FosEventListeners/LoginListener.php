<?php 

/**
 * This Class/Listener is responsible for redirecting to the admin panel or the user panel.
 * If the logged in user has role - ADMIN, then it will be redircting to the Admin panel, otherwise to the user panel.
 */
namespace App\FosEventListeners;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\UserBundle\Event\GetResponseUserEvent;

class LoginListener implements EventSubscriberInterface
{
    private $container;
    
    private $router;
    
    public function __construct(ContainerInterface $container , UrlGeneratorInterface $router)
    {
        $this->container = $container;
        $this->router = $router;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onLogin',
            SecurityEvents::INTERACTIVE_LOGIN => 'onLogin',
        );
    }

    public function onLogin($event)
    {
        // Get User here
        // if ($event instanceof UserEvent) {
        //    $user = $event->getUser();
        // }

        // OR

        // if ($event instanceof InteractiveLoginEvent) {
        //    $user = $event->getAuthenticationToken()->getUser();
        // }

        // OR
        
        // $user = $this->container->get('security.token_storage')->getToken()->getUser();
        // Check if user is admin then 
        
        if($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            return new RedirectResponse($this->router->generate('admin_home_route'));
        }
    }
}