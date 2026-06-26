# Diagrammes UML — Projet CMPB (soutenance)

Diagrammes du site du **Centre Médical Protestant de Bafoussam**
(React + TypeScript / FastAPI + SQLAlchemy / MySQL, déployé sur Vercel + Railway).

Sources **PlantUML** (`.puml`) + rendus **SVG** (vectoriel, pour les slides/impression)
et **PNG** (160 dpi). Charte graphique commune dans `style.puml` (traits orthogonaux,
palette sobre).

| # | Diagramme | Source | Rendu |
|---|-----------|--------|-------|
| 1 | Cas d'utilisation | `01-cas-utilisation.puml` | `svg/01-…svg` · `png/01-…png` |
| 2 | Classes (modèle du domaine) | `02-classes.puml` | `svg/02-…` · `png/02-…` |
| 3 | Modèle logique de données (MLD) | `03-entites-relations.puml` | `svg/03-…` · `png/03-…` |
| 4 | Séquence — Prise de rendez-vous | `04-sequence-rdv.puml` | `svg/04-…` · `png/04-…` |
| 5 | Séquence — Connexion admin + dashboard | `05-sequence-admin.puml` | `svg/05-…` · `png/05-…` |
| 6 | Activité — Cycle de vie d'un rendez-vous | `06-activite-rdv.puml` | `svg/06-…` · `png/06-…` |
| 7 | Composants — Architecture applicative | `07-composants.puml` | `svg/07-…` · `png/07-…` |
| 8 | Déploiement — Infrastructure | `08-deploiement.puml` | `svg/08-…` · `png/08-…` |

## Régénérer les images

Prérequis : **Java**, **Graphviz** (`dot`) et **plantuml.jar**.

```bash
cd docs/diagrams
# Vérifier la syntaxe
java -jar plantuml.jar -checkonly -failfast2 0*.puml
# Générer SVG + PNG
java -jar plantuml.jar -tsvg -o svg 0*.puml
java -jar plantuml.jar -tpng -Sdpi=160 -o png 0*.puml
```

> Astuce : on peut aussi coller le contenu d'un `.puml` sur https://www.plantuml.com/plantuml
> pour un rendu immédiat dans le navigateur.
