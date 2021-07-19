@testoneclient

Feature:
Display one client

    Scenario: Successfully display one client
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "GET" request to "api/clients/1" and I am logged in
        Then the response status code should be 200
        And the response should be in JSON

    Scenario: Wrong route
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "GET" request to "api/clien" and I am logged in
        Then the response status code should be 404
        And the response should be in JSON