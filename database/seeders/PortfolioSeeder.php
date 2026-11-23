<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@beka.uz'],
            [
                'name' => 'Erkinjonov Bexruz',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $setting = SiteSetting::first();
        $settingData = [
                'brand_name' => 'Erkinjonov Bexruz',
                'is_available' => true,
                'status_text_uz' => 'Syomka uchun ochiqman',
                'status_text_ru' => 'Открыт для съёмок',
                'status_text_en' => 'Available for shoots',

                'role_title_uz' => 'Mobilograf',
                'role_title_ru' => 'Мобилограф',
                'role_title_en' => 'Mobilographer',

                'hero_eyebrow_uz' => '4K · 60FPS · MOBILOGRAFIYA & REELS',
                'hero_eyebrow_ru' => '4K · 60FPS · МОБИЛОГРАФИЯ И REELS',
                'hero_eyebrow_en' => '4K · 60FPS · MOBILOGRAPHY & REELS',

                'hero_bio_uz' => "Reels va Shorts, reklama roliklari, biznes va brend videolari, tadbirlar, avto, food hamda shaxsiy bloglar uchun zamonaviy mobil videolar suratga olaman.",
                'hero_bio_ru' => 'Снимаю Reels и Shorts, рекламные ролики, видео для брендов и бизнеса, мероприятия, авто, фуд-съёмку и контент для личных блогов на мобильную камеру.',
                'hero_bio_en' => 'I shoot Reels & Shorts, commercial spots, brand & business videos, events, automotive, food, and personal blog content on mobile.',

                'about_title_uz' => 'Sifatli kadr va zamonaviy montaj',
                'about_title_ru' => 'Качественный кадр и современный монтаж',
                'about_title_en' => 'Clean frames, modern edits',

                'about_text_uz' => "Men Erkinjonov Bexruz — mobilografiya va video montaj bilan shug'ullanaman. Telefon kamerasi yordamida toza kadr, to'g'ri yorug'lik va jonli ritmga asoslangan zamonaviy videolar tayyorlayman. Asosiy e'tiborim — har bir videoda estetik ko'rinish va sifatli vizual natija.",
                'about_text_ru' => 'Я Эркинджонов Бехруз — занимаюсь мобилографией и видеомонтажом. Снимаю на телефон современные ролики с чистой картинкой, правильным светом и живым ритмом. Главный акцент делаю на эстетику и аккуратную подачу каждого кадра.',
                'about_text_en' => "I'm Erkinjonov Bexruz — focused on mobilography and video editing. Using a mobile camera, I shoot clean, well-lit, rhythm-driven videos with close attention to visual aesthetics and smooth pacing.",

                'stat_projects' => '150+',
                'stat_clients' => '45+',
                'stat_views' => '8M+',
                'stat_experience' => '3+',

                'phone' => null,
                'email' => null,
                'telegram' => 'https://t.me/Erkinjonov_29',
                'telegram_channel' => 'https://t.me/erknjnvv7',
                'instagram' => 'https://www.instagram.com/erkinjonovv77',
                'youtube' => null,
                'location_uz' => "Toshkent, O'zbekiston",
                'location_ru' => 'Ташкент, Узбекистан',
                'location_en' => 'Tashkent, Uzbekistan',
        ];

        if ($setting) {
            $setting->update($settingData);
        } else {
            SiteSetting::create($settingData);
        }

        if (Project::count() === 0) {
            $projects = [
                [
                    'title_uz' => 'Premium Kofe Brendi — Dinamik Reels',
                    'title_ru' => 'Премиальный кофейный бренд — Динамичный Reels',
                    'title_en' => 'Specialty Coffee Brand — Dynamic Reels',
                    'description_uz' => "Speed-ramp o'tishlar, makro kadrlar va boy sound-dizayn asosida yaratilgan virusli Reels roligi. 1 hafta ichida 1.2M+ organik ko'rish to'pladi.",
                    'description_ru' => 'Вирусный Reels со speed-ramp переходами, макро-кадрами и плотным саунд-дизайном. Собрал более 1.2M органических просмотров за неделю.',
                    'description_en' => 'Viral Reels crafted with speed-ramp transitions, macro shots, and layered sound design. Generated 1.2M+ organic views in its first week.',
                    'category' => 'reels',
                    'aspect_ratio' => 'vertical',
                    'client_name' => 'Roast & Ritual',
                    'duration' => '0:34',
                    'views_count' => '1.2M',
                    'year' => '2026',
                    'camera_spec' => 'iPhone 16 Pro · 4K 60fps Log',
                    'is_featured' => true,
                    'sort_order' => 1,
                ],
                [
                    'title_uz' => 'Avto Showroom — Tungi Tijorat Roligi',
                    'title_ru' => 'Автосалон — Ночной рекламный ролик',
                    'title_en' => 'Auto Showroom — Night Commercial Spot',
                    'description_uz' => "Neon yorug'lik, gimbal harakatlari va kinematografik rang korreksiyasi bilan ishlangan brend reklama videosi.",
                    'description_ru' => 'Коммерческий ролик с неоновым светом, плавной работой на стабилизаторе и киношной цветокоррекцией.',
                    'description_en' => 'Commercial brand film featuring neon reflections, stabilized tracking shots, and cinematic color grading.',
                    'category' => 'commercial',
                    'aspect_ratio' => 'horizontal',
                    'client_name' => 'Apex Motors UZ',
                    'duration' => '0:58',
                    'views_count' => '840K',
                    'year' => '2026',
                    'camera_spec' => 'iPhone 16 Pro · ProRes 4K',
                    'is_featured' => true,
                    'sort_order' => 2,
                ],
                [
                    'title_uz' => 'Urban Fashion — Kuzgi Kolleksiya',
                    'title_ru' => 'Urban Fashion — Осенняя коллекция',
                    'title_en' => 'Urban Fashion — Autumn Lookbook',
                    'description_uz' => "Streetwear kiyim brendi uchun shahar muhitida suratga olingan ritmik lookbook va Instagram Reels seriyasi.",
                    'description_ru' => 'Ритмичный городской лукбук и серия Instagram Reels для бренда уличной одежды.',
                    'description_en' => 'Rhythmic urban lookbook and Instagram Reels series shot on location for a streetwear label.',
                    'category' => 'brand',
                    'aspect_ratio' => 'vertical',
                    'client_name' => 'NOMA Streetwear',
                    'duration' => '0:42',
                    'views_count' => '620K',
                    'year' => '2026',
                    'camera_spec' => 'iPhone 16 Pro · 4K 120fps',
                    'is_featured' => true,
                    'sort_order' => 3,
                ],
                [
                    'title_uz' => 'Tech Forum 2026 — Tadbir Aftermovie',
                    'title_ru' => 'Tech Forum 2026 — Aftermovie мероприятия',
                    'title_en' => 'Tech Forum 2026 — Event Aftermovie',
                    'description_uz' => "Yirik biznes forumning eng yorqin lahzalari, sahna chiqishlari va jonli muhitini bir kun ichida montaj qilib topshirilgan hisobot videosi.",
                    'description_ru' => 'Отчётное видео с самыми яркими моментами бизнес-форума, смонтированное и сданное в течение 24 часов.',
                    'description_en' => 'High-energy event aftermovie capturing keynotes and atmosphere, edited and delivered within 24 hours.',
                    'category' => 'event',
                    'aspect_ratio' => 'horizontal',
                    'client_name' => 'Digital Summit',
                    'duration' => '1:15',
                    'views_count' => '410K',
                    'year' => '2026',
                    'camera_spec' => 'iPhone 16 Pro · DJI Osmo',
                    'is_featured' => false,
                    'sort_order' => 4,
                ],
                [
                    'title_uz' => 'Restoran Menyu — Food Cinematography',
                    'title_ru' => 'Ресторанное меню — Фуд-видеография',
                    'title_en' => 'Fine Dining — Food Cinematography',
                    'description_uz' => "Taom tayyorlash jarayoni, olov va teksturalarga urg'u berilgan ishtaha ochuvchi vertikal Reels.",
                    'description_ru' => 'Аппетитный вертикальный Reels с акцентом на текстуры, огонь и эстетику подачи блюд.',
                    'description_en' => 'Appetizing vertical Reels highlighting flame, plating textures, and dynamic kitchen energy.',
                    'category' => 'reels',
                    'aspect_ratio' => 'vertical',
                    'client_name' => 'Saffron Kitchen',
                    'duration' => '0:29',
                    'views_count' => '950K',
                    'year' => '2025',
                    'camera_spec' => 'iPhone 15 Pro · Macro 4K',
                    'is_featured' => false,
                    'sort_order' => 5,
                ],
                [
                    'title_uz' => 'Fitness Club — Motivatsion Brend Film',
                    'title_ru' => 'Фитнес-клуб — Мотивационный бренд-фильм',
                    'title_en' => 'Fitness Club — Brand Motivation Film',
                    'description_uz' => "Kuchli kontrast, dinamik kamera harakati va zarbali audio-effektlar bilan ishlangan imidj roligi.",
                    'description_ru' => 'Имиджевый ролик с глубоким контрастом, динамичной камерой и мощным саунд-дизайном.',
                    'description_en' => 'High-contrast brand campaign driven by punchy audio design and kinetic camera movement.',
                    'category' => 'brand',
                    'aspect_ratio' => 'vertical',
                    'client_name' => 'Pulse Arena',
                    'duration' => '0:48',
                    'views_count' => '530K',
                    'year' => '2025',
                    'camera_spec' => 'iPhone 15 Pro · 4K 60fps',
                    'is_featured' => false,
                    'sort_order' => 6,
                ],
            ];

            foreach ($projects as $item) {
                Project::create($item);
            }
        }

        if (Skill::count() === 0) {
            $skills = [
                // Core skills
                ['name_uz' => 'Mobil Syomka & Kompozitsiya', 'name_ru' => 'Мобильная съёмка и композиция', 'name_en' => 'Mobile Cinematography & Framing', 'subtitle_uz' => '4K · 60/120fps · ProRes Log', 'subtitle_ru' => '4K · 60/120fps · ProRes Log', 'subtitle_en' => '4K · 60/120fps · ProRes Log', 'type' => 'skill', 'level' => 98, 'sort_order' => 1],
                ['name_uz' => 'Dinamik Montaj & Speed-Ramp', 'name_ru' => 'Динамичный монтаж и Speed-Ramp', 'name_en' => 'Dynamic Editing & Speed-Ramping', 'subtitle_uz' => 'Ritm · O\'tishlar · Storytelling', 'subtitle_ru' => 'Ритм · Переходы · Сторителлинг', 'subtitle_en' => 'Pacing · Transitions · Storytelling', 'type' => 'skill', 'level' => 96, 'sort_order' => 2],
                ['name_uz' => 'Rang Korreksiyasi (Color Grading)', 'name_ru' => 'Цветокоррекция (Color Grading)', 'name_en' => 'Color Grading & LUTs', 'subtitle_uz' => 'Apple Log · Kino ranglar', 'subtitle_ru' => 'Apple Log · Киношный цвет', 'subtitle_en' => 'Apple Log · Film Emulation', 'type' => 'skill', 'level' => 93, 'sort_order' => 3],
                ['name_uz' => 'Sound Design & Ssenariy', 'name_ru' => 'Саунд-дизайн и сценарий', 'name_en' => 'Sound Design & Scripting', 'subtitle_uz' => 'SFX · Hook · Reels strategiya', 'subtitle_ru' => 'SFX · Хуки · Reels стратегия', 'subtitle_en' => 'SFX · Hooks · Reels Strategy', 'type' => 'skill', 'level' => 90, 'sort_order' => 4],

                // Gear & software
                ['name_uz' => 'iPhone 16 Pro', 'name_ru' => 'iPhone 16 Pro', 'name_en' => 'iPhone 16 Pro', 'subtitle_uz' => 'Asosiy kamera · 4K ProRes Log', 'subtitle_ru' => 'Основная камера · 4K ProRes Log', 'subtitle_en' => 'Primary Camera · 4K ProRes Log', 'type' => 'gear', 'level' => 100, 'sort_order' => 1],
                ['name_uz' => 'DJI Osmo Mobile & Mic 2', 'name_ru' => 'DJI Osmo Mobile и Mic 2', 'name_en' => 'DJI Osmo Mobile & Mic 2', 'subtitle_uz' => 'Stabilizatsiya & toza ovoz', 'subtitle_ru' => 'Стабилизация и чистый звук', 'subtitle_en' => 'Stabilization & Wireless Audio', 'type' => 'gear', 'level' => 100, 'sort_order' => 2],
                ['name_uz' => 'Amaran / Aputure RGB LED', 'name_ru' => 'Amaran / Aputure RGB LED', 'name_en' => 'Amaran / Aputure RGB LED', 'subtitle_uz' => 'Portativ studiya yorug\'ligi', 'subtitle_ru' => 'Портативный студийный свет', 'subtitle_en' => 'Portable Cinema Lighting', 'type' => 'gear', 'level' => 100, 'sort_order' => 3],
                ['name_uz' => 'CapCut Pro · DaVinci · VN', 'name_ru' => 'CapCut Pro · DaVinci · VN', 'name_en' => 'CapCut Pro · DaVinci · VN', 'subtitle_uz' => 'Montaj, SFX va Color Grading', 'subtitle_ru' => 'Монтаж, SFX и цветокоррекция', 'subtitle_en' => 'Editing, SFX & Color Grading', 'type' => 'gear', 'level' => 100, 'sort_order' => 4],
            ];

            foreach ($skills as $skill) {
                Skill::create($skill);
            }
        }

        if (Service::count() === 0) {
            $services = [
                [
                    'title_uz' => 'Reels / Shorts Start',
                    'title_ru' => 'Reels / Shorts Старт',
                    'title_en' => 'Reels / Shorts Starter',
                    'description_uz' => "Shaxsiy brendlar va ekspertlar uchun tezkor va trendga mos qisqa videolar.",
                    'description_ru' => 'Трендовые короткие видео для личных брендов и экспертов.',
                    'description_en' => 'Trend-ready short-form videos tailored for personal brands and creators.',
                    'price_label' => '$80+',
                    'features_uz' => "G'oya va qisqa ssenariy\n2 soatgacha mobil syomka\nDinamik montaj + subtitrlar\nRang korreksiyasi va musiqa\n24-48 soatda tayyor topshirish",
                    'features_ru' => "Идея и короткий сценарий\nДо 2 часов мобильной съёмки\nДинамичный монтаж + субтитры\nЦветокоррекция и подбор музыки\nСдача за 24-48 часов",
                    'features_en' => "Concept & short script\nUp to 2 hours on-location shoot\nDynamic edit + stylized captions\nColor grading & sound polish\n24-48h fast turnaround",
                    'is_popular' => false,
                    'sort_order' => 1,
                ],
                [
                    'title_uz' => 'Brend & Biznes Paket',
                    'title_ru' => 'Бренд и Бизнес Пакет',
                    'title_en' => 'Brand & Business Pack',
                    'description_uz' => "Restoran, do'kon, klinika va bizneslar uchun oy davomida barqaror sifatli video kontent.",
                    'description_ru' => 'Стабильный премиальный видеоконтент для ресторанов, магазинов и бизнеса.',
                    'description_en' => 'Consistent premium video content crafted for restaurants, stores, and growing businesses.',
                    'price_label' => '$350+',
                    'features_uz' => "6-10 ta professional Reels / reklama\nTo'liq kontent-reja va ssenariylar\nQo'shimcha studiya yorug'ligi & mikrofon\nKino darajasida Color Grading & SFX\nInstagram & TikTok formatlariga moslash",
                    'features_ru' => "6-10 профессиональных Reels / роликов\nПолный контент-план и сценарии\nДополнительный свет и петлички\nКиношная цветокоррекция и SFX\nАдаптация под Instagram и TikTok",
                    'features_en' => "6-10 high-impact Reels / promos\nFull content strategy & scripting\nPortable LED lighting & wireless audio\nCinema-grade Color Grading & SFX\nOptimized for Instagram & TikTok",
                    'is_popular' => true,
                    'sort_order' => 2,
                ],
                [
                    'title_uz' => 'Tadbir & Tijorat Syomka',
                    'title_ru' => 'Мероприятие и Реклама',
                    'title_en' => 'Event & Commercial Shoot',
                    'description_uz' => "Ochilish marosimi, forum, taqdimot va maxsus reklama kampaniyalari uchun to'liq qamrov.",
                    'description_ru' => 'Полное видеосопровождение открытий, форумов, презентаций и спецпроектов.',
                    'description_en' => 'Complete visual coverage for launches, summits, showcases, and commercial campaigns.',
                    'price_label' => '$200+',
                    'features_uz' => "Tadbir bo'ylab to'liq syomka (4-6 soat)\n1 ta asosiy Aftermovie (1-2 daqiqa)\n2 ta tezkor Reels (xuddi shu kuni)\nIntervyu va jonli ovoz yozuvi\n4K sifatda bulutli havola orqali topshirish",
                    'features_ru' => "Полная съёмка мероприятия (4-6 часов)\n1 главный Aftermovie (1-2 минуты)\n2 быстрых Reels в день события\nЗапись интервью и чистого звука\nПередача в 4K по облачной ссылке",
                    'features_en' => "Full event coverage (4-6 hours)\n1 hero Aftermovie (1-2 minutes)\n2 same-day highlight Reels\nClean interview & ambient audio\n4K master delivery via cloud link",
                    'is_popular' => false,
                    'sort_order' => 3,
                ],
            ];

            foreach ($services as $service) {
                Service::create($service);
            }
        }

        if (Experience::count() === 0) {
            $experiences = [
                [
                    'period' => '2025 — Hozir',
                    'company' => 'Erkinjonov Bexruz Studio',
                    'role_uz' => 'Asoschi & Bosh Mobilograf',
                    'role_ru' => 'Основатель и ведущий мобилограф',
                    'role_en' => 'Founder & Lead Mobilographer',
                    'description_uz' => "Toshkent va hududlardagi 40 dan ortiq mahalliy hamda xalqaro brendlar uchun tijorat Reels, imidj videolari va kontent strategiyalarini amalga oshirish.",
                    'description_ru' => 'Производство коммерческих Reels, имиджевых роликов и видеостратегий для более чем 40 локальных и международных брендов.',
                    'description_en' => 'Directing and shooting commercial Reels, brand films, and short-form video strategies for 40+ local and international brands.',
                    'sort_order' => 1,
                ],
                [
                    'period' => '2024 — 2025',
                    'company' => 'Creative Digital Agency',
                    'role_uz' => 'Senior Mobilograf & Video Montajchi',
                    'role_ru' => 'Senior Мобилограф и видеомонтажёр',
                    'role_en' => 'Senior Mobilographer & Video Editor',
                    'description_uz' => "HoReCa, moda va texnologiya sohasidagi mijozlar uchun oyiga 30+ qisqa formatli videolarni suratga olish va montaj qilish.",
                    'description_ru' => 'Съёмка и монтаж более 30 коротких видео в месяц для клиентов из сфер HoReCa, fashion и tech.',
                    'description_en' => 'Shot and edited 30+ monthly short-form productions across HoReCa, fashion, and tech accounts.',
                    'sort_order' => 2,
                ],
                [
                    'period' => '2023 — 2024',
                    'company' => 'Freelance Visual Creator',
                    'role_uz' => 'Mobilograf & Kontent Yaratuvchi',
                    'role_ru' => 'Мобилограф и контент-мейкер',
                    'role_en' => 'Mobilographer & Content Creator',
                    'description_uz' => "Shaxsiy blogerlar, tadbirlar va startaplar bilan ishlash orqali mobil kino va tezkor montaj bo'yicha o'z uslubimni shakllantirdim.",
                    'description_ru' => 'Сформировал авторский стиль мобильной съёмки и быстрого монтажа в проектах с блогерами, стартапами и ивентами.',
                    'description_en' => 'Developed a signature mobile filmmaking and rapid-editing style collaborating with creators, startups, and events.',
                    'sort_order' => 3,
                ],
            ];

            foreach ($experiences as $exp) {
                Experience::create($exp);
            }
        }
    }
}
