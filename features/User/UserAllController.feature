@testallusers

Feature:
Display all users with a get response

    Scenario: All users are displayed
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "GET" request to "api/all-users?page=1" and I am logged in
        Then the response status code should be 200
        And the response should be in JSON

    Scenario: Wrong route
        When I send a "GET" request to "all-use"
        Then the response status code should be 404
        And the response should be in JSON


