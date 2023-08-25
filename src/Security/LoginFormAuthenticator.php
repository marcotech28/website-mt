<?php

namespace App\Security;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;

class LoginFormAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    private RouterInterface $router;
    private UserRepository $userRepository;
    private UserCheckerInterface $userChecker;


    public function __construct(UserRepository $userRepository, RouterInterface $router, UserCheckerInterface $userChecker)
    {
        $this->userRepository = $userRepository;
        $this->router = $router;
        $this->userChecker = $userChecker;
    }

    public function supports(Request $request): ?bool
    {
        // TODO: Implement supports() method.
        return $request->attributes->get('_route') === 'security_login' && $request->isMethod('POST');
    }

    public function authenticate(Request $request): Passport
    {

        $loginData = $request->request->get('login');
        $email = $loginData['email'];
        $password = $loginData['password'];

        $user = $this->userRepository->findOneBy(['email' => $email]);

        $this->userChecker->checkPreAuth($user); // Utilisation du UserChecker

        if (!$user->isIsConfirmed()) {
            throw new CustomUserMessageAuthenticationException('Your account is not confirmed yet.');
        }

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($password)
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse('/');
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        return new RedirectResponse(
            $this->router->generate('security_login')
        );
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        /*
            * If you would like this class to control what happens when an anonymous user accesses a
            * protected page (e.g. redirect to /login), uncomment this method and make this class
            * implement Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface.
            *
            * For more details, see https://symfony.com/doc/current/security/experimental_authenticators.html#configuring-the-authentication-entry-point
            */
        return new RedirectResponse('/login');
    }
}
