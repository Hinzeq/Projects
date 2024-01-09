<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiController extends AbstractController
{
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    public function test(): Response{
        $response = $this->client->request(
            'GET',
            'https://gorest.co.in/public/v2/users'
        );

        // if ($response->getStatusCode() === 200) {

        // }
        
        dd(
            json_decode($response->getContent()),
            $response->toArray()
            // $response->getContent()
        );
        return $this->render('api/text.html.twig', [

            'number' => random_int(0, 100),
            'name' => 'Wojtek'
        ]);
    }
}