Feature: I would like to edit crustaceans

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/crustacean/"
    Then I should not see "<crustacean>"
    And I follow "Create a new entry"
    Then I should see "Crustacean creation"
    When I fill in "Name" with "<crustacean>"
    And I fill in "Capture" with "<capture>"
    And I press "Create"
    Then I should see "<crustacean>"
    And I should see "<capture>"

  Examples:
    | crustacean     | capture |
    | shrimp         | 3500    |
    | crab           | 1400    |
    | lobster        | 280     |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/crustacean/"
    Then I should not see "<new-crustacean>"
    When I follow "<old-crustacean>"
    Then I should see "<old-crustacean>"
    When I follow "Edit"
    And I fill in "Name" with "<new-crustacean>"
    And I fill in "Capture" with "<new-capture>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-crustacean>"
    And I should see "<new-capture>"
    And I should not see "<old-crustacean>"

  Examples:
    | old-crustacean  | new-crustacean    | new-capture |
    | shrimp          | krill             | 125         |
    | lobster         | crayfish          | 540         |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/crustacean/"
    Then I should see "<crustacean>"
    When I follow "<crustacean>"
    Then I should see "<crustacean>"
    When I press "Delete"
    Then I should not see "<crustacean>"

  Examples:
    |  crustacean |
    | krill       |
    | crab        |
    | crayfish    |

