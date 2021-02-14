@testoneclient

Feature:
Display one client

    Scenario: Successfully display one client
        When I send a "GET" request to "clients/4"
        Then the response status code should be 200
        And the response should be in JSON