Feature: I would like to edit fungus

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/fungus/"
    Then I should not see "<fungus>"
    And I follow "Create a new entry"
    Then I should see "Fungus creation"
    When I fill in "Name" with "<fungus>"
    And I fill in "Age" with "<age>"
    And I press "Create"
    Then I should see "<fungus>"
    And I should see "<age>"

  Examples:
    | fungus      | age |
    | mold        | 123 |
    | amanita     | 10  |
    | sarcosypha  | 798 |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/fungus/"
    Then I should not see "<new-fungus"
    When I follow "<old-fungus>"
    Then I should see "<old-fungus>"
    When I follow "Edit"
    And I fill in "Name" with "<new-fungus>"
    And I fill in "Age" with "<new-age>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-fungus>"
    And I should see "<new-age>"
    And I should not see "<old-fungus>"

  Examples:
    | old-fungus      | new-fungus        | new-age    |
    | amanita         | N-E-W-A-M-A       | 1111       |
    | sarcosypha      | N-E-W-S-A-R       | 2345       |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/fungus/"
    Then I should see "<fungus>"
    When I follow "<fungus>"
    Then I should see "<fungus>"
    When I press "Delete"
    Then I should not see "<fungus>"

  Examples:
    |  fungus     |
    | mold        |
    | N-E-W-A-M-A |
    | N-E-W-S-A-R |

