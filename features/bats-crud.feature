Feature: I would like to edit bats

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bats/"
    Then I should not see "<bats>"
    And I follow "Create a new entry"
    Then I should see "Bats creation"
    When I fill in "Name" with "<bats>"
    And I fill in "Weight" with "<weight>"
    And I press "Create"
    Then I should see "<bats>"
    And I should see "<weight>"

  Examples:
    | bats     | weight |
    | dus     | 10    |
    | rai   | 11    |
    



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bats/"
    Then I should not see "<new-bats>"
    When I follow "<old-bats>"
    Then I should see "<old-bats>"
    When I follow "Edit"
    And I fill in "Name" with "<new-bats>"
    And I fill in "Weight" with "<new-weight>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-bats>"
    And I should see "<new-weight>"
    And I should not see "<old-bats>"

  Examples:
    | old-bats    | new-bats          | new-weight    |
    | dus        | can            | 3            |
    | rai      | kea                | 10         |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bats/"
    Then I should see "<bats>"
    When I follow "<bats>"
    Then I should see "<bats>"
    When I press "Delete"
    Then I should not see "<bats>"

  Examples:
    |  bats    |
    | can    |
    | kea       |

