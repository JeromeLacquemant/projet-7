@testoneproduct

Feature:
Display one product

    Scenario: Wrong route
        When I send a "GET" request to "produc"
        Then the response status code should be 404
        And the response should be in JSON