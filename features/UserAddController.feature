Feature:
Add a new user

    Scenario: Successfully register a new user
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/users/add-new-user" with body:
        """
        {
            "username": "jhon",
            "password": "doe",
            "email": "jhon.doe@gmail.com"
        }
        """
        Then the response status code should be 201
        And the response should be in JSON