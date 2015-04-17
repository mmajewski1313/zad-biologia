Feature: I would like to edit reptiles

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/fish/"
    Then I should not see "<fish>"
    And I follow "Create a new entry"
    Then I should see "Fish creation"
    When I fill in "Name" with "<fish>"
    And I fill in "Age" with "<age>"
    And I press "Create"
    Then I should see "<fish>"
    And I should see "<age>"

  Examples:
    | fish        | age |
    | carp        | 38  |
    | crucian     | 10  |
    | amur        | 21  |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/fish/"
    Then I should not see "<new-fish>"
    When I follow "<old-fish>"
    Then I should see "<old-fish>"
    When I follow "Edit"
    And I fill in "Name" with "<new-fish>"
    And I fill in "Age" with "<new-age>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-fish>"
    And I should see "<new-age>"
    And I should not see "<old-fish>"

  Examples:
    | old-fish         | new-fish                  | new-age    |
    | carp             | mrigal                    | 15         |
    | crucian          | black Chinese roach       | 13         |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/fish/"
    Then I should see "<fish>"
    When I follow "<fish>"
    Then I should see "<fish>"
    When I press "Delete"
    Then I should not see "<fish>"

  Examples:
    | fish                |
    | amur                |
    | mrigal              |
    | black Chinese roach |

