Feature:
Display one user

    Scenario: Successfully display one user
        When I add "Content-Type" header equal to "application/json"
        And I send a "PUT" request to "/users/5" with body:
        """
        {
            "username": "jhon",
            "password": "doe",
            "email": "jhon.doe@gmail.com"
        }
        """
        Then the response status code should be 200