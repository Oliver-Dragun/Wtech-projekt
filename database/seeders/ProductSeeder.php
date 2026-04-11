<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            'Basic'    => 1.0,
            'Greater'  => 1.5,
            'Superior' => 2.0,
            'Supreme'  => 2.5,
        ];

        // Base products, each gets 4 grade variants
        $bases = [
            // Potions (category_id = 1)
            ['name' => 'Healing Potion',         'description' => 'A vivid red potion brewed from crimson herbs and moonwater. Instantly restores vitality and closes minor wounds.',           'category_id' => 1, 'effect' => 'Healing',         'base_price' => 20],
            ['name' => 'Speed Potion',           'description' => 'A shimmering golden liquid distilled from swiftroot and lightning beetle wings. Grants unnatural agility and reflexes.',    'category_id' => 1, 'effect' => 'Speed Boost',      'base_price' => 25],
            ['name' => 'Fire Resistance Potion', 'description' => 'A thick orange brew infused with salamander scales and volcanic ash. Grants temporary immunity to heat and flame.',         'category_id' => 1, 'effect' => 'Fire Resistance',  'base_price' => 30],
            ['name' => 'Restoration Potion',     'description' => 'A deep violet elixir combining restorative herbs and purified spring water. Removes fatigue and clears minor ailments.',    'category_id' => 1, 'effect' => 'Restoration',      'base_price' => 28],
            ['name' => 'Mana Potion',            'description' => 'A glowing blue potion condensed from arcane crystals and starlight essence. Rapidly replenishes magical energy.',           'category_id' => 1, 'effect' => 'Mana Restoration', 'base_price' => 18],
            ['name' => 'Invisibility Potion',    'description' => 'A colourless liquid with a faint shimmer, brewed from ghost orchid extract and shadow moss. Makes the drinker invisible.',  'category_id' => 1, 'effect' => 'Invisibility',     'base_price' => 40],
            ['name' => 'Strength Potion',        'description' => 'A dark red potion packed with iron root and giant\'s marrow. Temporarily doubles physical power, ideal before heavy combat.','category_id' => 1, 'effect' => 'Strength',         'base_price' => 35],
            ['name' => 'Fortitude Potion',       'description' => 'A murky brown brew made from stonebark and iron lichen. Hardens the skin and fortifies the body against physical damage.',  'category_id' => 1, 'effect' => 'Fortitude',        'base_price' => 38],

            // Scrolls (category_id = 2)
            ['name' => 'Scroll of Fireball',     'description' => 'A crackling parchment inscribed with ancient fire runes. Unleashes a devastating ball of flame, incinerating foes.',        'category_id' => 2, 'effect' => 'Fire',        'base_price' => 45],
            ['name' => 'Scroll of Healing',      'description' => 'A softly glowing scroll written in sacred ink. When read aloud, it channels restorative energy that mends wounds.',         'category_id' => 2, 'effect' => 'Healing',     'base_price' => 25],
            ['name' => 'Scroll of Lightning',    'description' => 'A scroll that hums with static charge. Upon activation, a bolt of lightning arcs toward the nearest enemy.',                'category_id' => 2, 'effect' => 'Lightning',   'base_price' => 50],
            ['name' => 'Scroll of Protection',   'description' => 'An ancient scroll sealed with a warding glyph. Reading it creates a shimmering barrier that absorbs incoming damage.',      'category_id' => 2, 'effect' => 'Protection',  'base_price' => 55],
            ['name' => 'Scroll of Frost',        'description' => 'A chilled parchment covered in frost runes. Releases a cone of freezing air that slows and damages all enemies.',           'category_id' => 2, 'effect' => 'Frost',       'base_price' => 48],
            ['name' => 'Scroll of Necromancy',   'description' => 'A dark scroll bound in shadow-thread. Raises fallen enemies as temporary undead servants to fight alongside the caster.',   'category_id' => 2, 'effect' => 'Necromancy',  'base_price' => 60],
            ['name' => 'Scroll of Haste',        'description' => 'A wind-touched scroll inscribed with speed glyphs. Grants supernatural quickness for a brief but decisive moment.',         'category_id' => 2, 'effect' => 'Speed Boost', 'base_price' => 30],
            ['name' => 'Scroll of Strength',     'description' => 'A battle scroll etched in blood-red ink. Temporarily infuses the reader with the might of ancient warriors.',               'category_id' => 2, 'effect' => 'Strength',    'base_price' => 50],

            // Orbs (category_id = 3)
            ['name' => 'Orb of Healing',         'description' => 'A smooth, pale green sphere pulsing with gentle light. Channels restorative energy to heal wounds during meditation.',      'category_id' => 3, 'effect' => 'Healing',    'base_price' => 60],
            ['name' => 'Orb of Fire',            'description' => 'A smouldering crimson orb that radiates intense heat. Amplifies fire-based spells and unleashes bursts of flame.',           'category_id' => 3, 'effect' => 'Fire',       'base_price' => 70],
            ['name' => 'Orb of Frost',           'description' => 'A crystal-blue sphere perpetually coated in frost. Enhances ice magic and can freeze enemies in their tracks.',              'category_id' => 3, 'effect' => 'Frost',      'base_price' => 75],
            ['name' => 'Orb of Shadow',          'description' => 'A dark, swirling sphere that absorbs light. Grants mastery over shadow magic and the ability to cloak in darkness.',         'category_id' => 3, 'effect' => 'Necromancy', 'base_price' => 50],
            ['name' => 'Orb of Lightning',       'description' => 'A crackling sphere of pure electrical energy. Arcs of lightning dance across its surface, empowering storm abilities.',      'category_id' => 3, 'effect' => 'Lightning',  'base_price' => 65],
            ['name' => 'Orb of Protection',      'description' => 'A golden orb surrounded by a faint shimmering aura. Creates a protective field around its wielder, deflecting attacks.',     'category_id' => 3, 'effect' => 'Protection', 'base_price' => 80],
            ['name' => 'Orb of Restoration',     'description' => 'A warm amber sphere that glows like a small sun. Slowly regenerates the wielder\'s vitality and cures ailments.',            'category_id' => 3, 'effect' => 'Healing',    'base_price' => 45],
            ['name' => 'Orb of the Void',        'description' => 'A pitch-black sphere that warps light around it. Draws power from the void to unleash devastating dark energy blasts.',      'category_id' => 3, 'effect' => 'Necromancy', 'base_price' => 90],

            // Artifacts (category_id = 4)
            ['name' => 'Flame Blade',            'description' => 'A legendary sword forged in dragonfire, its blade perpetually wreathed in flames. Cuts through armour and sears flesh.',     'category_id' => 4, 'effect' => 'Fire',        'base_price' => 150],
            ['name' => 'Guardian Shield',        'description' => 'A tower shield blessed by temple priests. Emanates a protective aura that deflects physical and magical attacks.',           'category_id' => 4, 'effect' => 'Protection',  'base_price' => 120],
            ['name' => 'Thunderstrike Spear',    'description' => 'A javelin crackling with electrical energy. When thrown, it splits into multiple bolts of lightning arcing between enemies.', 'category_id' => 4, 'effect' => 'Lightning',   'base_price' => 140],
            ['name' => 'Necromancer\'s Staff',   'description' => 'A gnarled staff topped with a skull glowing with eerie green light. Channels dark energy to raise the dead.',               'category_id' => 4, 'effect' => 'Necromancy',  'base_price' => 180],
            ['name' => 'Frostfang Dagger',       'description' => 'A sleek dagger carved from enchanted ice that never melts. Its blade numbs on contact and can freeze a foe\'s blood.',      'category_id' => 4, 'effect' => 'Frost',       'base_price' => 100],
            ['name' => 'Healer\'s Mace',         'description' => 'A golden mace imbued with divine light. Each strike channels restorative energy, healing the wielder while damaging foes.',  'category_id' => 4, 'effect' => 'Healing',     'base_price' => 90],
            ['name' => 'Stormcaller Bow',        'description' => 'A longbow strung with a thread of captured lightning. Arrows crackle with electricity and arc to nearby foes.',              'category_id' => 4, 'effect' => 'Lightning',   'base_price' => 160],
            ['name' => 'Ironbark Greataxe',      'description' => 'A massive axe hewn from petrified ironbark wood. Reinforces the wielder\'s endurance and delivers devastating blows.',      'category_id' => 4, 'effect' => 'Fortitude',   'base_price' => 130],
        ];

        foreach ($bases as $base) {
            $basePrice = $base['base_price'];
            unset($base['base_price']);

            foreach ($grades as $grade => $multiplier) {
                Product::create(array_merge($base, [
                    'grade' => $grade,
                    'price' => (int) round($basePrice * $multiplier),
                ]));
            }
        }

        // ── Bundles (category_id = 5) ─────────────────────────────────
        // Each bundle contains 1 potion + 1 scroll + 1 orb + 1 artifact
        $bundles = [
            [
                'name'        => 'Healer\'s Arsenal',
                'description' => 'The ultimate healing collection. Contains a Healing Potion, Scroll of Healing, Orb of Healing, and Healer\'s Mace: everything needed to keep your party alive.',
                'category_id' => 5,
                'effect'      => 'Healing',
                'grade'       => 'Greater',
                'price'       => 180,
                'is_bundle'   => true,
            ],
            [
                'name'        => 'Pyromancer\'s Kit',
                'description' => 'A blazing set for fire enthusiasts. Includes a Fire Resistance Potion, Scroll of Fireball, Orb of Fire, and the legendary Flame Blade.',
                'category_id' => 5,
                'effect'      => 'Fire',
                'grade'       => 'Superior',
                'price'       => 250,
                'is_bundle'   => true,
            ],
            [
                'name'        => 'Stormcaller\'s Bundle',
                'description' => 'Harness the power of lightning with a Speed Potion, Scroll of Lightning, Orb of Lightning, and Thunderstrike Spear. The storm answers your call.',
                'category_id' => 5,
                'effect'      => 'Lightning',
                'grade'       => 'Superior',
                'price'       => 230,
                'is_bundle'   => true,
            ],
            [
                'name'        => 'Shadow Collector\'s Set',
                'description' => 'For those who walk in darkness. Contains an Invisibility Potion, Scroll of Necromancy, Orb of Shadow, and Necromancer\'s Staff. Embrace the void.',
                'category_id' => 5,
                'effect'      => 'Necromancy',
                'grade'       => 'Supreme',
                'price'       => 300,
                'is_bundle'   => true,
            ],
        ];

        foreach ($bundles as $bundle) {
            Product::create($bundle);
        }
    }
}
