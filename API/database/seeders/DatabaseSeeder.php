<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $cases = [
            [
                'case_number' => 'H2025001',
                'title' => 'De Nachtclub Moord',
                'description' => 'Een bekende DJ werd dood aangetroffen in een afgesloten VIP-ruimte.',
                'status' => 'open',
                'date_reported' => Carbon::now()->subDays(8),
                'location' => 'Rotterdam',
                'investigator_id' => null,
            ],
            [
                'case_number' => 'H2025002',
                'title' => 'Het Verlaten Treinstation',
                'description' => 'Een zwerver vond een lichaam in een verlaten treinstation. Geen getuigen.',
                'status' => 'in onderzoek',
                'date_reported' => Carbon::now()->subDays(5),
                'location' => 'Utrecht',
                'investigator_id' => null,
            ],
            [
                'case_number' => 'H2025003',
                'title' => 'Verdwenen in de Mist',
                'description' => 'Een vrouw werd als vermist opgegeven. Haar auto werd gevonden met draaiende motor.',
                'status' => 'gesloten',
                'date_reported' => Carbon::now()->subDays(20),
                'location' => 'Amsterdam',
                'investigator_id' => null,
            ],
            [
                'case_number' => 'H2025004',
                'title' => 'Het Bosraadsel',
                'description' => 'Een groep wandelaars vond menselijke resten diep in een bosgebied.',
                'status' => 'open',
                'date_reported' => Carbon::now()->subDays(12),
                'location' => 'Veluwe',
                'investigator_id' => null,
            ],
            [
                'case_number' => 'H2025005',
                'title' => 'Moord bij de Oude Brug',
                'description' => 'Een zakenman werd in de vroege ochtenduren doodgeschoten gevonden.',
                'status' => 'in onderzoek',
                'date_reported' => Carbon::now()->subDays(7),
                'location' => 'Maastricht',
                'investigator_id' => null,
            ],
        ];

        foreach ($cases as &$case) {
            $case['id'] = DB::table('cases')->insertGetId($case);
        }

        $people = [
            // Nachtclub Moord
            ['name' => 'DJ Ray Vision', 'role' => 'slachtoffer', 'age' => 35, 'case_id' => $cases[0]['id']],
            ['name' => 'Leroy Bakker', 'role' => 'verdachte', 'age' => 40, 'case_id' => $cases[0]['id']],
            ['name' => 'Inspecteur De Groot', 'role' => 'rechercheur', 'age' => 50, 'case_id' => $cases[0]['id']],

            // Verlaten Treinstation
            ['name' => 'Onbekende man', 'role' => 'slachtoffer', 'age' => 28, 'case_id' => $cases[1]['id']],
            ['name' => 'Mevrouw Hendriks', 'role' => 'verdachte', 'age' => 65, 'case_id' => $cases[1]['id']],
            ['name' => 'Rechercheur Smit', 'role' => 'rechercheur', 'age' => 45, 'case_id' => $cases[1]['id']],

            // Verdwenen in de Mist
            ['name' => 'Sophie van Dijk', 'role' => 'slachtoffer', 'age' => 32, 'case_id' => $cases[2]['id']],
            ['name' => 'Mark Jansen', 'role' => 'verdachte', 'age' => 41, 'case_id' => $cases[2]['id']],
            ['name' => 'Inspecteur Van Loon', 'role' => 'rechercheur', 'age' => 52, 'case_id' => $cases[2]['id']],

            // Het Bosraadsel
            ['name' => 'Onbekende', 'role' => 'slachtoffer', 'age' => 50, 'case_id' => $cases[3]['id']],
            ['name' => 'Lucas Peeters', 'role' => 'verdachte', 'age' => 34, 'case_id' => $cases[3]['id']],
            ['name' => 'Detective Van Dam', 'role' => 'rechercheur', 'age' => 55, 'case_id' => $cases[3]['id']],

            // Moord bij de Oude Brug
            ['name' => 'Robert Meijer', 'role' => 'slachtoffer', 'age' => 45, 'case_id' => $cases[4]['id']],
            ['name' => 'Anna de Vries', 'role' => 'verdachte', 'age' => 38, 'case_id' => $cases[4]['id']],
            ['name' => 'Inspecteur Bos', 'role' => 'rechercheur', 'age' => 48, 'case_id' => $cases[4]['id']],
        ];

        foreach ($people as $person) {
            $personId = DB::table('people')->insertGetId($person);
            if ($person['role'] === 'rechercheur') {
                DB::table('cases')->where('id', $person['case_id'])->update(['investigator_id' => $personId]);
            }
        }

        $witnesses = [
            // Nachtclub Moord
            ['case_id' => $cases[0]['id'], 'witness_name' => 'Jessica Peters', 'statement' => 'Ik werkte die avond achter de bar en zag DJ Ray Vision rond 02:30 uur de VIP-ruimte inlopen met een onbekende man. Ze leken een verhitte discussie te voeren. Een half uur later hoorde ik een luide knal, maar de muziek stond zo hard dat ik niet zeker wist of het een pistoolschot was. Toen de beveiliging eindelijk ging kijken, lag Ray levenloos op de bank, en de andere man was verdwenen.'],
            ['case_id' => $cases[0]['id'], 'witness_name' => 'Patrick de Wit', 'statement' => 'Ik stond bij de ingang toen ik rond 03:00 uur een man zag wegrennen door de achterdeur. Hij had een zwart leren jasje en droeg een pet. Toen ik hem riep, keek hij even om, maar rende door richting de parkeerplaats. Ik had geen tijd om hem tegen te houden, want op dat moment hoorde ik paniekerig geschreeuw uit de VIP-ruimte.'],
            ['case_id' => $cases[0]['id'], 'witness_name' => 'Kimberly van Dijk', 'statement' => 'Ik was in de VIP-lounge en zag Ray met iemand praten. De man was gespierd en had een tatoeage op zijn rechterpols, een soort slang of draak. Ray leek nerveus. Ik hoorde iets over ‘geld dat ontbrak’ en ‘problemen met de verkeerde mensen’. Een uur later was hij dood...'],

            // Verlaten Treinstation
            ['case_id' => $cases[1]['id'], 'witness_name' => 'Ahmed Karim', 'statement' => 'Ik liep mijn ronde zoals altijd. Rond 03:00 uur zag ik een zwarte BMW stil staan aan de achterkant van het station. De koplampen bleven branden, maar niemand stapte uit. Ik vond het verdacht en liep er naartoe, maar tegen de tijd dat ik dichterbij kwam, reed de auto met hoge snelheid weg. Later die nacht werd een lichaam gevonden in de wachtruimte. Ik zweer dat er iemand op de achterbank van die BMW zat, maar ik kon het gezicht niet zien.'],
            ['case_id' => $cases[1]['id'], 'witness_name' => 'Marieke Vos', 'statement' => 'Ik zat op het perron te wachten op de laatste trein en hoorde een harde klap uit de wachtruimte. Ik dacht eerst dat het iemand was die struikelde, maar toen ik keek, zag ik een schim wegsluipen in de richting van de tunnel. Ik durfde niet dichterbij te komen.'],
            ['case_id' => $cases[1]['id'], 'witness_name' => 'Tom Jansen', 'statement' => 'De avond voordat het lichaam werd gevonden, zag ik een man met een donkere jas en een aktetas op het perron. Hij leek nerveus en bleef steeds op zijn horloge kijken. Een paar minuten later was hij plotseling verdwenen.'],

            // Verdwenen in de Mist
            ['case_id' => $cases[2]['id'], 'witness_name' => 'Anouk de Vries', 'statement' => 'Sophie was een rustige vrouw, maar de laatste paar dagen gedroeg ze zich vreemd. Ze bleef om zich heen kijken als ze naar haar auto liep, alsof ze iemand verwachtte. Op de avond van haar verdwijning zag ik haar in haar oprit stappen, maar ze bleef een tijdje in de auto zitten, telefonerend en gestrest. Een uur later stond haar auto nog steeds met draaiende motor in de straat, met de deur open… en Sophie was nergens te bekennen.'],
            ['case_id' => $cases[2]['id'], 'witness_name' => 'Daan Meijer', 'statement' => 'Ik reed die nacht naar huis en zag een vrouw langs de weg staan. Ze had een lange jas aan en leek overstuur. Ik wilde stoppen om te vragen of ze hulp nodig had, maar toen ik mijn lichten dimde, was ze plotseling verdwenen.'],
            ['case_id' => $cases[2]['id'], 'witness_name' => 'Lotte Sanders', 'statement' => 'Sophie had mij die ochtend gebeld en gezegd dat ze iemand vreesde. Ze wilde niet zeggen wie, alleen dat ze ‘een beslissing had genomen’ en niet wist wat er nu zou gebeuren. Dat was de laatste keer dat ik haar sprak.'],

            // Het Bosraadsel
            ['case_id' => $cases[3]['id'], 'witness_name' => 'Paul Jansen', 'statement' => 'Ik was mijn hond aan het uitlaten in het bos, zoals ik elke avond doe. Rond 22:00 uur hoorde ik een luide schreeuw, het klonk als een man. Mijn hond begon te blaffen en trok aan de lijn, maar toen werd het weer doodstil. Geen voetstappen, geen geluiden van beweging, alleen de wind door de bomen. Ik liep richting het geluid, maar zag niets. Een week later vond een wandelaar menselijke resten in datzelfde gebied...'],
            ['case_id' => $cases[3]['id'], 'witness_name' => 'Eva Vermeer', 'statement' => 'Ik ging ’s ochtends joggen en rook een vreemde geur in het bos. Het was een geur die ik niet kon thuisbrengen, maar ik kreeg er rillingen van. Pas later hoorde ik dat er menselijke resten waren gevonden.'],
            ['case_id' => $cases[3]['id'], 'witness_name' => 'Jan de Vries', 'statement' => 'Er was een oude schuur in het bos die ik vaak passeerde. Een paar dagen voordat de resten werden gevonden, zag ik dat de deur openstond en er licht naar buiten scheen. Toen ik terugliep, was alles donker.'],

            // Moord bij de Oude Brug
            ['case_id' => $cases[4]['id'], 'witness_name' => 'Sven Koopman', 'statement' => 'Ik was onderweg om de ochtendkranten te bezorgen toen ik een man zag wegrennen van de brug. Het was nog donker, en hij had een capuchon op, maar ik zag duidelijk dat hij iets in zijn handen had… het leek op een pistool. Toen ik dichterbij kwam, zag ik een lichaam in de rivier drijven. Ik belde meteen de politie, maar toen ze aankwamen, was het lichaam al meegesleurd door de stroming. Ik weet niet of de politie die man ooit gevonden heeft, maar hij zag eruit alsof hij wist wat hij deed.'],
            ['case_id' => $cases[4]['id'], 'witness_name' => 'Miriam van Beek', 'statement' => 'Ik reed die nacht over de brug en zag een auto langs de kant staan. De motor draaide nog. Toen ik even stopte om te kijken, zag ik niemand, maar ik hoorde iets in het water plonzen.'],
            ['case_id' => $cases[4]['id'], 'witness_name' => 'Hendrik Bos', 'statement' => 'De volgende ochtend zag ik een bebloed kledingstuk onder de brug. Het leek haastig weggegooid, alsof iemand zich ervan probeerde te ontdoen. Ik belde meteen de politie.'],
        ];


        DB::table('witnesses')->insert($witnesses);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
