Feature: save musical tastes by user

  As a user
  Minimun a musical taste and a user

  Rules:
  - User not null

  Scenario: Save musical taste by user
    Given a user from session "idrigan@gmail.com"
    And a taste musical "Rock"
    When executing the saveMusicalTastesUseCase
    Then A musical tastes is saved
