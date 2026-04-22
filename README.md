# Gamebibliotheek - Doorstroomopdracht Avans Informatica

Dit project is gemaakt voor de valideringsopdracht van het 1e leerjaar (instroom leerjaar 2).  
De applicatie is een webapplicatie voor het beheren van een gamebibliotheek met login, CRUD-functionaliteit en veel-op-veel-relaties.

## Functionaliteit

- Inloggen en registreren van gebruikers.
- Beheren van:
  - `games`
  - `genres`
  - `platforms`
  - `developers`
- Persoonlijke gamecollectie per gebruiker (`collection`) met status, rating en notitie.
- Veel-op-veel-relaties:
  - `games` <-> `genres`
  - `games` <-> `platforms`
  - `users` <-> `games` via `user_game_collections`

## Tech stack

- PHP 8.2+
- Laravel 12
- MySQL
- Blade templates
- Vite (voor frontend assets)
- CSS3 (eigen stylesheet)

## Project starten (voor beoordelaars)

Voer in de projectmap de volgende stappen uit:

1. Installeer dependencies:

```bash
composer install
npm install
```

2. Maak of controleer `.env` en databaseconfiguratie.

3. Genereer key en bouw database met seeddata:

```bash
php artisan key:generate
php artisan migrate --seed
```

4. Start de applicatie:

```bash
php artisan serve
```

5. (Optioneel voor frontend build)

```bash
npm run build
```

Standaard URL lokaal:

- `http://127.0.0.1:8000`  
  (of jouw lokale domein, bijvoorbeeld `http://propedeuse.test`)

## Demo accounts

Na seeden zijn onder andere deze accounts beschikbaar:

- Admin:
  - e-mail: `admin@example.com`
  - wachtwoord: `password`
- Member:
  - e-mail: `member@example.com`
  - wachtwoord: `password`

## Belangrijke documentatie

- Analyse- en ontwerpdocument:
  - `docs/analyse-ontwerp-gamebibliotheek.md`
- SQL schema:
  - `docs/sql/schema.sql`
- Deel 2 checklist:
  - `docs/evidence/checklist-deel2.md`

## Bewijsmateriaal

Validatie- en bewijsbestanden staan in `docs/evidence/`, waaronder:

- HTML validatiescreenshots
- CSS validatiescreenshot
- overige screenshots voor responsive en management/control

## Testen

Tests draaien met:

```bash
php artisan test
```
