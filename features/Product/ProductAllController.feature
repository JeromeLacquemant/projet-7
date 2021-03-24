@testallproduct

Feature:
Display all products with a get response

    Scenario: All products are displayed
        When I send a "GET" request to "all-products?page=4"
        Then the response status code should be 200
        And the response should be in JSON

    Scenario: Wrong route
        When I send a "GET" request to "all-product"
        Then the response status code should be 404
        And the response should be in JSON


