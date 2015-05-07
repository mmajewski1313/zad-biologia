Feature: I would like to edit reptiles

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/butterfly/"
    Then I should not see "<butterfly>"
    And I follow "Create a new entry"
    Then I should see "Butterfly creation"
    When I fill in "Name" with "<butterfly>"
    And I fill in "Age" with "<age>"
    And I press "Create"
    Then I should see "<butterfly>"
    And I should see "<age>"

  Examples:
    | butterfly        | age |
    | Ornithopera      |  4  |
    | Xerces blue      |  5  |
    | Mallow skipper   |  2  |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/butterfly/"
    Then I should not see "<new-butterfly>"
    When I follow "<old-butterfly>"
    Then I should see "<old-butterfly>"
    When I follow "Edit"
    And I fill in "Name" with "<new-butterfly>"
    And I fill in "Age" with "<new-age>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-butterfly>"
    And I should see "<new-age>"
    And I should not see "<old-butterfly>"

  Examples:
    | old-butterfly    | new-butterfly        | new-age    |
    | Ornithopera      | Morphogeus           |  6         |
    | Xerces blue      | Painted lady         |  6         |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/butterfly/"
    Then I should see "<butterfly>"
    When I follow "<butterfly>"
    Then I should see "<butterfly>"
    When I press "Delete"
    Then I should not see "<butterfly>"

  Examples:
    | butterfly          |
    | Mallow skipper     |
    | Morphogeus         |
    | Painted lady       |

