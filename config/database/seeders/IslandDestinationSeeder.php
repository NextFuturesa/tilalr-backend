<?php

namespace Database\Seeders;

use App\Models\IslandDestination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IslandDestinationSeeder extends Seeder
{
    
    public function run(): void
    {
        // Define all destinations with their type condition
        $destinations = [
            // LOCAL DESTINATIONS (type = 'local')
            [
                'type' => 'local',
                'title_en' => 'Local island near Farasan',
                'title_ar' => 'جزيرة محلية بالقرب من فرسان',
                'title_zh' => '法拉桑附近的本地岛屿',
                'description_en' => 'A beautiful local island near Farasan.',
                'description_ar' => 'وجهة جزيرة محلية بالقرب من فرسان.',
                'description_zh' => '法拉桑附近美丽的本地岛屿。',
                'location_en' => 'Farasan, Saudi Arabia',
                'location_ar' => 'فرسان، المملكة العربية السعودية',
                'location_zh' => '沙特阿拉伯法拉桑',
                'duration_en' => '3-4 Days',
                'duration_ar' => '3-4 أيام',
                'duration_zh' => '3-4天',
                'groupSize_en' => '2-6 People',
                'groupSize_ar' => '2-6 أشخاص',
                'groupSize_zh' => '2-6人',
                'features_en' => json_encode(['Swimming', 'Snorkeling', 'Beach BBQ']),
                'features_ar' => json_encode(['السباحة', 'الغطس بالأنابيب', 'حفلة شواء الشاطئ']),
                'features_zh' => json_encode(['游泳', '浮潜', '海滩烧烤']),
                'image' => 'islands/354.jpeg',
                'price' => 99.00,
                'rating' => 4.2,
                'slug' => 'local-island-farasan',
                'active' => true,
            ],
            [
                'type' => 'local',
                'title_en' => 'Local island near Umluj',
                'title_ar' => 'جزيرة محلية بالقرب من أملج',
                'title_zh' => '乌姆卢吉附近的本地岛屿',
                'description_en' => 'A beautiful local island near Umluj.',
                'description_ar' => 'وجهة جزيرة محلية بالقرب من أملج.',
                'description_zh' => '乌姆卢吉附近美丽的本地岛屿。',
                'location_en' => 'Umluj, Saudi Arabia',
                'location_ar' => 'أملج، المملكة العربية السعودية',
                'location_zh' => '沙特阿拉伯乌姆卢吉',
                'duration_en' => '2-3 Days',
                'duration_ar' => '2-3 أيام',
                'duration_zh' => '2-3天',
                'groupSize_en' => '2-4 People',
                'groupSize_ar' => '2-4 أشخاص',
                'groupSize_zh' => '2-4人',
                'features_en' => json_encode(['Diving', 'Photography', 'Relaxation']),
                'features_ar' => json_encode(['الغوص', 'التصوير الفوتوغرافي', 'الاسترخاء']),
                'features_zh' => json_encode(['潜水', '摄影', '休闲']),
                'image' => 'international/5.webp',
                'price' => 99.00,
                'rating' => 4.3,
                'slug' => 'local-island-umluj',
                'active' => true,
            ],
            [
                'type' => 'local',
                'title_en' => 'Local island near Al Lith',
                'title_ar' => 'جزيرة محلية بالقرب من الليث',
                'title_zh' => '利斯附近的本地岛屿',
                'description_en' => 'A beautiful local island near Al Lith.',
                'description_ar' => 'وجهة جزيرة محلية بالقرب من الليث.',
                'description_zh' => '利斯附近美丽的本地岛屿。',
                'location_en' => 'Al Lith, Saudi Arabia',
                'location_ar' => 'الليث، المملكة العربية السعودية',
                'location_zh' => '沙特阿拉伯利斯',
                'duration_en' => '2-3 Days',
                'duration_ar' => '2-3 أيام',
                'duration_zh' => '2-3天',
                'groupSize_en' => '2-5 People',
                'groupSize_ar' => '2-5 أشخاص',
                'groupSize_zh' => '2-5人',
                'features_en' => json_encode(['Fishing', 'Beach', 'Water Sports']),
                'features_ar' => json_encode(['صيد السمك', 'الشاطئ', 'الرياضات المائية']),
                'features_zh' => json_encode(['钓鱼', '海滩', '水上运动']),
                'image' => 'international/4.webp',
                'price' => 99.00,
                'rating' => 4.1,
                'slug' => 'local-island-al-lith',
                'active' => true,
            ],

            // INTERNATIONAL DESTINATIONS (type = 'international')
            [
                'type' => 'international',
                'title_en' => 'Maldives Paradise Island',
                'title_ar' => 'جزيرة المالديف الفردوس',
                'title_zh' => '马尔代夫天堂岛',
                'description_en' => 'Experience luxury at its finest with crystal clear waters and pristine beaches.',
                'description_ar' => 'اختبر الفخامة بأفضل صورها مع المياه الصافية والشواطئ النقية.',
                'description_zh' => '体验极致奢华，尽享清澈海水和原始海滩。',
                'location_en' => 'Maldives',
                'location_ar' => 'المالديف',
                'location_zh' => '马尔代夫',
                'duration_en' => '7 Days',
                'duration_ar' => '٧ أيام',
                'duration_zh' => '7天',
                'groupSize_en' => '2-4 People',
                'groupSize_ar' => '٢-٤ أشخاص',
                'groupSize_zh' => '2-4人',
                'features_en' => json_encode(['Water Sports', 'Spa & Wellness', 'Fine Dining', 'Snorkeling']),
                'features_ar' => json_encode(['ألعاب مائية', 'سبا وعافية', 'تناول طعام فاخر', 'الغطس بالأنابيب']),
                'features_zh' => json_encode(['水上运动', '水疗养生', '高级餐饮', '浮潜']),
                'image' => 'international/1.webp',
                'price' => 2500.00,
                'rating' => 4.8,
                'slug' => 'maldives-paradise',
                'active' => true,
            ],
            [
                'type' => 'international',
                'title_en' => 'Bali Island Escape',
                'title_ar' => 'رحلة جزيرة بالي',
                'title_zh' => '巴厘岛逃离之旅',
                'description_en' => 'Discover the cultural richness and natural beauty of Bali with expert guides.',
                'description_ar' => 'اكتشف الثروة الثقافية والجمال الطبيعي لبالي مع الأدلاء الخبراء.',
                'description_zh' => '与专业导游一起探索巴厘岛的文化底蕴和自然美景。',
                'location_en' => 'Indonesia',
                'location_ar' => 'إندونيسيا',
                'location_zh' => '印度尼西亚',
                'duration_en' => '5 Days',
                'duration_ar' => '٥ أيام',
                'duration_zh' => '5天',
                'groupSize_en' => '2-6 People',
                'groupSize_ar' => '٢-٦ أشخاص',
                'groupSize_zh' => '2-6人',
                'features_en' => json_encode(['Temple Tours', 'Yoga Retreat', 'Beach Club', 'Cultural Immersion']),
                'features_ar' => json_encode(['جولات معابد', 'انسحاب يوجا', 'ناد شاطئي', 'الانغماس الثقافي']),
                'features_zh' => json_encode(['寺庙之旅', '瑜伽静修', '海滩俱乐部', '文化沉浸']),
                'image' => 'international/2.webp',
                'price' => 1800.00,
                'rating' => 4.7,
                'slug' => 'bali-escape',
                'active' => true,
            ],
            [
                'type' => 'international',
                'title_en' => 'Seychelles Luxury Retreat',
                'title_ar' => 'ملجأ سيشل الفاخر',
                'title_zh' => '塞舌尔豪华度假',
                'description_en' => 'An exclusive tropical paradise with white sand beaches and turquoise lagoons.',
                'description_ar' => 'جنة استوائية حصرية مع شواطئ رملية بيضاء وبحيرات فيروزية.',
                'description_zh' => '独享热带天堂，白沙海滩和碧绿泻湖。',
                'location_en' => 'Seychelles',
                'location_ar' => 'سيشل',
                'location_zh' => '塞舌尔',
                'duration_en' => '8 Days',
                'duration_ar' => '٨ أيام',
                'duration_zh' => '8天',
                'groupSize_en' => '2-4 People',
                'groupSize_ar' => '٢-٤ أشخاص',
                'groupSize_zh' => '2-4人',
                'features_en' => json_encode(['Diving', 'Private Beach', 'Sunset Cruises', 'Wildlife Tours']),
                'features_ar' => json_encode(['الغوص', 'شاطئ خاص', 'رحلات الغروب', 'جولات الحياة البرية']),
                'features_zh' => json_encode(['潜水', '私人海滩', '日落巡航', '野生动物之旅']),
                'image' => 'international/3.webp',
                'price' => 3200.00,
                'rating' => 4.9,
                'slug' => 'seychelles-luxury',
                'active' => true,
            ],
        ];

        // Insert or update destinations based on type condition
        foreach ($destinations as $destination) {
            IslandDestination::updateOrCreate(
                ['slug' => $destination['slug']],
                $destination
            );
        }

        // Log seeding completion
        $localCount = IslandDestination::where('type', 'local')->count();
        $internationalCount = IslandDestination::where('type', 'international')->count();

        echo "✅ Island Destinations Seeded Successfully!\n";
        echo "   Local: {$localCount} | International: {$internationalCount}\n";
    }
}
