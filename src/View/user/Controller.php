<?php

use Service\User\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public function action()
    {
        $request = Request::class;
        $logout = false;

        if($request->isMethod(Request::METHOD_POST)){
            $user = new Security($request->getSession());

            $isAuthenticationSuccess = $user->authentication(
                $request->request->get('login'),
                $request->request->get('password')
            );
            if ($isAuthenticationSuccess) {
                return $this->render(
                    'user/authentication_success.html.php',
                    ['user' => $user->getUser()]
                );
            }else {
                $error = 'Неправильный логин и/или пароль';
            }
            $this->render(
                'user/authentication.html.php',
                ['error' => $error ?? '']
            );
        }

        if($logout){
            (new Security($request->getSession()))->logout();
            $this->redirect('index');
        }





    }
}