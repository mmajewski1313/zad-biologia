Feature: I would like to edit birds

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/birds/"
    Then I should not see "<birds>"
    And I follow "Create a new entry"
    Then I should see "Bird creation"
    When I fill in "Name" with "<birds>"
    And I fill in "Weight" with "<weight>"
    And I press "Create"
    Then I should see "<birds>"
    And I should see "<weight>"

  Examples:
    | birds     | weight |
    | dusky     | 155    |
    | rainbow   | 130    |
    | red       | 170    |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/birds/"
    Then I should not see "<new-birds>"
    When I follow "<old-birds>"
    Then I should see "<old-birds>"
    When I follow "Edit"
    And I fill in "Name" with "<new-birds>"
    And I fill in "Weight" with "<new-weight>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-birds>"
    And I should see "<new-weight>"
    And I should not see "<old-birds>"

  Examples:
    | old-birds     | new-birds          | new-weight    |
    | dusky         | canary             | 30            |
    | rainbow       | kea                | 1000          |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/birds/"
    Then I should see "<birds>"
    When I follow "<birds>"
    Then I should see "<birds>"
    When I press "Delete"
    Then I should not see "<birds>"

  Examples:
    |  birds    |
    | red       |
    | canary    |
    | kea       |

