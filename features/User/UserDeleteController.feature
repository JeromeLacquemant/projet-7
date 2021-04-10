@testdeleteuser

Feature:
Delete a new user

    Scenario: Successfully delete a user (because I'm logged)
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "DELETE" request to "api/users/1" and I am logged in
        Then the response status code should be 200
        Then the response should be equal to:
        """
        {"message":"L'utilisateur a bien \u00e9t\u00e9 effac\u00e9 de la base de donn\u00e9es"}
        """

    Scenario: Unsuccessfully delete a user (because I'm not logged)
        When I send a "DELETE" request to "api/users/1"
        Then the response status code should be 401
        And the response should be in JSON
        Then the response should be equal to:
        """
        {"code":401,"message":"JWT Token not found"}
        """

    Scenario: Unsuccessfully delete a user (because I'm logged but not authorized)
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "DELETE" request to "api/users/2" and I am logged in
        Then the response status code should be 403
        And the response should be in JSON
        Then the response should be equal to:
        """
        {"message":"Vous n\u0027\u00eates pas autoris\u00e9 \u00e0 effacer \u00e0 cet user"}
        """

    Scenario: Unsuccessfully delete a user (because I'm logged but the user doesn't exist)
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "DELETE" request to "api/users/101" and I am logged in
        Then the response status code should be 404
        And the response should be in JSON
        Then the response should be equal to:
        """
        {"message":"Cet utilisateur n\u0027existe pas"}
        """

    Scenario: Wrong route
        Given I am successfully logged in with username: "client_1@gmail.com", and password: "12345"
        When I send a "DELETE" request to "api/user"
        Then the response status code should be 404
        And the response should be in JSON