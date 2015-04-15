Feature: I would like to edit reptiles

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/snail/"
    Then I should not see "<snail>"
    And I follow "Create a new entry"
    Then I should see "Snail creation"
    When I fill in "Name" with "<Snail>"
    And I fill in "Lifespan" with "<lifespan>"
    And I press "Create"
    Then I should see "<Snail>"
    And I should see "<lifespan>"

  Examples:
    | Snail             | lifespan |




  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/Snail/"
    Then I should not see "<new-Snail>"
    When I follow "<old-Snail>"
    Then I should see "<old-Snail>"
    When I follow "Edit"
    And I fill in "Name" with "<new-Snail>" 
    And I fill in "Lifespan" with "<new-lifespan>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-Snail>"
    And I should see "<new-lifespan>"
    And I should not see "<old-Snail>

  Examples:
    | old-Snail            | new-Snail                | new-lifespan |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/Snail/"
    Then I should see "<Snail>"
    When I follow "<Snail>"
    Then I should see "<Snail>""
    When I press "Delete"
    Then I should not see "<Snail>""

  Examples:
    |  Snail|
