<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use \App\Libraries\Oauth;
use \OAuth2\Request;
use \OAuth2\Response;


class OauthFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
       $oauth = new Oauth();
       $request = Request::createFromGlobals();
       $response = new Response();

       if(!$oauth->server->verifyResourceRequest($request)){
         $oauth->server->getResponse()->send();
         die();
       }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}
