<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    public function run()
    {
        // Clear existing offers
        DB::table('offers')->truncate();

        $offers = [
            [
                'slug' => 'alula-day-trip',
                'image' => '/islands/354.jpeg',
                'title_en' => 'AlUla Day Trip',
                'title_ar' => 'رحلة العلا يوم واحد',
                'title_zh' => '欧拉一日游',
                'description_en' => 'A full-day AlUla tour visiting natural and heritage highlights with lunch in nature.',
                'description_ar' => 'جولة ليوم كامل في العلا لزيارة المعالم الطبيعية والتراثية مع غداء في الطبيعة.',
                'description_zh' => '欧拉全日游，参观自然和文化遗产景点，含自然午餐。',
                'duration_en' => '1 Day',
                'duration_ar' => 'يوم واحد',
                'duration_zh' => '1天',
                'location_en' => 'AlUla, Saudi Arabia',
                'location_ar' => 'العلا، السعودية',
                'location_zh' => '沙特阿拉伯欧拉',
                'group_size_en' => '2-15 Persons',
                'group_size_ar' => '2-15 أشخاص',
                'group_size_zh' => '2-15人',
                'badge_en' => 'Most Popular',
                'badge_ar' => 'الأكثر شيوعاً',
                'badge_zh' => '最受欢迎',
                'features_en' => json_encode(['Round-trip transportation from Al-Madinah', 'Lunch in nature', 'Guided visits']),
                'features_ar' => json_encode(['المواصلات ذهابًا وعودة من المدينة المنورة', 'وجبة غداء في الطبيعة', 'زيارات بصحبة مرشد']),
                'features_zh' => json_encode(['麦地那往返交通', '自然午餐', '导游服务']),
                'highlights_en' => json_encode(['Al-Maraya Theater (visit subject to availability)', 'Elephant Rock', 'Old Town']),
                'highlights_ar' => json_encode(['مسرح مرايا (حسب التوافر)', 'جبل الفيل', 'البلدة القديمة']),
                'highlights_zh' => json_encode(['玛拉雅剧院（视情况而定）', '象岩', '老城区']),
                'is_active' => true,
            ],
            [
                'slug' => 'alula-two-days',
                'image' => '/islands/1800.jpeg',
                'title_en' => 'Two-Day AlUla Overnight',
                'title_ar' => 'رحلة مبيت يومين للعلا',
                'title_zh' => '欧拉两日游（含住宿）',
                'description_en' => 'A two-day AlUla overnight experience covering key heritage sites, farm stay, and Hegra visit.',
                'description_ar' => 'تجربة مبيت لمدة يومين في العلا تشمل المواقع التراثية الرئيسية والإقامة في مزرعة وزيارة الحجر.',
                'description_zh' => '两天欧拉住宿体验，涵盖主要遗产景点、农场住宿和黑格拉参观。',
                'duration_en' => '2 Days 1 Night',
                'duration_ar' => 'يومان ليلة واحدة',
                'duration_zh' => '2天1晚',
                'location_en' => 'AlUla, Saudi Arabia',
                'location_ar' => 'العلا، السعودية',
                'location_zh' => '沙特阿拉伯欧拉',
                'group_size_en' => '4-20 Persons',
                'group_size_ar' => '4-20 أشخاص',
                'group_size_zh' => '4-20人',
                'badge_en' => 'Limited Spots',
                'badge_ar' => 'أماكن محدودة',
                'badge_zh' => '限量名额',
                'features_en' => json_encode(['Farm stay', 'Guided Hegra visit', 'Meals included']),
                'features_ar' => json_encode(['إقامة في مزرعة', 'زيارة الحجر بصحبة مرشد', 'الوجبات مشمولة']),
                'features_zh' => json_encode(['农场住宿', '黑格拉导览', '含餐']),
                'highlights_en' => json_encode(['Shabtraz Farm', 'Hegra (Mada\'in Saleh)', 'Al-Maraya Theater']),
                'highlights_ar' => json_encode(['مزرعة شابترز', 'الحجر (مدائن صالح)', 'مسرح مرايا']),
                'highlights_zh' => json_encode(['沙布特拉兹农场', '黑格拉（玛甸沙勒）', '玛拉雅剧院']),
                'is_active' => true,
            ],
            [
                'slug' => 'alula-three-days',
                'image' => '/islands/3200.jpeg',
                'title_en' => 'Three Days AlUla Experience',
                'title_ar' => 'رحلة مبيت ٣ أيام العلا',
                'title_zh' => '欧拉三日体验',
                'description_en' => 'A three-day AlUla program featuring camps, guided archaeological tours, and cultural experiences.',
                'description_ar' => 'برنامج لمدة ثلاثة أيام في العلا يتضمن المخيمات والجولات الأثرية المرشدة والتجارب الثقافية.',
                'description_zh' => '三天欧拉项目，包括露营、考古导览和文化体验。',
                'duration_en' => '3 Days 2 Nights',
                'duration_ar' => '3 أيام ليلتان',
                'duration_zh' => '3天2晚',
                'location_en' => 'AlUla, Saudi Arabia',
                'location_ar' => 'العلا، السعودية',
                'location_zh' => '沙特阿拉伯欧拉',
                'group_size_en' => '4-20 Persons',
                'group_size_ar' => '4-20 أشخاص',
                'group_size_zh' => '4-20人',
                'badge_en' => 'New Experience',
                'badge_ar' => 'تجربة جديدة',
                'badge_zh' => '全新体验',
                'features_en' => json_encode(['Camps & farms', 'Guided tours', 'All meals']),
                'features_ar' => json_encode(['مخيمات ومزارع', 'جولات مرشدة', 'جميع الوجبات']),
                'features_zh' => json_encode(['露营和农场', '导览服务', '全餐']),
                'highlights_en' => json_encode(['Hegra', 'Al-Maraya Theater', 'Elephant Rock']),
                'highlights_ar' => json_encode(['الحجر', 'مسرح مرايا', 'جبل الفيل']),
                'highlights_zh' => json_encode(['黑格拉', '玛拉雅剧院', '象岩']),
                'is_active' => true,
            ],
        ];

        foreach ($offers as $o) {
            Offer::create($o);
        }
    }
}
