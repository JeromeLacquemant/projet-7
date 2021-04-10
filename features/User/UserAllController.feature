@testallusers

Feature:
Display all users with a get response

    Scenario: Successfully display all users (because I'm logged)
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "GET" request to "api/users" and I am logged in
        Then the response status code should be 200
        And the response should be in JSON

    Scenario: Unsuccessfully display all users (because I'm not logged)
        When I send a "GET" request to "api/users" and I am logged in
        Then the response status code should be 401
        And the response should be in JSON         

    Scenario: Wrong route
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "GET" request to "all-use"
        Then the response status code should be 404
        And the response should be in JSON


