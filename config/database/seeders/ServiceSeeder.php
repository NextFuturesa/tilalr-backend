<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            [
                'slug' => 'school-trips',
                'icon' => 'services/school-trip.webp',
                'name' => json_encode([
                    'en' => 'School Trips',
                    'ar' => 'رحلات المدارس',
                    'zh' => '学校旅行',
                ]),
                'short_description' => json_encode([
                    'en' => 'Fun educational trips combining learning and entertainment, including workshops and cultural site visits.',
                    'ar' => 'رحلات تعليمية ممتعة تجمع بين التعلم والترفيه، تشمل ورش عمل وزيارات لمواقع ثقافية.',
                    'zh' => '寓教于乐的趣味教育旅行，包括工作坊和文化遗址参观。',
                ]),
                'description' => json_encode([
                    'en' => 'We offer fun educational trips that combine learning and entertainment. Includes workshops and visits to cultural sites, providing a unique educational experience for students.',
                    'ar' => 'نقدم رحلات تعليمية ممتعة تجمع بين التعلم والترفيه. تشمل ورش عمل وزيارات لمواقع ثقافية مما يوفر تجربة تعليمية فريدة للطلاب.',
                    'zh' => '我们提供寓教于乐的趣味教育旅行。包括工作坊和文化遗址参观，为学生提供独特的教育体验。',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'corporate-trips',
                'icon' => 'services/corporate-trips.jpeg',
                'name' => json_encode([
                    'en' => 'Corporate Trips',
                    'ar' => 'رحلات الشركات',
                    'zh' => '企业团建',
                ]),
                'short_description' => json_encode([
                    'en' => 'Motivational trips to strengthen cooperation and creativity among employees.',
                    'ar' => 'رحلات تحفيزية لتعزيز التعاون والإبداع بين الموظفين.',
                    'zh' => '激励性旅行，增强员工之间的合作与创造力。',
                ]),
                'description' => json_encode([
                    'en' => 'Make your company events special! We offer motivational trips to enhance cooperation and creativity among employees, with interactive activities and team building to strengthen group spirit.',
                    'ar' => 'اجعل فعاليات شركتك مميزة! نقدم رحلات تحفيزية لتعزيز التعاون والإبداع بين الموظفين مع أنشطة تفاعلية وبناء فرق لتعزيز الروح الجماعية.',
                    'zh' => '让您的公司活动与众不同！我们提供激励性旅行，通过互动活动和团队建设增强员工之间的合作与创造力，培养团队精神。',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'family-private-group-trips',
                'icon' => 'services/family-trips.jpeg',
                'name' => json_encode([
                    'en' => 'Family & Private Group Trips',
                    'ar' => 'رحلات العوائل والمجموعات الخاصة',
                    'zh' => '家庭与私人团体旅行',
                ]),
                'short_description' => json_encode([
                    'en' => 'Custom trips for families and private groups with unforgettable experiences.',
                    'ar' => 'رحلات مخصصة للعوائل والمجموعات الخاصة بتجارب لا تنسى.',
                    'zh' => '为家庭和私人团体定制的旅行，提供难忘的体验。',
                ]),
                'description' => json_encode([
                    'en' => 'Enjoy wonderful time with your family or friends! We offer customized trips suitable for all tastes, with unique experiences that guarantee unforgettable memories.',
                    'ar' => 'استمتع بوقت ممتع مع عائلتك أو أصدقائك! نقدم رحلات مخصصة تناسب جميع الأذواق مع تجارب فريدة تضمن لكم ذكريات لا تنسى.',
                    'zh' => '与家人或朋友共度美好时光！我们提供适合各种口味的定制旅行，独特的体验将为您留下难忘的回忆。',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
