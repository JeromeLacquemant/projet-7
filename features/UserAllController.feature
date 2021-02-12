Feature:
Display all users with a get response

    Scenario: All users are displayed
        When I send a "GET" request to "all-users"
        Then the response status code should be 200
        And the response should be in JSON


