Feature: I would like to edit dog

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/dog/"
    Then I should not see "<dog>"
    And I follow "Create a new entry"
    Then I should see "Dog creation"
    When I fill in "Name" with "<dog>"
    And I fill in "Age" with "<age>"
    And I press "Create"
    Then I should see "<dog>"
    And I should see "<age>"

  Examples:
    | dog           | age |
    | labrador      | 3   |
    | husky         | 4   |
    | cocer-spaniel | 2   |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/dog/"
    Then I should not see "<new-dog>"
    When I follow "<old-dog>"
    Then I should see "<old-dog>"
    When I follow "Edit"
    And I fill in "Name" with "<new-dog>"
    And I fill in "Age" with "<new-age>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-dog>"
    And I should see "<new-age>"
    And I should not see "<old-dog>"

  Examples:
    | old-dog    | new-dog         | new-age |
    | labrador   | L-A-B-R-A-D-O-R | 13      |
    | husky      | H-U-S-K-Y       | 12      |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/dog/"
    Then I should see "<dog>"
    When I follow "<dog>"
    Then I should see "<dog>"
    When I press "Delete"
    Then I should not see "<dog>"

  Examples:
    |  elephant           |
    | L-A-B-R-A-D-O-R     |
    | H-U-S-K-Y           |
    | cocer-spaniel       |

