Feature: I would like to edit forests

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/forest/"
    Then I should not see "<forest>"
    And I follow "Create a new entry"
    Then I should see "Forest creation"
    When I fill in "Name" with "<forest>"
    And I fill in "Area" with "<area>"
    And I press "Create"
    Then I should see "<forest>"
    And I should see "<area>"

  Examples:
    | forest            | area |
    | Puszcza Solska    | 1230 |
    | Lasy Janowskie    | 2110 |
    | Lasy Parczewskie  | 990  |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/forest/"
    Then I should not see "<new-forest>"
    When I follow "<old-forest>"
    Then I should see "<old-forest>"
    When I follow "Edit"
    And I fill in "Name" with "<new-forest>"
    And I fill in "Area" with "<new-area>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-forest>"
    And I should see "<new-area>"
    And I should not see "<old-forest>"

  Examples:
    | old-forest       | new-forest         | new-area    |
    | Puszcza Solska   | S-O-L-S-K-A        | 3214        |
    | Lasy Janowskie   | J-A-N-O-W-S-K-A    | 4321        |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/forest/"
    Then I should see "<forest>"
    When I follow "<forest>"
    Then I should see "<forest>"
    When I press "Delete"
    Then I should not see "<forest>"

  Examples:
    |  forest            |
    | Lasy Parczewskie   |
    | S-O-L-S-K-A        |
    | J-A-N-O-W-S-K-A    |

