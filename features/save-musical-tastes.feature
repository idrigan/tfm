Feature: save musical tastes by user

  As a user
  Minimun a musical taste and a user

  Rules:
    - User not null

  Scenario: Save musical taste by user
    Given user from session
    And with a taste musical
    When executing the saveMusicalTastesUseCase
    Then A musical tastes is saved