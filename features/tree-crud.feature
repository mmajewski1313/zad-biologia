Feature: I would like to edit tree

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/tree/"
    Then I should not see "<tree>"
    And I follow "Create a new entry"
    Then I should see "Tree creation"
    When I fill in "Name" with "<tree>"
    And I fill in "Height" with "<height>"
    And I press "Create"
    Then I should see "<tree>"
    And I should see "<height>"

  Examples:
    | tree        | height |
    | hornbeam    | 25  |
    | limetree    | 40  |
    | palm        | 60  |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/tree/"
    Then I should not see "<new-tree>"
    When I follow "<old-tree>"
    Then I should see "<old-tree>"
    When I follow "Edit"
    And I fill in "Name" with "<new-tree>"
    And I fill in "Height" with "<new-height>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-tree>"
    And I should see "<new-height"
    And I should not see "<old-tree>"

  Examples:
    | old-tree        | new-tree          | new-height |
    | hornbeam        | plumtree          | 5          |
    | limetree        | spruce            | 20         |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/tree/"
    Then I should see "<tree>"
    When I follow "<tree>"
    Then I should see "<tree>"
    When I press "Delete"
    Then I should not see "<tree>"

  Examples:
    |  tree       |
    | hornbeam    |
    | plumtree    |
    | spruce      |

