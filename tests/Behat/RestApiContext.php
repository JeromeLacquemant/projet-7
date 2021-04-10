<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use Behatch\Context\RestContext;
use Behat\Gherkin\Node\PyStringNode;

class RestApiContext extends RestContext
{
    private $headers = [];
    private $token;

    /**
     * Adds JWT Token to Authentication header for next request
     *
     * @param string $username
     * @param string $password
     *
     * @Given I am successfully logged in with username: :username, and password: :password
     */
    public function iAmSuccessfullyLoggedInWithUsernameAndPassword($username, $password)
    {
        $requestLogin = $this->request->send(
            'POST',
            $this->locatePath('/api/login_check'),
            [],
            [],
            json_encode([
                'username' => $username,
                'password' => (string) $password,
            ]),
            ['CONTENT_TYPE' => 'application/json']
        );

        $responseLogin = json_decode($requestLogin->getContent(), true);

        $this->addHeader('Authorization', 'Bearer '.$responseLogin['token']);
        $this->addToken($responseLogin['token']);
    }

    /**
     * @When /^(?:I )?send a "([A-Z]+)" request to "([^"]+)" with such body:$/
     */
    public function iSendARequestToWithSuchBody($method, $url, PyStringNode $string)
    {
        $request = $this->request->send(
            $method,
            $this->locatePath($url),
            [],
            [],
            null !== $string ? $string->getRaw() : null,
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Authorization' => sprintf('Bearer %s', $this->token),
            ]
        );

        return $request->getContent();
    }

/**
     * @When /^(?:I )?send a "([A-Z]+)" request to "([^"]+)" and I am logged in$/
     */
    public function iSendARequestToAndIAmLoggedIn($method, $url, $body = null)
    {
        $request = $this->request->send(
            $method,
            $this->locatePath($url),
            [],
            [],
            null !== $body ? $body->getRaw() : null,
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Authorization' => sprintf('Bearer %s', $this->token),
            ]
        );

        return $request->getContent();
    }

    protected function addHeader($name, $value)
    {
        if (isset($this->headers[$name])) {
            if (!is_array($this->headers[$name])) {
                $this->headers[$name] = [$this->headers[$name]];
            }

            $this->headers[$name][] = $value;

            return;
        }

        $this->headers[$name] = $value;
    }

    protected function addToken($value)
    {
        $this->token = $value;
    }
}
