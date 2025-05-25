# GameHub - Gaming Community Platform

Een dynamische website gebouwd met Laravel 12 voor de Backend Web eindopdracht. GameHub is een platform voor gaming enthusiasten waar gebruikers nieuws kunnen lezen, FAQ's kunnen raadplegen en hun gaming profiel kunnen delen.

## 📋 Functionaliteiten

### 🔐 Authenticatie & Gebruikersbeheer
- Gebruikersregistratie en login systeem
- Admin en gewone gebruiker rollen
- Admin dashboard voor gebruikersbeheer
- Mogelijkheid voor admins om andere gebruikers admin rechten te geven/afnemen
- Standaard admin account ingebouwd

### 👤 Profielsysteem
- Publieke profielpagina's voor alle gebruikers
- Persoonlijke profielinstellingen (username, verjaardag, profielfoto, over mij)
- Gaming interesses selecteren en weergeven
- Klikbare gebruikersnamen door de hele applicatie

### 📰 Nieuws Systeem
- Nieuws CRUD functionaliteit voor admins
- Publieke nieuwsweergave voor alle bezoekers
- Afbeelding upload en management
- Auteur informatie met klikbare profielen

### ❓ FAQ Systeem
- Categorieën en vragen beheer voor admins
- Uitklapbare FAQ weergave met moderne UI
- Georganiseerd per categorie

### 📧 Contact Systeem
- Contact formulier voor alle bezoekers
- Berichten management voor admins

### 🎮 Gaming Features
- GameInterest systeem voor gebruikersvoorkeuren
- Gaming-themed dark UI design
- Community focus met profielinteracties

## 🛠 Technische Implementatie

### Models & Database Relaties
- **User Model** (`app/Models/User.php`) - Gebruikersbeheer met gaming interesses
- **NewsItem Model** (`app/Models/NewsItem.php`) - Nieuws artikel beheer  
- **FaqCategory Model** (`app/Models/FaqCategory.php`) - FAQ categorieën
- **FaqQuestion Model** (`app/Models/FaqQuestion.php`) - FAQ vragen en antwoorden
- **GameInterest Model** (`app/Models/GameInterest.php`) - Gaming categorieën
- **ContactMessage Model** (`app/Models/ContactMessage.php`) - Contact berichten

#### Database Relaties:
- **One-to-Many**: User → NewsItem, FaqCategory → FaqQuestion
- **Many-to-Many**: User ↔ GameInterest (via `user_game_interests` pivot tabel)

### Controllers
- **AdminUserController** (`app/Http/Controllers/AdminUserController.php`) - Gebruikersbeheer met veiligheidsmaatregelen
- **NewsItemController** (`app/Http/Controllers/NewsItemController.php`) - Nieuws CRUD operaties
- **FaqCategoryController** (`app/Http/Controllers/FaqCategoryController.php`) - FAQ categorieën beheer
- **FaqQuestionController** (`app/Http/Controllers/FaqQuestionController.php`) - FAQ vragen beheer
- **ContactController** (`app/Http/Controllers/ContactController.php`) - Contact formulier handling
- **ProfileController** (`app/Http/Controllers/ProfileController.php`) - Profiel management

### Views & Layout
- **Layouts**: `app-layout` voor ingelogde gebruikers, `guest-layout` voor bezoekers
- **Components**: Herbruikbare navigation en user-link components
- **XSS Protection**: Alle user input wordt geëscaped via Laravel Blade
- **CSRF Protection**: Standaard Laravel CSRF tokens op alle formulieren

### Routes & Middleware
Alle routes zijn georganiseerd in groepen met appropriate middleware:
- **Public routes**: Nieuws, FAQ, Contact (geen authenticatie vereist)
- **Auth routes**: Dashboard, Profiel (authenticatie vereist)
- **Admin routes**: Admin panel (authenticatie + admin rol vereist)

## 📁 Project Structuur

```
eindopdracht-laravel/
├── app/
│   ├── Http/Controllers/          # Alle controller logica
│   ├── Models/                    # Eloquent models
│   └── Middleware/               # Route middleware
├── database/
│   ├── migrations/               # Database schema's
│   └── seeders/                  # Test data generators
├── resources/views/              # Blade templates
│   ├── admin/users/             # Admin gebruikersbeheer
│   ├── contact/                 # Contact formulieren
│   ├── faq/                     # FAQ pagina's
│   ├── news/                    # Nieuws overzicht en details
│   ├── profile/                 # Gebruikersprofielen
│   └── layouts/                 # Template layouts
└── routes/web.php               # Route definities
```

## 🚀 Installatie

### Vereisten
- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js & NPM

### Installatiestappen

1. **Clone de repository**
```bash
git clone [repository-url]
cd eindopdracht-laravel
```

2. **Installeer dependencies**
```bash
composer install
npm install
```

3. **Environment configuratie**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database configuratie**
Pas je `.env` bestand aan met je database gegevens:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gamehub
DB_USERNAME=root
DB_PASSWORD=test1234
```

5. **Database setup**
```bash
php artisan migrate:fresh --seed
```

6. **Storage link**
```bash
php artisan storage:link
```

7. **Build assets**
```bash
npm run dev
```

8. **Start de applicatie**
```bash
php artisan serve
```

Bezoek `http://localhost:8000` om de applicatie te bekijken.

## 👨‍💻 Standaard Admin Account

Na het uitvoeren van de seeders is er een standaard admin account beschikbaar:

- **Email**: admin@ehb.be
- **Password**: Password!321
- **Rol**: Administrator

## 📷 Screenshots

### Dashboard
Het hoofddashboard toont een overzicht van alle beschikbare functies met directe links naar nieuws, FAQ en contact.

![Dashboard](images/dashboard.png)

### Admin Panel - Gebruikersbeheer
Uitgebreid admin panel voor het beheren van gebruikers met mogelijkheid om admin rechten toe te kennen.

![Admin Gebruikersbeheer](images/admin-users.png)

### Gebruikersprofiel
Publieke profielpagina's tonen gebruikersinformatie, gaming interesses en maken deel uit van de community ervaring.

![Gebruikersprofiel](images/user-profile.png)

### Profiel Instellingen
Gaming interesses selectie met verschillende categorieën voor personalisatie.

![Profiel Instellingen](images/profile-settings.png)

### Nieuws Systeem
Nieuws overzicht met afbeeldingen, publicatiedata en auteur informatie.

![Nieuws Overzicht](images/news-overview.png)

### FAQ Systeem
Interactieve FAQ pagina met uitklapbare vragen georganiseerd per categorie.

![FAQ Pagina](images/faq-page.png)

### Contact Formulier
Clean en gebruiksvriendelijk contact formulier voor gebruikersfeedback.

![Contact Formulier](images/contact-form.png)

## 🧩 Technische Vereisten Implementatie

| Vereiste | Implementatie Locatie | Beschrijving |
|----------|----------------------|--------------|
| **Views - Layouts** | `resources/views/layouts/` | App-layout en guest-layout |
| **Views - Components** | `resources/views/components/` | User-link component voor herbruikbaarheid |
| **XSS Protection** | Alle `.blade.php` files | Laravel Blade auto-escaping |
| **CSRF Protection** | Alle formulieren | `@csrf` directive |
| **Route Middleware** | `routes/web.php` lijnen 15-45 | Auth en admin middleware groepen |
| **Resource Controllers** | `app/Http/Controllers/` | NewsItemController, FaqCategoryController |
| **One-to-Many** | `app/Models/User.php` lijn 47 | User → NewsItem relatie |
| **Many-to-Many** | `app/Models/User.php` lijn 52 | User ↔ GameInterest relatie |
| **Migrations** | `database/migrations/` | Alle database schema's |
| **Seeders** | `database/seeders/` | GameInterestSeeder, AdminUserSeeder |

## 🌟 Extra Features

- **Gaming Interesses Systeem**: Gebruikers kunnen hun gaming voorkeuren selecteren
- **Klikbare Gebruikersprofielen**: Community interactie door de hele applicatie
- **Admin Beveiligingen**: Admins kunnen hun eigen rechten niet per ongeluk verwijderen
- **Dark Gaming Theme**: Professionele gaming-geïnspireerde UI
- **Responsive Design**: Werkt op alle apparaten
- **Image Management**: Upload en beheer van profiel- en nieuwsafbeeldingen

## 📚 Gebruikte Technologieën

- **Backend**: Laravel 12, PHP 8.2
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL met Eloquent ORM
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage met public disk
- **Styling**: Tailwind CSS met custom gaming theme

## 🔗 Gebruikte Bronnen

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)
- [Alpine.js Documentation](https://alpinejs.dev/)
- **AI Assistants**: 
  - Claude (Anthropic) voor code review, optimalisatie en debugging (en deze Read me): https://claude.ai/share/1fd2af4a-d9f6-4133-b678-a749337e3f0a en https://claude.ai/chat/52d1451d-a721-4b53-b943-fb17b8ad7a82
  - GitHub Copilot voor code suggestions, vragen en autocompletion tijdens development

## 👨‍🎓 Auteur

**Naam**: Zakaria Korchi
**Vak**: Backend Web   
**Academiejaar**: 2024-2025  
**Hogeschool**: Erasmushogeschool Brussel

---
