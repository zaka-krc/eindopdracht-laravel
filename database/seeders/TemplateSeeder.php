<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\NewsItem;
use App\Models\Comment;
use App\Models\GameInterest;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use App\Models\ContactMessage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        // 1. USERS - Maak test gebruikers
        $user1 = User::create([
            'name' => 'John Gamer',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'username' => 'johngamer',
            'about_me' => 'Hardcore gamer die houdt van RPGs en FPS games.',
            'email_verified_at' => now(),
        ]);

        $user2 = User::create([
            'name' => 'Sarah Player',
            'email' => 'sarah@example.com',
            'password' => Hash::make('password'),
            'username' => 'sarahplayer',
            'about_me' => 'Indie game lover en streaming content creator.',
            'email_verified_at' => now(),
        ]);

        $user3 = User::create([
            'name' => 'Mike Pro',
            'email' => 'mike@example.com',
            'password' => Hash::make('password'),
            'username' => 'mikepro',
            'about_me' => 'Esports speler en strategy game expert.',
            'email_verified_at' => now(),
        ]);

        // Get admin user
        $admin = User::where('email', 'admin@ehb.be')->first();

        // Koppel game interests aan gebruikers (GameInterests bestaan al)
        $fps = GameInterest::where('slug', 'fps')->first();
        $rpg = GameInterest::where('slug', 'rpg')->first();
        $strategy = GameInterest::where('slug', 'strategy')->first();
        $indie = GameInterest::where('slug', 'indie')->first();
        $sports = GameInterest::where('slug', 'sports')->first();
        $horror = GameInterest::where('slug', 'horror')->first();

        if ($fps && $rpg && $strategy && $indie && $sports && $horror) {
            $user1->gameInterests()->sync([$fps->id, $rpg->id]); // FPS, RPG
            $user2->gameInterests()->sync([$indie->id, $horror->id]); // Indie, Horror
            $user3->gameInterests()->sync([$strategy->id, $fps->id, $sports->id]); // Strategy, FPS, Sports
            if ($admin) {
                $admin->gameInterests()->sync([$fps->id, $rpg->id, $strategy->id, $indie->id]); // FPS, RPG, Strategy, Indie
            }
        }

        // 2. FAQ CATEGORIES & QUESTIONS
        $accountCategory = FaqCategory::create(['name' => 'Account & Profiel']);
        $gamingCategory = FaqCategory::create(['name' => 'Gaming & Community']);
        $techCategory = FaqCategory::create(['name' => 'Technische Vragen']);

        // Account FAQ
        FaqQuestion::create([
            'faq_category_id' => $accountCategory->id,
            'question' => 'Hoe maak ik een GameHub account aan?',
            'answer' => 'Klik op "Registreer" in de navigatie, vul je gegevens in en bevestig je e-mailadres.',
        ]);

        FaqQuestion::create([
            'faq_category_id' => $accountCategory->id,
            'question' => 'Kan ik mijn profiel aanpassen?',
            'answer' => 'Ja! Ga naar je profiel instellingen om je foto, bio en gaming interesses bij te werken.',
        ]);

        FaqQuestion::create([
            'faq_category_id' => $accountCategory->id,
            'question' => 'Hoe reset ik mijn wachtwoord?',
            'answer' => 'Klik op "Wachtwoord vergeten" op de login pagina en volg de instructies in je e-mail.',
        ]);

        // Gaming FAQ
        FaqQuestion::create([
            'faq_category_id' => $gamingCategory->id,
            'question' => 'Wat zijn gaming interesses?',
            'answer' => 'Gaming interesses helpen je om gelijkgestemde gamers te vinden en relevante content te zien.',
        ]);

        FaqQuestion::create([
            'faq_category_id' => $gamingCategory->id,
            'question' => 'Hoe kan ik comments plaatsen?',
            'answer' => 'Log in en ga naar een nieuwsartikel. Scroll naar beneden om een comment achter te laten.',
        ]);

        // Tech FAQ
        FaqQuestion::create([
            'faq_category_id' => $techCategory->id,
            'question' => 'Welke browsers worden ondersteund?',
            'answer' => 'GameHub werkt het beste in moderne browsers zoals Chrome, Firefox, Safari en Edge.',
        ]);

        FaqQuestion::create([
            'faq_category_id' => $techCategory->id,
            'question' => 'Is er een mobile app?',
            'answer' => 'Momenteel is GameHub een web-applicatie, maar een mobile app staat op onze roadmap.',
        ]);

        // 3. NEWS ITEMS - Gaming nieuws
        $news1 = NewsItem::create([
            'title' => 'Nieuwe Gaming Console Aangekondigd voor 2025',
            'content' => "De gaming industrie staat op zijn kop na de aankondiging van een baanbrekende nieuwe console die belooft de manier waarop we gamen te revolutioneren.\n\nMet geavanceerde ray-tracing technologie, 8K ondersteuning en een volledig nieuwe controller interface, belooft deze console de toekomst van gaming in te luiden.\n\nDe console zal beschikbaar zijn in verschillende configuraties, van een budget-vriendelijke versie tot een high-end model voor hardcore gamers.\n\nVerwachte releasedatum is eind 2025, met pre-orders die later dit jaar van start gaan.",
            'publication_date' => now()->subDays(2),
            'user_id' => $admin ? $admin->id : 1,
            'image' => 'news/console-2025.jpg',
        ]);

        $news2 = NewsItem::create([
            'title' => 'Indie Game Festival: De Winnaars van 2025',
            'content' => "Het jaarlijkse Indie Game Festival heeft zijn winnaars bekendgemaakt, en het is een fantastisch jaar geweest voor onafhankelijke game ontwikkelaars.\n\nDe grote winnaar, 'Pixel Dreams', een retro-geïnspireerde platformer, heeft de harten van spelers en critici veroverd met zijn unieke art style en innovatieve gameplay mechanics.\n\nAndere opvallende winnaars zijn:\n- 'Neon Nights' - Beste Visual Design\n- 'Code Warriors' - Beste Multiplayer Experience\n- 'Garden Tales' - Beste Family Game\n\nDeze games laten zien dat creativiteit en passie nog steeds de drijvende krachten zijn achter geweldige gaming experiences.",
            'publication_date' => now()->subDays(5),
            'user_id' => $admin ? $admin->id : 1,
            'image' => 'news/indie-festival.jpg',
        ]);

        $news3 = NewsItem::create([
            'title' => 'Esports Tournament Breekt Kijkrecords',
            'content' => "Het World Championship Esports Tournament heeft alle verwachtingen overtroffen met meer dan 50 miljoen kijkers wereldwijd.\n\nHet finale duel tussen Team Phoenix en Lightning Bolts was een ware nail-biter die tot de laatste seconde spannend bleef. Team Phoenix wist uiteindelijk de overwinning binnen te slepen met een spectaculaire comeback in de laatste ronde.\n\nDe prijzenpot van 10 miljoen dollar is de grootste ooit in de esports geschiedenis, wat aantoont hoe snel deze industrie blijft groeien.\n\nVolgend jaar wordt het toernooi uitgebreid naar nog meer games en categorieën.",
            'publication_date' => now()->subWeek(),
            'user_id' => $admin ? $admin->id : 1,
            'image' => 'news/esports-championship.jpg',
        ]);

        $news4 = NewsItem::create([
            'title' => 'Virtual Reality: De Volgende Stap in Gaming',
            'content' => "Virtual Reality gaming heeft een nieuwe mijlpaal bereikt met de lancering van ultra-realistische VR headsets die de grenzen tussen virtuele en werkelijke wereld doen vervagen.\n\nDe nieuwe generatie VR-apparaten bieden:\n- 4K resolutie per oog\n- Draadloze connectiviteit\n- Haptic feedback over het hele lichaam\n- Eye-tracking voor natuurlijke interactie\n\nGamers kunnen nu volledig onderdompelen in virtuele werelden en ervaringen die vroeger ondenkbaar waren.",
            'publication_date' => now()->subDays(10),
            'user_id' => $admin ? $admin->id : 1,
            'image' => 'news/vr-gaming.jpg',
        ]);

        // 4. COMMENTS
        $comment1 = Comment::create([
            'user_id' => $user1->id,
            'news_item_id' => $news1->id,
            'content' => 'Dit klinkt geweldig! Kan niet wachten om meer details te horen over de specs.',
        ]);

        $comment2 = Comment::create([
            'user_id' => $user2->id,
            'news_item_id' => $news1->id,
            'content' => 'Hoop dat de prijs niet te hoog wordt. Gaming moet toegankelijk blijven voor iedereen.',
        ]);

        // Reply op comment 2
        if ($admin) {
            Comment::create([
                'user_id' => $admin->id,
                'news_item_id' => $news1->id,
                'parent_id' => $comment2->id,
                'content' => 'Er komen verschillende prijsklassen, dus er zou voor elke budget wat moeten zijn!',
            ]);
        }

        Comment::create([
            'user_id' => $user3->id,
            'news_item_id' => $news2->id,
            'content' => 'Pixel Dreams verdient echt die prijs! Heb het al 50 uur gespeeld.',
        ]);

        Comment::create([
            'user_id' => $user1->id,
            'news_item_id' => $news2->id,
            'content' => 'Indie games zijn echt de toekomst van creatieve gaming. Groot fan van Neon Nights!',
        ]);

        Comment::create([
            'user_id' => $user2->id,
            'news_item_id' => $news3->id,
            'content' => 'Wat een finale! Team Phoenix speelde echt next level in die laatste ronde.',
        ]);

        $vrComment = Comment::create([
            'user_id' => $user3->id,
            'news_item_id' => $news4->id,
            'content' => 'VR is eindelijk volwassen geworden. De technologie is nu echt indrukwekkend.',
        ]);

        // Reply op VR comment
        Comment::create([
            'user_id' => $user1->id,
            'news_item_id' => $news4->id,
            'parent_id' => $vrComment->id,
            'content' => 'Ja! En de draadloze functie maakt het zo veel toegankelijker.',
        ]);

        // 5. CONTACT MESSAGES
        ContactMessage::create([
            'name' => 'Lisa Gamer',
            'email' => 'lisa@example.com',
            'subject' => 'Vraag over lidmaatschap',
            'message' => 'Hallo, ik vroeg me af of er premium lidmaatschappen beschikbaar zijn met extra features? Ik zou graag meer willen weten over de mogelijkheden.',
            'is_read' => false,
        ]);

        ContactMessage::create([
            'name' => 'Tom Developer',
            'email' => 'tom@gamedev.com',
            'subject' => 'Partnership mogelijkheid',
            'message' => 'Hi team, ik ben een indie game developer en zou graag willen praten over een mogelijke samenwerking voor het promoten van mijn upcoming game op jullie platform.',
            'is_read' => false,
        ]);

        ContactMessage::create([
            'name' => 'Emma Community',
            'email' => 'emma@community.org',
            'subject' => 'Gaming event organisatie',
            'message' => 'We organiseren een lokaal gaming event en zouden graag GameHub als sponsor hebben. Kunnen we hier over in gesprek?',
            'is_read' => true,
        ]);

        ContactMessage::create([
            'name' => 'Alex Bug Reporter',
            'email' => 'alex@testing.com',
            'subject' => 'Bug report - Comments laden niet',
            'message' => 'Hoi, ik heb een bug gevonden waarbij comments soms niet laden op nieuwsartikelen. Dit gebeurt vooral op mobile devices. Kunnen jullie dit onderzoeken?',
            'is_read' => true,
        ]);

        $this->command->info('🎮 GameHub template data succesvol toegevoegd!');
        $this->command->info('📧 Bestaande admin: admin@ehb.be / Password!321');
        $this->command->info('👤 Nieuwe test users: john@example.com, sarah@example.com, mike@example.com / password');
        $this->command->info('');
        $this->command->info('💡 Run: php artisan db:seed --class=TemplateSeeder om alleen template data toe te voegen');
    }
}