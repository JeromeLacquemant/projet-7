@testadduser

Feature:
Add a new user

    Scenario: Client is logged in and post valid user
        When I add "Contet-Type" header equal to "application/json"
        And I add "Accept" header equal to "application/json"
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "POST" request to "api/users/add-new-user" with such body:
        """
            {
                "username": "jhon",
                "password": "doe",
                "email": "jhon.doe@gmail.com"
            }
        """

        Then the response status code should be 201