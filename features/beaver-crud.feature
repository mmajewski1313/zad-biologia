Feature: I would like to edit beavers

Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/beaver/"
    Then I should not see "<beaver>"
     And I follow "Create a new entry"
    Then I should see "Beaver creation"
    When I fill in "Name" with "<beaver>"
     And I fill in "Age" with "<age>"
     And I press "Create"
    Then I should see "<beaver>"
     And I should see "<age>"

  Examples:
    | beaver     | age |
    | bob        | 15  |
    | nick       | 190 |
    | joe        | 70  |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/beaver/"
    Then I should not see "<new-beaver>"
    When I follow "<old-beaver>"
    Then I should see "<old-beaver>"
    When I follow "Edit"
     And I fill in "Name" with "<new-beaver>"
     And I fill in "Age" with "<new-age>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-beaver>"
     And I should see "<new-age>"
     And I should not see "<old-beaver>"

  Examples:
    | old-beaver      | new-beaver        | new-age    |
    | bob             | N-E-W-B-O-B       | 9876       |
    | nick            | N-E-W-N-I-C-K     | 3333       |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/beaver/"
    Then I should see "<beaver>"
    When I follow "<beaver>"
    Then I should see "<beaver>"
    When I press "Delete"
    Then I should not see "<beaver>"

  Examples:
    |  beaver        |
    | N-E-W-B-O-B    |
    | N-E-W-N-I-C-K  |
    | joe            |