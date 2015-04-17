Feature: I would like to edit mushrooms

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/mushroom/"
    Then I should not see "<mushroom>"
    And I follow "Create a new entry"
    Then I should see "Mushroom creation"
    When I fill in "Name" with "<mushroom>"
    And I fill in "Height" with "<height>"
    And I press "Create"
    Then I should see "<mushroom>"
    And I should see "<height>"

  Examples:
    | mushroom        | height |
    | chanterelle     | 10     |
    | toadstool       | 5      |
    | chevalier       | 18     |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/mushroom/"
    Then I should not see "<new-mushroom>"
    When I follow "<old-mushroom>"
    Then I should see "<old-mushroom>"
    When I follow "Edit"
    And I fill in "Name" with "<new-mushroom>"
    And I fill in "Height" with "<new-height>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-mushroom>"
    And I should see "<new-height>"
    And I should not see "<old-mushroom>"

  Examples:
    | old-mushroom     | new-mushroom  | new-height |
    | chanterelle      | boletus       | 12         |
    | toadstool        | baybolete     | 6          |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/mushroom/"
    Then I should see "<mushroom>"
    When I follow "<mushroom>"
    Then I should see "<mushroom>"
    When I press "Delete"
    Then I should not see "<mushroom>"

  Examples:
    | mushroom    |
    | chevalier   |
    | boletus     |
    | baybolete   |

