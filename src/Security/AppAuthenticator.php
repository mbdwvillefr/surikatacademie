<?php
//AppAuthenticator.php是一个自定义的认证器类，负责实现用户的认证逻辑。
//认证器类负责验证用户的凭据（如用户名和密码），并返回一个认证的用户对象。
namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AppAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    use TargetPathTrait;

    public function supports(Request $request): ?bool
    {
        // Determine if this authenticator should be used for the given request
        // For example, check if the request is a POST request to the login route
        return $request->attributes->get('_route') === 'app_login'
            && $request->isMethod('POST');
    }

    public function authenticate(Request $request): PassportInterface
    {
        // Implement the logic to authenticate the user
        // For example, retrieve user information from the request and create a PassportInterface object
        // This method should return a PassportInterface object representing the authenticated user
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Implement actions to be taken on successful authentication
        // For example, redirect the user to a specific page or return a Response object
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        // Implement actions to be taken on authentication failure
        // For example, redirect the user to the login page with an error message
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        // Implement logic for handling the start of the authentication process
        // For example, redirect the user to the login page or return a Response object
    }
}
