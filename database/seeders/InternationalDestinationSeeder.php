<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternationalDestination;

class InternationalDestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            // UAE
            [
                'name_en' => 'Burj Khalifa Experience',
                'name_ar' => 'تجربة برج خليفة',
                'country_en' => 'UAE',
                'country_ar' => 'الإمارات',
                'city_en' => 'Dubai',
                'city_ar' => 'دبي',
                'description_en' => 'Visit the world\'s tallest building with panoramic views of Dubai',
                'description_ar' => 'زيارة أطول مبنى في العالم مع إطلالات بانورامية على دبي',
                'price' => 500,
                'active' => true,
            ],
            [
                'name_en' => 'Dubai Desert Safari',
                'name_ar' => 'سفاري صحراء دبي',
                'country_en' => 'UAE',
                'country_ar' => 'الإمارات',
                'city_en' => 'Dubai',
                'city_ar' => 'دبي',
                'description_en' => 'Experience the thrill of dune bashing and traditional Bedouin camp',
                'description_ar' => 'استمتع بإثارة القيادة على الكثبان الرملية ومخيم البدو التقليدي',
                'price' => 350,
                'active' => true,
            ],
            [
                'name_en' => 'Abu Dhabi Grand Mosque',
                'name_ar' => 'مسجد الشيخ زايد الكبير',
                'country_en' => 'UAE',
                'country_ar' => 'الإمارات',
                'city_en' => 'Abu Dhabi',
                'city_ar' => 'أبوظبي',
                'description_en' => 'Visit the magnificent Sheikh Zayed Grand Mosque',
                'description_ar' => 'زيارة مسجد الشيخ زايد الكبير الرائع',
                'price' => 250,
                'active' => true,
            ],

            // Turkey
            [
                'name_en' => 'Hagia Sophia Tour',
                'name_ar' => 'جولة آيا صوفيا',
                'country_en' => 'Turkey',
                'country_ar' => 'تركيا',
                'city_en' => 'Istanbul',
                'city_ar' => 'إسطنبول',
                'description_en' => 'Explore the iconic Hagia Sophia museum and mosque',
                'description_ar' => 'استكشف متحف ومسجد آيا صوفيا الأيقوني',
                'price' => 400,
                'active' => true,
            ],
            [
                'name_en' => 'Bosphorus Cruise',
                'name_ar' => 'رحلة بحرية في البوسفور',
                'country_en' => 'Turkey',
                'country_ar' => 'تركيا',
                'city_en' => 'Istanbul',
                'city_ar' => 'إسطنبول',
                'description_en' => 'Scenic cruise along the Bosphorus strait between Europe and Asia',
                'description_ar' => 'رحلة بحرية خلابة على طول مضيق البوسفور بين أوروبا وآسيا',
                'price' => 200,
                'active' => true,
            ],
            [
                'name_en' => 'Cappadocia Hot Air Balloon',
                'name_ar' => 'منطاد كابادوكيا',
                'country_en' => 'Turkey',
                'country_ar' => 'تركيا',
                'city_en' => 'Cappadocia',
                'city_ar' => 'كابادوكيا',
                'description_en' => 'Magical hot air balloon ride over the fairy chimneys',
                'description_ar' => 'رحلة ساحرة بالمنطاد فوق المداخن الجنية',
                'price' => 600,
                'active' => true,
            ],

            // Thailand
            [
                'name_en' => 'Bangkok Temple Tour',
                'name_ar' => 'جولة معابد بانكوك',
                'country_en' => 'Thailand',
                'country_ar' => 'تايلاند',
                'city_en' => 'Bangkok',
                'city_ar' => 'بانكوك',
                'description_en' => 'Visit the Grand Palace and famous Thai temples',
                'description_ar' => 'زيارة القصر الكبير والمعابد التايلاندية الشهيرة',
                'price' => 300,
                'active' => true,
            ],
            [
                'name_en' => 'Phuket Beach Resort',
                'name_ar' => 'منتجع شاطئ بوكيت',
                'country_en' => 'Thailand',
                'country_ar' => 'تايلاند',
                'city_en' => 'Phuket',
                'city_ar' => 'بوكيت',
                'description_en' => 'Relax at beautiful beaches and enjoy water activities',
                'description_ar' => 'استرخِ على الشواطئ الجميلة واستمتع بالأنشطة المائية',
                'price' => 450,
                'active' => true,
            ],

            // Maldives
            [
                'name_en' => 'Maldives Overwater Villa',
                'name_ar' => 'فيلا فوق الماء في المالديف',
                'country_en' => 'Maldives',
                'country_ar' => 'المالديف',
                'city_en' => 'Male',
                'city_ar' => 'ماليه',
                'description_en' => 'Luxury overwater villa experience with crystal clear waters',
                'description_ar' => 'تجربة فيلا فاخرة فوق الماء مع مياه صافية كريستالية',
                'price' => 1500,
                'active' => true,
            ],
            [
                'name_en' => 'Maldives Diving Adventure',
                'name_ar' => 'مغامرة الغوص في المالديف',
                'country_en' => 'Maldives',
                'country_ar' => 'المالديف',
                'city_en' => 'Ari Atoll',
                'city_ar' => 'أتول آري',
                'description_en' => 'Scuba diving with manta rays and tropical fish',
                'description_ar' => 'الغوص مع أسماك المانتا والأسماك الاستوائية',
                'price' => 700,
                'active' => true,
            ],

            // Egypt
            [
                'name_en' => 'Pyramids of Giza Tour',
                'name_ar' => 'جولة أهرامات الجيزة',
                'country_en' => 'Egypt',
                'country_ar' => 'مصر',
                'city_en' => 'Cairo',
                'city_ar' => 'القاهرة',
                'description_en' => 'Explore the ancient wonders of the Pyramids and Sphinx',
                'description_ar' => 'استكشف عجائب الأهرامات وأبو الهول القديمة',
                'price' => 350,
                'active' => true,
            ],
            [
                'name_en' => 'Nile River Cruise',
                'name_ar' => 'رحلة نهر النيل',
                'country_en' => 'Egypt',
                'country_ar' => 'مصر',
                'city_en' => 'Luxor',
                'city_ar' => 'الأقصر',
                'description_en' => 'Cruise along the Nile visiting ancient temples and tombs',
                'description_ar' => 'رحلة بحرية على النيل لزيارة المعابد والمقابر القديمة',
                'price' => 800,
                'active' => true,
            ],
        ];

        foreach ($destinations as $destination) {
            InternationalDestination::updateOrCreate(
                ['name_en' => $destination['name_en']],
                $destination
            );
        }
    }
}
