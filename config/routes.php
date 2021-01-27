<?php
declare(strict_types=1);

use App\Shared\Middleware\AuthValidateTokenMiddleware;
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
//use App\BackOffice\Home\Application\Actions\HelloWorldAction;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('/api', function (RouteCollectorProxy $group) {

        $group->group('/security', function (RouteCollectorProxy $group) {
            $group->post('/login', \App\BackOffice\Security\Application\Actions\LoginAction::class);
            $group->post('/register', \App\BackOffice\Security\Application\Actions\RegisterAction::class);
            $group->post('/forgot-password', \App\BackOffice\Security\Application\Actions\ForgotPasswordAction::class);
            $group->post('/reset-password', \App\BackOffice\Security\Application\Actions\ResetPasswordAction::class);
            $group->post('/change-password', \App\BackOffice\Security\Application\Actions\ChangePasswordAction::class)->add(AuthValidateTokenMiddleware::class);
            $group->get('/me-profile', \App\BackOffice\Security\Application\Actions\ProfileAction::class);
            $group->post('/verify-token', \App\BackOffice\Security\Application\Actions\VerifyTokenAction::class);
        });

        $group->group('/plans', function (RouteCollectorProxy $group) {
            $group->post('/attempts', \App\BackOffice\Plans\Application\Actions\SaveAttemptsAction::class)->add(AuthValidateTokenMiddleware::class);;
        });

        $group->group('/users', function (RouteCollectorProxy $group) {
//            $group->post('/sync-external', \App\BackOffice\Users\Application\Actions\RegisterAction::class);
//            $group->post('', \App\BackOffice\Users\Application\Actions\RegisterAction::class);
//            $group->get('/{id}', \App\BackOffice\Users\Application\Actions\UserFindAction::class);
//            $group->get('', \App\BackOffice\Users\Application\Actions\UserFindAllAction::class);
//            $group->put('/{id}', \App\BackOffice\Users\Application\Actions\UserEditAction::class);
//            $group->put('/{id}/change-password', \App\BackOffice\Users\Application\Actions\UserChangePassword::class);
//            $group->put('/{id}/is-disabled', \App\BackOffice\Users\Application\Actions\UserIsDisabled::class);
//            $group->delete('/{id}', \App\BackOffice\Users\Application\Actions\UserRemoveAction::class);
        });

    });

};