@testallclients

Feature:
Display all clients with a get response

    Scenario: All clients are displayed
        When I send a "GET" request to "all-clients"
        Then the response status code should be 200
        And the response should be in JSON


