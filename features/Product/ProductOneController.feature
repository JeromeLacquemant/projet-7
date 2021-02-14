@testoneproduct

Feature:
Display one product

    Scenario: Successfully display one product
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/products/5" with body:
        """
        {
            "name": "produit1",
            "description": "description du produit",
            "price": "265"
        }
        """
        Then the response status code should be 200