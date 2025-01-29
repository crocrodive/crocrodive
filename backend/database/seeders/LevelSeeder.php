<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private const LEVEL_TABLE_NAME = 'croc_levels';
    private const SKILLS_TABLE_NAME = 'croc_skills';
    private const ABILITIES_TABLE_NAME = 'croc_abilities';

    private const DICTIONNARY = [
        "Débutant" => [],
        "N1" => [
            "S'EQUIPER ET SE DESEQUIPER" => [
                "Gréage et dégréage",
                "Capelage et décapelage",
                "Choix de son matériel personnel",
            ],
            "Se mettre à l'eau et en sortir" => [
                "Saut droit",
                "Bascule arrière",
                "Départ plage",
                "Sortir de l'eau"
            ],
            "Evoluer dans l'eau s'immerger" => [
                "Canard",
                "Phoque"
            ],
            "Evoluer dans l'eau se propulser" => [
                "Palmage ventral en surface",
                "Palmage dorsal",
                "Palmage de sustentation",
                "Palmage en immersion",
                "Nage en capelé"
            ],
            "Evoluer dans l'eau se ventiler" => [
                "Ventilation en immersion",
                "Ventilation sur tuba et vidage du tuba",
                "Vidage du masque",
                "Lâcher et reprise d'embout"
            ],
            "Évoluer dans l'eau s'équilibrer" => [
                "Gestion du gilet de stabilisation",
                "Poumon ballast"
            ],
            "Communiquer" => [
                "Exécution des signes conventionnels"
            ],
            "Appliquer les conduites de sécurité" => [
                "Application des procédures mises e œuvre par le GP",
                "Intervention en relai"
            ],
            "Respecter le milieu et l'environnement" => [
                "Aisance aquatique",
            ],
            "Retourner en surface" => [
                "Maîtrise de la vitesse de remontée",
                "Tenue d'un palier",
                "Tour d'horizon",
                "Gonflage du gilet en surface",
                "Remontée en expiration contrôlée"
            ]
            ],
        "N2" => [
            "ÊTRE ATTENTIF AU MATERIEL DE SES ÉQUIPIERS" => [
                "Mise en oeuvre de son propre matériel",
                "Connaissance du matériel des équipiers"
            ],
            "ÉVOLUER EN AUTONOMIE" => [
                "Sécurité de la palanquée",
            ],
            "PLANIFIER LA PLONGÉE EN FONCTION DES CONSIGNES DU DP" => [
                "Compréhension des directives du DP",
                "Compréhension de la topologie du site de plongée, orientation",
                "Détermination du profil de la plongée et des différentes procédures en immersion."
            ]
        ],
        "N3" => [
            "PLANIFIER LA PLONGÉE" => [
                "Prise en compte des directives du DP",
                "Compréhension de la topologie du site orientation",
                "Determination du profil de la plongée et des différentes procédures en immersion"
            ],
            "ÉVOLUER EN AUTONOMIE" => [
                "Orientation",
                "Evolution subaquatique",
                "Désaturation"
            ],
            "INTERVENIR ET PORTER ASSISTANCE À UN PLONGEUR EN DIFFICULTÉ" => [
                "Observation, compréhension et réaction face à un incident"
            ]
        ],
        "N4" => [],
        "MF1" => [],
        "MF2" => [],
    ];

    public function run(): void
    {
        $levels_data = [
            ['name' => 'Débutant', 'has_courses' => false],
            ['name' => 'N1', 'has_courses' => true, 'instructor_required_level' => 'N2'],
            ['name' => 'N2', 'has_courses' => true, 'instructor_required_level' => 'MF1'],
            ['name' => 'N3', 'has_courses' => true, 'instructor_required_level' => 'MF1'],
            ['name' => 'N4', 'has_courses' => false],
            ['name' => 'MF1', 'has_courses' => false],
            ['name' => 'MF2', 'has_courses' => false],
        ];

        // Map where keys are levels names and values are their ids
        $levels_name_id_map = [];

        foreach($levels_data as $level){
            $insertedId = DB::table(self::LEVEL_TABLE_NAME)->insertGetId([
                "leve_name" => $level['name'],
                "created_at" => now(),
                'leve_has_courses' => $level['has_courses'],
            ]);

            $levels_name_id_map[$level['name']] = $insertedId;

            $this->seedSkillsTable($insertedId, $level['name']);
        }

        foreach($levels_data as $level){
            if(! $level['has_courses']) {
                continue;
            }
            // If the level has courses, set the required level for instructors
            DB::table(self::LEVEL_TABLE_NAME)
                ->where('leve_id', $levels_name_id_map[$level['name']])
                ->update([
                    'instructor_required_level_id' => $levels_name_id_map[$level['instructor_required_level']]
                ])
            ;
        }
    }

    private function seedSkillsTable($leve_id, $level_name){
        $skills = self::DICTIONNARY[$level_name];

        foreach($skills as $skill_name => $abilities){
            $skil_id = Str::uuid();
            DB::table(self::SKILLS_TABLE_NAME)->insertGetId([
                "skil_id" => $skil_id,
                "leve_id" => $leve_id,
                "skil_label" => $skill_name,
                "created_at" => now()
            ]);

            $this->seedAbilitiesTable($skil_id, $abilities);
        }

    }

    private function seedAbilitiesTable($skill_id, $abilities): void{
        foreach($abilities as $ability){
            DB::table(self::ABILITIES_TABLE_NAME)->insert([
                "abil_id" => Str::uuid(),
                "skil_id" => $skill_id,
                "abil_label" => $ability,
                "created_at" => now()
            ]);
        }
    }
}
