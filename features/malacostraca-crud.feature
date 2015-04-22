Feature: I would like to edit malacostraca

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/malacostraca/"
    Then I should not see "<malacostraca>"
     And I follow "Create a new entry"
    Then I should see "Malacostraca creation"
    When I fill in "Name" with "<malacostraca>"
     And I fill in "Age" with "<age>"
     And I press "Create"
    Then I should see "<malacostraca>"
     And I should see "<age>"

Examples:
    | malacostraca   | age |
    | Isopoda        | 11  |
    | Mictacea       | 120 |
    | Mysia          | 30  |

  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/malacostraca/"
    Then I should not see "<new-malacostraca>"
    When I follow "<old-malacostraca>"
    Then I should see "<old-malacostraca>"
    When I follow "Edit"
     And I fill in "Name" with "<new-malacostraca>"
     And I fill in "Age" with "<new-malacostraca>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-malacostraca>"
     And I should see "<new-age>"
     And I should not see "<old-malacostraca>"
Examples:
    | old-malacostraca     | new-malacostraca  | new-age  |
    | Isopoda              | Decapoda          | 45       |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/malacostraca/"
    Then I should see "<malacostraca>"
    When I follow "<malacostraca>"
    Then I should see "<malacostraca>"
    When I press "Delete"
    Then I should not see "<malacostraca>"

   Examples:
    | malacostraca   |
    | Mysia          |
 