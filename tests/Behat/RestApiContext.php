<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use App\Repository\ClientRepository;
use Behat\Behat\Context\Context;
use Behatch\HttpCall\Request;

class RestApiContext implements Context
{
    /**
     * RestApiContext constructor.
     *
     * @param ClientInterface $client
     * @param string          $dummyDataPath
     */
    public function __construct(ClientRepository $client, $dummyDataPath = null)
    {
        $this->client = $client;
        $this->dummyDataPath = $dummyDataPath;
    }

    /**
     * Adds JWT Token to Authentication header for next request.
     *
     * @param string $username
     * @param string $password
     *
     * @Given /^I am successfully logged in with username: "([^"]*)", and password: "([^"]*)"$/
     */
    public function iAmSuccessfullyLoggedInWithUsernameAndPassword($username, $password)
    {
        $response = $this->client->post('login', [
            'json' => [
                'username' => $username,
                'password' => $password,
            ],
        ]);

        \PHPUnit_Framework_Assert::assertEquals(200, $response->getStatusCode());

        $responseBody = json_decode($response->getBody(), true);
        $this->addHeader('Authorization', 'Bearer '.$responseBody['token']);
    }
}
