# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
    Homepage

    Scenario: All users are displayed
        Given I am on "/all-products"
        Then the response status code should be 200
