Feature: user login
  As a anonymous user
  Anonymous user registers on the web

  Rules:
  - User null

  Scenario: login user in application
    Given valid email "idrigan@gmail.com"
    When executing the Google Auth give name "Carlos" familyName "González" picture "https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg"
    Then user register in system
