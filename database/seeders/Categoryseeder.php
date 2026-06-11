<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Helper: build a category row
        $make = fn(string $name, ?int $parent_id = null) => [
            'name'       => $name,
            'slug'       => Str::slug($name) . '-' . rand(100000, 999999),
            'parent_id'  => $parent_id,
            'status'     => true,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // ══════════════════════════════════════════
        //  WAVE 1 — ROOT CATEGORIES (parent = null)
        // ══════════════════════════════════════════
        $roots = [
            'Men', 'Women', 'Kids & Baby', 'Electronics', 'Home & Living',
            'Beauty & Personal Care', 'Sports & Outdoors', 'Automotive',
            'Books & Stationery', 'Toys & Games', 'Health & Wellness',
            'Food & Grocery', 'Jewelry & Watches', 'Pet Supplies',
            'Office & Business', 'Music & Instruments', 'Art & Crafts',
            'Travel & Luggage', 'Garden & Outdoor', 'Industrial & Tools',
        ];

        foreach ($roots as $name) {
            DB::table('categories')->insert($make($name, null));
        }

        // ── Fetch root IDs ──────────────────────────────────────────────
        $r = fn(string $name) =>
            DB::table('categories')->where('name', $name)->whereNull('parent_id')->value('id');

        $men        = $r('Men');
        $women      = $r('Women');
        $kids       = $r('Kids & Baby');
        $electronics= $r('Electronics');
        $home       = $r('Home & Living');
        $beauty     = $r('Beauty & Personal Care');
        $sports     = $r('Sports & Outdoors');
        $auto       = $r('Automotive');
        $books      = $r('Books & Stationery');
        $toys       = $r('Toys & Games');
        $health     = $r('Health & Wellness');
        $food       = $r('Food & Grocery');
        $jewelry    = $r('Jewelry & Watches');
        $pet        = $r('Pet Supplies');
        $office     = $r('Office & Business');
        $music      = $r('Music & Instruments');
        $art        = $r('Art & Crafts');
        $travel     = $r('Travel & Luggage');
        $garden     = $r('Garden & Outdoor');
        $industrial = $r('Industrial & Tools');

        // ══════════════════════════════════════════
        //  WAVE 2 — LEVEL-2 CATEGORIES
        // ══════════════════════════════════════════
        $level2 = [

            // ── MEN ──────────────────────────────
            ['Clothing',              $men],
            ['Shoes',                 $men],
            ['Accessories',           $men],
            ['Sportswear',            $men],
            ['Formal Wear',           $men],
            ['Underwear & Socks',     $men],
            ['Grooming',              $men],
            ['Watches & Sunglasses',  $men],

            // ── WOMEN ────────────────────────────
            ['Clothing',              $women],
            ['Shoes',                 $women],
            ['Accessories',           $women],
            ['Activewear',            $women],
            ['Lingerie & Sleepwear',  $women],
            ['Handbags & Purses',     $women],
            ['Beauty',                $women],
            ['Watches & Jewelry',     $women],

            // ── KIDS & BABY ──────────────────────
            ['Boys Clothing',         $kids],
            ['Girls Clothing',        $kids],
            ['Baby Clothing',         $kids],
            ['Kids Shoes',            $kids],
            ['Toys',                  $kids],
            ['Baby Gear',             $kids],
            ['School Supplies',       $kids],
            ['Kids Accessories',      $kids],

            // ── ELECTRONICS ─────────────────────
            ['Smartphones & Tablets',  $electronics],
            ['Laptops & Computers',    $electronics],
            ['TV & Home Theater',      $electronics],
            ['Audio & Headphones',     $electronics],
            ['Cameras & Photography',  $electronics],
            ['Wearables',              $electronics],
            ['Gaming',                 $electronics],
            ['Home Appliances',        $electronics],
            ['Networking',             $electronics],
            ['Cables & Accessories',   $electronics],
            ['Smart Home',             $electronics],
            ['Drones & RC',            $electronics],

            // ── HOME & LIVING ────────────────────
            ['Furniture',              $home],
            ['Bedding & Bath',         $home],
            ['Kitchen & Dining',       $home],
            ['Home Decor',             $home],
            ['Lighting',               $home],
            ['Storage & Organization', $home],
            ['Cleaning Supplies',      $home],
            ['Rugs & Flooring',        $home],
            ['Wall Art & Frames',      $home],
            ['Curtains & Blinds',      $home],

            // ── BEAUTY & PERSONAL CARE ───────────
            ['Skincare',               $beauty],
            ['Haircare',               $beauty],
            ['Makeup & Cosmetics',     $beauty],
            ['Fragrances',             $beauty],
            ['Nail Care',              $beauty],
            ['Shaving & Hair Removal', $beauty],
            ['Oral Care',              $beauty],
            ['Bath & Body',            $beauty],

            // ── SPORTS & OUTDOORS ────────────────
            ['Exercise & Fitness',     $sports],
            ['Outdoor Recreation',     $sports],
            ['Team Sports',            $sports],
            ['Water Sports',           $sports],
            ['Winter Sports',          $sports],
            ['Cycling',                $sports],
            ['Hunting & Fishing',      $sports],
            ['Yoga & Pilates',         $sports],
            ['Martial Arts',           $sports],
            ['Sports Nutrition',       $sports],

            // ── AUTOMOTIVE ──────────────────────
            ['Car Parts & Accessories', $auto],
            ['Car Electronics',         $auto],
            ['Car Care',                $auto],
            ['Motorcycle',              $auto],
            ['Tools & Equipment',       $auto],
            ['Tires & Wheels',          $auto],

            // ── BOOKS & STATIONERY ───────────────
            ['Books',                  $books],
            ['eBooks & Digital',       $books],
            ['Magazines',              $books],
            ['Office Supplies',        $books],
            ['Pens & Writing',         $books],
            ['Notebooks & Planners',   $books],

            // ── TOYS & GAMES ─────────────────────
            ['Action Figures',         $toys],
            ['Board Games',            $toys],
            ['Building & Construction',$toys],
            ['Dolls & Stuffed Animals',$toys],
            ['Video Games',            $toys],
            ['Outdoor Play',           $toys],
            ['Educational Toys',       $toys],
            ['Puzzles',                $toys],

            // ── HEALTH & WELLNESS ────────────────
            ['Vitamins & Supplements', $health],
            ['Medical Devices',        $health],
            ['First Aid',              $health],
            ['Weight Management',      $health],
            ['Mental Wellness',        $health],
            ['Sexual Health',          $health],

            // ── FOOD & GROCERY ───────────────────
            ['Fresh Produce',          $food],
            ['Dairy & Eggs',           $food],
            ['Meat & Seafood',         $food],
            ['Bakery & Bread',         $food],
            ['Snacks & Chips',         $food],
            ['Beverages',              $food],
            ['Condiments & Sauces',    $food],
            ['Organic & Natural',      $food],
            ['International Foods',    $food],
            ['Frozen Foods',           $food],

            // ── JEWELRY & WATCHES ────────────────
            ['Rings',                  $jewelry],
            ['Necklaces & Pendants',   $jewelry],
            ['Earrings',               $jewelry],
            ['Bracelets & Bangles',    $jewelry],
            ['Watches',                $jewelry],
            ['Fine Jewelry',           $jewelry],
            ['Fashion Jewelry',        $jewelry],

            // ── PET SUPPLIES ─────────────────────
            ['Dogs',                   $pet],
            ['Cats',                   $pet],
            ['Fish & Aquatic',         $pet],
            ['Birds',                  $pet],
            ['Small Animals',          $pet],
            ['Reptiles',               $pet],
            ['Pet Health',             $pet],

            // ── OFFICE & BUSINESS ────────────────
            ['Printers & Scanners',    $office],
            ['Office Furniture',       $office],
            ['Presentation & Display', $office],
            ['Shipping & Packaging',   $office],
            ['Breakroom Supplies',     $office],

            // ── MUSIC & INSTRUMENTS ──────────────
            ['Guitars',                $music],
            ['Keyboards & Pianos',     $music],
            ['Drums & Percussion',     $music],
            ['Wind Instruments',       $music],
            ['String Instruments',     $music],
            ['DJ & Audio Equipment',   $music],
            ['Music Accessories',      $music],

            // ── ART & CRAFTS ─────────────────────
            ['Drawing & Sketching',    $art],
            ['Painting',               $art],
            ['Sewing & Knitting',      $art],
            ['Scrapbooking',           $art],
            ['Jewelry Making',         $art],
            ['Ceramics & Pottery',     $art],

            // ── TRAVEL & LUGGAGE ─────────────────
            ['Luggage & Suitcases',    $travel],
            ['Backpacks & Bags',       $travel],
            ['Travel Accessories',     $travel],
            ['Packing Organizers',     $travel],
            ['Travel Electronics',     $travel],

            // ── GARDEN & OUTDOOR ─────────────────
            ['Plants & Seeds',         $garden],
            ['Garden Tools',           $garden],
            ['Outdoor Furniture',      $garden],
            ['BBQ & Grilling',         $garden],
            ['Lawn Mowers',            $garden],
            ['Irrigation & Watering',  $garden],
            ['Pest Control',           $garden],

            // ── INDUSTRIAL & TOOLS ───────────────
            ['Power Tools',            $industrial],
            ['Hand Tools',             $industrial],
            ['Safety Equipment',       $industrial],
            ['Measuring & Layout',     $industrial],
            ['Fasteners',              $industrial],
            ['Electrical',             $industrial],
            ['Plumbing',               $industrial],
        ];

        foreach ($level2 as [$name, $parentId]) {
            DB::table('categories')->insert($make($name, $parentId));
        }

        // ── Fetch level-2 IDs ───────────────────────────────────────────
        $l2 = fn(string $name, int $parentId) =>
            DB::table('categories')->where('name', $name)->where('parent_id', $parentId)->value('id');

        // Men
        $menClothing    = $l2('Clothing',           $men);
        $menShoes       = $l2('Shoes',              $men);
        $menAcc         = $l2('Accessories',        $men);
        $menSport       = $l2('Sportswear',         $men);
        $menFormal      = $l2('Formal Wear',        $men);
        $menUnder       = $l2('Underwear & Socks',  $men);

        // Women
        $womenClothing  = $l2('Clothing',           $women);
        $womenShoes     = $l2('Shoes',              $women);
        $womenAcc       = $l2('Accessories',        $women);
        $womenActive    = $l2('Activewear',         $women);
        $womenLingerie  = $l2('Lingerie & Sleepwear',$women);
        $womenBags      = $l2('Handbags & Purses',  $women);

        // Kids
        $kidsBoys       = $l2('Boys Clothing',      $kids);
        $kidsGirls      = $l2('Girls Clothing',     $kids);
        $kidsBaby       = $l2('Baby Clothing',      $kids);
        $kidsShoes      = $l2('Kids Shoes',         $kids);
        $kidsToys       = $l2('Toys',               $kids);
        $kidsBabyGear   = $l2('Baby Gear',          $kids);

        // Electronics
        $elecPhones     = $l2('Smartphones & Tablets', $electronics);
        $elecLaptops    = $l2('Laptops & Computers',   $electronics);
        $elecTV         = $l2('TV & Home Theater',     $electronics);
        $elecAudio      = $l2('Audio & Headphones',    $electronics);
        $elecCameras    = $l2('Cameras & Photography', $electronics);
        $elecWearables  = $l2('Wearables',             $electronics);
        $elecGaming     = $l2('Gaming',                $electronics);
        $elecAppliances = $l2('Home Appliances',       $electronics);
        $elecSmartHome  = $l2('Smart Home',            $electronics);

        // Home
        $homeFurniture  = $l2('Furniture',             $home);
        $homeBedding    = $l2('Bedding & Bath',        $home);
        $homeKitchen    = $l2('Kitchen & Dining',      $home);
        $homeDecor      = $l2('Home Decor',            $home);

        // Beauty
        $bSkincare      = $l2('Skincare',              $beauty);
        $bHaircare      = $l2('Haircare',              $beauty);
        $bMakeup        = $l2('Makeup & Cosmetics',    $beauty);

        // Sports
        $sFitness       = $l2('Exercise & Fitness',    $sports);
        $sOutdoor       = $l2('Outdoor Recreation',    $sports);
        $sTeam          = $l2('Team Sports',           $sports);
        $sWater         = $l2('Water Sports',          $sports);
        $sCycling       = $l2('Cycling',               $sports);

        // Pets
        $petDogs        = $l2('Dogs',                  $pet);
        $petCats        = $l2('Cats',                  $pet);

        // Food
        $foodBev        = $l2('Beverages',             $food);
        $foodSnacks     = $l2('Snacks & Chips',        $food);

        // ══════════════════════════════════════════
        //  WAVE 3 — LEVEL-3 CATEGORIES
        // ══════════════════════════════════════════
        $level3 = [

            // ── MEN › Clothing ───────────────────
            ['Hoodies & Sweatshirts',   $menClothing],
            ['Jackets & Vests',         $menClothing],
            ['Pants & Trousers',        $menClothing],
            ['Shorts',                  $menClothing],
            ['Tops & T-Shirts',         $menClothing],
            ['Shirts',                  $menClothing],
            ['Jeans',                   $menClothing],
            ['Suits & Blazers',         $menClothing],
            ['Sweaters & Cardigans',    $menClothing],
            ['Swimwear',                $menClothing],
            ['Tracksuits',              $menClothing],
            ['Coats & Overcoats',       $menClothing],
            ['Ethnic & Kurta',          $menClothing],
            ['Loungewear',              $menClothing],

            // ── MEN › Shoes ──────────────────────
            ['Sneakers',                $menShoes],
            ['Running Shoes',           $menShoes],
            ['Basketball Shoes',        $menShoes],
            ['Soccer Cleats',           $menShoes],
            ['Sandals & Slides',        $menShoes],
            ['Boots',                   $menShoes],
            ['Formal Shoes',            $menShoes],
            ['Loafers & Moccasins',     $menShoes],
            ['Flip Flops',              $menShoes],
            ['Hiking Shoes',            $menShoes],

            // ── MEN › Accessories ────────────────
            ['Bags & Backpacks',        $menAcc],
            ['Hats & Beanies',          $menAcc],
            ['Belts',                   $menAcc],
            ['Wallets',                 $menAcc],
            ['Sunglasses',              $menAcc],
            ['Scarves & Gloves',        $menAcc],
            ['Ties & Pocket Squares',   $menAcc],

            // ── MEN › Sportswear ─────────────────
            ['Sports Tops',             $menSport],
            ['Sports Bottoms',          $menSport],
            ['Compression Wear',        $menSport],
            ['Sports Jackets',          $menSport],

            // ── MEN › Formal Wear ────────────────
            ['Formal Shirts',           $menFormal],
            ['Formal Pants',            $menFormal],
            ['Blazers',                 $menFormal],
            ['Ties',                    $menFormal],
            ['Cufflinks & Accessories', $menFormal],

            // ── MEN › Underwear & Socks ──────────
            ['Briefs & Boxers',         $menUnder],
            ['Undershirts',             $menUnder],
            ['Socks',                   $menUnder],
            ['Thermal Underwear',       $menUnder],

            // ── WOMEN › Clothing ─────────────────
            ['Tops & T-Shirts',         $womenClothing],
            ['Dresses',                 $womenClothing],
            ['Skirts',                  $womenClothing],
            ['Pants & Trousers',        $womenClothing],
            ['Jeans',                   $womenClothing],
            ['Hoodies & Sweatshirts',   $womenClothing],
            ['Jackets & Coats',         $womenClothing],
            ['Sweaters & Cardigans',    $womenClothing],
            ['Shorts',                  $womenClothing],
            ['Blouses & Shirts',        $womenClothing],
            ['Jumpsuits & Rompers',     $womenClothing],
            ['Ethnic & Sarees',         $womenClothing],
            ['Swimwear & Bikinis',      $womenClothing],
            ['Maternity Clothing',      $womenClothing],
            ['Suits & Blazers',         $womenClothing],

            // ── WOMEN › Shoes ────────────────────
            ['Sneakers',                $womenShoes],
            ['Heels & Pumps',           $womenShoes],
            ['Flats & Loafers',         $womenShoes],
            ['Sandals',                 $womenShoes],
            ['Boots & Booties',         $womenShoes],
            ['Wedges',                  $womenShoes],
            ['Running Shoes',           $womenShoes],
            ['Flip Flops',              $womenShoes],
            ['Mules & Slides',          $womenShoes],

            // ── WOMEN › Accessories ──────────────
            ['Handbags',                $womenAcc],
            ['Clutches & Wristlets',    $womenAcc],
            ['Tote Bags',               $womenAcc],
            ['Hair Accessories',        $womenAcc],
            ['Hats & Caps',             $womenAcc],
            ['Scarves & Wraps',         $womenAcc],
            ['Sunglasses',              $womenAcc],
            ['Belts',                   $womenAcc],

            // ── WOMEN › Activewear ───────────────
            ['Sports Bras',             $womenActive],
            ['Leggings & Tights',       $womenActive],
            ['Yoga Pants',              $womenActive],
            ['Sports Tops',             $womenActive],
            ['Athletic Shorts',         $womenActive],
            ['Sports Jackets',          $womenActive],
            ['Sports Shoes',            $womenActive],

            // ── WOMEN › Lingerie ─────────────────
            ['Bras',                    $womenLingerie],
            ['Panties',                 $womenLingerie],
            ['Shapewear',               $womenLingerie],
            ['Nightgowns',              $womenLingerie],
            ['Pajamas & Robes',         $womenLingerie],
            ['Camisoles & Slips',       $womenLingerie],

            // ── WOMEN › Handbags ─────────────────
            ['Shoulder Bags',           $womenBags],
            ['Crossbody Bags',          $womenBags],
            ['Satchels',                $womenBags],
            ['Mini Bags',               $womenBags],
            ['Backpack Purses',         $womenBags],

            // ── KIDS › Boys ──────────────────────
            ['Boys T-Shirts',           $kidsBoys],
            ['Boys Pants & Jeans',      $kidsBoys],
            ['Boys Shorts',             $kidsBoys],
            ['Boys Jackets',            $kidsBoys],
            ['Boys Suits',              $kidsBoys],
            ['Boys Sleepwear',          $kidsBoys],
            ['Boys Swimwear',           $kidsBoys],

            // ── KIDS › Girls ─────────────────────
            ['Girls Dresses',           $kidsGirls],
            ['Girls Tops',              $kidsGirls],
            ['Girls Skirts',            $kidsGirls],
            ['Girls Pants',             $kidsGirls],
            ['Girls Jackets',           $kidsGirls],
            ['Girls Sleepwear',         $kidsGirls],
            ['Girls Swimwear',          $kidsGirls],

            // ── KIDS › Baby ──────────────────────
            ['Onesies & Bodysuits',     $kidsBaby],
            ['Baby Sets',               $kidsBaby],
            ['Baby Sleepwear',          $kidsBaby],
            ['Baby Outerwear',          $kidsBaby],
            ['Baby Accessories',        $kidsBaby],

            // ── KIDS › Shoes ─────────────────────
            ['Boys Sneakers',           $kidsShoes],
            ['Girls Sneakers',          $kidsShoes],
            ['Sandals',                 $kidsShoes],
            ['School Shoes',            $kidsShoes],
            ['Baby Shoes',              $kidsShoes],
            ['Boots',                   $kidsShoes],

            // ── KIDS › Toys ──────────────────────
            ['Action & Adventure',      $kidsToys],
            ['Dolls & Fashion',         $kidsToys],
            ['Cars & Vehicles',         $kidsToys],
            ['Building Blocks',         $kidsToys],
            ['Electronic Toys',         $kidsToys],
            ['Outdoor Toys',            $kidsToys],

            // ── KIDS › Baby Gear ─────────────────
            ['Strollers & Prams',       $kidsBabyGear],
            ['Car Seats',               $kidsBabyGear],
            ['Baby Carriers',           $kidsBabyGear],
            ['High Chairs',             $kidsBabyGear],
            ['Baby Monitors',           $kidsBabyGear],
            ['Diapering',               $kidsBabyGear],
            ['Feeding',                 $kidsBabyGear],
            ['Baby Safety',             $kidsBabyGear],

            // ── ELECTRONICS › Phones ─────────────
            ['Android Phones',          $elecPhones],
            ['iPhones',                 $elecPhones],
            ['Tablets',                 $elecPhones],
            ['iPads',                   $elecPhones],
            ['Phone Cases & Covers',    $elecPhones],
            ['Screen Protectors',       $elecPhones],
            ['Chargers & Cables',       $elecPhones],
            ['Power Banks',             $elecPhones],

            // ── ELECTRONICS › Laptops ────────────
            ['Windows Laptops',         $elecLaptops],
            ['MacBooks',                $elecLaptops],
            ['Chromebooks',             $elecLaptops],
            ['Gaming Laptops',          $elecLaptops],
            ['Desktop Computers',       $elecLaptops],
            ['Monitors',                $elecLaptops],
            ['Laptop Bags',             $elecLaptops],
            ['Keyboards & Mice',        $elecLaptops],
            ['RAM & Storage',           $elecLaptops],

            // ── ELECTRONICS › TV ─────────────────
            ['Smart TVs',               $elecTV],
            ['OLED TVs',                $elecTV],
            ['4K TVs',                  $elecTV],
            ['Projectors',              $elecTV],
            ['TV Accessories',          $elecTV],
            ['Streaming Devices',       $elecTV],
            ['Soundbars',               $elecTV],
            ['Home Theater Systems',    $elecTV],

            // ── ELECTRONICS › Audio ──────────────
            ['Over-Ear Headphones',     $elecAudio],
            ['In-Ear Earphones',        $elecAudio],
            ['Wireless Earbuds',        $elecAudio],
            ['Bluetooth Speakers',      $elecAudio],
            ['Portable Speakers',       $elecAudio],
            ['Home Audio',              $elecAudio],
            ['Microphones',             $elecAudio],
            ['Noise Cancelling',        $elecAudio],

            // ── ELECTRONICS › Cameras ────────────
            ['DSLR Cameras',            $elecCameras],
            ['Mirrorless Cameras',      $elecCameras],
            ['Point & Shoot',           $elecCameras],
            ['Action Cameras',          $elecCameras],
            ['Security Cameras',        $elecCameras],
            ['Camera Lenses',           $elecCameras],
            ['Tripods & Mounts',        $elecCameras],
            ['Camera Bags',             $elecCameras],

            // ── ELECTRONICS › Wearables ──────────
            ['Smartwatches',            $elecWearables],
            ['Fitness Trackers',        $elecWearables],
            ['Smart Glasses',           $elecWearables],
            ['VR Headsets',             $elecWearables],

            // ── ELECTRONICS › Gaming ─────────────
            ['Consoles',                $elecGaming],
            ['Controllers',             $elecGaming],
            ['Gaming Headsets',         $elecGaming],
            ['Gaming Keyboards',        $elecGaming],
            ['Gaming Mice',             $elecGaming],
            ['Gaming Chairs',           $elecGaming],
            ['Game Titles',             $elecGaming],

            // ── ELECTRONICS › Appliances ─────────
            ['Washing Machines',        $elecAppliances],
            ['Refrigerators',           $elecAppliances],
            ['Air Conditioners',        $elecAppliances],
            ['Microwaves',              $elecAppliances],
            ['Vacuum Cleaners',         $elecAppliances],
            ['Air Purifiers',           $elecAppliances],
            ['Dishwashers',             $elecAppliances],
            ['Irons & Steamers',        $elecAppliances],
            ['Fans & Heaters',          $elecAppliances],
            ['Water Purifiers',         $elecAppliances],

            // ── ELECTRONICS › Smart Home ─────────
            ['Smart Speakers',          $elecSmartHome],
            ['Smart Lights',            $elecSmartHome],
            ['Smart Locks',             $elecSmartHome],
            ['Smart Plugs',             $elecSmartHome],
            ['Doorbells & Cameras',     $elecSmartHome],
            ['Smart Thermostats',       $elecSmartHome],

            // ── HOME › Furniture ─────────────────
            ['Sofas & Sectionals',      $homeFurniture],
            ['Beds & Frames',           $homeFurniture],
            ['Wardrobes & Closets',     $homeFurniture],
            ['Dining Tables & Chairs',  $homeFurniture],
            ['Office Desks & Chairs',   $homeFurniture],
            ['Bookshelves',             $homeFurniture],
            ['TV Units',                $homeFurniture],
            ['Coffee Tables',           $homeFurniture],
            ['Cabinets & Sideboards',   $homeFurniture],
            ['Kids Furniture',          $homeFurniture],

            // ── HOME › Bedding & Bath ────────────
            ['Bed Sheets & Covers',     $homeBedding],
            ['Comforters & Duvets',     $homeBedding],
            ['Pillows & Cushions',      $homeBedding],
            ['Mattresses',              $homeBedding],
            ['Towels',                  $homeBedding],
            ['Bath Mats',               $homeBedding],
            ['Shower Curtains',         $homeBedding],

            // ── HOME › Kitchen & Dining ──────────
            ['Cookware',                $homeKitchen],
            ['Bakeware',                $homeKitchen],
            ['Knives & Cutting Boards', $homeKitchen],
            ['Small Appliances',        $homeKitchen],
            ['Dinnerware',              $homeKitchen],
            ['Glassware',               $homeKitchen],
            ['Storage & Containers',    $homeKitchen],
            ['Coffee & Tea',            $homeKitchen],

            // ── HOME › Decor ─────────────────────
            ['Vases & Planters',        $homeDecor],
            ['Candles & Holders',       $homeDecor],
            ['Clocks',                  $homeDecor],
            ['Mirrors',                 $homeDecor],
            ['Photo Frames',            $homeDecor],
            ['Indoor Plants',           $homeDecor],
            ['Decorative Cushions',     $homeDecor],
            ['Figurines & Sculptures',  $homeDecor],

            // ── BEAUTY › Skincare ────────────────
            ['Moisturizers',            $bSkincare],
            ['Serums & Treatments',     $bSkincare],
            ['Cleansers & Toners',      $bSkincare],
            ['Sunscreen & SPF',         $bSkincare],
            ['Eye Creams',              $bSkincare],
            ['Face Masks',              $bSkincare],
            ['Anti-Aging',              $bSkincare],
            ['Acne & Spot Treatments',  $bSkincare],

            // ── BEAUTY › Haircare ────────────────
            ['Shampoos',                $bHaircare],
            ['Conditioners',            $bHaircare],
            ['Hair Oils & Serums',      $bHaircare],
            ['Hair Color & Dye',        $bHaircare],
            ['Hair Styling Tools',      $bHaircare],
            ['Hair Masks & Treatments', $bHaircare],
            ['Wigs & Extensions',       $bHaircare],

            // ── BEAUTY › Makeup ──────────────────
            ['Foundation & Concealer',  $bMakeup],
            ['Lipstick & Lip Gloss',    $bMakeup],
            ['Mascara & Eyeliner',      $bMakeup],
            ['Eyeshadow Palettes',      $bMakeup],
            ['Blush & Bronzer',         $bMakeup],
            ['Makeup Brushes & Tools',  $bMakeup],
            ['Setting & Primers',       $bMakeup],

            // ── SPORTS › Fitness ─────────────────
            ['Treadmills',              $sFitness],
            ['Exercise Bikes',          $sFitness],
            ['Dumbbells & Barbells',    $sFitness],
            ['Resistance Bands',        $sFitness],
            ['Pull-Up Bars',            $sFitness],
            ['Yoga Mats',               $sFitness],
            ['Gym Gloves & Belts',      $sFitness],
            ['Jump Ropes',              $sFitness],
            ['Foam Rollers',            $sFitness],

            // ── SPORTS › Outdoor ─────────────────
            ['Camping & Hiking',        $sOutdoor],
            ['Climbing',                $sOutdoor],
            ['Trekking Poles',          $sOutdoor],
            ['Tents & Shelters',        $sOutdoor],
            ['Sleeping Bags',           $sOutdoor],

            // ── SPORTS › Team Sports ─────────────
            ['Football',                $sTeam],
            ['Basketball',              $sTeam],
            ['Cricket',                 $sTeam],
            ['Volleyball',              $sTeam],
            ['Baseball',                $sTeam],
            ['Rugby',                   $sTeam],
            ['Hockey',                  $sTeam],

            // ── SPORTS › Water Sports ────────────
            ['Swimming',                $sWater],
            ['Surfing',                 $sWater],
            ['Kayaking',                $sWater],
            ['Snorkeling & Diving',     $sWater],
            ['Water Polo',              $sWater],

            // ── SPORTS › Cycling ─────────────────
            ['Road Bikes',              $sCycling],
            ['Mountain Bikes',          $sCycling],
            ['Electric Bikes',          $sCycling],
            ['Kids Bikes',              $sCycling],
            ['Helmets',                 $sCycling],
            ['Bike Accessories',        $sCycling],

            // ── PETS › Dogs ──────────────────────
            ['Dog Food',                $petDogs],
            ['Dog Treats',              $petDogs],
            ['Dog Beds & Crates',       $petDogs],
            ['Dog Clothing',            $petDogs],
            ['Dog Toys',                $petDogs],
            ['Dog Grooming',            $petDogs],
            ['Dog Collars & Leashes',   $petDogs],
            ['Dog Health & Vet',        $petDogs],

            // ── PETS › Cats ──────────────────────
            ['Cat Food',                $petCats],
            ['Cat Treats',              $petCats],
            ['Cat Beds & Trees',        $petCats],
            ['Cat Toys',                $petCats],
            ['Cat Grooming',            $petCats],
            ['Cat Litter & Boxes',      $petCats],
            ['Cat Collars',             $petCats],

            // ── FOOD › Beverages ─────────────────
            ['Water & Juices',          $foodBev],
            ['Soft Drinks',             $foodBev],
            ['Tea & Coffee',            $foodBev],
            ['Energy Drinks',           $foodBev],
            ['Alcohol',                 $foodBev],
            ['Plant-Based Drinks',      $foodBev],

            // ── FOOD › Snacks ────────────────────
            ['Chips & Crisps',          $foodSnacks],
            ['Nuts & Dried Fruits',     $foodSnacks],
            ['Chocolates',              $foodSnacks],
            ['Cookies & Biscuits',      $foodSnacks],
            ['Popcorn',                 $foodSnacks],
            ['Protein Bars',            $foodSnacks],
        ];

        foreach ($level3 as [$name, $parentId]) {
            DB::table('categories')->insert($make($name, $parentId));
        }

        $this->command->info('✅ Category seeder completed!');
        $this->command->info('📦 Total categories: ' . DB::table('categories')->count());
    }
}