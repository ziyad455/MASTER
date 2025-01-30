import random
import os

questions = {
  'Algorithmes et Logique': {
    'facile': [
      {'Quel est le type de données de la valeur True ?': {'A': 'bool', 'B': 'int', 'C': 'string'}},
      {'Quelle instruction permet de sortir d’une boucle en Python ?': {'A': 'exit', 'B': 'break', 'C': 'stop'}},
      {'Quel est le résultat de 2 ** 3 en Python ?': {'A': '6', 'B': '8', 'C': '9'}},
      {'Quelle est la valeur de 5 % 2 ?': {'A': '2', 'B': '1', 'C': '0'}},
      {'Quel est l’équivalent de x = x + 1 en Python ?': {'A': 'x++', 'B': '++x', 'C': 'x += 1'}}
    ],
    'Intermédiaire': [
      {'Quel algorithme est le plus efficace pour rechercher un élément dans une liste triée ?': {'A': 'Recherche linéaire', 'B': 'Recherche binaire', 'C': 'Tri rapide'}},
      {'Quelle structure de données utilise le principe FIFO ?': {'A': 'Pile', 'B': 'File', 'C': 'Dictionnaire'}}
    ],
    'Avancé': [
      {'Quelle boucle s’exécute au moins une fois, même si la condition est fausse ?': {'A': 'for', 'B': 'while', 'C': 'dowhile'}},
      {'Quel algorithme est utilisé pour trier rapidement de grandes quantités de données ?': {'A': 'Tri à bulles', 'B': 'Tri fusion', 'C': 'Tri par insertion'}}
    ]
  },
  'Bases de Données': {
    'facile': [
      {'Quelle commande SQL est utilisée pour ajouter des données dans une table ?': {'A': 'INSERT', 'B': 'UPDATE', 'C': 'SELECT'}},
      {'Quelle clé assure l’unicité des enregistrements dans une table?': {'A': 'Clé étrangère', 'B': 'Clé primaire', 'C': 'Index'}},
      {'Que signifie SQL ?': {'A': 'Structured Query Language', 'B': 'Simple Query Logic', 'C': 'Sequential Query Language'}},
      {'Quelle commande permet de récupérer toutes les données d’une table clients ?': {'A': 'SELECT * FROM clients', 'B': 'GET * FROM clients', 'C': 'SHOW * FROM clients'}},
      {'Quel type de base de données utilise SQL ?': {'A': 'Relationnelle', 'B': 'NoSQL', 'C': 'Graphique'}}
    ],
    'Intermédiaire': [
      {'Quelle commande supprime des données sans supprimer la structure de la table ?': {'A': 'DROP', 'B': 'DELETE', 'C': 'TRUNCATE'}},
      {'Quelle commande est utilisée pour modifier une table existante ?': {'A': 'ALTER', 'B': 'MODIFY', 'C': 'CHANGE'}},
      {'Quel est le rôle d’une clé étrangère ?': {'A': 'Identifier de manière unique une ligne', 'B': 'Lier deux tables', 'C': 'Créer un index'}}
    ],
    'Avancé': [
      {'Quel type de jointure renvoie les enregistrements correspondants des deux tables ?': {'A': 'LEFT JOIN', 'B': 'RIGHT JOIN', 'C': 'INNER JOIN'}},
      {'Que fait la commande DROP TABLE clients ?': {'A': 'Supprime la table et ses données', 'B': 'Supprime uniquement les données', 'C': 'Vide la table'}}
    ]
  },
  'Programmation Orientée Objet (POO)': {
    'facile': [
      {'Quel mot-clé est utilisé pour créer une classe en Python ?': {'A': 'object', 'B': 'class', 'C': 'def'}},
      {'Qu’est-ce que l’héritage en POO ?': {'A': 'La création d’une nouvelle classe sans attributs', 'B': 'Une classe qui hérite les attributs et méthodes d’une autre', 'C': 'Une copie exacte d’une classe'}},
      {'Comment appelle-t-on une fonction définie dans une classe ?': {'A': 'Méthode', 'B': 'Fonction', 'C': 'Procédure'}},
      {'Quel est le rôle du constructeur dans une classe ?': {'A': 'Détruire un objet', 'B': 'Initialiser un objet', 'C': 'Copier un objet'}}
    ],
    'Intermédiaire': [
      {'Quel mot-clé est utilisé pour créer un objet à partir d’une classe ?': {'A': 'create', 'B': 'init', 'C': 'new'}},
      {'Que signifie l’encapsulation ?': {'A': 'Regrouper les données et les méthodes dans une même classe', 'B': 'Cacher les données uniquement', 'C': 'Partager les données entre classes'}},
      {'Quelle syntaxe permet d’accéder à un attribut privé d’une classe ?': {'A': 'self.attribut', 'B': 'self.attribut', 'C': 'self._attribut'}},
      {'Quelle relation représente "est un" entre deux classes ?': {'A': 'Composition', 'B': 'Association', 'C': 'Héritage'}}
    ],
    'Avancé': [
      {'Quel concept permet d’utiliser le même nom de méthode pour des comportements différents ?': {'A': 'Encapsulation', 'B': 'Polymorphisme', 'C': 'Abstraction'}},
      {'Quel est le concept qui consiste à cacher les détails d’implémentation ?': {'A': 'Abstraction', 'B': 'Héritage', 'C': 'Polymorphisme'}}
    ]
  },
  'Développement Web Statique': {
    'facile': [
      {'Quel langage est utilisé pour structurer une page web ?': {'A': 'CSS', 'B': 'HTML', 'C': 'JavaScript'}},
      {'Quel langage est utilisé pour styliser une page web ?': {'A': 'HTML', 'B': 'JavaScript', 'C': 'CSS'}},
      {'Quelle balise HTML permet d’insérer une image ?': {'A': '<img>', 'B': '<image>', 'C': '<pic>'}},
      {'Quel attribut de la balise <a> définit le lien ?': {'A': 'href', 'B': 'link', 'C': 'src'}},
      {'Quelle propriété CSS change la couleur du texte ?': {'A': 'color', 'B': 'background-color', 'C': 'text-color'}},
      {'Quel est le rôle du fichier index.html ?': {'A': 'Page d\'erreur', 'B': 'Page principale', 'C': 'Feuille de style'}},
      {'Quelle balise est utilisée pour les listes non ordonnées ?': {'A': '<ul>', 'B': '<ol>', 'C': '<li>'}},
      {'Quel élément HTML permet de structurer un formulaire ?': {'A': '<input>', 'B': '<form>', 'C': '<textarea>'}}
    ],
    'Intermédiaire': [
      {'Quel format d\'image est le plus adapté pour des icônes ?': {'A': 'PNG', 'B': 'JPEG', 'C': 'BMP'}},
      {'Comment lier un fichier CSS à un fichier HTML ?': {'A': '<link rel="stylesheet" href="style.css">', 'B': '<style src="style.css">', 'C': '<css link="style.css">'}}
    ]
  }
}

correct_answer = {
  'Algorithmes et Logique': {
    'facile': {'Quel est le type de données de la valeur True ?': 'A', 'Quelle instruction permet de sortir d’une boucle en Python ?': 'B', 'Quel est le résultat de 2 ** 3 en Python ?': 'B', 'Quelle est la valeur de 5 % 2 ?': 'B', 'Quel est l’équivalent de x = x + 1 en Python ?': 'C'},
    'Intermédiaire': {'Quel algorithme est le plus efficace pour rechercher un élément dans une liste triée ?': 'B', 'Quelle structure de données utilise le principe FIFO ?': 'B'},
    'Avancé': {'Quelle boucle s’exécute au moins une fois, même si la condition est fausse ?': 'C', 'Quel algorithme est utilisé pour trier rapidement de grandes quantités de données ?': 'B'}
  },
  'Bases de Données': {
    'facile': {'Quelle commande SQL est utilisée pour ajouter des données dans une table ?': 'A', 'Quelle clé assure l’unicité des enregistrements dans une table?': 'B', 'Que signifie SQL ?': 'A', 'Quelle commande permet de récupérer toutes les données d’une table clients ?': 'A', 'Quel type de base de données utilise SQL ?': 'A'},
    'Intermédiaire': {'Quelle commande supprime des données sans supprimer la structure de la table ?': 'B', 'Quelle commande est utilisée pour modifier une table existante ?': 'A', 'Quel est le rôle d’une clé étrangère ?': 'B'},
    'Avancé': {'Quel type de jointure renvoie les enregistrements correspondants des deux tables ?': 'C', 'Que fait la commande DROP TABLE clients ?': 'A'}
  },
  'Programmation Orientée Objet (POO)': {
    'facile': {'Quel mot-clé est utilisé pour créer une classe en Python ?': 'B', 'Qu’est-ce que l’héritage en POO ?': 'B', 'Comment appelle-t-on une fonction définie dans une classe ?': 'A', 'Quel est le rôle du constructeur dans une classe ?': 'B'},
    'Intermédiaire': {'Quel mot-clé est utilisé pour créer un objet à partir d’une classe ?': 'C', 'Que signifie l’encapsulation ?': 'A', 'Quelle syntaxe permet d’accéder à un attribut privé d’une classe ?': 'C', 'Quelle relation représente "est un" entre deux classes ?': 'C'},
    'Avancé': {'Quel concept permet d’utiliser le même nom de méthode pour des comportements différents ?': 'B', 'Quel est le concept qui consiste à cacher les détails d’implémentation ?': 'A'}
  },
  'Développement Web Statique': {
    'facile': {'Quel langage est utilisé pour structurer une page web ?': 'B', 'Quel langage est utilisé pour styliser une page web ?': 'C', 'Quelle balise HTML permet d’insérer une image ?': 'A', 'Quel attribut de la balise <a> définit le lien ?': 'A', 'Quelle propriété CSS change la couleur du texte ?': 'A', 'Quel est le rôle du fichier index.html ?': 'B', 'Quelle balise est utilisée pour les listes non ordonnées ?': 'A', 'Quel élément HTML permet de structurer un formulaire ?': 'B'},
    'Intermédiaire': {'Quel format d\'image est le plus adapté pour des icônes ?': 'A', 'Comment lier un fichier CSS à un fichier HTML ?': 'A'}
  }
}

def choisir_categorie(choix):
  categoris = {
    1: 'Algorithmes et Logique',
    2: 'Bases de Données',
    3: 'Programmation Orientée Objet (POO)',
    4: 'Développement Web Statique'
  }
  return categoris.get(choix, "choix invalide")

  

def choisir_niveau(niveau):
  niveau = {
    1: 'facile',
    2: 'Intermédiaire',
    3: 'Avancé'}
  return niveau.get(niveau, "choix invalide")

def choisir_question(categorie, level, nombre_questions):
  if nombre_questions > len(questions[categorie][level]):
    return "le nombre de question est superieur a la liste de question"
  else:
    return random.sample(questions[categorie][level], nombre_questions)


def main():
  while True:
    print("*****Bienvenue dans le quiz de programmation******")
    print()
    print("Choisissez une matiere: ")
    print("1. Algorithmes et Logique")
    print("2. Bases de Données")
    print("3. Programmation Orientée Objet (POO)")
    print("4. Développement Web Statique")
    try:
      choix = int(input("enter votre choix: "))
    except ValueError:
      print("Entrée invalide, veuillez entrer un nombre.")
      continue
    categorie = choisir_categorie(choix)
    if categorie == "choix invalide":
      print(f"{categorie}")
      continue
    break

  print()
  while True:
    print("Choisissez un niveau: ")
    print("1. Facile")
    print("2. Intermédiaire")
    print("3. Avancé")
    try:
      niveau = int(input("enter votre choix: "))
    except ValueError:
      print("Entrée invalide, veuillez entrer un nombre.")
      continue
    level = choisir_niveau(niveau)
    if level == "choix invalide":
      print(level)
      continue
    break

  while True:
    print()
    print("Combien de questions vous voulez répondre?")
    try:
      nombre_questions = int(input("enter votre choix: "))
    except ValueError:
      print("Entrée invalide, veuillez entrer un nombre.")
      continue

    questions_selectionnees = choisir_question(categorie, level, nombre_questions)
    if questions_selectionnees == "le nombre de question est superieur a la liste de question":
      print('Le nombre de question est superieur a la liste de question')
      continue
    elif nombre_questions <= 0:
      print("Le nombre de question doit être supérieur à 0")
      continue
    else:
      input("Appuyez sur entrée pour commencer")
      os.system('cls')
      score = 0
      for question in questions_selectionnees:
        for q, options in question.items():
          print(q)
          for option, answer in options.items():
            print(f"{option}: {answer}")

          reponse = input("Réponse: ").upper()

          if reponse == correct_answer[categorie][level][q]:
            print("Correct")
            score += 1
          else:
            print(f"incorrect answer \n  the correct answer is {correct_answer[categorie][level][q]}")
            
          print()

      print(f"Votre score est {score}/{nombre_questions}")
      rejouer = input("Voulez-vous rejouer? (O/N): ").upper()
      if rejouer != "O":
        break
      else:
        os.system('cls')
        continue
  

if __name__ == "__main__":
  main()
