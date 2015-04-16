Feature: I would like to edit reptiles

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/cats/"
    Then I should not see "<cats>"
    And I follow "Create a new entry"
    Then I should see "Cats creation"
    When I fill in "Name" with "<cats>"
    And I fill in "Lifespan" with "<lifespan>"
    And I press "Create"
    Then I should see "<cats>"
    And I should see "<lifespan>"

  Examples:
    | cats     | lifespan |
    | lion     | 27  |
    | cheetah  | 23  |
    | lynx     | 15  |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/cats/"
    Then I should not see "<new-cats>"
    When I follow "<old-cats>"
    Then I should see "<old-cats>"
    When I follow "Edit"
    And I fill in "Name" with "<new-cats>"
    And I fill in "Lifespan" with "<new-lifespan>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-cats>"
    And I should see "<new-lifespan>"
    And I should not see "<old-cats>"

  Examples:
    | old-cats     | new-cats          | new-lifespan    |
    | lion         | puma              | 12              |
    | cheetah      | tiger             | 15              |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/cats/"
    Then I should see "<cats>"
    When I follow "<cats>"
    Then I should see "<cats>"
    When I press "Delete"
    Then I should not see "<cats>"

  Examples:
    |  cats     |
    | puma      |
    | tiger     |

