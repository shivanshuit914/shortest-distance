Feature: Find shortest distance between two contributor users

  Scenario: Path not found
    Given User "A" has contributed to repositories "R1,R2,R5"
    And User "B" has contributed to repositories "R4,R6"
    When Client request for distance between user "A" and user "B"
    Then System will response with  message "Path not found between A and B"

  Scenario: Path found
    Given User "A" has contributed to repositories "R1,R2,R5"
    And User "B" has contributed to repositories "R2,R3"
    When Client request for distance between user "A" and user "B"
    Then System will response with  message "Shortest distance path between A and B is A -> R2 -> B"

  Scenario: Shortest Path found
    Given User "A" has contributed to repositories "R1,R2,R5"
    And User "B" has contributed to repositories "R2,R3"
    And User "C" has contributed to repositories "R3,R4,R5"
    When Client request for distance between user "A" and user "C"
    Then System will response with  message "Shortest distance path between A and C is A -> R5 -> C"
