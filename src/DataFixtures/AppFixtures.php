<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Recipe;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        // 1. Création de l'utilisateur Admin
        $user = new User();
        $user->setEmail('admin@gourmand.fr');
        $password = $this->hasher->hashPassword($user, 'admin123');
        $user->setPassword($password);
        $manager->persist($user);

        // 2. Création des Catégories et Recettes
        $categoriesData = [
            'Entrées' => [
                [
                    'title' => 'Guacamole mexicain rapide',
                    'description' => 'Une entrée fraîche et épicée idéale pour l\'apéro avec des tortillas de maïs.',
                    'instructions' => "1. Écraser la chair des avocats à la fourchette dans un bol.\n2. Ajouter le jus d'un demi-citron vert.\n3. Incorporer la tomate coupée en dés et l'oignon émincé.\n4. Assaisonner avec le sel et la coriandre.",
                    'prep' => 10,
                    'cook' => 0,
                    'servings' => 4
                ],
                [
                    'title' => 'Velouté de potimarron',
                    'description' => 'Une soupe onctueuse et réconfortante pour l\'hiver.',
                    'instructions' => "1. Couper le potimarron en morceaux.\n2. Faire revenir dans un peu de beurre avec un oignon.\n3. Couvrir d'eau et cuire 20 minutes.\n4. Mixer avec une cuillère de crème fraîche.",
                    'prep' => 15,
                    'cook' => 20,
                    'servings' => 4
                ],
                [
                    'title' => 'Salade Caprese au basilic',
                    'description' => 'La fameuse salade italienne tomates, mozzarella di bufala et huile d\'olive.',
                    'instructions' => "1. Couper les tomates et la mozzarella en rondelles.\n2. Les alterner sur un plat de service.\n3. Arroser d'un filet d'huile d'olive et ajouter les feuilles de basilic frais.",
                    'prep' => 10,
                    'cook' => 0,
                    'servings' => 2
                ],
                [
                    'title' => 'Bruschetta à la tomate et ail',
                    'description' => 'Tranches de pain grillé frottées à l\'ail et garnies de tomates fraîches.',
                    'instructions' => "1. Faire griller les tranches de pain de campagne.\n2. Les frotter avec une gousse d'ail coupée.\n3. Déposer un mélange de tomates en dés, basilic et huile d\'olive.",
                    'prep' => 15,
                    'cook' => 5,
                    'servings' => 4
                ],
                [
                    'title' => 'Soupe à l\'oignon gratinée',
                    'description' => 'Un grand classique de la cuisine française avec du pain grillé et du fromage fondu.',
                    'instructions' => "1. Émincer finement les oignons et les faire caraméliser dans du beurre.\n2. Ajouter la farine, puis mouiller avec le bouillon de bœuf.\n3. Laisser mijoter 20 minutes.\n4. Verser dans des bols, recouvrir de pain et de comté, puis faire gratiner au four.",
                    'prep' => 15,
                    'cook' => 30,
                    'servings' => 4
                ],
                [
                    'title' => 'Tartare de saumon à l\'avocat',
                    'description' => 'Une entrée raffinée à base de saumon frais coupé au couteau et dés d\'avocat.',
                    'instructions' => "1. Couper le saumon frais et l'avocat en petits dés réguliers.\n2. Mélanger dans un bol avec du jus de citron, de l'huile d'olive et de la ciboulette.\n3. Réserver au frais 30 minutes avant de servir à l'emporte-pièce.",
                    'prep' => 20,
                    'cook' => 0,
                    'servings' => 2
                ]
            ],
            'Plats' => [
                [
                    'title' => 'Tartiflette savoyarde',
                    'description' => 'Le grand classique réconfortant à base de pommes de terre, reblochon et lardons.',
                    'instructions' => "1. Cuire les pommes de terre à l'eau.\n2. Faire revenir les oignons et les lardons à la poêle.\n3. Disposer les pommes de terre et le mélange dans un plat à gratin.\n4. Déposer le reblochon coupé en deux par-dessus et enfourner 20 min à 200°C.",
                    'prep' => 20,
                    'cook' => 40,
                    'servings' => 6
                ],
                [
                    'title' => 'Poulet au curry et lait de coco',
                    'description' => 'Un plat exotique simple et rapide à préparer pour la semaine.',
                    'instructions' => "1. Émincer les blancs de poulet et les oignons.\n2. Faire revenir le poulet dans une sauteuse.\n3. Ajouter le curry en poudre, puis verser le lait de coco.\n4. Laisser mijoter 15 minutes à feu doux.",
                    'prep' => 15,
                    'cook' => 15,
                    'servings' => 4
                ],
                [
                    'title' => 'Spaghettis à la Carbonara',
                    'description' => 'La vraie recette italienne avec jaunes d\'œufs, guanciale et pecorino.',
                    'instructions' => "1. Cuire les spaghettis al dente.\n2. Faire dorer les lardons/guanciale sans matière grasse.\n3. Mélanger les jaunes d'œufs et le fromage râpé.\n4. Hors du feu, mélanger les pâtes chaudes avec la préparation à l'œuf.",
                    'prep' => 10,
                    'cook' => 12,
                    'servings' => 3
                ],
                [
                    'title' => 'Risotto aux champignons',
                    'description' => 'Un risotto crémeux au bouillon de légumes et champignons de Paris.',
                    'instructions' => "1. Faire nacrer le riz Arborio avec des échalotes.\n2. Déglacer au vin blanc.\n3. Ajouter le bouillon chaud louche par louche en remuant.\n4. Incorporer les champignons poêlés et le parmesan en fin de cuisson.",
                    'prep' => 15,
                    'cook' => 25,
                    'servings' => 4
                ],
                [
                    'title' => 'Burger maison au cheddar',
                    'description' => 'Un bon burger généreux avec viande hachée fraîche et sauce maison.',
                    'instructions' => "1. Former les steaks hachés et les cuire à la poêle.\n2. Faire fondre le cheddar sur les steaks en fin de cuisson.\n3. Toaster les pains à burger.\n4. Assembler avec salade, tomate, oignon et sauce.",
                    'prep' => 20,
                    'cook' => 10,
                    'servings' => 2
                ],
                [
                    'title' => 'Boeuf Bourguignon traditionnel',
                    'description' => 'Un plat mijoté savoureux à la viande de bœuf, vin rouge et petits légumes.',
                    'instructions' => "1. Faire saisir les morceaux de bœuf dans une cocotte.\n2. Ajouter les carottes, les oignons et सिंगर avec un peu de farine.\n3. Mouiller avec le vin rouge et le bouillon.\n4. Laisser mijoter à feu doux pendant 2h30.",
                    'prep' => 30,
                    'cook' => 150,
                    'servings' => 6
                ],
                [
                    'title' => 'Lasagnes à la bolognaise',
                    'description' => 'Des couches généreuses de pâte à lasagne, sauce viande mijotée et béchamel.',
                    'instructions' => "1. Préparer une sauce bolognaise avec la viande hachée, les tomates et les oignons.\n2. Préparer une sauce béchamel maison.\n3. Alterner les couches de pâte, de bolognaise et de béchamel dans un plat.\n4. Recouvrir de fromage râpé et enfourner 35 min à 180°C.",
                    'prep' => 30,
                    'cook' => 35,
                    'servings' => 6
                ],
                [
                    'title' => 'Pavé de saumon grillé et riz',
                    'description' => 'Une recette saine et équilibrée accompagnée d\'une sauce à l\'aneth.',
                    'instructions' => "1. Cuire le riz basmati à l'eau bouillante salée.\n2. Poêler les pavés de saumon côté peau pendant 4 minutes, puis retourner 2 minutes.\n3. Préparer une sauce rapide avec de la crème, du citron et de l'aneth frais.",
                    'prep' => 10,
                    'cook' => 15,
                    'servings' => 2
                ]
            ],
            'Desserts' => [
                [
                    'title' => 'Tiramisu traditionnel',
                    'description' => 'Un dessert italien fondant au café et au mascarpone, saupoudré de cacao.',
                    'instructions' => "1. Séparer les blancs des jaunes d'œufs.\n2. Fouetter les jaunes avec le sucre puis ajouter le mascarpone.\n3. Monter les blancs en neige et les incorporer délicatement.\n4. Imprimer les biscuits cuillère dans du café fort et alterner les couches.",
                    'prep' => 25,
                    'cook' => 0,
                    'servings' => 6
                ],
                [
                    'title' => 'Fondant au chocolat',
                    'description' => 'Un gâteau gourmand avec un cœur coulant irrésistible.',
                    'instructions' => "1. Faire fondre le chocolat avec le beurre.\n2. Mélanger les œufs, le sucre et la farine.\n3. Incorporer le chocolat fondu.\n4. Verser dans des moules et enfourner 10-12 min à 200°C.",
                    'prep' => 10,
                    'cook' => 12,
                    'servings' => 4
                ],
                [
                    'title' => 'Crumble aux pommes et cannelle',
                    'description' => 'Des pommes fondantes sous une pâte croustillante au beurre et à la cannelle.',
                    'instructions' => "1. Éplucher et couper les pommes en morceaux, puis les faire revenir 5 min.\n2. Préparer la pâte à crumble en sablant le beurre, la farine et le sucre.\n3. Disposer les pommes dans un plat et recouvrir de pâte.\n4. Enfourner 30 min à 180°C.",
                    'prep' => 20,
                    'cook' => 30,
                    'servings' => 5
                ],
                [
                    'title' => 'Mousse au chocolat noir',
                    'description' => 'Une mousse légère et intense avec seulement 2 ingrédients.',
                    'instructions' => "1. Faire fondre le chocolat au bain-marie.\n2. Séparer les œufs, mélanger les jaunes au chocolat.\n3. Monter les blancs en neige très fermes et les incorporer doucement.\n4. Réserver au frais au moins 4 heures.",
                    'prep' => 15,
                    'cook' => 0,
                    'servings' => 4
                ],
                [
                    'title' => 'Crème brûlée à la vanille',
                    'description' => 'Une crème onctueuse parfumée à la vanille avec sa couche de caramel craquant.',
                    'instructions' => "1. Blanchir les jaunes d'œufs avec le sucre.\n2. Faire chauffer la crème avec la gousse de vanille fendue et l'incorporer.\n3. Verser dans des ramequins et cuire 45 min à 100°C.\n4. Saupoudrer de cassonade et brûler au chalumeau avant de servir.",
                    'prep' => 15,
                    'cook' => 45,
                    'servings' => 4
                ],
                [
                    'title' => 'Tarte Tatin aux pommes',
                    'description' => 'La célèbre tarte renversée aux pommes caramélisées au beurre et au sucre.',
                    'instructions' => "1. Faire un caramel au beurre dans un moule à tatin.\n2. Disposer les quartiers de pommes de manière serrée.\n3. Recouvrir avec une pâte feuilletée en rentrant les bords.\n4. Enfourner 30 min à 180°C puis démouler encore chaud.",
                    'prep' => 25,
                    'cook' => 30,
                    'servings' => 6
                ]
            ]
        ];

        foreach ($categoriesData as $categoryName => $recipes) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);

            foreach ($recipes as $data) {
                $recipe = new Recipe();
                $recipe->setTitle($data['title'])
                    ->setDescription($data['description'])
                    ->setInstructions($data['instructions'])
                    ->setPreparationTime($data['prep'])
                    ->setCookingTime($data['cook'])
                    ->setServings($data['servings'])
                    ->setCategory($category);

                // Initialisation des vues à 0
                if (method_exists($recipe, 'setViews')) {
                    $recipe->setViews(0);
                }

                $manager->persist($recipe);
            }
        }

        $manager->flush();
    }
}