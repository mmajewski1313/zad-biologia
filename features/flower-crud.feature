Feature: I would like to edit flower

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/flower/"
    Then I should not see "<flower>"
     And I follow "Create a new entry"
    Then I should see "Flower creation"
    When I fill in "Name" with "<flower>"
     And I fill in "Height" with "<height>"
     And I press "Create"
    Then I should see "<flower>"
     And I should see "<height>"

  Examples:
    | flower         | height |
    | rose           | 6      |
    | iris           | 15     |
    | lilium         | 3      |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/flower/"
    Then I should not see "<new-flower>"
    When I follow "<old-flower>"
    Then I should see "<old-flower>"
    When I follow "Edit"
     And I fill in "Name" with "<new-flower>"
     And I fill in "Height" with "<new-height>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-flower>"
     And I should see "<new-height>"
     And I should not see "<old-flower>"

  Examples:
    | old-flower     | new-flower   | new-height    |
    | rose           | tulip        | 7             |
    | iris           | bellis       | 2             |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/flower/"
    Then I should see "<flower>"
    When I follow "<flower>"
    Then I should see "<flower>"
    When I press "Delete"
    Then I should not see "<flower>"

  Examples:
    |  flower      |
    | lilium       |
    | tulip        |
    | bellis       |