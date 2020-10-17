



## Projet chef d'oeuvre Simplon
#### William Szurkowski


Suite a ma discussion avec Marie et mon maitre, il a été convenu que le developpement d'un prototype de module de CMS (Prestashop) serait un projet adéquat pour mon projet Chef d'Oeuvre.

Voici le [lien](https://www.caves-legrand.com/) vers le site de l'entreprise

[Synthèse du stage ayant permi de choisir Prestashop comme CMS](https://github.com/wSzki/lg)*
  *Ce repository est privé


    Entreprise :        Caves Legrand Filles & Fils
    
    Type d'entreprise : E-commerce de vin (vin de type primeur / préventes de vins)
    Site web actuel :   https://www.caves-legrand.com/ 
    Projet :            Refonte du site web via un CMS
    Raison du projet :  Minimisation des couts de developpement / maintenance
    
    CMS choisi :        PRESTASHOP
    Language utilisé :  PHP
    Frameworks :        Smarty, Symfony

---
    Sujet du projet Chef d'Oeuvre : Création d'un prototype fonctionnel de module Prestashop
    Nature du module :              Gérer les options de conditionnement des vins en prévente
                                        
    Un vin peut etre vendu en bouteille ou en magnum, avec des tailles de caisses differentes. 
    Les bouteilles  et caisses sont facturées et doivent pouvoir être a la fois 
      - ajoutés au total TTC du panier du client.
      - déstockées de la base de données.


    Le front-end de ce module consistera en :
      - L'insertion des options de conditionnement dans les pages des produits concernés
      - L'affichage des disponibilités des divers types de conditionnement
      - La prise en compte du prix des options, et ajout dans le panier
      - Ajout d'une interface graphique dans le back office 
        > Gérer l'activation du module par catégorie de produit
    Le
     back-end :
      - Destockage des options dans la base de données (bouteilles, caisses)
      - Création d'une nouvelle catégorie de produit dans la BDD (vin primeur)


Voici un exemple de module qui corresponderait aux besoins de l'entreprise
[Module](https://addons.prestashop.com/en/combinaisons-customization/19536-product-options-bundles-and-customization.html)