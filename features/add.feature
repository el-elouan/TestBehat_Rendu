Feature: AddBook
    In order to add a book
    As a user
    Test fonctionnel sur l'ajout d'un livre
    Scenario: test add I fill nom and auteur and edition and information
    Given I am on the addLivre page
    And I add "LeTitre" as nom and "Thomas" as auteur and "Gaumont" as edition and "non donnee" as information
    When I submit the form
    Then I should see addLivre