Feature: I would like to edit reptiles

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/reptile/"
    Then I should not see "<reptile>"
    And I follow "Create a new entry"
    Then I should see "Reptile creation"
    When I fill in "Name" with "<reptile>"
    And I fill in "Age" with "<age>"
    And I press "Create"
    Then I should see "<reptile>"
    And I should see "<age>"

  Examples:
    | reptile     | age |
    | viper       | 15  |
    | turtle      | 190 |
    | crocodile   | 70  |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/reptile/"
    Then I should not see "<new-reptile>"
    When I follow "<old-reptile>"
    Then I should see "<old-reptile>"
    When I follow "Edit"
    And I fill in "Name" with "<new-reptile>"
    And I fill in "Age" with "<new-age>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-reptile>"
    And I should see "<new-age>"
    And I should not see "<old-reptile>"

  Examples:
    | old-reptile     | new-reptile  | new-age    |
    | viper           | N-E-W-V-I-P       | 9876       |
    | turtle          | T-U-R-T-U-R       | 3333       |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/reptile/"
    Then I should see "<reptile>"
    When I follow "<reptile>"
    Then I should see "<reptile>"
    When I press "Delete"
    Then I should not see "<reptile>"

  Examples:
    |  reptile    |
    | crocodile   |
    | N-E-W-V-I-P |
    | T-U-R-T-U-R |

