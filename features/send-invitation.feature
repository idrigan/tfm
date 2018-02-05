Feature: send invitation to email
  As a user web
  I want send invitation

  Rules:
  - User is not null
  - Send email valid

  Scenario: Send invitation to email
    Given recipient valid email "prueba@gmail.com"
    When send invitation
    Then invitation sent
