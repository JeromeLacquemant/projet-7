@testadduser

Feature:
Add a new user

    Scenario: Successfully add a user (because I'm logged)
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "POST" request to "api/users" with such body: 
        """
            {
                "username": "jhon",
                "password": "12345678",
                "email": "jhon.doe@gmail.com"
            }
        """
        Then the response status code should be 201
        And the response should be in JSON

    Scenario: Unsuccessfully add a user (because I'm not logged)
        When I send a "POST" request to "api/users" with such body: 
        """
            {
                "username": "jhon",
                "password": "12345678",
                "email": "jhon.doe@gmail.com"
            }
        """
        Then the response status code should be 401
        And the response should be in JSON
        Then the response should be equal to:
        """
        {"code":401,"message":"JWT Token not found"}
        """

    Scenario: Unsuccessfully add a user (because the email already exist in the database)
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "POST" request to "api/users" with such body: 
        """
            {
                "username": "jhon",
                "password": "12345678",
                "email": "user_1@gmail.com"
            }
        """
        Then the response status code should be 400
        And the response should be in JSON
        Then the response should be equal to:
        """
        {"message":["Cet email est d\u00e9j\u00e0 pris."]}
        """

    Scenario: Wrong route
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "POST" request to "api/user"
        Then the response status code should be 404
        And the response should be in JSON