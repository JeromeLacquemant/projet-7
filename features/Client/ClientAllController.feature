@testallclients

Feature:
Display all clients with a get response

    Scenario: All clients are displayed
        When I send a "GET" request to "clients?page=2"
        Then the response status code should be 200
        And the response should be in JSON

    Scenario: Wrong route
        When I send a "GET" request to "clien"
        Then the response status code should be 404
        And the response should be in JSON


