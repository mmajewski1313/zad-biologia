Feature: I would like to edit bears

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bears/"
    Then I should not see "<bears>"
    And I follow "Create a new entry"
    Then I should see "Bears creation"
    When I fill in "Name" with "<bears>"
    And I fill in "Weight" with "<weight>"
    And I press "Create"
    Then I should see "<bears>"
    And I should see "<weight>"

  Examples:
    |bears          |weight |
    |american bear  |430    |
    |polar bear     |300    |
    |brown bear     |780    |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bears/"
    Then I should not see "<new-bears>"
    When I follow "<old-bears>"
    Then I should see "<old-bears>"
    When I follow "Edit"
    And I fill in "Name" with "<new-bears>"
    And I fill in "Capture" with "<new-weight>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-bears>"
    And I should see "<new-weight>"
    And I should not see "<old-bears>"

  Examples:
    |old-bears     |new-bears |new-weight|
    |american bear |cave bear |500       |
    |brown bear    |blue bear |400       |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/bears/"
    Then I should see "<bears>"
    When I follow "<bears>"
    Then I should see "<bears>"
    When I press "Delete"
    Then I should not see "<bears>"

  Examples:
    |bears      |
    |cave bear  |
    |polar bear |
    |blue bear  |

