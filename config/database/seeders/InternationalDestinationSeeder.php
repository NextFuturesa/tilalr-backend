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
                'name_zh' => '哈利法塔体验',
                'country_en' => 'UAE',
                'country_ar' => 'الإمارات',
                'country_zh' => '阿联酋',
                'city_en' => 'Dubai',
                'city_ar' => 'دبي',
                'city_zh' => '迪拜',
                'description_en' => 'Visit the world\'s tallest building with panoramic views of Dubai',
                'description_ar' => 'زيارة أطول مبنى في العالم مع إطلالات بانورامية على دبي',
                'description_zh' => '参观世界最高建筑，欣赏迪拜全景',
                'price' => 500,
                'active' => true,
            ],
            [
                'name_en' => 'Dubai Desert Safari',
                'name_ar' => 'سفاري صحراء دبي',
                'name_zh' => '迪拜沙漠探险',
                'country_en' => 'UAE',
                'country_ar' => 'الإمارات',
                'country_zh' => '阿联酋',
                'city_en' => 'Dubai',
                'city_ar' => 'دبي',
                'city_zh' => '迪拜',
                'description_en' => 'Experience the thrill of dune bashing and traditional Bedouin camp',
                'description_ar' => 'استمتع بإثارة القيادة على الكثبان الرملية ومخيم البدو التقليدي',
                'description_zh' => '体验刺激的沙丘冲浪和传统贝都因营地',
                'price' => 350,
                'active' => true,
            ],
            [
                'name_en' => 'Abu Dhabi Grand Mosque',
                'name_ar' => 'مسجد الشيخ زايد الكبير',
                'name_zh' => '谢赫扎耶德大清真寺',
                'country_en' => 'UAE',
                'country_ar' => 'الإمارات',
                'country_zh' => '阿联酋',
                'city_en' => 'Abu Dhabi',
                'city_ar' => 'أبوظبي',
                'city_zh' => '阿布扎比',
                'description_en' => 'Visit the magnificent Sheikh Zayed Grand Mosque',
                'description_ar' => 'زيارة مسجد الشيخ زايد الكبير الرائع',
                'description_zh' => '参观壮丽的谢赫扎耶德大清真寺',
                'price' => 250,
                'active' => true,
            ],

            // Turkey
            [
                'name_en' => 'Hagia Sophia Tour',
                'name_ar' => 'جولة آيا صوفيا',
                'name_zh' => '圣索菲亚大教堂之旅',
                'country_en' => 'Turkey',
                'country_ar' => 'تركيا',
                'country_zh' => '土耳其',
                'city_en' => 'Istanbul',
                'city_ar' => 'إسطنبول',
                'city_zh' => '伊斯坦布尔',
                'description_en' => 'Explore the iconic Hagia Sophia museum and mosque',
                'description_ar' => 'استكشف متحف ومسجد آيا صوفيا الأيقوني',
                'description_zh' => '探索标志性的圣索菲亚大教堂博物馆和清真寺',
                'price' => 400,
                'active' => true,
            ],
            [
                'name_en' => 'Bosphorus Cruise',
                'name_ar' => 'رحلة بحرية في البوسفور',
                'name_zh' => '博斯普鲁斯海峡巡游',
                'country_en' => 'Turkey',
                'country_ar' => 'تركيا',
                'country_zh' => '土耳其',
                'city_en' => 'Istanbul',
                'city_ar' => 'إسطنبول',
                'city_zh' => '伊斯坦布尔',
                'description_en' => 'Scenic cruise along the Bosphorus strait between Europe and Asia',
                'description_ar' => 'رحلة بحرية خلابة على طول مضيق البوسفور بين أوروبا وآسيا',
                'description_zh' => '沿着连接欧亚的博斯普鲁斯海峡进行风景巡游',
                'price' => 200,
                'active' => true,
            ],
            [
                'name_en' => 'Cappadocia Hot Air Balloon',
                'name_ar' => 'منطاد كابادوكيا',
                'name_zh' => '卡帕多西亚热气球',
                'country_en' => 'Turkey',
                'country_ar' => 'تركيا',
                'country_zh' => '土耳其',
                'city_en' => 'Cappadocia',
                'city_ar' => 'كابادوكيا',
                'city_zh' => '卡帕多西亚',
                'description_en' => 'Magical hot air balloon ride over the fairy chimneys',
                'description_ar' => 'رحلة ساحرة بالمنطاد فوق المداخن الجنية',
                'description_zh' => '在精灵烟囱上空的神奇热气球之旅',
                'price' => 600,
                'active' => true,
            ],

            // Thailand
            [
                'name_en' => 'Bangkok Temple Tour',
                'name_ar' => 'جولة معابد بانكوك',
                'name_zh' => '曼谷寺庙之旅',
                'country_en' => 'Thailand',
                'country_ar' => 'تايلاند',
                'country_zh' => '泰国',
                'city_en' => 'Bangkok',
                'city_ar' => 'بانكوك',
                'city_zh' => '曼谷',
                'description_en' => 'Visit the Grand Palace and famous Thai temples',
                'description_ar' => 'زيارة القصر الكبير والمعابد التايلاندية الشهيرة',
                'description_zh' => '参观大皇宫和著名的泰国寺庙',
                'price' => 300,
                'active' => true,
            ],
            [
                'name_en' => 'Phuket Beach Resort',
                'name_ar' => 'منتجع شاطئ بوكيت',
                'name_zh' => '普吉岛海滩度假村',
                'country_en' => 'Thailand',
                'country_ar' => 'تايلاند',
                'country_zh' => '泰国',
                'city_en' => 'Phuket',
                'city_ar' => 'بوكيت',
                'city_zh' => '普吉岛',
                'description_en' => 'Relax at beautiful beaches and enjoy water activities',
                'description_ar' => 'استرخِ على الشواطئ الجميلة واستمتع بالأنشطة المائية',
                'description_zh' => '在美丽的海滩放松身心，享受水上活动',
                'price' => 450,
                'active' => true,
            ],

            // Maldives
            [
                'name_en' => 'Maldives Overwater Villa',
                'name_ar' => 'فيلا فوق الماء في المالديف',
                'name_zh' => '马尔代夫水上别墅',
                'country_en' => 'Maldives',
                'country_ar' => 'المالديف',
                'country_zh' => '马尔代夫',
                'city_en' => 'Male',
                'city_ar' => 'ماليه',
                'city_zh' => '马累',
                'description_en' => 'Luxury overwater villa experience with crystal clear waters',
                'description_ar' => 'تجربة فيلا فاخرة فوق الماء مع مياه صافية كريستالية',
                'description_zh' => '豪华水上别墅体验，尽享清澈海水',
                'price' => 1500,
                'active' => true,
            ],
            [
                'name_en' => 'Maldives Diving Adventure',
                'name_ar' => 'مغامرة الغوص في المالديف',
                'name_zh' => '马尔代夫潜水探险',
                'country_en' => 'Maldives',
                'country_ar' => 'المالديف',
                'country_zh' => '马尔代夫',
                'city_en' => 'Ari Atoll',
                'city_ar' => 'أتول آري',
                'city_zh' => '阿里环礁',
                'description_en' => 'Scuba diving with manta rays and tropical fish',
                'description_ar' => 'الغوص مع أسماك المانتا والأسماك الاستوائية',
                'description_zh' => '与蝠鲼和热带鱼一起潜水',
                'price' => 700,
                'active' => true,
            ],

            // Egypt
            [
                'name_en' => 'Pyramids of Giza Tour',
                'name_ar' => 'جولة أهرامات الجيزة',
                'name_zh' => '吉萨金字塔之旅',
                'country_en' => 'Egypt',
                'country_ar' => 'مصر',
                'country_zh' => '埃及',
                'city_en' => 'Cairo',
                'city_ar' => 'القاهرة',
                'city_zh' => '开罗',
                'description_en' => 'Explore the ancient wonders of the Pyramids and Sphinx',
                'description_ar' => 'استكشف عجائب الأهرامات وأبو الهول القديمة',
                'description_zh' => '探索金字塔和狮身人面像的古老奇观',
                'price' => 350,
                'active' => true,
            ],
            [
                'name_en' => 'Nile River Cruise',
                'name_ar' => 'رحلة نهر النيل',
                'name_zh' => '尼罗河游船',
                'country_en' => 'Egypt',
                'country_ar' => 'مصر',
                'country_zh' => '埃及',
                'city_en' => 'Luxor',
                'city_ar' => 'الأقصر',
                'city_zh' => '卢克索',
                'description_en' => 'Cruise along the Nile visiting ancient temples and tombs',
                'description_ar' => 'رحلة بحرية على النيل لزيارة المعابد والمقابر القديمة',
                'description_zh' => '沿尼罗河游览古老的神庙和陵墓',
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
