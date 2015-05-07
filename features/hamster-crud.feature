Feature: I would like to edit hamsters

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/hamster/"
    Then I should not see "<hamster>"
     And I follow "Create a new entry"
    Then I should see "Hamster creation"
    When I fill in "Name" with "<hamster>"
     And I fill in "Age" with "<age>"
     And I press "Create"
    Then I should see "<hamster>"
     And I should see "<age>"

Examples:

    | hamster     | age |
    | bolek       | 2   |
    | lolek       | 1   |
    | romek       | 3   |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/hamster/"
    Then I should not see "<new-hamster>"
    When I follow "<old-hamster>"
    Then I should see "<old-hamster>"
    When I follow "Edit"
     And I fill in "Name" with "<new-hamster>"
     And I fill in "Age" with "<new-age>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-hamster>"
     And I should see "<new-age>"
     And I should not see "<old-hamster>"

  Examples:
    | old-hamster     | new-hamster  | new-age    |
    | bolek           | ATOMEK       | 2    	|
    | lolek           | ZIOMEK       | 3          |
    


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/hamster/"
    Then I should see "<hamster>"
    When I follow "<hamster>"
    Then I should see "<hamster>"
    When I press "Delete"
    Then I should not see "<hamster>"

  Examples:
    |  hamster     |
    |	ATOMEK     |
    |   ZIOMEK     |

