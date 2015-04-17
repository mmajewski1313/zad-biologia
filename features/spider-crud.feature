Feature: I would like to edit spiders

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/spider/"
    Then I should not see "<spider>"
    And I follow "Create a new entry"
    Then I should see "Spider creation"
    When I fill in "Name" with "<spider>"
    And I fill in "Legspan" with "<legspan>"
    And I press "Create"
    Then I should see "<spider>"
    And I should see "<legspan>"

  Examples:
    | spider         | legspan |
    | Brachionopus   | 6       |
    | Augacephalus   | 7       |
    | Eucratoscelus  | 5       |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/spider/"
    Then I should not see "<new-spider>"
    When I follow "<old-spider>"
    Then I should see "<old-spider>"
    When I follow "Edit"
    And I fill in "Name" with "<new-spider>"
    And I fill in "Legspan" with "<new-legspan>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-spider>"
    And I should see "<new-legspan>"
    And I should not see "<old-spider>"

  Examples:
    | old-spider     | new-spider  | new-legspan    |
    | Brachionopus   | N-E-W-B-R-A | 22             |
    | Augacephalus   | N-E-W-A-U-G | 12             |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/spider/"
    Then I should see "<spider>"
    When I follow "<spider>"
    Then I should see "<spider>"
    When I press "Delete"
    Then I should not see "<spider>"

  Examples:
    |  spider         |
    | Eucratoscelus   |
    | N-E-W-B-R-A     |
    | N-E-W-A-U-G     |

