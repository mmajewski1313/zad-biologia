Feature: I would like to edit elephant

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/elephant/"
    Then I should not see "<elephant>"
    And I follow "Create a new entry"
    Then I should see "Elephant creation"
    When I fill in "Name" with "<elephant>"
    And I fill in "Weight" with "<weight>"
    And I press "Create"
    Then I should see "<elephant>"
    And I should see "<elephant>"

  Examples:
    | elephant   | weight |
    | afrykanski | 4500   |
    | lesny      | 4600   |
    | indyjski   | 4700   |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/elephant/"
    Then I should not see "<new-elephant>"
    When I follow "<old-elephant>"
    Then I should see "<old-elephant>"
    When I follow "Edit"
    And I fill in "Name" with "<new-elephant>"
    And I fill in "Weight" with "<new-weight>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-elephant>"
    And I should see "<new-weight>"
    And I should not see "<old-elephant>"

  Examples:
    | old-elephant | new-elephant | new-weight |
    | afrykanski   | Afrykanski   | 4800       |
    | lesny        | Lesny        | 4900       |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/elephant/"
    Then I should see "<elephant>"
    When I follow "<elephant>"
    Then I should see "<elephant>"
    When I press "Delete"
    Then I should not see "<elephant>"

  Examples:
    |  elephant  |
    | Afrykanski |
    | Lesny      |
    | indyjski   |

