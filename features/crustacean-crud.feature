Feature: I would like to edit viruses

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/viruses/"
    Then I should not see "<viruses>"
    And I follow "Create a new entry"
    Then I should see "Viruses creation"
    When I fill in "Name" with "<viruses>"
    And I fill in "Capture" with "<size>"
    And I press "Create"
    Then I should see "<viruses>"
    And I should see "<size>"

  Examples:
    | viruses     | size |
    | Ebola         | 1    |
    | HIV           | 2    |
    | Echo        | 3     |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/viruses/"
    Then I should not see "<new-viruses>"
    When I follow "<old-viruses>"
    Then I should see "<old-viruses>"
    When I follow "Edit"
    And I fill in "Name" with "<new-viruses>"
    And I fill in "Capture" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-viruses>"
    And I should see "<new-size>"
    And I should not see "<old-viruses>"

  Examples:
    | old-viruses  | new-viruses    | new-size |
    | Ebola          | Hendra             | 4        |
    | HIV          | Junin          | 5         |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/viruses/"
    Then I should see "<viruses>"
    When I follow "<viruses>"
    Then I should see "<viruses>"
    When I press "Delete"
    Then I should not see "<viruses>"

  Examples:
    |  crustacean |
    | ABC       |
    | BCA        |
    | CBA    |

