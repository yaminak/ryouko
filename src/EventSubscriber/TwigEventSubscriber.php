<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Repository\PaysRepository;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $paysRepository;

    public function __construct(Environment $twig, PaysRepository $paysRepository)
    {
        $this->twig = $twig;
        $this->paysRepository = $paysRepository;
    }
    public function onKernelController(ControllerEvent $event): void
    {
        $this->twig->addGlobal('pays', $this->paysRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
