Feature:
Delete a new user

    Scenario: Successfully delete a user
        When I add "Content-Type" header equal to "application/json"
        And I send a "DELETE" request to "api/users/delete/9"
        Then the response status code should be 204