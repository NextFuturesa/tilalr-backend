<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InternationalFlight;
use App\Models\InternationalHotel;
use App\Models\InternationalPackage;
use App\Models\InternationalDestination;

class InternationalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Flights Data
        InternationalFlight::create([
            'airline_en' => 'Saudia Airlines',
            'airline_ar' => 'الخطوط السعودية',
            'route_en' => 'Jeddah → Dubai',
            'route_ar' => 'جدة → دبي',
            'departure_time' => '12:00 PM',
            'arrival_time' => '04:00 PM',
            'duration' => '2h 30m',
            'stops_en' => 'Non-stop',
            'stops_ar' => 'بدون توقف',
            'active' => true,
        ]);

        InternationalFlight::create([
            'airline_en' => 'Egypt Air',
            'airline_ar' => 'مصر للطيران',
            'route_en' => 'Jeddah → Cairo',
            'route_ar' => 'جدة → القاهرة',
            'departure_time' => '06:00 AM',
            'arrival_time' => '08:30 AM',
            'duration' => '2h 30m',
            'stops_en' => 'Non-stop',
            'stops_ar' => 'بدون توقف',
            'active' => true,
        ]);

        InternationalFlight::create([
            'airline_en' => 'Turkish Airlines',
            'airline_ar' => 'الخطوط التركية',
            'route_en' => 'Riyadh → Istanbul',
            'route_ar' => 'الرياض → إسطنبول',
            'departure_time' => '10:00 AM',
            'arrival_time' => '02:15 PM',
            'duration' => '4h 15m',
            'stops_en' => 'Non-stop',
            'stops_ar' => 'بدون توقف',
            'active' => true,
        ]);

        InternationalFlight::create([
            'airline_en' => 'British Airways',
            'airline_ar' => 'بريتيش إيرويز',
            'route_en' => 'Dammam → London',
            'route_ar' => 'الدمام → لندن',
            'departure_time' => '08:00 PM',
            'arrival_time' => '02:45 AM',
            'duration' => '6h 45m',
            'stops_en' => 'Non-stop',
            'stops_ar' => 'بدون توقف',
            'active' => true,
        ]);

        InternationalFlight::create([
            'airline_en' => 'Qatar Airways',
            'airline_ar' => 'الخطوط القطرية',
            'route_en' => 'Medina → Bangkok',
            'route_ar' => 'المدينة → بانكوك',
            'departure_time' => '02:00 PM',
            'arrival_time' => '09:30 PM',
            'duration' => '7h 30m',
            'stops_en' => '1 stop (Doha)',
            'stops_ar' => 'توقف واحد (الدوحة)',
            'active' => true,
        ]);

        InternationalFlight::create([
            'airline_en' => 'Etihad Airways',
            'airline_ar' => 'الاتحاد للطيران',
            'route_en' => 'Jeddah → Abu Dhabi',
            'route_ar' => 'جدة → أبو ظبي',
            'departure_time' => '07:20 PM',
            'arrival_time' => '11:00 PM',
            'duration' => '2h 25m',
            'stops_en' => 'Non-stop',
            'stops_ar' => 'بدون توقف',
            'active' => true,
        ]);

        // Hotels Data
        InternationalHotel::create([
            'name_en' => 'The St. Regis New York',
            'name_ar' => 'ذا سانت ريجس نيويورك',
            'location_en' => 'New York, USA',
            'location_ar' => 'نيويورك، الولايات المتحدة',
            'description_en' => 'Iconic luxury hotel in the heart of Manhattan',
            'description_ar' => 'فندق فاخر أيقوني في قلب مانهاتن',
            'rating' => 5,
            'image' => 'international/4.webp',
            'amenities_en' => json_encode(['Luxury Rooms', 'Fine Dining', 'Spa', 'City View']),
            'amenities_ar' => json_encode(['غرف فاخرة', 'مطعم فاخر', 'سبا', 'إطلالة على المدينة']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Sheraton Manila Bay',
            'name_ar' => 'شيراتون خليج مانيلا',
            'location_en' => 'Manila, Philippines',
            'location_ar' => 'مانيلا، الفلبين',
            'description_en' => 'Beachfront resort with modern amenities',
            'description_ar' => 'منتجع على الشاطئ مع مرافق حديثة',
            'rating' => 4,
            'image' => 'international/3.webp',
            'amenities_en' => json_encode(['Beach Access', 'Pool', 'Restaurant', 'Gym']),
            'amenities_ar' => json_encode(['وصول الشاطئ', 'مسبح', 'مطعم', 'نادي رياضي']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Sina Bernini Bristol',
            'name_ar' => 'سينا برنيني بريستول',
            'location_en' => 'Rome, Italy',
            'location_ar' => 'روما، إيطاليا',
            'description_en' => 'Historic luxury hotel in ancient Rome',
            'description_ar' => 'فندق فاخر تاريخي في روما القديمة',
            'rating' => 5,
            'image' => 'international/2.webp',
            'amenities_en' => json_encode(['Historic', 'Rooftop Terrace', 'Restaurant', 'Spa']),
            'amenities_ar' => json_encode(['تاريخي', 'شرفة السطح', 'مطعم', 'سبا']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Sofitel Munich Bayerpost',
            'name_ar' => 'سوفيتيل ميونخ بايرفوست',
            'location_en' => 'Munich, Germany',
            'location_ar' => 'ميونخ، ألمانيا',
            'description_en' => 'Modern luxury hotel in Bavaria',
            'description_ar' => 'فندق فاخر حديث في بافاريا',
            'rating' => 4,
            'image' => 'international/1.webp',
            'amenities_en' => json_encode(['Modern Design', 'Pool', 'Spa', 'Restaurant']),
            'amenities_ar' => json_encode(['تصميم حديث', 'مسبح', 'سبا', 'مطعم']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'InterContinental Paris le Grand',
            'name_ar' => 'إنتركونتينينتال باريس لو جراند',
            'location_en' => 'Paris, France',
            'location_ar' => 'باريس، فرنسا',
            'description_en' => 'Legendary Parisian luxury hotel',
            'description_ar' => 'فندق فاخر باريسي أسطوري',
            'rating' => 5,
            'image' => 'international/5.webp',
            'amenities_en' => json_encode(['City View', 'Fine Dining', 'Spa', 'Concierge']),
            'amenities_ar' => json_encode(['إطلالة على المدينة', 'مطعم فاخر', 'سبا', 'خدمة الكونسيرج']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Crowne Plaza Quanzhou Riverview',
            'name_ar' => 'كراون بلازا كوانتشو ريفرفيو',
            'location_en' => 'Quanzhou, China',
            'location_ar' => 'كوانتشو، الصين',
            'description_en' => 'Riverside luxury resort in China',
            'description_ar' => 'منتجع فاخر على النهر في الصين',
            'rating' => 4,
            'image' => 'international/6.webp',
            'amenities_en' => json_encode(['River View', 'Pool', 'Restaurant', 'Gym']),
            'amenities_ar' => json_encode(['إطلالة على النهر', 'مسبح', 'مطعم', 'نادي رياضي']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Hilton Ramses',
            'name_ar' => 'هيلتون رمسيس',
            'location_en' => 'Cairo, Egypt',
            'location_ar' => 'القاهرة، مصر',
            'description_en' => 'Historic luxury hotel on the Nile',
            'description_ar' => 'فندق فاخر تاريخي على النيل',
            'rating' => 4,
            'image' => 'international/7.webp',
            'amenities_en' => json_encode(['Nile View', 'Pool', 'Restaurant', 'Spa']),
            'amenities_ar' => json_encode(['إطلالة على النيل', 'مسبح', 'مطعم', 'سبا']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Pullman Singapore Orchard',
            'name_ar' => 'بولمان سنغافورة أوركارد',
            'location_en' => 'Singapore',
            'location_ar' => 'سنغافورة',
            'description_en' => 'Modern luxury hotel in Singapore',
            'description_ar' => 'فندق فاخر حديث في سنغافورة',
            'rating' => 4,
            'image' => 'international/8.webp',
            'amenities_en' => json_encode(['Rooftop Pool', 'Restaurant', 'Business Center', 'Spa']),
            'amenities_ar' => json_encode(['مسبح السطح', 'مطعم', 'مركز أعمال', 'سبا']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'The Biltmore Hotel Tbilisi',
            'name_ar' => 'ذا بيلتمور هوتيل تبليسي',
            'location_en' => 'Tbilisi, Georgia',
            'location_ar' => 'تبليسي، جورجيا',
            'description_en' => 'Luxury hotel in the heart of Tbilisi',
            'description_ar' => 'فندق فاخر في قلب تبليسي',
            'rating' => 4,
            'image' => 'international/9.webp',
            'amenities_en' => json_encode(['City View', 'Restaurant', 'Spa', 'Gym']),
            'amenities_ar' => json_encode(['إطلالة على المدينة', 'مطعم', 'سبا', 'نادي رياضي']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Taj Coral Reef Resort & Spa Maldives',
            'name_ar' => 'تاج كورال ريف ريسورت وسبا المالديف',
            'location_en' => 'Maldives',
            'location_ar' => 'جزر المالديف',
            'description_en' => 'Tropical paradise resort with water bungalows',
            'description_ar' => 'منتجع جنة استوائية مع أكواخ مائية',
            'rating' => 5,
            'image' => 'international/10.webp',
            'amenities_en' => json_encode(['Water Bungalows', 'Diving', 'Spa', 'Beach']),
            'amenities_ar' => json_encode(['أكواخ مائية', 'الغوص', 'سبا', 'شاطئ']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Jumeirah Bali Resort Indonesia',
            'name_ar' => 'جميرة بالي ريسورت إندونيسيا',
            'location_en' => 'Bali, Indonesia',
            'location_ar' => 'بالي، إندونيسيا',
            'description_en' => 'Beachfront luxury resort in Bali',
            'description_ar' => 'منتجع فاخر على الشاطئ في بالي',
            'rating' => 5,
            'image' => 'international/11.webp',
            'amenities_en' => json_encode(['Beach Access', 'Pool', 'Spa', 'Restaurant']),
            'amenities_ar' => json_encode(['وصول الشاطئ', 'مسبح', 'سبا', 'مطعم']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Anantara The Palm Dubai',
            'name_ar' => 'أنانتارا ذا بالم دبي',
            'location_en' => 'Dubai, UAE',
            'location_ar' => 'دبي، الإمارات',
            'description_en' => 'Ultra-luxury resort on Palm Jumeirah',
            'description_ar' => 'منتجع فاخر جداً على نخلة جميرة',
            'rating' => 5,
            'image' => 'international/12.webp',
            'amenities_en' => json_encode(['Private Beach', 'Infinity Pool', 'Spa', 'Fine Dining']),
            'amenities_ar' => json_encode(['شاطئ خاص', 'مسبح لا متناهي', 'سبا', 'تناول طعام فاخر']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Amari Phuket',
            'name_ar' => 'أماري فوكيت',
            'location_en' => 'Phuket, Thailand',
            'location_ar' => 'فوكيت، تايلاند',
            'description_en' => 'Beachfront resort with Thai hospitality',
            'description_ar' => 'منتجع على الشاطئ مع الضيافة التايلاندية',
            'rating' => 4,
            'image' => 'international/13.webp',
            'amenities_en' => json_encode(['Beach Access', 'Pool', 'Spa', 'Restaurant']),
            'amenities_ar' => json_encode(['وصول الشاطئ', 'مسبح', 'سبا', 'مطعم']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Royal Park Resort Penang',
            'name_ar' => 'رويال بارك ريسورت بينانج',
            'location_en' => 'Penang Island, Malaysia',
            'location_ar' => 'جزيرة بينانج، ماليزيا',
            'description_en' => 'Luxury resort on Penang Island',
            'description_ar' => 'منتجع فاخر على جزيرة بينانج',
            'rating' => 4,
            'image' => 'international/14.webp',
            'amenities_en' => json_encode(['Beach Access', 'Pool', 'Spa', 'Restaurant']),
            'amenities_ar' => json_encode(['وصول الشاطئ', 'مسبح', 'سبا', 'مطعم']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Sunway Hotel Malaysia',
            'name_ar' => 'صن واي هوتيل ماليزيا',
            'location_en' => 'Petaling Jaya, Malaysia',
            'location_ar' => 'بتالينج جايا، ماليزيا',
            'description_en' => 'Modern hotel near Kuala Lumpur',
            'description_ar' => 'فندق حديث بالقرب من كوالالمبور',
            'rating' => 4,
            'image' => 'international/15.webp',
            'amenities_en' => json_encode(['Business Center', 'Pool', 'Restaurant', 'Gym']),
            'amenities_ar' => json_encode(['مركز أعمال', 'مسبح', 'مطعم', 'نادي رياضي']),
            'active' => true,
        ]);

        InternationalHotel::create([
            'name_en' => 'Hilton Jumeirah Dubai',
            'name_ar' => 'هيلتون جميرة دبي',
            'location_en' => 'Dubai, UAE',
            'location_ar' => 'دبي، الإمارات',
            'description_en' => 'Luxury beachfront hotel in Dubai',
            'description_ar' => 'فندق فاخر على الشاطئ في دبي',
            'rating' => 5,
            'image' => 'international/16.webp',
            'amenities_en' => json_encode(['Beach Front', 'Spa', 'Pool', 'Fine Dining']),
            'amenities_ar' => json_encode(['شاطئ خاص', 'سبا', 'مسبح', 'تناول طعام فاخر']),
            'active' => true,
        ]);

        // Packages Data
        InternationalPackage::create([
            'type_en' => 'Cultural Heritage',
            'type_ar' => 'التراث الثقافي',
            'title_en' => 'Yerevan, Armenia',
            'title_ar' => 'يريفان، أرمينيا',
            'description_en' => 'A collection of history and modern life',
            'description_ar' => 'مجموعة من التاريخ والحياة الحديثة',
            'image' => 'international/4.webp',
            'duration_en' => '5 Days 4 Nights',
            'duration_ar' => '٥ أيام ٤ ليالي',
            'discount' => '15% OFF',
            'features_en' => json_encode(['Historic Sites', 'Modern City', 'Local Culture', 'Guided Tours']),
            'features_ar' => json_encode(['المواقع التاريخية', 'مدينة حديثة', 'الثقافة المحلية', 'جولات موجهة']),
            'highlight_en' => 'Best Value',
            'highlight_ar' => 'أفضل قيمة',
            'active' => true,
        ]);

        InternationalPackage::create([
            'type_en' => 'Asia Explorer',
            'type_ar' => 'مستكشف آسيا',
            'title_en' => 'Vietnam & Thailand',
            'title_ar' => 'فيتنام وتايلاند',
            'description_en' => 'All the magic of Asia in one trip',
            'description_ar' => 'كل سحر آسيا في رحلة واحدة',
            'image' => 'international/10.webp',
            'duration_en' => '9 Days 8 Nights',
            'duration_ar' => '٩ أيام ٨ ليالي',
            'discount' => '20% OFF',
            'features_en' => json_encode(['Beach Resorts', 'Cultural Tours', 'Local Cuisine', 'Island Hopping']),
            'features_ar' => json_encode(['منتجعات شاطئية', 'جولات ثقافية', 'المطبخ المحلي', 'القفز بين الجزر']),
            'highlight_en' => 'Popular',
            'highlight_ar' => 'مشهور',
            'active' => true,
        ]);

        InternationalPackage::create([
            'type_en' => 'Heritage Discovery',
            'type_ar' => 'اكتشاف التراث',
            'title_en' => 'Tbilisi, Georgia',
            'title_ar' => 'تبليسي، جورجيا',
            'description_en' => 'The magic of history and modernity in the heart of the Caucasus Mountains',
            'description_ar' => 'سحر التاريخ والحداثة في قلب جبال القوقاز',
            'image' => 'international/8.webp',
            'duration_en' => '4 Days 3 Nights',
            'duration_ar' => '٤ أيام ٣ ليالي',
            'discount' => '10% OFF',
            'features_en' => json_encode(['Historic Sites', 'Wine Tasting', 'Local Cuisine', 'Mountain Views']),
            'features_ar' => json_encode(['المواقع التاريخية', 'تذوق النبيذ', 'المطبخ المحلي', 'إطلالات جبلية']),
            'highlight_en' => 'Unique',
            'highlight_ar' => 'فريد',
            'active' => true,
        ]);

        InternationalPackage::create([
            'type_en' => 'Early Bird',
            'type_ar' => 'الحجز المبكر',
            'title_en' => 'Malaysia - Special Honeymoon',
            'title_ar' => 'ماليزيا - شهر عسل خاص',
            'description_en' => 'Perfect for couples seeking romance and adventure',
            'description_ar' => 'مثالي للأزواج الباحثين عن الرومانسية والمغامرة',
            'image' => 'international/7.webp',
            'duration_en' => '9 Days 8 Nights',
            'duration_ar' => '٩ أيام ٨ ليالي',
            'discount' => '25% OFF',
            'features_en' => json_encode(['Romantic Dinner', 'Spa Treatments', 'Island Tours', 'Sunset Cruise']),
            'features_ar' => json_encode(['عشاء رومانسي', 'علاجات السبا', 'جولات الجزر', 'رحلة الغروب']),
            'highlight_en' => 'Honeymoon Special',
            'highlight_ar' => 'عرض شهر العسل',
            'active' => true,
        ]);

        InternationalPackage::create([
            'type_en' => 'Family',
            'type_ar' => 'عائلة',
            'title_en' => 'Indonesia - Unique Honeymoon',
            'title_ar' => 'إندونيسيا - شهر عسل فريد',
            'description_en' => 'Exotic islands with pristine beaches',
            'description_ar' => 'جزر غريبة مع شواطئ نقية',
            'image' => 'international/9.webp',
            'duration_en' => '8 Days 7 Nights',
            'duration_ar' => '٨ أيام ٧ ليالي',
            'discount' => '18% OFF',
            'features_en' => json_encode(['Beach Resorts', 'Water Sports', 'Cultural Tours', 'Spa Treatments']),
            'features_ar' => json_encode(['منتجعات شاطئية', 'رياضات مائية', 'جولات ثقافية', 'علاجات السبا']),
            'highlight_en' => 'Exotic',
            'highlight_ar' => 'غريب',
            'active' => true,
        ]);

        InternationalPackage::create([
            'type_en' => 'Honeymoon',
            'type_ar' => 'شهر العسل',
            'title_en' => 'Thailand & Malaysia',
            'title_ar' => 'تايلاند وماليزيا',
            'description_en' => 'A fun family trip for everyone',
            'description_ar' => 'رحلة عائلية ممتعة للجميع',
            'image' => 'international/10.webp',
            'duration_en' => '9 Days 8 Nights',
            'duration_ar' => '٩ أيام ٨ ليالي',
            'discount' => '22% OFF',
            'features_en' => json_encode(['Beach Resorts', 'Temple Tours', 'Water Sports', 'Local Markets']),
            'features_ar' => json_encode(['منتجعات شاطئية', 'جولات المعابد', 'رياضات مائية', 'الأسواق المحلية']),
            'highlight_en' => 'Family Friendly',
            'highlight_ar' => 'صديقة للعائلة',
            'active' => true,
        ]);

        InternationalPackage::create([
            'type_en' => 'Last Minute',
            'type_ar' => 'آخر لحظة',
            'title_en' => 'Singapore Romantic',
            'title_ar' => 'سنغافورة الرومانسية',
            'description_en' => 'A romantic city, perfect for a honeymoon',
            'description_ar' => 'مدينة رومانسية، مثالية لشهر العسل',
            'image' => 'international/11.webp',
            'duration_en' => '6 Days 5 Nights',
            'duration_ar' => '٦ أيام ٥ ليالي',
            'discount' => '30% OFF',
            'features_en' => json_encode(['Urban Exploration', 'Fine Dining', 'Shopping', 'Night Life']),
            'features_ar' => json_encode(['استكشاف حضري', 'تناول طعام فاخر', 'التسوق', 'الحياة الليلية']),
            'highlight_en' => 'Hot Deal',
            'highlight_ar' => 'صفقة ساخنة',
            'active' => true,
        ]);

        // Destinations Data
        InternationalDestination::create([
            'name_en' => 'Armenia',
            'name_ar' => 'أرمينيا',
            'description_en' => 'A collection of history and modern life',
            'description_ar' => 'مجموعة من التاريخ والحياة الحديثة',
            'image' => 'international/4.webp',
            'active' => true,
        ]);

        InternationalDestination::create([
            'name_en' => 'Tbilisi, Georgia',
            'name_ar' => 'تبليسي، جورجيا',
            'description_en' => 'The magic of history and the spirit of modernity in the heart of the Caucasus Mountains',
            'description_ar' => 'سحر التاريخ وروح الحداثة في قلب جبال القوقاز',
            'image' => 'international/8.webp',
            'active' => true,
        ]);

        InternationalDestination::create([
            'name_en' => 'Malaysia',
            'name_ar' => 'ماليزيا',
            'description_en' => 'Special honeymoon destination with exotic beaches and culture',
            'description_ar' => 'وجهة شهر عسل خاصة مع شواطئ ثقافة غريبة',
            'image' => 'international/7.webp',
            'active' => true,
        ]);

        InternationalDestination::create([
            'name_en' => 'Indonesia',
            'name_ar' => 'إندونيسيا',
            'description_en' => 'Unique honeymoon destination with pristine beaches and culture',
            'description_ar' => 'وجهة شهر عسل فريدة مع شواطئ نقية وثقافة',
            'image' => 'international/9.webp',
            'active' => true,
        ]);

        InternationalDestination::create([
            'name_en' => 'Singapore',
            'name_ar' => 'سنغافورة',
            'description_en' => 'A romantic city, perfect for a honeymoon',
            'description_ar' => 'مدينة رومانسية، مثالية لشهر العسل',
            'image' => 'international/11.webp',
            'active' => true,
        ]);
    }
}
