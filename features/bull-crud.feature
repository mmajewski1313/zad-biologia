Feature: I would like to edit bull

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bull/"
    Then I should not see "<bull>"
    And I follow "Create a new entry"
    Then I should see "bull creation"
    When I fill in "Name" with "<bull>"
    And I fill in "Weight" with "<weight>"
    And I press "Create"
    Then I should see "<bull>"
    And I should see "<weight>"

  Examples:
    |bull           |weight |
    |simental       |1200   |
    |galloway       |800    |
    |angus          |800    |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bull/"
    Then I should not see "<new-bull>"
    When I follow "<old-bull>"
    Then I should see "<old-bull>"
    When I follow "Edit"
    And I fill in "Name" with "<new-bull>"
    And I fill in "Weight" with "<new-weight>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-bull>"
    And I should see "<new-weight>"
    And I should not see "<old-bull>"

  Examples:
    |old-bull      |new-bull  |new-weight|
    |simental      |highland  |625       |
    |galloway      |hereford  |835       |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bull/"
    Then I should see "<bull>"
    When I follow "<bull>"
    Then I should see "<bull>"
    When I press "Delete"
    Then I should not see "<bull>"

  Examples:
    |bull       |
    |simental   |
    |galloway   |
    |highland   |

