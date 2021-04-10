@ testmodifyuser

Feature:
Modify a new user

    Scenario: Successfully modify a user (because I'm logged)
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "PUT" request to "api/users/1" and I am logged in
        When I send a "PUT" request to "api/users/1" with such body:
        """
        {
            "username": "jhon",
            "password": "doe",
            "email": "user@gmail.com"
        }
        """
        Then the response status code should be 200
        And the response should be in JSON

    Scenario: Successfully modify a user (because I'm not logged)
        When I send a "PUT" request to "api/users/1" with such body:
        """
        {
            "username": "jhon",
            "password": "doe",
            "email": "user@gmail.com"
        }
        """
        Then the response status code should be 401
        And the response should be in JSON
        Then the response should be equal to:
        """
        {"code":401,"message":"JWT Token not found"}
        """

    Scenario: Successfully modify a user (because I'm logged but not authorized)
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "PUT" request to "api/users/2" and I am logged in
        When I send a "PUT" request to "api/users/2" with such body:
        """
        {
            "username": "jhon",
            "password": "doe",
            "email": "user@gmail.com"
        }
        """
        Then the response status code should be 403
        And the response should be in JSON

    Scenario: Wrong route
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "PUT" request to "api/user"
        Then the response status code should be 404
        And the response should be in JSON