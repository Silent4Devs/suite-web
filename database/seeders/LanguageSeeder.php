<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     $langua = [
    //         'ab' => [
    //             'idioma' => 'Abkhaz',
    //             'nativeName' => 'аҧсуа',
    //         ],
    //         'aa' => [
    //             'idioma' => 'Afar',
    //             'nativeName' => 'Afaraf',
    //         ],
    //         'af' => [
    //             'idioma' => 'Afrikaans',
    //             'nativeName' => 'Afrikaans',
    //         ],
    //         'ak' => [
    //             'idioma' => 'Akan',
    //             'nativeName' => 'Akan',
    //         ],
    //         'sq' => [
    //             'idioma' => 'Albanian',
    //             'nativeName' => 'Shqip',
    //         ],
    //         'am' => [
    //             'idioma' => 'Amharic',
    //             'nativeName' => 'አማርኛ',
    //         ],
    //         'ar' => [
    //             'idioma' => 'Arabic',
    //             'nativeName' => 'العربية',
    //         ],
    //         'an' => [
    //             'idioma' => 'Aragonese',
    //             'nativeName' => 'Aragonés',
    //         ],
    //         'hy' => [
    //             'idioma' => 'Armenian',
    //             'nativeName' => 'Հայերեն',
    //         ],
    //         'as' => [
    //             'idioma' => 'Assamese',
    //             'nativeName' => 'অসমীয়া',
    //         ],
    //         'av' => [
    //             'idioma' => 'Avaric',
    //             'nativeName' => 'авар мацӀ, магӀарул мацӀ',
    //         ],
    //         'ae' => [
    //             'idioma' => 'Avestan',
    //             'nativeName' => 'avesta',
    //         ],
    //         'ay' => [
    //             'idioma' => 'Aymara',
    //             'nativeName' => 'aymar aru',
    //         ],
    //         'az' => [
    //             'idioma' => 'Azerbaijani',
    //             'nativeName' => 'azərbaycan dili',
    //         ],
    //         'bm' => [
    //             'idioma' => 'Bambara',
    //             'nativeName' => 'bamanankan',
    //         ],
    //         'ba' => [
    //             'idioma' => 'Bashkir',
    //             'nativeName' => 'башҡорт теле',
    //         ],
    //         'eu' => [
    //             'idioma' => 'Basque',
    //             'nativeName' => 'euskara, euskera',
    //         ],
    //         'be' => [
    //             'idioma' => 'Belarusian',
    //             'nativeName' => 'Беларуская',
    //         ],
    //         'bn' => [
    //             'idioma' => 'Bengali',
    //             'nativeName' => 'বাংলা',
    //         ],
    //         'bh' => [
    //             'idioma' => 'Bihari',
    //             'nativeName' => 'भोजपुरी',
    //         ],
    //         'bi' => [
    //             'idioma' => 'Bislama',
    //             'nativeName' => 'Bislama',
    //         ],
    //         'bs' => [
    //             'idioma' => 'Bosnian',
    //             'nativeName' => 'bosanski jezik',
    //         ],
    //         'br' => [
    //             'idioma' => 'Breton',
    //             'nativeName' => 'brezhoneg',
    //         ],
    //         'bg' => [
    //             'idioma' => 'Bulgarian',
    //             'nativeName' => 'български език',
    //         ],
    //         'my' => [
    //             'idioma' => 'Burmese',
    //             'nativeName' => 'ဗမာစာ',
    //         ],
    //         'ca' => [
    //             'idioma' => 'Catalan; Valencian',
    //             'nativeName' => 'Català',
    //         ],
    //         'ch' => [
    //             'idioma' => 'Chamorro',
    //             'nativeName' => 'Chamoru',
    //         ],
    //         'ce' => [
    //             'idioma' => 'Chechen',
    //             'nativeName' => 'нохчийн мотт',
    //         ],
    //         'ny' => [
    //             'idioma' => 'Chichewa; Chewa; Nyanja',
    //             'nativeName' => 'chiCheŵa, chinyanja',
    //         ],
    //         'zh' => [
    //             'idioma' => 'Chinese',
    //             'nativeName' => '中文 (Zhōngwén), 汉语, 漢語',
    //         ],
    //         'cv' => [
    //             'idioma' => 'Chuvash',
    //             'nativeName' => 'чӑваш чӗлхи',
    //         ],
    //         'kw' => [
    //             'idioma' => 'Cornish',
    //             'nativeName' => 'Kernewek',
    //         ],
    //         'co' => [
    //             'idioma' => 'Corsican',
    //             'nativeName' => 'corsu, lingua corsa',
    //         ],
    //         'cr' => [
    //             'idioma' => 'Cree',
    //             'nativeName' => 'ᓀᐦᐃᔭᐍᐏᐣ',
    //         ],
    //         'hr' => [
    //             'idioma' => 'Croatian',
    //             'nativeName' => 'hrvatski',
    //         ],
    //         'cs' => [
    //             'idioma' => 'Czech',
    //             'nativeName' => 'česky, čeština',
    //         ],
    //         'da' => [
    //             'idioma' => 'Danish',
    //             'nativeName' => 'dansk',
    //         ],
    //         'dv' => [
    //             'idioma' => 'Divehi; Dhivehi; Maldivian;',
    //             'nativeName' => 'ދިވެހި',
    //         ],
    //         'nl' => [
    //             'idioma' => 'Dutch',
    //             'nativeName' => 'Nederlands, Vlaams',
    //         ],
    //         'en' => [
    //             'idioma' => 'English',
    //             'nativeName' => 'English',
    //         ],
    //         'eo' => [
    //             'idioma' => 'Esperanto',
    //             'nativeName' => 'Esperanto',
    //         ],
    //         'et' => [
    //             'idioma' => 'Estonian',
    //             'nativeName' => 'eesti, eesti keel',
    //         ],
    //         'ee' => [
    //             'idioma' => 'Ewe',
    //             'nativeName' => 'Eʋegbe',
    //         ],
    //         'fo' => [
    //             'idioma' => 'Faroese',
    //             'nativeName' => 'føroyskt',
    //         ],
    //         'fj' => [
    //             'idioma' => 'Fijian',
    //             'nativeName' => 'vosa Vakaviti',
    //         ],
    //         'fi' => [
    //             'idioma' => 'Finnish',
    //             'nativeName' => 'suomi, suomen kieli',
    //         ],
    //         'fr' => [
    //             'idioma' => 'French',
    //             'nativeName' => 'français, langue française',
    //         ],
    //         'ff' => [
    //             'idioma' => 'Fula; Fulah; Pulaar; Pular',
    //             'nativeName' => 'Fulfulde, Pulaar, Pular',
    //         ],
    //         'gl' => [
    //             'idioma' => 'Galician',
    //             'nativeName' => 'Galego',
    //         ],
    //         'ka' => [
    //             'idioma' => 'Georgian',
    //             'nativeName' => 'ქართული',
    //         ],
    //         'de' => [
    //             'idioma' => 'German',
    //             'nativeName' => 'Deutsch',
    //         ],
    //         'el' => [
    //             'idioma' => 'Greek, Modern',
    //             'nativeName' => 'Ελληνικά',
    //         ],
    //         'gn' => [
    //             'idioma' => 'Guaraní',
    //             'nativeName' => 'Avañeẽ',
    //         ],
    //         'gu' => [
    //             'idioma' => 'Gujarati',
    //             'nativeName' => 'ગુજરાતી',
    //         ],
    //         'ht' => [
    //             'idioma' => 'Haitian; Haitian Creole',
    //             'nativeName' => 'Kreyòl ayisyen',
    //         ],
    //         'ha' => [
    //             'idioma' => 'Hausa',
    //             'nativeName' => 'Hausa, هَوُسَ',
    //         ],
    //         'he' => [
    //             'idioma' => 'Hebrew (modern)',
    //             'nativeName' => 'עברית',
    //         ],
    //         'hz' => [
    //             'idioma' => 'Herero',
    //             'nativeName' => 'Otjiherero',
    //         ],
    //         'hi' => [
    //             'idioma' => 'Hindi',
    //             'nativeName' => 'हिन्दी, हिंदी',
    //         ],
    //         'ho' => [
    //             'idioma' => 'Hiri Motu',
    //             'nativeName' => 'Hiri Motu',
    //         ],
    //         'hu' => [
    //             'idioma' => 'Hungarian',
    //             'nativeName' => 'Magyar',
    //         ],
    //         'ia' => [
    //             'idioma' => 'Interlingua',
    //             'nativeName' => 'Interlingua',
    //         ],
    //         'id' => [
    //             'idioma' => 'Indonesian',
    //             'nativeName' => 'Bahasa Indonesia',
    //         ],
    //         'ie' => [
    //             'idioma' => 'Interlingue',
    //             'nativeName' => 'Originally called Occidental; then Interlingue after WWII',
    //         ],
    //         'ga' => [
    //             'idioma' => 'Irish',
    //             'nativeName' => 'Gaeilge',
    //         ],
    //         'ig' => [
    //             'idioma' => 'Igbo',
    //             'nativeName' => 'Asụsụ Igbo',
    //         ],
    //         'ik' => [
    //             'idioma' => 'Inupiaq',
    //             'nativeName' => 'Iñupiaq, Iñupiatun',
    //         ],
    //         'io' => [
    //             'idioma' => 'Ido',
    //             'nativeName' => 'Ido',
    //         ],
    //         'is' => [
    //             'idioma' => 'Icelandic',
    //             'nativeName' => 'Íslenska',
    //         ],
    //         'it' => [
    //             'idioma' => 'Italian',
    //             'nativeName' => 'Italiano',
    //         ],
    //         'iu' => [
    //             'idioma' => 'Inuktitut',
    //             'nativeName' => 'ᐃᓄᒃᑎᑐᑦ',
    //         ],
    //         'ja' => [
    //             'idioma' => 'Japanese',
    //             'nativeName' => '日本語 (にほんご／にっぽんご)',
    //         ],
    //         'jv' => [
    //             'idioma' => 'Javanese',
    //             'nativeName' => 'basa Jawa',
    //         ],
    //         'kl' => [
    //             'idioma' => 'Kalaallisut, Greenlandic',
    //             'nativeName' => 'kalaallisut, kalaallit oqaasii',
    //         ],
    //         'kn' => [
    //             'idioma' => 'Kannada',
    //             'nativeName' => 'ಕನ್ನಡ',
    //         ],
    //         'kr' => [
    //             'idioma' => 'Kanuri',
    //             'nativeName' => 'Kanuri',
    //         ],
    //         'ks' => [
    //             'idioma' => 'Kashmiri',
    //             'nativeName' => 'कश्मीरी, كشميري‎',
    //         ],
    //         'kk' => [
    //             'idioma' => 'Kazakh',
    //             'nativeName' => 'Қазақ тілі',
    //         ],
    //         'km' => [
    //             'idioma' => 'Khmer',
    //             'nativeName' => 'ភាសាខ្មែរ',
    //         ],
    //         'ki' => [
    //             'idioma' => 'Kikuyu, Gikuyu',
    //             'nativeName' => 'Gĩkũyũ',
    //         ],
    //         'rw' => [
    //             'idioma' => 'Kinyarwanda',
    //             'nativeName' => 'Ikinyarwanda',
    //         ],
    //         'ky' => [
    //             'idioma' => 'Kirghiz, Kyrgyz',
    //             'nativeName' => 'кыргыз тили',
    //         ],
    //         'kv' => [
    //             'idioma' => 'Komi',
    //             'nativeName' => 'коми кыв',
    //         ],
    //         'kg' => [
    //             'idioma' => 'Kongo',
    //             'nativeName' => 'KiKongo',
    //         ],
    //         'ko' => [
    //             'idioma' => 'Korean',
    //             'nativeName' => '한국어 (韓國語), 조선말 (朝鮮語)',
    //         ],
    //         'ku' => [
    //             'idioma' => 'Kurdish',
    //             'nativeName' => 'Kurdî, كوردی‎',
    //         ],
    //         'kj' => [
    //             'idioma' => 'Kwanyama, Kuanyama',
    //             'nativeName' => 'Kuanyama',
    //         ],
    //         'la' => [
    //             'idioma' => 'Latin',
    //             'nativeName' => 'latine, lingua latina',
    //         ],
    //         'lb' => [
    //             'idioma' => 'Luxembourgish, Letzeburgesch',
    //             'nativeName' => 'Lëtzebuergesch',
    //         ],
    //         'lg' => [
    //             'idioma' => 'Luganda',
    //             'nativeName' => 'Luganda',
    //         ],
    //         'li' => [
    //             'idioma' => 'Limburgish, Limburgan, Limburger',
    //             'nativeName' => 'Limburgs',
    //         ],
    //         'ln' => [
    //             'idioma' => 'Lingala',
    //             'nativeName' => 'Lingála',
    //         ],
    //         'lo' => [
    //             'idioma' => 'Lao',
    //             'nativeName' => 'ພາສາລາວ',
    //         ],
    //         'lt' => [
    //             'idioma' => 'Lithuanian',
    //             'nativeName' => 'lietuvių kalba',
    //         ],
    //         'lu' => [
    //             'idioma' => 'Luba-Katanga',
    //             'nativeName' => '',
    //         ],
    //         'lv' => [
    //             'idioma' => 'Latvian',
    //             'nativeName' => 'latviešu valoda',
    //         ],
    //         'gv' => [
    //             'idioma' => 'Manx',
    //             'nativeName' => 'Gaelg, Gailck',
    //         ],
    //         'mk' => [
    //             'idioma' => 'Macedonian',
    //             'nativeName' => 'македонски јазик',
    //         ],
    //         'mg' => [
    //             'idioma' => 'Malagasy',
    //             'nativeName' => 'Malagasy fiteny',
    //         ],
    //         'ms' => [
    //             'idioma' => 'Malay',
    //             'nativeName' => 'bahasa Melayu, بهاس ملايو‎',
    //         ],
    //         'ml' => [
    //             'idioma' => 'Malayalam',
    //             'nativeName' => 'മലയാളം',
    //         ],
    //         'mt' => [
    //             'idioma' => 'Maltese',
    //             'nativeName' => 'Malti',
    //         ],
    //         'mi' => [
    //             'idioma' => 'Māori',
    //             'nativeName' => 'te reo Māori',
    //         ],
    //         'mr' => [
    //             'idioma' => 'Marathi (Marāṭhī)',
    //             'nativeName' => 'मराठी',
    //         ],
    //         'mh' => [
    //             'idioma' => 'Marshallese',
    //             'nativeName' => 'Kajin M̧ajeļ',
    //         ],
    //         'mn' => [
    //             'idioma' => 'Mongolian',
    //             'nativeName' => 'монгол',
    //         ],
    //         'na' => [
    //             'idioma' => 'Nauru',
    //             'nativeName' => 'Ekakairũ Naoero',
    //         ],
    //         'nv' => [
    //             'idioma' => 'Navajo, Navaho',
    //             'nativeName' => 'Diné bizaad, Dinékʼehǰí',
    //         ],
    //         'nb' => [
    //             'idioma' => 'Norwegian Bokmål',
    //             'nativeName' => 'Norsk bokmål',
    //         ],
    //         'nd' => [
    //             'idioma' => 'North Ndebele',
    //             'nativeName' => 'isiNdebele',
    //         ],
    //         'ne' => [
    //             'idioma' => 'Nepali',
    //             'nativeName' => 'नेपाली',
    //         ],
    //         'ng' => [
    //             'idioma' => 'Ndonga',
    //             'nativeName' => 'Owambo',
    //         ],
    //         'nn' => [
    //             'idioma' => 'Norwegian Nynorsk',
    //             'nativeName' => 'Norsk nynorsk',
    //         ],
    //         'no' => [
    //             'idioma' => 'Norwegian',
    //             'nativeName' => 'Norsk',
    //         ],
    //         'ii' => [
    //             'idioma' => 'Nuosu',
    //             'nativeName' => 'ꆈꌠ꒿ Nuosuhxop',
    //         ],
    //         'nr' => [
    //             'idioma' => 'South Ndebele',
    //             'nativeName' => 'isiNdebele',
    //         ],
    //         'oc' => [
    //             'idioma' => 'Occitan',
    //             'nativeName' => 'Occitan',
    //         ],
    //         'oj' => [
    //             'idioma' => 'Ojibwe, Ojibwa',
    //             'nativeName' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
    //         ],
    //         'cu' => [
    //             'idioma' => 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic',
    //             'nativeName' => 'ѩзыкъ словѣньскъ',
    //         ],
    //         'om' => [
    //             'idioma' => 'Oromo',
    //             'nativeName' => 'Afaan Oromoo',
    //         ],
    //         'or' => [
    //             'idioma' => 'Oriya',
    //             'nativeName' => 'ଓଡ଼ିଆ',
    //         ],
    //         'os' => [
    //             'idioma' => 'Ossetian, Ossetic',
    //             'nativeName' => 'ирон æвзаг',
    //         ],
    //         'pa' => [
    //             'idioma' => 'Panjabi, Punjabi',
    //             'nativeName' => 'ਪੰਜਾਬੀ, پنجابی‎',
    //         ],
    //         'pi' => [
    //             'idioma' => 'Pāli',
    //             'nativeName' => 'पाऴि',
    //         ],
    //         'fa' => [
    //             'idioma' => 'Persian',
    //             'nativeName' => 'فارسی',
    //         ],
    //         'pl' => [
    //             'idioma' => 'Polish',
    //             'nativeName' => 'polski',
    //         ],
    //         'ps' => [
    //             'idioma' => 'Pashto, Pushto',
    //             'nativeName' => 'پښتو',
    //         ],
    //         'pt' => [
    //             'idioma' => 'Portuguese',
    //             'nativeName' => 'Português',
    //         ],
    //         'qu' => [
    //             'idioma' => 'Quechua',
    //             'nativeName' => 'Runa Simi, Kichwa',
    //         ],
    //         'rm' => [
    //             'idioma' => 'Romansh',
    //             'nativeName' => 'rumantsch grischun',
    //         ],
    //         'rn' => [
    //             'idioma' => 'Kirundi',
    //             'nativeName' => 'kiRundi',
    //         ],
    //         'ro' => [
    //             'idioma' => 'Romanian, Moldavian, Moldovan',
    //             'nativeName' => 'română',
    //         ],
    //         'ru' => [
    //             'idioma' => 'Russian',
    //             'nativeName' => 'русский язык',
    //         ],
    //         'sa' => [
    //             'idioma' => 'Sanskrit (Saṁskṛta)',
    //             'nativeName' => 'संस्कृतम्',
    //         ],
    //         'sc' => [
    //             'idioma' => 'Sardinian',
    //             'nativeName' => 'sardu',
    //         ],
    //         'sd' => [
    //             'idioma' => 'Sindhi',
    //             'nativeName' => 'सिन्धी, سنڌي، سندھی‎',
    //         ],
    //         'se' => [
    //             'idioma' => 'Northern Sami',
    //             'nativeName' => 'Davvisámegiella',
    //         ],
    //         'sm' => [
    //             'idioma' => 'Samoan',
    //             'nativeName' => 'gagana faa Samoa',
    //         ],
    //         'sg' => [
    //             'idioma' => 'Sango',
    //             'nativeName' => 'yângâ tî sängö',
    //         ],
    //         'sr' => [
    //             'idioma' => 'Serbian',
    //             'nativeName' => 'српски језик',
    //         ],
    //         'gd' => [
    //             'idioma' => 'Scottish Gaelic; Gaelic',
    //             'nativeName' => 'Gàidhlig',
    //         ],
    //         'sn' => [
    //             'idioma' => 'Shona',
    //             'nativeName' => 'chiShona',
    //         ],
    //         'si' => [
    //             'idioma' => 'Sinhala, Sinhalese',
    //             'nativeName' => 'සිංහල',
    //         ],
    //         'sk' => [
    //             'idioma' => 'Slovak',
    //             'nativeName' => 'slovenčina',
    //         ],
    //         'sl' => [
    //             'idioma' => 'Slovene',
    //             'nativeName' => 'slovenščina',
    //         ],
    //         'so' => [
    //             'idioma' => 'Somali',
    //             'nativeName' => 'Soomaaliga, af Soomaali',
    //         ],
    //         'st' => [
    //             'idioma' => 'Southern Sotho',
    //             'nativeName' => 'Sesotho',
    //         ],
    //         'es' => [
    //             'idioma' => 'Spanish; Castilian',
    //             'nativeName' => 'español, castellano',
    //         ],
    //         'su' => [
    //             'idioma' => 'Sundanese',
    //             'nativeName' => 'Basa Sunda',
    //         ],
    //         'sw' => [
    //             'idioma' => 'Swahili',
    //             'nativeName' => 'Kiswahili',
    //         ],
    //         'ss' => [
    //             'idioma' => 'Swati',
    //             'nativeName' => 'SiSwati',
    //         ],
    //         'sv' => [
    //             'idioma' => 'Swedish',
    //             'nativeName' => 'svenska',
    //         ],
    //         'ta' => [
    //             'idioma' => 'Tamil',
    //             'nativeName' => 'தமிழ்',
    //         ],
    //         'te' => [
    //             'idioma' => 'Telugu',
    //             'nativeName' => 'తెలుగు',
    //         ],
    //         'tg' => [
    //             'idioma' => 'Tajik',
    //             'nativeName' => 'тоҷикӣ, toğikī, تاجیکی‎',
    //         ],
    //         'th' => [
    //             'idioma' => 'Thai',
    //             'nativeName' => 'ไทย',
    //         ],
    //         'ti' => [
    //             'idioma' => 'Tigrinya',
    //             'nativeName' => 'ትግርኛ',
    //         ],
    //         'bo' => [
    //             'idioma' => 'Tibetan Standard, Tibetan, Central',
    //             'nativeName' => 'བོད་ཡིག',
    //         ],
    //         'tk' => [
    //             'idioma' => 'Turkmen',
    //             'nativeName' => 'Türkmen, Түркмен',
    //         ],
    //         'tl' => [
    //             'idioma' => 'Tagalog',
    //             'nativeName' => 'Wikang Tagalog, ᜏᜒᜃᜅ᜔ ᜆᜄᜎᜓᜄ᜔',
    //         ],
    //         'tn' => [
    //             'idioma' => 'Tswana',
    //             'nativeName' => 'Setswana',
    //         ],
    //         'to' => [
    //             'idioma' => 'Tonga (Tonga Islands)',
    //             'nativeName' => 'faka Tonga',
    //         ],
    //         'tr' => [
    //             'idioma' => 'Turkish',
    //             'nativeName' => 'Türkçe',
    //         ],
    //         'ts' => [
    //             'idioma' => 'Tsonga',
    //             'nativeName' => 'Xitsonga',
    //         ],
    //         'tt' => [
    //             'idioma' => 'Tatar',
    //             'nativeName' => 'татарча, tatarça, تاتارچا‎',
    //         ],
    //         'tw' => [
    //             'idioma' => 'Twi',
    //             'nativeName' => 'Twi',
    //         ],
    //         'ty' => [
    //             'idioma' => 'Tahitian',
    //             'nativeName' => 'Reo Tahiti',
    //         ],
    //         'ug' => [
    //             'idioma' => 'Uighur, Uyghur',
    //             'nativeName' => 'Uyƣurqə, ئۇيغۇرچە‎',
    //         ],
    //         'uk' => [
    //             'idioma' => 'Ukrainian',
    //             'nativeName' => 'українська',
    //         ],
    //         'ur' => [
    //             'idioma' => 'Urdu',
    //             'nativeName' => 'اردو',
    //         ],
    //         'uz' => [
    //             'idioma' => 'Uzbek',
    //             'nativeName' => 'zbek, Ўзбек, أۇزبېك‎',
    //         ],
    //         've' => [
    //             'idioma' => 'Venda',
    //             'nativeName' => 'Tshivenḓa',
    //         ],
    //         'vi' => [
    //             'idioma' => 'Vietnamese',
    //             'nativeName' => 'Tiếng Việt',
    //         ],
    //         'vo' => [
    //             'idioma' => 'Volapük',
    //             'nativeName' => 'Volapük',
    //         ],
    //         'wa' => [
    //             'idioma' => 'Walloon',
    //             'nativeName' => 'Walon',
    //         ],
    //         'cy' => [
    //             'idioma' => 'Welsh',
    //             'nativeName' => 'Cymraeg',
    //         ],
    //         'wo' => [
    //             'idioma' => 'Wolof',
    //             'nativeName' => 'Wollof',
    //         ],
    //         'fy' => [
    //             'idioma' => 'Western Frisian',
    //             'nativeName' => 'Frysk',
    //         ],
    //         'xh' => [
    //             'idioma' => 'Xhosa',
    //             'nativeName' => 'isiXhosa',
    //         ],
    //         'yi' => [
    //             'idioma' => 'Yiddish',
    //             'nativeName' => 'ייִדיש',
    //         ],
    //         'yo' => [
    //             'idioma' => 'Yoruba',
    //             'nativeName' => 'Yorùbá',
    //         ],
    //         'za' => [
    //             'idioma' => 'Zhuang, Chuang',
    //             'nativeName' => 'Saɯ cueŋƅ, Saw cuengh',
    //         ],
    //     ];
    //     Language::insert($langua);
    // }

    public function run()
    {
        $langua = [
            'ab' => [
                'idioma' => 'Abjasia',
                'nativeName' => 'аҧсуа',
            ],
            'aa' => [
                'idioma' => 'Afar',
                'nativeName' => 'Afaraf',
            ],
            'af' => [
                'idioma' => 'Afrikaans',
                'nativeName' => 'Afrikaans',
            ],
            'ak' => [
                'idioma' => 'Akan',
                'nativeName' => 'Akan',
            ],
            'sq' => [
                'idioma' => 'Albanés',
                'nativeName' => 'Shqip',
            ],
            'de' => [
                'idioma' => 'Alemán',
                'nativeName' => 'Deutsch',
            ],
            'am' => [
                'idioma' => 'Arameo',
                'nativeName' => 'አማርኛ',
            ],
            'ar' => [
                'idioma' => 'Árabe',
                'nativeName' => 'العربية',
            ],
            'an' => [
                'idioma' => 'Aragonés',
                'nativeName' => 'Aragonés',
            ],
            'hy' => [
                'idioma' => 'Armenio',
                'nativeName' => 'Հայերեն',
            ],
            'as' => [
                'idioma' => 'Asamés',
                'nativeName' => 'অসমীয়া',
            ],
            'av' => [
                'idioma' => 'Avaric',
                'nativeName' => 'авар мацӀ, магӀарул мацӀ',
            ],
            'ae' => [
                'idioma' => 'Avestan',
                'nativeName' => 'avesta',
            ],
            'ay' => [
                'idioma' => 'Aymara',
                'nativeName' => 'aymar aru',
            ],
            'az' => [
                'idioma' => 'Azerbaijani',
                'nativeName' => 'azərbaycan dili',
            ],
            'bm' => [
                'idioma' => 'Bambara',
                'nativeName' => 'bamanankan',
            ],
            'ba' => [
                'idioma' => 'Bashkir',
                'nativeName' => 'башҡорт теле',
            ],
            'eu' => [
                'idioma' => 'Basque',
                'nativeName' => 'euskara, euskera',
            ],
            'be' => [
                'idioma' => 'Belarusian',
                'nativeName' => 'Беларуская',
            ],
            'bn' => [
                'idioma' => 'Bengalí',
                'nativeName' => 'বাংলা',
            ],
            'bh' => [
                'idioma' => 'Bihari',
                'nativeName' => 'भोजपुरी',
            ],
            'bi' => [
                'idioma' => 'Bislama',
                'nativeName' => 'Bislama',
            ],
            'bs' => [
                'idioma' => 'Bosnian',
                'nativeName' => 'bosanski jezik',
            ],
            'br' => [
                'idioma' => 'Breton',
                'nativeName' => 'brezhoneg',
            ],
            'bg' => [
                'idioma' => 'Búlgaro',
                'nativeName' => 'български език',
            ],
            'my' => [
                'idioma' => 'Burmese',
                'nativeName' => 'ဗမာစာ',
            ],
            'ca' => [
                'idioma' => 'Catalan; Valencian',
                'nativeName' => 'Català',
            ],
            'ch' => [
                'idioma' => 'Chamorro',
                'nativeName' => 'Chamoru',
            ],
            'ce' => [
                'idioma' => 'Chechen',
                'nativeName' => 'нохчийн мотт',
            ],
            'ny' => [
                'idioma' => 'Chichewa; Chewa; Nyanja',
                'nativeName' => 'chiCheŵa, chinyanja',
            ],
            'zh' => [
                'idioma' => 'Chino',
                'nativeName' => '中文 (Zhōngwén), 汉语, 漢語',
            ],
            'cv' => [
                'idioma' => 'Chuvash',
                'nativeName' => 'чӑваш чӗлхи',
            ],
            'kw' => [
                'idioma' => 'Cornish',
                'nativeName' => 'Kernewek',
            ],
            'co' => [
                'idioma' => 'Corso',
                'nativeName' => 'corsu, lingua corsa',
            ],
            'cr' => [
                'idioma' => 'Cree',
                'nativeName' => 'ᓀᐦᐃᔭᐍᐏᐣ',
            ],
            'hr' => [
                'idioma' => 'Croatian',
                'nativeName' => 'hrvatski',
            ],
            'cs' => [
                'idioma' => 'Czech',
                'nativeName' => 'česky, čeština',
            ],
            'da' => [
                'idioma' => 'Danés',
                'nativeName' => 'dansk',
            ],
            'dv' => [
                'idioma' => 'Divehi; Dhivehi; Maldivian;',
                'nativeName' => 'ދިވެހި',
            ],
            'nl' => [
                'idioma' => 'Dutch',
                'nativeName' => 'Nederlands, Vlaams',
            ],
            'en' => [
                'idioma' => 'Inglés',
                'nativeName' => 'English',
            ],
            'eo' => [
                'idioma' => 'Esperanto',
                'nativeName' => 'Esperanto',
            ],
            'et' => [
                'idioma' => 'Estonio',
                'nativeName' => 'eesti, eesti keel',
            ],
            'ee' => [
                'idioma' => 'Ewe',
                'nativeName' => 'Eʋegbe',
            ],
            'fo' => [
                'idioma' => 'Faroese',
                'nativeName' => 'føroyskt',
            ],
            'fj' => [
                'idioma' => 'Fijian',
                'nativeName' => 'vosa Vakaviti',
            ],
            'fi' => [
                'idioma' => 'Finlandés',
                'nativeName' => 'suomi, suomen kieli',
            ],
            'fr' => [
                'idioma' => 'Francés',
                'nativeName' => 'français, langue française',
            ],
            'ff' => [
                'idioma' => 'Fula; Fulah; Pulaar; Pular',
                'nativeName' => 'Fulfulde, Pulaar, Pular',
            ],
            'gl' => [
                'idioma' => 'Gallego',
                'nativeName' => 'Galego',
            ],
            'ka' => [
                'idioma' => 'Georgiano',
                'nativeName' => 'ქართული',
            ],

            'el' => [
                'idioma' => 'Greek, Modern',
                'nativeName' => 'Ελληνικά',
            ],
            'gn' => [
                'idioma' => 'Guaraní',
                'nativeName' => 'Avañeẽ',
            ],
            'gu' => [
                'idioma' => 'Gujarati',
                'nativeName' => 'ગુજરાતી',
            ],
            'ht' => [
                'idioma' => 'Haitian; Haitian Creole',
                'nativeName' => 'Kreyòl ayisyen',
            ],
            'ha' => [
                'idioma' => 'Hausa',
                'nativeName' => 'Hausa, هَوُسَ',
            ],
            'he' => [
                'idioma' => 'Hebrew (modern)',
                'nativeName' => 'עברית',
            ],
            'hz' => [
                'idioma' => 'Herero',
                'nativeName' => 'Otjiherero',
            ],
            'hi' => [
                'idioma' => 'Hindi',
                'nativeName' => 'हिन्दी, हिंदी',
            ],
            'ho' => [
                'idioma' => 'Hiri Motu',
                'nativeName' => 'Hiri Motu',
            ],
            'hu' => [
                'idioma' => 'Hungarian',
                'nativeName' => 'Magyar',
            ],
            'ia' => [
                'idioma' => 'Interlingua',
                'nativeName' => 'Interlingua',
            ],
            'id' => [
                'idioma' => 'Indonesian',
                'nativeName' => 'Bahasa Indonesia',
            ],
            'ie' => [
                'idioma' => 'Interlingue',
                'nativeName' => 'Originally called Occidental; then Interlingue after WWII',
            ],
            'ga' => [
                'idioma' => 'Irish',
                'nativeName' => 'Gaeilge',
            ],
            'ig' => [
                'idioma' => 'Igbo',
                'nativeName' => 'Asụsụ Igbo',
            ],
            'ik' => [
                'idioma' => 'Inupiaq',
                'nativeName' => 'Iñupiaq, Iñupiatun',
            ],
            'io' => [
                'idioma' => 'Ido',
                'nativeName' => 'Ido',
            ],
            'is' => [
                'idioma' => 'Icelandic',
                'nativeName' => 'Íslenska',
            ],
            'it' => [
                'idioma' => 'Italiano',
                'nativeName' => 'Italiano',
            ],
            'iu' => [
                'idioma' => 'Inuktitut',
                'nativeName' => 'ᐃᓄᒃᑎᑐᑦ',
            ],
            'ja' => [
                'idioma' => 'Japonés',
                'nativeName' => '日本語 (にほんご／にっぽんご)',
            ],
            'jv' => [
                'idioma' => 'Javanese',
                'nativeName' => 'basa Jawa',
            ],
            'kl' => [
                'idioma' => 'Kalaallisut, Greenlandic',
                'nativeName' => 'kalaallisut, kalaallit oqaasii',
            ],
            'kn' => [
                'idioma' => 'Kannada',
                'nativeName' => 'ಕನ್ನಡ',
            ],
            'kr' => [
                'idioma' => 'Kanuri',
                'nativeName' => 'Kanuri',
            ],
            'ks' => [
                'idioma' => 'Kashmiri',
                'nativeName' => 'कश्मीरी, كشميري‎',
            ],
            'kk' => [
                'idioma' => 'Kazakh',
                'nativeName' => 'Қазақ тілі',
            ],
            'km' => [
                'idioma' => 'Khmer',
                'nativeName' => 'ភាសាខ្មែរ',
            ],
            'ki' => [
                'idioma' => 'Kikuyu, Gikuyu',
                'nativeName' => 'Gĩkũyũ',
            ],
            'rw' => [
                'idioma' => 'Kinyarwanda',
                'nativeName' => 'Ikinyarwanda',
            ],
            'ky' => [
                'idioma' => 'Kirghiz, Kyrgyz',
                'nativeName' => 'кыргыз тили',
            ],
            'kv' => [
                'idioma' => 'Komi',
                'nativeName' => 'коми кыв',
            ],
            'kg' => [
                'idioma' => 'Kongo',
                'nativeName' => 'KiKongo',
            ],
            'ko' => [
                'idioma' => 'Korean',
                'nativeName' => '한국어 (韓國語), 조선말 (朝鮮語)',
            ],
            'ku' => [
                'idioma' => 'Kurdish',
                'nativeName' => 'Kurdî, كوردی‎',
            ],
            'kj' => [
                'idioma' => 'Kwanyama, Kuanyama',
                'nativeName' => 'Kuanyama',
            ],
            'la' => [
                'idioma' => 'Latin',
                'nativeName' => 'latine, lingua latina',
            ],
            'lb' => [
                'idioma' => 'Luxembourgish, Letzeburgesch',
                'nativeName' => 'Lëtzebuergesch',
            ],
            'lg' => [
                'idioma' => 'Luganda',
                'nativeName' => 'Luganda',
            ],
            'li' => [
                'idioma' => 'Limburgish, Limburgan, Limburger',
                'nativeName' => 'Limburgs',
            ],
            'ln' => [
                'idioma' => 'Lingala',
                'nativeName' => 'Lingála',
            ],
            'lo' => [
                'idioma' => 'Lao',
                'nativeName' => 'ພາສາລາວ',
            ],
            'lt' => [
                'idioma' => 'Lithuanian',
                'nativeName' => 'lietuvių kalba',
            ],
            'lu' => [
                'idioma' => 'Luba-Katanga',
                'nativeName' => '',
            ],
            'lv' => [
                'idioma' => 'Latvian',
                'nativeName' => 'latviešu valoda',
            ],
            'gv' => [
                'idioma' => 'Manx',
                'nativeName' => 'Gaelg, Gailck',
            ],
            'mk' => [
                'idioma' => 'Macedonian',
                'nativeName' => 'македонски јазик',
            ],
            'mg' => [
                'idioma' => 'Malagasy',
                'nativeName' => 'Malagasy fiteny',
            ],
            'ms' => [
                'idioma' => 'Malay',
                'nativeName' => 'bahasa Melayu, بهاس ملايو‎',
            ],
            'ml' => [
                'idioma' => 'Malayalam',
                'nativeName' => 'മലയാളം',
            ],
            'mt' => [
                'idioma' => 'Maltese',
                'nativeName' => 'Malti',
            ],
            'mi' => [
                'idioma' => 'Māori',
                'nativeName' => 'te reo Māori',
            ],
            'mr' => [
                'idioma' => 'Marathi (Marāṭhī)',
                'nativeName' => 'मराठी',
            ],
            'mh' => [
                'idioma' => 'Marshallese',
                'nativeName' => 'Kajin M̧ajeļ',
            ],
            'mn' => [
                'idioma' => 'Mongolian',
                'nativeName' => 'монгол',
            ],
            'na' => [
                'idioma' => 'Nauru',
                'nativeName' => 'Ekakairũ Naoero',
            ],
            'nv' => [
                'idioma' => 'Navajo, Navaho',
                'nativeName' => 'Diné bizaad, Dinékʼehǰí',
            ],
            'nb' => [
                'idioma' => 'Norwegian Bokmål',
                'nativeName' => 'Norsk bokmål',
            ],
            'nd' => [
                'idioma' => 'North Ndebele',
                'nativeName' => 'isiNdebele',
            ],
            'ne' => [
                'idioma' => 'Nepali',
                'nativeName' => 'नेपाली',
            ],
            'ng' => [
                'idioma' => 'Ndonga',
                'nativeName' => 'Owambo',
            ],
            'nn' => [
                'idioma' => 'Norwegian Nynorsk',
                'nativeName' => 'Norsk nynorsk',
            ],
            'no' => [
                'idioma' => 'Norwegian',
                'nativeName' => 'Norsk',
            ],
            'ii' => [
                'idioma' => 'Nuosu',
                'nativeName' => 'ꆈꌠ꒿ Nuosuhxop',
            ],
            'nr' => [
                'idioma' => 'South Ndebele',
                'nativeName' => 'isiNdebele',
            ],
            'oc' => [
                'idioma' => 'Occitan',
                'nativeName' => 'Occitan',
            ],
            'oj' => [
                'idioma' => 'Ojibwe, Ojibwa',
                'nativeName' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
            ],
            'cu' => [
                'idioma' => 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic',
                'nativeName' => 'ѩзыкъ словѣньскъ',
            ],
            'om' => [
                'idioma' => 'Oromo',
                'nativeName' => 'Afaan Oromoo',
            ],
            'or' => [
                'idioma' => 'Oriya',
                'nativeName' => 'ଓଡ଼ିଆ',
            ],
            'os' => [
                'idioma' => 'Ossetian, Ossetic',
                'nativeName' => 'ирон æвзаг',
            ],
            'pa' => [
                'idioma' => 'Panjabi, Punjabi',
                'nativeName' => 'ਪੰਜਾਬੀ, پنجابی‎',
            ],
            'pi' => [
                'idioma' => 'Pāli',
                'nativeName' => 'पाऴि',
            ],
            'fa' => [
                'idioma' => 'Persa',
                'nativeName' => 'فارسی',
            ],
            'pl' => [
                'idioma' => 'Polaco',
                'nativeName' => 'polski',
            ],
            'ps' => [
                'idioma' => 'Pashto, Pushto',
                'nativeName' => 'پښتو',
            ],
            'pt' => [
                'idioma' => 'Portuguese',
                'nativeName' => 'Português',
            ],
            'qu' => [
                'idioma' => 'Quechua',
                'nativeName' => 'Runa Simi, Kichwa',
            ],
            'rm' => [
                'idioma' => 'Romansh',
                'nativeName' => 'rumantsch grischun',
            ],
            'rn' => [
                'idioma' => 'Kirundi',
                'nativeName' => 'kiRundi',
            ],
            'ro' => [
                'idioma' => 'Rumano',
                'nativeName' => 'română',
            ],
            'ru' => [
                'idioma' => 'Ruso',
                'nativeName' => 'русский язык',
            ],
            'sa' => [
                'idioma' => 'Sanskrit (Saṁskṛta)',
                'nativeName' => 'संस्कृतम्',
            ],
            'sc' => [
                'idioma' => 'Sardinian',
                'nativeName' => 'sardu',
            ],
            'sd' => [
                'idioma' => 'Sindhi',
                'nativeName' => 'सिन्धी, سنڌي، سندھی‎',
            ],
            'se' => [
                'idioma' => 'Northern Sami',
                'nativeName' => 'Davvisámegiella',
            ],
            'sm' => [
                'idioma' => 'Samoan',
                'nativeName' => 'gagana faa Samoa',
            ],
            'sg' => [
                'idioma' => 'Sango',
                'nativeName' => 'yângâ tî sängö',
            ],
            'sr' => [
                'idioma' => 'Serbian',
                'nativeName' => 'српски језик',
            ],
            'gd' => [
                'idioma' => 'Scottish Gaelic; Gaelic',
                'nativeName' => 'Gàidhlig',
            ],
            'sn' => [
                'idioma' => 'Shona',
                'nativeName' => 'chiShona',
            ],
            'si' => [
                'idioma' => 'Sinhala, Sinhalese',
                'nativeName' => 'සිංහල',
            ],
            'sk' => [
                'idioma' => 'Slovak',
                'nativeName' => 'slovenčina',
            ],
            'sl' => [
                'idioma' => 'Slovene',
                'nativeName' => 'slovenščina',
            ],
            'so' => [
                'idioma' => 'Somali',
                'nativeName' => 'Soomaaliga, af Soomaali',
            ],
            'st' => [
                'idioma' => 'Southern Sotho',
                'nativeName' => 'Sesotho',
            ],
            'es' => [
                'idioma' => 'Español Castellano',
                'nativeName' => 'español, castellano',
            ],
            'su' => [
                'idioma' => 'Sundanese',
                'nativeName' => 'Basa Sunda',
            ],
            'sw' => [
                'idioma' => 'Swahili',
                'nativeName' => 'Kiswahili',
            ],
            'ss' => [
                'idioma' => 'Swati',
                'nativeName' => 'SiSwati',
            ],
            'sv' => [
                'idioma' => 'Swedish',
                'nativeName' => 'svenska',
            ],
            'ta' => [
                'idioma' => 'Tamil',
                'nativeName' => 'தமிழ்',
            ],
            'te' => [
                'idioma' => 'Telugu',
                'nativeName' => 'తెలుగు',
            ],
            'tg' => [
                'idioma' => 'Tajik',
                'nativeName' => 'тоҷикӣ, toğikī, تاجیکی‎',
            ],
            'th' => [
                'idioma' => 'Thai',
                'nativeName' => 'ไทย',
            ],
            'ti' => [
                'idioma' => 'Tigrinya',
                'nativeName' => 'ትግርኛ',
            ],
            'bo' => [
                'idioma' => 'Tibetan Standard, Tibetan, Central',
                'nativeName' => 'བོད་ཡིག',
            ],
            'tk' => [
                'idioma' => 'Turkmen',
                'nativeName' => 'Türkmen, Түркмен',
            ],
            'tl' => [
                'idioma' => 'Tagalog',
                'nativeName' => 'Wikang Tagalog, ᜏᜒᜃᜅ᜔ ᜆᜄᜎᜓᜄ᜔',
            ],
            'tn' => [
                'idioma' => 'Tswana',
                'nativeName' => 'Setswana',
            ],
            'to' => [
                'idioma' => 'Tonga (Tonga Islands)',
                'nativeName' => 'faka Tonga',
            ],
            'tr' => [
                'idioma' => 'Turkish',
                'nativeName' => 'Türkçe',
            ],
            'ts' => [
                'idioma' => 'Tsonga',
                'nativeName' => 'Xitsonga',
            ],
            'tt' => [
                'idioma' => 'Tatar',
                'nativeName' => 'татарча, tatarça, تاتارچا‎',
            ],
            'tw' => [
                'idioma' => 'Twi',
                'nativeName' => 'Twi',
            ],
            'ty' => [
                'idioma' => 'Tahitian',
                'nativeName' => 'Reo Tahiti',
            ],
            'ug' => [
                'idioma' => 'Uighur, Uyghur',
                'nativeName' => 'Uyƣurqə, ئۇيغۇرچە‎',
            ],
            'uk' => [
                'idioma' => 'Ukrainian',
                'nativeName' => 'українська',
            ],
            'ur' => [
                'idioma' => 'Urdu',
                'nativeName' => 'اردو',
            ],
            'uz' => [
                'idioma' => 'Uzbek',
                'nativeName' => 'zbek, Ўзбек, أۇزبېك‎',
            ],
            've' => [
                'idioma' => 'Venda',
                'nativeName' => 'Tshivenḓa',
            ],
            'vi' => [
                'idioma' => 'Vietnamese',
                'nativeName' => 'Tiếng Việt',
            ],
            'vo' => [
                'idioma' => 'Volapük',
                'nativeName' => 'Volapük',
            ],
            'wa' => [
                'idioma' => 'Walloon',
                'nativeName' => 'Walon',
            ],
            'cy' => [
                'idioma' => 'Welsh',
                'nativeName' => 'Cymraeg',
            ],
            'wo' => [
                'idioma' => 'Wolof',
                'nativeName' => 'Wollof',
            ],
            'fy' => [
                'idioma' => 'Western Frisian',
                'nativeName' => 'Frysk',
            ],
            'xh' => [
                'idioma' => 'Xhosa',
                'nativeName' => 'isiXhosa',
            ],
            'yi' => [
                'idioma' => 'Yiddish',
                'nativeName' => 'ייִדיש',
            ],
            'yo' => [
                'idioma' => 'Yoruba',
                'nativeName' => 'Yorùbá',
            ],
            'za' => [
                'idioma' => 'Zhuang, Chuang',
                'nativeName' => 'Saɯ cueŋƅ, Saw cuengh',
            ],
        ];
        Language::insert($langua);
    }
}
