<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AuthenticationHandler
    implements AuthenticationSuccessHandlerInterface,
    AuthenticationFailureHandlerInterface
{
    private $router;

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {

    }
}
