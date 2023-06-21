<?php
class WC_every_currency_converter
{

    public static function init()
    {
        add_filter('woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50);
        add_action('woocommerce_settings_tabs_every_currency_converter', __CLASS__ . '::settings_tab');
        add_action('woocommerce_update_options_every_currency_converter', __CLASS__ . '::update_settings');
    }

    public static function add_settings_tab($settings_tabs)
    {
        $settings_tabs['every_currency_converter'] = __('Every Currency Converter', 'woocommerce-settings-tab-demo');
        return $settings_tabs;
    }


    public static function settings_tab()
    {
        woocommerce_admin_fields(self::get_settings());
    }

    public static function update_settings()
    {
        woocommerce_update_options(self::get_settings());
    }


    public static function get_settings()
    {

        $settings = array(
            'section_title' => array(
                'name'     => __('Every Currency Converter Setting', 'woocommerce-settings-tab-demo'),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wc_every_currency_converter_section_title'
            ),
            'title' => array(
                'name' => __('API KEY', 'woocommerce-settings-tab-demo'),
                'type' => 'text',
                'desc' => __('<a href="#" style="text-decoration:none; font-weight:600;">GET API KEY</a>', 'woocommerce-settings-tab-demo'),
                'id'   => 'wc_every_currency_converter_title'
            ),
            'checkbox' => array(
                'name' => __('Select Type', 'woocommerce-settings-tab-demo'),
                'type' => 'checkbox',
                'desc' => __('Allow Convert Currency By User IP Address', 'woocommerce-settings-tab-demo'),
                'id'   => 'wc_every_currency_converter_checkbox'
            ),
            'description' => array(
                'name' => __('Select Country', 'woocommerce-settings-tab-demo'),
                'type' => 'multiselect',
                'desc' => __('<span style="font-weight:600;color:#000;">Press CTRL and Select Countries</span>'),
                'css' => 'height:300px',
                'id'   => 'wc_every_currency_converter_selector',
                'options' => array(
                    'AED|United Arab Emirates dirham' => 'United Arab Emirates dirham',
                    'AFN|Afghan afghani' => 'Afghan afghani',
                    'ALL|Albanian lek' => 'Albanian lek',
                    'AMD|Armenian dram' => 'Armenian dram',
                    'ANG|Netherlands Antillean guilder' => 'Netherlands Antillean guilder',
                    'AOA|Angolan kwanza' => 'Angolan kwanza',
                    'ARS|Argentine peso' => 'Argentine peso',
                    'AUD|Australian dollar' => 'Australian dollar',
                    'AWG|Aruban florin' => 'Aruban florin',
                    'AZN|Azerbaijani manat' => 'Azerbaijani manat',
                    'BAM|Bosnia and Herzegovina convertible mark' => 'Bosnia and Herzegovina convertible mark',
                    'BBD|Barbadian dollar' => 'Barbadian dollar',
                    'BDT|Bangladeshi taka' => 'Bangladeshi taka',
                    'BGN|Bulgarian lev' => 'Bulgarian lev',
                    'BHD|Bahraini dinar' => 'Bahraini dinar',
                    'BIF|Burundian franc' => 'Burundian franc',
                    'BMD|Bermudian dollar' => 'Bermudian dollar',
                    'BND|Brunei dollar' => 'Brunei dollar',
                    'BOB|Bolivian boliviano' => 'Bolivian boliviano',
                    'BRL|Brazilian real' => 'Brazilian real',
                    'BSD|Bahamian dollar' => 'Bahamian dollar',
                    'BTC|Bitcoin' => 'Bitcoin',
                    'BTN|Bhutanese ngultrum' => 'Bhutanese ngultrum',
                    'BWP|Botswana pula' => 'Botswana pula',
                    'BYR|Belarusian ruble (old)' => 'Belarusian ruble (old)',
                    'BYN|Belarusian ruble' => 'Belarusian ruble',
                    'BZD|Belize dollar' => 'Belize dollar',
                    'CAD|Canadian dollar' => 'Canadian dollar',
                    'CDF|Congolese franc' => 'Congolese franc',
                    'CHF|Swiss franc' => 'Swiss franc',
                    'CLP|Chilean peso' => 'Chilean peso',
                    'CNY|Chinese yuan' => 'Chinese yuan',
                    'COP|Colombian peso' => 'Colombian peso',
                    'CRC|Costa Rican colón' => 'Costa Rican colón',
                    'CUC|Cuban convertible peso' => 'Cuban convertible peso',
                    'CUP|Cuban peso' => 'Cuban peso',
                    'CVE|Cape Verdean escudo' => 'Cape Verdean escudo',
                    'CZK|Czech koruna' => 'Czech koruna',
                    'DJF|Djiboutian franc' => 'Djiboutian franc',
                    'DKK|Danish krone' => 'Danish krone',
                    'DOP|Dominican peso' => 'Dominican peso',
                    'DZD|Algerian dinar' => 'Algerian dinar',
                    'EGP|Egyptian pound' => 'Egyptian pound',
                    'ERN|Eritrean nakfa' => 'Eritrean nakfa',
                    'ETB|Ethiopian birr' => 'Ethiopian birr',
                    'EUR|Euro' => 'Euro',
                    'FJD|Fijian dollar' => 'Fijian dollar',
                    'FKP|Falkland Islands pound' => 'Falkland Islands pound',
                    'GBP|Pound sterling' => 'Pound sterling',
                    'GEL|Georgian lari' => 'Georgian lari',
                    'GGP|Guernsey pound' => 'Guernsey pound',
                    'GHS|Ghana cedi' => 'Ghana cedi',
                    'GIP|Gibraltar pound' => 'Gibraltar pound',
                    'GMD|Gambian dalasi' => 'Gambian dalasi',
                    'GNF|Guinean franc' => 'Guinean franc',
                    'GTQ|Guatemalan quetzal' => 'Guatemalan quetzal',
                    'GYD|Guyanese dollar' => 'Guyanese dollar',
                    'HKD|Hong Kong dollar' => 'Hong Kong dollar',
                    'HNL|Honduran lempira' => 'Honduran lempira',
                    'HRK|Croatian kuna' => 'Croatian kuna',
                    'HTG|Haitian gourde' => 'Haitian gourde',
                    'HUF|Hungarian forint' => 'Hungarian forint',
                    'IDR|Indonesian rupiah' => 'Indonesian rupiah',
                    'ILS|Israeli new shekel' => 'Israeli new shekel',
                    'IMP|Manx pound' => 'Manx pound',
                    'INR|Indian rupee' => 'Indian rupee',
                    'IQD|Iraqi dinar' => 'Iraqi dinar',
                    'IRR|Iranian rial' => 'Iranian rial',
                    'IRT|Iranian toman' => 'Iranian toman',
                    'ISK|Icelandic króna' => 'Icelandic króna',
                    'JEP|Jersey pound' => 'Jersey pound',
                    'JMD|Jamaican dollar' => 'Jamaican dollar',
                    'JOD|Jordanian dinar' => 'Jordanian dinar',
                    'JPY|Japanese yen' => 'Japanese yen',
                    'KES|Kenyan shilling' => 'Kenyan shilling',
                    'KGS|Kyrgyzstani som' => 'Kyrgyzstani som',
                    'KHR|Cambodian riel' => 'Cambodian riel',
                    'KMF|Comorian franc' => 'Comorian franc',
                    'KPW|North Korean won' => 'North Korean won',
                    'KRW|South Korean won' => 'South Korean won',
                    'KWD|Kuwaiti dinar' => 'Kuwaiti dinar',
                    'KYD|Cayman Islands dollar' => 'Cayman Islands dollar',
                    'KZT|Kazakhstani tenge' => 'Kazakhstani tenge',
                    'LAK|Lao kip' => 'Lao kip',
                    'LBP|Lebanese pound' => 'Lebanese pound',
                    'LKR|Sri Lankan rupee' => 'Sri Lankan rupee',
                    'LRD|Liberian dollar' => 'Liberian dollar',
                    'LSL|Lesotho loti' => 'Lesotho loti',
                    'LYD|Libyan dinar' => 'Libyan dinar',
                    'MAD|Moroccan dirham' => 'Moroccan dirham',
                    'MDL|Moldovan leu' => 'Moldovan leu',
                    'MGA|Malagasy ariary' => 'Malagasy ariary',
                    'MKD|Macedonian denar' => 'Macedonian denar',
                    'MMK|Burmese kyat' => 'Burmese kyat',
                    'MNT|Mongolian tögrög' => 'Mongolian tögrög',
                    'MOP|Macanese pataca' => 'Macanese pataca',
                    'MRU|Mauritanian ouguiya' => 'Mauritanian ouguiya',
                    'MUR|Mauritian rupee' => 'Mauritian rupee',
                    'MVR|Maldivian rufiyaa' => 'Maldivian rufiyaa',
                    'MWK|Malawian kwacha' => 'Malawian kwacha',
                    'MXN|Mexican peso' => 'Mexican peso',
                    'MYR|Malaysian ringgit' => 'Malaysian ringgit',
                    'MZN|Mozambican metical' => 'Mozambican metical',
                    'NAD|Namibian dollar' => 'Namibian dollar',
                    'NGN|Nigerian naira' => 'Nigerian naira',
                    'NIO|Nicaraguan córdoba' => 'Nicaraguan córdoba',
                    'NOK|Norwegian krone' => 'Norwegian krone',
                    'NPR|Nepalese rupee' => 'Nepalese rupee',
                    'NZD|New Zealand dollar' => 'New Zealand dollar',
                    'OMR|Omani rial' => 'Omani rial',
                    'PAB|Panamanian balboa' => 'Panamanian balboa',
                    'PEN|Sol' => 'Sol',
                    'PGK|Papua New Guinean kina' => 'Papua New Guinean kina',
                    'PHP|Philippine peso' => 'Philippine peso',
                    'PKR|Pakistani rupee' => 'Pakistani rupee',
                    'PLN|Polish złoty' => 'Polish złoty',
                    'PRB|Transnistrian ruble' => 'Transnistrian ruble',
                    'PYG|Paraguayan guaraní' => 'Paraguayan guaraní',
                    'QAR|Qatari riyal' => 'Qatari riyal',
                    'RON|Romanian leu' => 'Romanian leu',
                    'RSD|Serbian dinar' => 'Serbian dinar',
                    'RUB|Russian ruble' => 'Russian ruble',
                    'RWF|Rwandan franc' => 'Rwandan franc',
                    'SAR|Saudi riyal' => 'Saudi riyal',
                    'SBD|Solomon Islands dollar' => 'Solomon Islands dollar',
                    'SCR|Seychellois rupee' => 'Seychellois rupee',
                    'SDG|Sudanese pound' => 'Sudanese pound',
                    'SEK|Swedish krona' => 'Swedish krona',
                    'SGD|Singapore dollar' => 'Singapore dollar',
                    'SHP|Saint Helena pound' => 'Saint Helena pound',
                    'SLL|Sierra Leonean leone' => 'Sierra Leonean leone',
                    'SOS|Somali shilling' => 'Somali shilling',
                    'SRD|Surinamese dollar' => 'Surinamese dollar',
                    'SSP|South Sudanese pound' => 'South Sudanese pound',
                    'STN|São Tomé and Príncipe dobra' => 'São Tomé and Príncipe dobra',
                    'SYP|Syrian pound' => 'Syrian pound',
                    'SZL|Swazi lilangeni' => 'Swazi lilangeni',
                    'THB|Thai baht' => 'Thai baht',
                    'TJS|Tajikistani somoni' => 'Tajikistani somoni',
                    'TMT|Turkmenistan manat' => 'Turkmenistan manat',
                    'TND|Tunisian dinar' => 'Tunisian dinar',
                    'TOP|Tongan paanga' => 'Tongan paanga',
                    'TRY|Turkish lira' => 'Turkish lira',
                    'TTD|Trinidad and Tobago dollar' => 'Trinidad and Tobago dollar',
                    'TWD|New Taiwan dollar' => 'New Taiwan dollar',
                    'TZS|Tanzanian shilling' => 'Tanzanian shilling',
                    'UAH|Ukrainian hryvnia' => 'Ukrainian hryvnia',
                    'UGX|Ugandan shilling' => 'Ugandan shilling',
                    'USD|United States (US) dollar' => 'United States (US) dollar',
                    'UYU|Uruguayan peso' => 'Uruguayan peso',
                    'UZS|Uzbekistani som' => 'Uzbekistani som',
                    'VEF|Venezuelan bolívar' => 'Venezuelan bolívar',
                    'VES|Bolívar soberano' => 'Bolívar soberano',
                    'VND|Vietnamese đồng' => 'Vietnamese đồng',
                    'VUV|Vanuatu vatu' => 'Vanuatu vatu',
                    'WST|Samoan tālā' => 'Samoan tālā',
                    'XAF|Central African CFA franc' => 'Central African CFA franc',
                    'XCD|East Caribbean dollar' => 'East Caribbean dollar',
                    'XOF|West African CFA franc' => 'West African CFA franc',
                    'XPF|CFP franc' => 'CFP franc',
                    'YER|Yemeni rial' => 'Yemeni rial',
                    'ZAR|South African rand' => 'South African rand',
                )
            ),
            'section_end' => array(
                'type' => 'sectionend',
                'id' => 'wc_every_currency_converter_section_end'
            )
        );

        return apply_filters('wc_every_currency_converter_settings', $settings);
    }
}

WC_every_currency_converter::init();
