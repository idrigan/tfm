Feature: save musical tastes by user

  As a user
  Minimun a musical taste and a user

  Rules:
    - User not null

  Scenario: Save musical taste by user
    Given the user "idrigan@gmail.com" for taste musical
    And with a taste musical "Blues"
    When executing the saveMusicalTastesUseCase
    Then A musical tastes is saved