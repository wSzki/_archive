
  
<div align="center"> 
<img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.caves-legrand.com%2Fimages%2Flogo-caves-legrand.png&f=1&nofb=1">
</div>

---

<div align="center">
<p style="font-size:32px"> Etude de CMS</p>
<img src="./img/pre.png">
</div>

---

<div style="background-color: bisque">

## **[INDEX]**


  * **I. [Pourquoi cette étude](https://github.com/wSzki/lg#i-pourquoi-cette-%C3%A9tude)**
  * **II. [Les problématiques e-commerce liées aux besoins de LFF](https://github.com/wSzki/lg#ii-les-probl%C3%A9matiques-e-commerce-li%C3%A9es-aux-besoins-de-lff)**
    * A. [Vente de produit HT et TTC dans un meme panier]
    * B. [Multitude de references, d'options de conditionnement et d'envoi]
    * C. [Catalogue de vins sous allocation accessible a un type de clientèle précis, mais visible à tous]
    * D. [Vente de produit livrable et non livrable]
  * **III. [Pourquoi Prestashop - Comparatif des differents CMS](https://github.com/wSzki/lg#iii-pourquoi-prestashop)**
    * A. [Liste des CMS étudiés]
    * B. [Descriptif de differents CMS]
      * Prestashop
      * Magento
      * Shopify

  * **IV. [Liste et coût des modules prestashop répondant aux problématiques](https://github.com/wSzki/lg#iv-liste-et-co%C3%BBt-des-modules-prestashop-pouvant-r%C3%A9pondre-aux-probl%C3%A9matiques)**
  * **V. [Modifications et développement à effectuer sur la structure du template Prestashop et les modules](https://github.com/wSzki/lg#v-modifications-et-d%C3%A9veloppement-%C3%A0-effectuer-sur-la-structure-du-template-prestashop-et-les-modules)**

</div>


---

## **I. [Pourquoi cette étude?]**
[Retour vers l'index](https://github.com/wSzki/lg#index)

<details>
  <summary>Cliquez pour ouvrir</summary>
  

Dans le cadre d'une refonte du site web (https://www.caves-legrand.com/), face aux coûts élevés de development web, Monsieur Neveux a initié l'étude des CMS existants (Content Management System, ou système de gestion de contenu > voir VINIUM) afin de définir s'il en existe un ou plusieurs pouvant répondre aux besoins spécifiques de LFF (cités plus bas).

L'utilisation d'un CMS permettrait de réduire les coûts de développement :

- Maintenabilité accrue, car utilisation d'un environnement de développement standardisé. "Bonnes pratiques" de développement définies, documentation existante.

- Développement plus simple, rapide, car existence de "modules" éventuellement modifiables (fonctionnalités génériques de type paiement, livraison etc.) 

</details>

---


## **II. [Les problématiques e-commerce liées aux besoins de LFF]**
[Retour vers l'index](https://github.com/wSzki/lg#index)

<details>
  <summary>Cliquez pour ouvrir</summary>
  
#### A. _[Vente de produit HT et TTC dans un meme panier]_


- Difference de prix HT et TTC
  * Prix HT pour professionels
  * Prix HT sur les primeurs
    > Les primeurs sont facturés HT, puis TTC + frais de port et de conditionnement lors de l'expedition
    > Les vins non primeur integrent le prix du conditionnement.

#### B. _[Multitude de references, d'options de conditionnement et d'envoi]_

- Differentes references :
  * **134** references de vins primeur au 01/03/2020 [Bordeaux uniquement]
  * **350** references de selection de vins au 01/03/2020 [Bordeaux uniquement]
  * **3700** vins référencés au total
  * Une partie du catalogue est **"sous allocation"**, soit non references sur le site / catalogue, reserves pour un type de clientele. 
  </br>
- Differentes options de conditionnement :
  * Bouteilles = Mangnums, Bouteilles de 75cL
  * Caisses = Differents types 
  </br>
- Differentes options d'envoi
  * Services de livraison 
    * Livraison UPS/COLISSIMO, Transporteur privé, retrait en magasin.
      > Voir **[UPELA](https://www.upela.com/en/)**

  * Variables dans le calcul du prix total :
    * Prix de la livraison en fonction de la distance et du poids
    * Prix du caissage et des bouteilles utilisées 
  </br>

- Options de paiement:
  * CB
  * Mastercard
  * Visa
  > AMEX [NON] car 2.5% comission  
  > Paypal [NON] car 5% comission

#### C. _[Catalogue de vins **sous allocation** accessible a un type de clientèle précis, mais visible à tous]_

- Bot de suggestion, de type [MATCHA](https://www.matcha.wine/#home)
  * Permet de se passer d'un catalogue classique

  </br>

- Utilisation d'un catalogue privé
  * Le catalogue doit etre consultable par l'ensemble de la clientele
  * Separation du catalogue de vins sous allocation du reste du catalogue, pour eviter l'abondance de produits hors stocks.

#### D. _[Vente de produit livrable et non livrable]_

- Degustation 
  * Evenement - vente d'une place pour degustation.
    * Prix - 80 euros en moyenne variable de 65 a 190 euros
    * Reservation pour 1 a 5 personnes
  </br>

- Primeur 
  * Vente d'une cuvée dans différents formats et caissages + prix de vente HT avec des supplements en fonction des formats de caissage
  </br>

- Bons cadeau pour degustation - diner



</details>

---


## **III. [Pourquoi Prestashop]**
[Retour vers l'index](https://github.com/wSzki/lg#index)

<details>
  <summary>Cliquez pour ouvrir</summary>

  ### A PROPOS

  > Prestashop semble ếtre la solution la plus adéquate en terme de fonctionnalité et de coût.
  > Il s'agit d'un service de création de site web Open Source, ce qui implique que le code est accessible et modifiable á souhait.

  > Prestashop utilise le language de programmation PHP (très bien documenté et répandu), qui existe notamment pour relier les bases de données au front-end (client)
  > Malgré la compatibilité limitée avec les versions précédentes, le passage en v1.7 introduit l'utilisation du framework Symfony (en plus du framework Smarty), dans le but de faciliter et de fluidifier le développement.
  ---



#### A. **[Comparatif des differents CMS]**

| CMS             | COMMENTAIRE                                                                                 |
| --------------- | ------------------------------------------------------------------------------------------- |
| PRESTAHOP       | > Open source, coût faible des modules (paiement unique), mais documentation assez légère   |
| ~~SHOPIFY~~     | > Plugins non editables - Ne repondent pas specifiquement aux besoins de LFF - coûts élevés |
| ~~MAGENTO~~     | > Bilbiotheque de plugin peu fournie, coûts de developpement élevés                         |
| ~~WOOCOMMERCE~~ | > Framework basé sur Wordpress, a priori peu de support, facturation des plugins mensuelle  |
| ~~DRUPAL~~      | > CMF (Content Management Framework) a proscrire car implique trop de developpement         |
| ~~LARAVEL~~     | > CMF (Content Management Framework) a proscrire car implique trop de developpement         |
| ~~OPENCART~~    | > Ne repond pas aux besoins - Trop  peu de fonctionnalités                                  |
| ~~TYPO3~~       | > Ne repond pas aux besoins - Trop peu de fonctionnalités                                   |
| ~~BIGCOMMERCE~~ | > Ne repond pas aux besoins - Trop peu de fonctionnalités                                   |
| ~~CRAFTCMS~~    | > Ne repond pas aux besoins - Trop peu de fonctionnalités                                   |
| ~~SANITY~~      | > Ne repond pas aux besoins - Trop peu de fonctionnalités                                   |
| ~~3DCART~~      | > Ne repond pas aux besoins - Trop peu de fonctionnalités                                   |

---

  #### B. **[Descriptif de différents CMS]**

#### PrestaShop
<details>
  <summary>Cliquez pour ouvrir</summary>
  
  > PrestaShop est une solution de commerce électronique libre et open source pour les marchands en ligne. Selon les statistiques de PrestaShop, plus de 300 000 e-entreprises dans le monde utilisent sa technologie. La plate-forme est couramment utilisée lorsque les magasins installent et personnalisent facilement le logiciel. Vous êtes libre de sélectionner une version entièrement hébergée ou auto-hébergée. Par conséquent, vous pouvez déterminer votre niveau de contrôle technique.
  > 
  > Outre la fonctionnalité intégrée de PrestaShop, les utilisateurs peuvent étendre la plateforme en utilisant des plugins et des thèmes. 
  > Prestashop étant Open Source et utilisant PHP (un language de programmation tres repandu), il est possible de récupérer le code source des modules afin d'etendre ou de modifier leur fonctionnalité.

  > Tout le service de base de Prestashop est gratuit. Il n'y a aucune comission sur les ventes, ni frais d'utilisation.
  > Les modules sont payants, et le service d'hebergement du site devra étre géré par LFF. mais cela implique des frais moindre á ce niveau.

  > Prestashop propose également un service de migration de site :
  https://www.prestashop.com/en/switch-to-prestashop 



| PRO                                                                                   | CON                                                                                                                |
| ------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------ |
| Versatile, facile a apprendre et a maintenir                                          | Quelques bugs dans l'interface back-end á noter                                                                    |
| Prix (gratuit), personnalisable                                                       | Documentation assez éparse depuis le passage en version 1.7 - compatibilité avec les versions précédentes limitées |
| Bon template SEO - bonne interface backoffice - API - coût de dev relativement faible |                                                                                                                    |
| Utilisation des frameworks Symfony, Smarty                                            |                                                                                                                    |

</details>

#### Magento
<details>
  <summary>Cliquez pour ouvrir</summary>
  
  > Magento est connue comme la principale plate-forme de commerce électronique open source. Le système est développé en PHP qui permet aux propriétaires de magasins de créer facilement leurs entreprises en ligne. La plate-forme prend en charge toutes les tailles d'entreprise et répond aux besoins des entreprises en B2B, omnicanal, commerce mobile, etc. En outre, Magento permet l'intégration avec plusieurs extensions de tiers, créant des expériences de vente au détail numériques distinctes.
  >
  > Pus de 100 milliards de dollars de marchandises brutes sont traitées par Magento chaque année. Magento a construit une communauté florissante avec plus de 300 000 développeurs Magento dans le monde. En outre, il propose le grand marché Magento où plusieurs extensions sont disponibles au téléchargement.

  > Magento utilise, comme Prestahop le language PHP et est Open source, mais la difference des deux CMS repose dans la complexité de la structure du code.

  > De par sa compléxité, Magento nécessite des developpeurs spécialisés pour la maintenance/developpement du site.
  > Le taux horaire pour le développement de Magento peut varier de 95 $ à 250 $.

  > La version Magento sans support est gratuite (hors couts d'hebergement), la version "Entreprise" avec support et davantage de fonctionnalités est facturée 18.000 $ / an

  https://sherocommerce.com/how-much-does-a-magento-website-cost-general-pricing-guidelines-and-what-to-look-for/#ee
  https://aionhill.com/en/magento-pricing/

  | PRO                                                         | CON                              |
  | ----------------------------------------------------------- | -------------------------------- |
  | Tres flexible                                               | Tres complexe                    |
  | Prix (gratuit pour la version de base, mais pas de support) | Cout de developpement très élevé |
  | Utilisation de PHP                                          |                                  |
  | Open source                                                 |                                  |

</details>

#### Shopify
<details>
  <summary>Cliquez pour ouvrir</summary>

  > Shopify est une plateforme de commerce électronique flexible. Selon le rapport Shopify, plus de 800 000 entreprises dans le monde utilisent la plateforme Shopify. Ce chiffre a rapporté plus de 41,1 milliards de marchandises brutes totales pour Shopify en 2018.
  > 
  > Shopify est considéré comme une plateforme de commerce électronique tout-en-un. Les petits commerçants peuvent configurer leurs boutiques en ligne, gérer leurs produits et gérer toutes les commandes dans un seul tableau de bord. L'intégration gratuite avec eBay et Amazon sans code personnalisé est un avantage notable de Shopify.
  > 
  > Shopify propose également des remises prénégotiées avec DHL, UPS, USPS.
  > 
  > Néanmoins shopify peut se révéler couteux : l'utilisation du service et des plug-ins est facturée mensuellement, et un prélevement est effectué par shopify sur chaque vente (a la maniere d'eBay ou Amazon)
  > De plus, les modules n'etant pas Open Source, il n'est pas possible de les modifier. 
  > Répondre aux problématiques LFF devient alors davantage onéreux car le developpement des fonctionnalités devra se faire de zero.

|                                                                            | Basique     | Pro         | Avancé      |
| -------------------------------------------------------------------------- | ----------- | ----------- | ----------- |
| Cout d'utilisation du CMS par mois                                         | 29$ / mois  | 79$ / mois  | 299$ / mois |
| Remises sur prix de la livraison pré-négotiées avec DHL Express, UPS, USPS | Jusqu'a 64% | Jusqu'a 72% | Jusqu'a 74% |
| Taux prélevé á chaque paiement via CB, via le service SHohify Payments     | 2.9%        | 2.6%        | 2.4%        |
| Taux prélevés si utilisation d'un autre service de paiement                | 2%          | 1%          | 0.5%        |
|                                                                            |             |             |             |

| PROS                                       | CONS                                                                                              |
| ------------------------------------------ | ------------------------------------------------------------------------------------------------- |
| Bon support client pour les plugins natifs | Chaque module est loué. Redevance mensuelle                                                       |
| De nombreux plugins disponibles            | Les plugins ne sont pas open source. Impossible de les personnaliser. Code source non disponible. |
| Remises d'expédition pré-négociées         | Développement des plugins pour ajouter des fonctionnalités assez limité                           |
| Les thèmes sont facilement modifiables     | Les plugins existants ne répondent pas exactement aux demandes particulières de LFF               |
| Excellente documentation                   | Prélevement d'un pourcentage du prix total á chaque vente                                         |


##### PLUGINS SHOPIFY (Ne repondent pas exactement aux besoins)

| Problematique                          | Plugin                                                                                                                                                                             | Prix du plugin                |
| -------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------- |
| [Vente des primeur - paiement partiel] | [PreOrder Plugin with Partial Pay](https://apps.shopify.com/advanced-pre-order)                                                                                                    | [8.99, 15.99, 27.00$ / month] |
| [Vente des primeur - paiement partiel] | [Partial Payments](https://apps.shopify.com/split-partial-payments?surface_detail=partiql+pay&surface_inter_position=1&surface_intra_position=5&surface_type=search)               | [9.95, 18.95 $ / month]       |
| [Vente des primeur - paiement partiel] | [Pre-Order](https://apps.shopify.com/pre-order?surface_detail=pre+order&surface_inter_position=1&surface_intra_position=4&surface_type=search)                                     | [25, 34 $ / month]            |
| [Caissage / Conditionnement]           | [Infinite Options](https://apps.shopify.com/custom-options?surface_detail=infinite+options&surface_inter_position=1&surface_intra_position=4&surface_type=search)                  | [6$ / month]                  |
| [Caissage / Conditionnement]           | [Option Customizer](https://apps.shopify.com/product-customizer?surface_detail=premium&surface_inter_position=1&surface_intra_position=11&surface_type=search)                     | [10, 20, 100$ / month]        |
| [Livraison]                            | [Shippo](https://apps.shopify.com/shippo?ot=c9ae25f9-a85b-4a3d-96fe-fc2dc6b1c69e&surface_detail=shipping&surface_inter_position=1&surface_intra_position=2&surface_type=search_ad) | [0.05$ per label]             |
| [Livraison]                            | [SendCloud](https://apps.shopify.com/sendcloud?surface_detail=shipping&surface_inter_position=1&surface_intra_position=3&surface_type=search)                                      | [45, 100, 200$ / month]       |
| [Livraison]                            | [Boxtal](https://apps.shopify.com/boxtal?surface_detail=shipping&surface_inter_position=1&surface_intra_position=18&surface_type=search)                                           | Free                          |
| [Vins Sous Allocation]                 | Ventes Flash [Smart Flash Sales](https://apps.shopify.com/daily-deals-6?surface_detail=flash+sales&surface_inter_position=1&surface_intra_position=4&surface_type=search)          | [20$ / month]                 |
| [Vins Sous Allocation]                 | [Flash Sales and Urgency](https://apps.shopify.com/discount-app?surface_detail=flash+sales&surface_inter_position=1&surface_intra_position=5&surface_type=search)                  | [9, 15, 20$ / month]          |
| [Vins Sous Allocation]                 | [Memberships](https://apps.shopify.com/recurring-memberships?surface_detail=member&surface_inter_position=1&surface_intra_position=5&surface_type=search)                          | [10$ / month]                 |
| [Vins Sous Allocation]                 | [MAGICPASS WHOLESALE](https://apps.shopify.com/password-protected-pages?surface_detail=member&surface_inter_position=2&surface_intra_position=13&surface_type=search)              | [5, 20, 50, 100$ / month]     |

</details>



</details>

---

## **IV. [Liste et coût des modules Prestashop pouvant répondre aux problématiques]**
[Retour vers l'index](https://github.com/wSzki/lg#index)

<details>
  <summary>Cliquez pour ouvrir</summary>

### A PROPOS
  > Les modules mentionnés ci dessous ne répondent pas spécifiquement aux problématiques.
  > Néannmoins, il est possible de les développer dans ce but; leur faible coût (par rapport au prix d'un developpement à partir de zéro) les rendent pertinents pour répondre aux problématiques.

### **Problematique : paiement en deux fois** [Vente des primeur]

> Une fois a la commande, prix HT  
> Une fois a la livraison, reste du prix pour TTC + livraison + conditionnement

| MODULE                                                                                                                                          | PRIX ($) | DESCRIPTION                                                                              |
| ----------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ---------------------------------------------------------------------------------------- |
| [PRE COMMANDE 1](https://addons.prestashop.com/en/registration-ordering-process/17707-pre-order-book-in-advance-sell-out-of-stock-product.html) | 50       | Paiement Partiel, mais n'inclut pas la séparation HT TTC                                 |
| [PRE COMMANDE 2](https://addons.prestashop.com/en/registration-ordering-process/18819-pre-order-waiting-list-notification.html)                 | 50       | Paiement Partiel, mais n'inclut pas la séparation HT TTC                                 |
| [FACTURE SANS TVA](https://addons.prestashop.com/en/accounting-invoicing/17263-invoice-without-tax-tax-excl-without-vat.html)                   | 50       | Affiche le prix HT et TTC de chaque article sur la page produit                          |
| [AFFICHAGE TTC & HT](https://addons.prestashop.com/en/price-management/20296-b2b-dual-display-of-tax-included-and-tax-excluded-price.html)      | 50       | Affiche le prix HT et TTC de chaque article sur la page produit                          |
| [AFFICHAGE SUR DEMANDE TTC & HT](https://addons.prestashop.com/en/b2b/46879-price-switcher-display-of-price-tax-incl-or-tax-excl.html)          | 50       | Permet de changer l'affichage du prix HT & TTC de tout le site via le click d'un boutton |

---

### **Problematique : multiples options de conditionnement pour les primeurs**  [Caissage / Conditionnement]
> Caisses
> Bouteilles


| MODULE                                                                                                                                        | PRIX ($) | DESCRIPTION                                                       |
| --------------------------------------------------------------------------------------------------------------------------------------------- | -------- | ----------------------------------------------------------------- |
| [OPTIONS, FRAIS SUPPLEMENTAIRES](https://addons.prestashop.com/en/price-management/12794-options-fees-taxes-and-discounts-shipping-cost.html) | 150      | Frais supplémentaires liés au mode de paiement                    |
| [OPTIONS PAR CATEGORIE](https://addons.prestashop.com/en/combinaisons-customization/19536-product-options-bundles-and-customization.html)     | 200      | Permet l'ajout d'options et leur déstockage (caisses, bouteilles) |

---

### **Problematique** [Vins Sous Allocation]
> Volonte d'afficher les vins sous allocation, pour un type de client particulier
> Volonte d'afficher les vins sans pour autant polluer le site avec des produits hors stock


| MODULE                                                                                                                          | PRIX ($) | DESCRIPTION                                                    |
| ------------------------------------------------------------------------------------------------------------------------------- | -------- | -------------------------------------------------------------- |
| [PRIME MEMBERSHIP](https://addons.prestashop.com/en/referral-loyalty-programs/41717-prime-membership.html)                      | 70       | Affiche une catégorie de produit à un groupe de clients défini |
| [MAGASIN PRIVÉ](https://addons.prestashop.com/en/private-sales-flash-sales/20141-private-shop-login-to-see-products-store.html) | 50       | Affiche une catégorie de produit à un groupe de clients défini |

---

### **Problematique : multiples options de livraison** [Livraisons] 
> Livraison internationale, necessite un acces aux services de multiples services de livraison


| MODULE                                                                                                         | PRIX ($) | DESCRIPTION                |
| -------------------------------------------------------------------------------------------------------------- | -------- | -------------------------- |
| [UPELA](https://addons.prestashop.com/en/shipping-carriers/26804-upela-parcel-shipping-at-the-best-rate.html)  | 0        | API - Service de livraison |
| [BOXTAL](https://addons.prestashop.com/en/shipping-carriers/1755-boxtal-multi-carreer-shipping-solutions.html) | 0        | API - Service de livraison |


</details>

---



## **V. [Modifications et développement à effectuer sur la structure du template Prestashop et les modules]**
[Retour vers l'index](https://github.com/wSzki/lg#index)

<details>
  <summary>Cliquez pour ouvrir</summary>


  >Prestashop utilise des "hooks" (points d'ancrage).
  >Ce sont des points d'entrée et de sortie pour les modules,  qui injectent et reçoivent des données vers le "Core" (coeur du code du site web) via ces hooks.
  >Ci-dessous se trouve une liste non exhaustive des hooks disponibles, classés par mot clef.

  >Les "hooks" permettent d'intégrer de nouveaux elements (images,  texte, etc...) á des endroits specifiques du site web (par exemple, le panier d'achat, la fiche de chaque produit, la banniére de la page d'acceuil etc...) ou de déclencher des évenements suite á des interactions utilisateur (mise en panier d'un produit, changement de page etc...).
  >Les hooks ne peuvent néamoins pas repondre a toutes les problematiques techniques, notamment la problématique des vins primeurs qui nécessite un développement du panier d'achat / processus de paiement. (voir fichiers .php ci dessous)

  >Un developpement sur le Core nécessaire, faisable via ce que prestashop appelle des "Overrides"
  >Un Override est un fichier remplaçant un élément du Core, sans pour autant le supprimer. 
  >Dans ce cas, il s'agit de creer un override afin de modifier les classes PHP gérant les >fonctionalités du panier et de paiement.

Ci dessous, les fichiers PHP définissant les classes a developper

[Cart](./php/Cart.php)

[CartRule](./php/CartRule.php)

[PaymentModule](./php/PaymentModule.php)


   #### Problematique A. [Vente de produit HT et TTC dans un meme panier]
   
>Extension de la classe CartCore et CartRuleCore dans les fichier /classes/Cart.php et CartRule.php
>afin de dissocier le traitement des articles primeur ou non dans le panier d'achat.

Si un ou plusieurs vins primeur est mis dans le panier, ces vins seront traités indépendamments du reste du panier : 

La panier gerera le total HT des vins primeurs presents d'une part et le montant des taxes additioné aux couts de livraison d'autre part, puis informera le client

* Du sous-total des vins primeur
* Du sous-total des articles non vin primeur
* Du montant a regler immediatement (Primeur HT + (Autres Articles TTC + Livraison))
* Du montant a regler á la livraison des primeurs

* Du total de la commande ((Primeur TTC + Livraion) + (Autres Articles + Livraison))

![Alt](./img/proto&#32;primeur.png)


La gestion du paiement partiel peut ensuite être faite via [ce module](https://addons.prestashop.com/en/registration-ordering-process/17707-pre-order-book-in-advance-sell-out-of-stock-product.html) (50$), moyennant modification du module.
Ou par la création d'un module via l'utilisation du hook [407] PaymentOptions


#### Problematique B. [Multitude de references, d'options de conditionnement et d'envoi]

[Ce module](https://addons.prestashop.com/en/combinaisons-customization/19536-product-options-bundles-and-customization.html) semble permettre la gestion de multiples options sur un type de produit, et de déstocker les options



#### Problematique C. [Catalogue de vins sous allocation accessible a un type de clientèle précis, mais visible à tous]

[Ce module](https://addons.prestashop.com/en/referral-loyalty-programs/41717-prime-membership.html) permet la création de comptes "Premiums", ce qui permet de rendre disponible à des clients sélectionnés, l'achat une certaine catégorie de produits (Ici, les vins sous allocations) 
Le catalogue de vins sous allocation peut rester visible par tous.


#### problematique D. [Vente de produit livrable et non livrable]

La gestion de vente des produits livrables ou non est gérée nativement par Prestashop
En ce qui concerne les relations d'articles (par exemple la relation entre quotité et la quantité du vin), la problématique peut être résolue nativement en SQL, qui existe spécifiquement pour la gestion de base de données et leur mise en relation.



</details>


  ---

<details>
  <summary>Liste non exhaustive des Hooks </summary>


### CART HOOKS

| id  | Hook Name                             | Hook Title                        | Hook Description                                                                                | Position |
| --- | ------------------------------------- | --------------------------------- | ----------------------------------------------------------------------------------------------- | -------- |
| 15  | actionCartSave                        | Cart creation and update          | This hook is displayed when a product is added to the cart or if the cart's content is modified | 1        |
| 25  | actionObjectProductInCartDeleteBefore | Cart product removal              | This hook is called before a product is removed from a cart                                     | 1        |
| 26  | actionObjectProductInCartDeleteAfter  | Cart product removal              | This hook is called after a product is removed from a cart                                      | 1        |
| 45  | displayShoppingCartFooter             | Shopping cart footer              | This hook displays some specific information on the shopping cart's page                        | 1        |
| 61  | displayShoppingCart                   | Shopping cart - Additional button | This hook displays new action buttons within the shopping cart                                  | 1        |
| 112 | displayCartExtraProductActions        | Extra buttons in shopping cart    | This hook adds extra buttons to the product lines, in the shopping cart                         | 1        |
| 420 | displayCrossSellingShoppingCart       | displayCrossSellingShoppingCart   |                                                                                                 | 1        |
| 443 | actionCartUpdateQuantityBefore        | actionCartUpdateQuantityBefore    |                                                                                                 | 1        |
| 455 | actionObjectCartAddAfter              | actionObjectCartAddAfter          |                                                                                                 | 1        |
| 458 | actionObjectCartRuleAddAfter          | actionObjectCartRuleAddAfter      |                                                                                                 | 1        |


### PAYMENT HOOKS
| id  | Hook Name                    | Hook Title                                         | Hook Description                                                                       | Position |
| --- | ---------------------------- | -------------------------------------------------- | -------------------------------------------------------------------------------------- | -------- |
| 4   | actionPaymentConfirmation    | Payment confirmation                               | This hook displays new elements after the payment is validated                         | 1        |
| 5   | displayPaymentReturn         | Payment return                                     |                                                                                        | 1        |
| 74  | actionPaymentCCAdd           | Payment CC added                                   |                                                                                        | 1        |
| 78  | displayPaymentTop            | Top of payment page                                | This hook is displayed at the top of the payment page                                  | 1        |
| 113 | displayPaymentByBinaries     | Payment form generated by binaries                 | This hook displays form generated by binaries during the checkout                      | 1        |
| 284 | actionPaymentPreferencesForm | Modify payment preferences options form content    | This hook allows to modify payment preferences options form FormBuilder                | 1        |
| 311 | actionPaymentPreferencesSave | Modify payment preferences options form saved data | This hook allows to modify data of payment preferences options form after it was saved | 1        |
| 407 | paymentOptions               | paymentOptions                                     |                                                                                        | 1        |
| 465 | displayPayment               | displayPayment                                     |                                                                                        | 1        |
| 466 | advancedPaymentOptions       | advancedPaymentOptions                             |                                                                                        | 1        |

### TAX HOOKS

| id  | Hook Name                         | Hook Title                                             | Hook Description                                                                                                      | Position |
| --- | --------------------------------- | ------------------------------------------------------ | --------------------------------------------------------------------------------------------------------------------- | -------- |
| 98  | actionTaxManager                  | Tax Manager Factory                                    |                                                                                                                       | 1        |
| 201 | actionTaxFormBuilderModifier      | Modify tax identifiable object form                    | This hook allows to modify tax identifiable object forms content by modifying form builder data or FormBuilder itself | 1        |
| 217 | actionBeforeUpdateTaxFormHandler  | Modify tax identifiable object data before updating it | This hook allows to modify tax identifiable object forms data before it was updated                                   | 1        |
| 233 | actionAfterUpdateTaxFormHandler   | Modify tax identifiable object data after updating it  | This hook allows to modify tax identifiable object forms data after it was updated                                    | 1        |
| 249 | actionBeforeCreateTaxFormHandler  | Modify tax identifiable object data before creating it | This hook allows to modify tax identifiable object forms data before it was created                                   | 1        |
| 265 | actionAfterCreateTaxFormHandler   | Modify tax identifiable object data after creating it  | This hook allows to modify tax identifiable object forms data after it was created                                    | 1        |
| 293 | actionTaxForm                     | Modify tax options form content                        | This hook allows to modify tax options form FormBuilder                                                               | 1        |
| 320 | actionTaxSave                     | Modify tax options form saved data                     | This hook allows to modify data of tax options form after it was saved                                                | 1        |
| 331 | actionTaxGridDefinitionModifier   | Modify tax grid definition                             | This hook allows to alter tax grid columns, actions and filters                                                       | 1        |
| 345 | actionTaxGridQueryBuilderModifier | Modify tax grid query builder                          | This hook allows to alter Doctrine query builder for tax grid                                                         | 1        |
| 364 | actionTaxGridDataModifier         | Modify tax grid data                                   | This hook allows to modify tax grid data                                                                              | 1        |
| 377 | actionTaxGridFilterFormModifier   | Modify tax grid filters                                | This hook allows to modify filters for tax grid                                                                       | 1        |
| 390 | actionTaxGridPresenterModifier    | Modify tax grid template data                          | This hook allows to modify data which is about to be used in template for tax grid                                    | 1        |


### SHIPPING HOOKS


| id  | Hook Name                              | Hook Title                                                      | Hook Description                                                                                                                 | Position |
| --- | -------------------------------------- | --------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------- | -------- |
| 32  | displayAdminOrderTabShip               | Display new elements in Back Office, AdminOrder, panel Shipping | This hook launches modules when the AdminOrder tab is displayed in the Back Office and extends / override Shipping panel tabs    | 1        |
| 34  | displayAdminOrderContentShip           | Display new elements in Back Office, AdminOrder, panel Shipping | This hook launches modules when the AdminOrder tab is displayed in the Back Office and extends / override Shipping panel content | 1        |
| 149 | displayAdminProductsShippingStepBottom | Display new elements in back office product page, Shipping tab  | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 271 | actionShippingPreferencesPageForm      | Modify shipping preferences page options form content           | This hook allows to modify shipping preferences page options form FormBuilder                                                    | 1        |
| 298 | actionShippingPreferencesPageSave      | Modify shipping preferences page options form saved data        | This hook allows to modify data of shipping preferences page options form after it was saved                                     | 1        |


### OPTIONS HOOK 

| id  | Hook Name                                           | Hook Title                                                    | Hook Description                                                                               | Position |
| --- | --------------------------------------------------- | ------------------------------------------------------------- | ---------------------------------------------------------------------------------------------- | -------- |
| 146 | displayAdminProductsOptionsStepTop                  | Display new elements in back office product page, Options tab | This hook launches modules when the back office product page is displayed                      | 1        |
| 147 | displayAdminProductsOptionsStepBottom               | Display new elements in back office product page, Options tab | This hook launches modules when the back office product page is displayed                      | 1        |
| 274 | actionOrdersInvoicesOptionsForm                     | Modify orders invoices options options form content           | This hook allows to modify orders invoices options options form FormBuilder                    | 1        |
| 280 | actionOrderDeliverySlipOptionsForm                  | Modify order delivery slip options options form content       | This hook allows to modify order delivery slip options options form FormBuilder                | 1        |
| 301 | actionOrdersInvoicesOptionsSave                     | Modify orders invoices options options form saved data        | This hook allows to modify data of orders invoices options options form after it was saved     | 1        |
| 307 | actionOrderDeliverySlipOptionsSave                  | Modify order delivery slip options options form saved data    | This hook allows to modify data of order delivery slip options options form after it was saved | 1        |
| 407 | paymentOptions                                      | paymentOptions                                                |                                                                                                | 1        |
| 409 | actionAdminStoresControllerUpdate_optionsAfter      | actionAdminStoresControllerUpdate_optionsAfter                |                                                                                                | 1        |
| 446 | actionAdminMetaControllerUpdate_optionsAfter        | actionAdminMetaControllerUpdate_optionsAfter                  |                                                                                                | 1        |
| 450 | actionAdminThemesControllerUpdate_optionsAfter      | actionAdminThemesControllerUpdate_optionsAfter                |                                                                                                | 1        |
| 452 | actionAdminPreferencesControllerUpdate_optionsAfter | actionAdminPreferencesControllerUpdate_optionsAfter           |                                                                                                | 1        |
| 466 | advancedPaymentOptions                              | advancedPaymentOptions                                        |                                                                                                | 1        |

### DISPLAY HOOKS


| id  | Hook Name                                     | Hook Title                                                       | Hook Description                                                                                                                 | Position |
| --- | --------------------------------------------- | ---------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------- | -------- |
| 2   | displayMaintenance                            | Maintenance Page                                                 | This hook displays new elements on the maintenance page                                                                          | 1        |
| 3   | displayProductPageDrawer                      | Product Page Drawer                                              | This hook displays content in the right sidebar of the product page                                                              | 1        |
| 5   | displayPaymentReturn                          | Payment return                                                   |                                                                                                                                  | 1        |
| 7   | displayRightColumn                            | Right column blocks                                              | This hook displays new elements in the right-hand column                                                                         | 1        |
| 8   | displayWrapperTop                             | Main wrapper section (top)                                       | This hook displays new elements in the top of the main wrapper                                                                   | 1        |
| 9   | displayWrapperBottom                          | Main wrapper section (bottom)                                    | This hook displays new elements in the bottom of the main wrapper                                                                | 1        |
| 10  | displayContentWrapperTop                      | Content wrapper section (top)                                    | This hook displays new elements in the top of the content wrapper                                                                | 1        |
| 11  | displayContentWrapperBottom                   | Content wrapper section (bottom)                                 | This hook displays new elements in the bottom of the content wrapper                                                             | 1        |
| 12  | displayLeftColumn                             | Left column blocks                                               | This hook displays new elements in the left-hand column                                                                          | 1        |
| 13  | displayHome                                   | Homepage content                                                 | This hook displays new elements on the homepage                                                                                  | 1        |
| 19  | displayAfterBodyOpeningTag                    | Very top of pages                                                | Use this hook for advertisement or modals you want to load first                                                                 | 1        |
| 20  | displayBeforeBodyClosingTag                   | Very bottom of pages                                             | Use this hook for your modals or any content you want to load at the very end                                                    | 1        |
| 21  | displayTop                                    | Top of pages                                                     | This hook displays additional elements at the top of your pages                                                                  | 1        |
| 22  | displayNavFullWidth                           | Navigation                                                       | This hook displays full width navigation menu at the top of your pages                                                           | 1        |
| 23  | displayRightColumnProduct                     | New elements on the product page (right column)                  | This hook displays new elements in the right-hand column of the product page                                                     | 1        |
| 27  | displayFooterProduct                          | Product footer                                                   | This hook adds new blocks under the product's description                                                                        | 1        |
| 28  | displayInvoice                                | Invoice                                                          | This hook displays new blocks on the invoice (order)                                                                             | 1        |
| 30  | displayAdminOrder                             | Display new elements in the Back Office, tab AdminOrder          | This hook launches modules when the AdminOrder tab is displayed in the Back Office                                               | 1        |
| 31  | displayAdminOrderTabOrder                     | Display new elements in Back Office, AdminOrder, panel Order     | This hook launches modules when the AdminOrder tab is displayed in the Back Office and extends / override Order panel tabs       | 1        |
| 32  | displayAdminOrderTabShip                      | Display new elements in Back Office, AdminOrder, panel Shipping  | This hook launches modules when the AdminOrder tab is displayed in the Back Office and extends / override Shipping panel tabs    | 1        |
| 33  | displayAdminOrderContentOrder                 | Display new elements in Back Office, AdminOrder, panel Order     | This hook launches modules when the AdminOrder tab is displayed in the Back Office and extends / override Order panel content    | 1        |
| 34  | displayAdminOrderContentShip                  | Display new elements in Back Office, AdminOrder, panel Shipping  | This hook launches modules when the AdminOrder tab is displayed in the Back Office and extends / override Shipping panel content | 1        |
| 35  | displayFooter                                 | Footer                                                           | This hook displays new blocks in the footer                                                                                      | 1        |
| 36  | displayPDFInvoice                             | PDF Invoice                                                      | This hook allows you to display additional information on PDF invoices                                                           | 1        |
| 37  | displayInvoiceLegalFreeText                   | PDF Invoice - Legal Free Text                                    | This hook allows you to modify the legal free text on PDF invoices                                                               | 1        |
| 38  | displayAdminCustomers                         | Display new elements in the Back Office, tab AdminCustomers      | This hook launches modules when the AdminCustomers tab is displayed in the Back Office                                           | 1        |
| 39  | displayAdminCustomersAddressesItemAction      | Display new elements in the Back Office, tab AdminCustomers, Add | This hook launches modules when the Addresses list into the AdminCustomers tab is displayed in the Back Office                   | 1        |
| 40  | displayOrderConfirmation                      | Order confirmation page                                          | This hook is called within an order's confirmation page                                                                          | 1        |
| 43  | displayCustomerAccount                        | Customer account displayed in Front Office                       | This hook displays new elements on the customer account page                                                                     | 1        |
| 45  | displayShoppingCartFooter                     | Shopping cart footer                                             | This hook displays some specific information on the shopping cart's page                                                         | 1        |
| 46  | displayCreateAccountEmailFormBottom           | Customer authentication form                                     | This hook displays some information on the bottom of the email form                                                              | 1        |
| 47  | displayAuthenticateFormBottom                 | Customer authentication form                                     | This hook displays some information on the bottom of the authentication form                                                     | 1        |
| 48  | displayCustomerAccountForm                    | Customer account creation form                                   | This hook displays some information on the form to create a customer account                                                     | 1        |
| 49  | displayAdminStatsModules                      | Stats - Modules                                                  |                                                                                                                                  | 1        |
| 50  | displayAdminStatsGraphEngine                  | Graph engines                                                    |                                                                                                                                  | 1        |
| 52  | displayProductAdditionalInfo                  | Product page additional info                                     | This hook adds additional information on the product page                                                                        | 1        |
| 53  | displayBackOfficeHome                         | Administration panel homepage                                    | This hook is displayed on the admin panel's homepage                                                                             | 1        |
| 54  | displayAdminStatsGridEngine                   | Grid engines                                                     |                                                                                                                                  | 1        |
| 57  | displayLeftColumnProduct                      | New elements on the product page (left column)                   | This hook displays new elements in the left-hand column of the product page                                                      | 1        |
| 60  | displayCarrierList                            | Extra carrier (module mode)                                      |                                                                                                                                  | 1        |
| 61  | displayShoppingCart                           | Shopping cart - Additional button                                | This hook displays new action buttons within the shopping cart                                                                   | 1        |
| 64  | displayCustomerAccountFormTop                 | Block above the form for create an account                       | This hook is displayed above the customer's account creation form                                                                | 1        |
| 65  | displayBackOfficeHeader                       | Administration panel header                                      | This hook is displayed in the header of the admin panel                                                                          | 1        |
| 66  | displayBackOfficeTop                          | Administration panel hover the tabs                              | This hook is displayed on the roll hover of the tabs within the admin panel                                                      | 1        |
| 67  | displayAdminEndContent                        | Administration end of content                                    | This hook is displayed at the end of the main content, before the footer                                                         | 1        |
| 68  | displayBackOfficeFooter                       | Administration panel footer                                      | This hook is displayed within the admin panel's footer                                                                           | 1        |
| 71  | displayBeforeCarrier                          | Before carriers list                                             | This hook is displayed before the carrier list in Front Office                                                                   | 1        |
| 72  | displayAfterCarrier                           | After carriers list                                              | This hook is displayed after the carrier list in Front Office                                                                    | 1        |
| 73  | displayOrderDetail                            | Order detail                                                     | This hook is displayed within the order's details in Front Office                                                                | 1        |
| 78  | displayPaymentTop                             | Top of payment page                                              | This hook is displayed at the top of the payment page                                                                            | 1        |
| 81  | displayAttributeGroupForm                     | Add fields to the form 'attribute group'                         | This hook adds fields to the form 'attribute group'                                                                              | 1        |
| 84  | displayFeatureForm                            | Add fields to the form 'feature'                                 | This hook adds fields to the form 'feature'                                                                                      | 1        |
| 88  | displayAttributeGroupPostProcess              | On post-process in admin attribute group                         | This hook is called on post-process in admin attribute group                                                                     | 1        |
| 89  | displayFeaturePostProcess                     | On post-process in admin feature                                 | This hook is called on post-process in admin feature                                                                             | 1        |
| 90  | displayFeatureValueForm                       | Add fields to the form 'feature value'                           | This hook adds fields to the form 'feature value'                                                                                | 1        |
| 91  | displayFeatureValuePostProcess                | On post-process in admin feature value                           | This hook is called on post-process in admin feature value                                                                       | 1        |
| 94  | displayAttributeForm                          | Add fields to the form 'attribute value'                         | This hook adds fields to the form 'attribute value'                                                                              | 1        |
| 99  | displayMyAccountBlock                         | My account block                                                 | This hook displays extra information within the 'my account' block&quot;                                                         | 1        |
| 102 | displayTopColumn                              | Top column blocks                                                | This hook displays new elements in the top of columns                                                                            | 1        |
| 103 | displayBackOfficeCategory                     | Display new elements in the Back Office, tab AdminCategories     | This hook launches modules when the AdminCategories tab is displayed in the Back Office                                          | 1        |
| 104 | displayProductListFunctionalButtons           | Display new elements in the Front Office, products list          | This hook launches modules when the products list is displayed in the Front Office                                               | 1        |
| 105 | displayNav                                    | Navigation                                                       |                                                                                                                                  | 1        |
| 106 | displayOverrideTemplate                       | Change the default template of current controller                |                                                                                                                                  | 1        |
| 112 | displayCartExtraProductActions                | Extra buttons in shopping cart                                   | This hook adds extra buttons to the product lines, in the shopping cart                                                          | 1        |
| 113 | displayPaymentByBinaries                      | Payment form generated by binaries                               | This hook displays form generated by binaries during the checkout                                                                | 1        |
| 117 | displayCustomerLoginFormAfter                 | Display elements after login form                                | This hook displays new elements after the login form                                                                             | 1        |
| 122 | displayCarrierExtraContent                    | Display additional content for a carrier (e.g pickup points)     | This hook calls only the module related to the carrier, in order to add options when needed                                      | 1        |
| 124 | displayProductExtraContent                    | Display extra content on the product page                        | This hook expects ProductExtraContent instances, which will be properly displayed by the template on the product page            | 1        |
| 132 | displayDashboardTop                           | Dashboard Top                                                    | Displays the content in the dashboard's top area                                                                                 | 1        |
| 135 | displayAfterProductThumbs                     | Display extra content below product thumbs                       | This hook displays new elements below product images ex. additional media                                                        | 1        |
| 141 | displayAdminProductsMainStepLeftColumnMiddle  | Display new elements in back office product page, left column of | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 142 | displayAdminProductsMainStepLeftColumnBottom  | Display new elements in back office product page, left column of | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 143 | displayAdminProductsMainStepRightColumnBottom | Display new elements in back office product page, right column o | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 144 | displayAdminProductsQuantitiesStepBottom      | Display new elements in back office product page, Quantities/Com | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 145 | displayAdminProductsPriceStepBottom           | Display new elements in back office product page, Price tab      | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 146 | displayAdminProductsOptionsStepTop            | Display new elements in back office product page, Options tab    | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 147 | displayAdminProductsOptionsStepBottom         | Display new elements in back office product page, Options tab    | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 148 | displayAdminProductsSeoStepBottom             | Display new elements in back office product page, SEO tab        | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 149 | displayAdminProductsShippingStepBottom        | Display new elements in back office product page, Shipping tab   | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 150 | displayAdminProductsCombinationBottom         | Display new elements in back office product page, Combination ta | This hook launches modules when the back office product page is displayed                                                        | 1        |
| 151 | displayDashboardToolbarTopMenu                | Display new elements in back office page with a dashboard, on to | This hook launches modules when a page with a dashboard is displayed                                                             | 1        |
| 152 | displayDashboardToolbarIcons                  | Display new elements in back office page with dashboard, on icon | This hook launches modules when the back office with dashboard is displayed                                                      | 1        |
| 189 | displayProductActions                         | Display additional action button on the product page             | This hook allow additional actions to be triggered, near the add to cart button.                                                 | 1        |
| 190 | displayPersonalInformationTop                 | Content in the checkout funnel, on top of the personal informati | Display actions or additional content in the personal details tab of the checkout funnel.                                        | 1        |
| 408 | displayNav1                                   | displayNav1                                                      |                                                                                                                                  | 1        |
| 414 | displayFooterBefore                           | displayFooterBefore                                              |                                                                                                                                  | 1        |
| 415 | displayAdminCustomersForm                     | displayAdminCustomersForm                                        |                                                                                                                                  | 1        |
| 419 | displayOrderConfirmation2                     | displayOrderConfirmation2                                        |                                                                                                                                  | 1        |
| 420 | displayCrossSellingShoppingCart               | displayCrossSellingShoppingCart                                  |                                                                                                                                  | 1        |
| 437 | displaySearch                                 | displaySearch                                                    |                                                                                                                                  | 1        |
| 438 | displayAdminNavBarBeforeEnd                   | displayAdminNavBarBeforeEnd                                      |                                                                                                                                  | 1        |
| 439 | displayAdminAfterHeader                       | displayAdminAfterHeader                                          |                                                                                                                                  | 1        |
| 440 | displayGDPRConsent                            | displayGDPRConsent                                               |                                                                                                                                  | 1        |
| 442 | displayExpressCheckout                        | displayExpressCheckout                                           |                                                                                                                                  | 1        |
| 444 | displayNav2                                   |                                                                  |                                                                                                                                  | 1        |
| 445 | displayReassurance                            |                                                                  |                                                                                                                                  | 1        |
| 463 | displayBackOfficeOrderActions                 | displayBackOfficeOrderActions                                    |                                                                                                                                  | 1        |
| 464 | displayProductTabContent                      | displayProductTabContent                                         |                                                                                                                                  | 1        |
| 465 | displayPayment                                | displayPayment                                                   |                                                                                                                                  | 1        |


</details>

---

<div align="center"></div>
<div align="center"></div>
<div align="center"></div>


  </details>