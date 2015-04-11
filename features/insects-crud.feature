Feature: I would like to edit insects

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/insects/"
    Then I should not see "<insects>"
     And I follow "Create a new entry"
    Then I should see "insects creation"
    When I fill in "Name" with "<insects>"
     And I fill in "Age" with "<age>"
     And I press "Create"
    Then I should see "<insects>"
     And I should see "<age>"


  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/insects/"
    Then I should not see "<new-insects>"
    When I follow "<old-insects>"
    Then I should see "<old-insects>"
    When I follow "Edit"
     And I fill in "Name" with "<new-insects>"
     And I fill in "Age" with "<new-insects>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-insects>"
     And I should see "<new-age>"
     And I should not see "<old-insects>"

  


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/insects/"
    Then I should see "<insects>"
    When I follow "<insects>"
    Then I should see "<insects>"
    When I press "Delete"
    Then I should not see "<insects>"

  