Feature:
Modify a new user

    Scenario: Successfully modify a user
        When I add "Content-Type" header equal to "application/json"
        And I send a "PUT" request to "api/users/modify/8" with body:
        """
        {
            "username": "jhon",
            "password": "doe",
            "email": "jhon.doe@gmail.com"
        }
        """
        Then the response status code should be 204