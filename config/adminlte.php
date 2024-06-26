<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */
    'title' => 'MedirWeb',

    'title_prefix' => '',

    'title_postfix' => ' - Plataforma individualizadora',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => 'Medir<b>Web</b>',

    'logo_mini' => 'M<b>W</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => '',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => ['GERENCIAL'],

    'menu_admin' => [
        [
            'text' => 'Dashboard',
            'url'  => 'home',
            'icon' => 'tasks',
        ],
        [
            'text'    => 'Clientes',
            'icon'    => 'users',
            'submenu' => [
                [
                    'text' => 'Novo cliente',
                    'icon' => 'plus',
                    'url'  => 'cliente/create',
                ],
                [
                    'text' => 'Ver todos',
                    'icon' => 'list',
                    'url'  => 'cliente/',
                ],
            ],
        ],
        [
            'text'    => 'Imóveis',
            'icon'    => 'building',
            'submenu' => [
                [
                    'text' => 'Novo imóvel',
                    'icon' => 'plus',
                    'url'  => 'imovel/create',
                ],
                [
                    'text' => 'Buscar',
                    'icon' => 'search',
                    'url'  => '/imovel/buscar',
                ],
                [
                    'text' => 'Ver todos',
                    'icon' => 'list',
                    'url'  => 'imovel',
                ],
            ],
        ],
        [
            'text'    => 'Cadastros',
            'icon'    => 'floppy-o',
            'submenu' => [
                [
                    'text' => 'Agrupamentos',
                    'icon' => 'plus',
                    'url'  => 'agrupamento/create',
                ],
                [
                    'text' => 'Unidades',
                    'icon' => 'home',
                    'url'  => 'unidade/create',
                ],
                [
                    'text' => 'Equipamentos',
                    'icon' => 'cog',
                    'url'  => 'prumada/create',
                ]
            ],
        ],
        [
            'text'    => 'Infos',
            'icon'    => 'info-circle',
            'submenu' => [
                [
                    'text' => 'Comandos',
                    'icon' => 'dev',
                    'url'  => 'server/comandos',
                ],
                [
                    'text' => 'Equipamentos',
                    'icon' => 'cog',
                    'url'  => 'timeline/equipamento/buscar',
                ],
                [
                    'text' => 'Importar Unidades',
                    'icon' => 'id-card-o',
                    'url'  => 'importar/csv',
                ],
                [
                    'text' => 'Teste de Conexão Servidor',
                    'icon' => 'cloud',
                    'url'  => 'server/test',
                ],
                [
                    'text' => 'Teste Avançado de Conexão',
                    'icon' => 'cloud',
                    'url' => '/server/test/local'
                ]
            ],
        ],
        [
            'text'    => 'Consulta consumo',
            'icon'    => 'tachometer',
            'url'     => 'relatorio/consumo',
        ],
        [
            'text'    => 'Usuários',
            'icon'    => 'users',
            'submenu' => [
                [
                    'text' => 'Novo usuário',
                    'icon' => 'plus',
                    'url'  => 'usuario/create',
                ],
                [
                    'text' => 'Administrador',
                    'icon' => 'user',
                    'url'  => '/usuario/tipo/administrador',
                ],
                [
                    'text' => 'Sindico',
                    'icon' => 'user',
                    'url'  => '/usuario/tipo/sindico/',
                ],
                [
                    'text' => 'Secretário',
                    'icon' => 'user',
                    'url'  => '/usuario/tipo/secretario/',
                ],
            ],
        ],
        [
            'text'    => 'Relatórios',
            'icon'    => 'file-o ',
            'url'     => '#',
            'submenu' => [
                [
                    'text' => 'Consulta Consumo',
                    'icon' => 'tachometer',
                    'url'  => 'relatorio/consumo',
                    
                ],
                [
                    'text' => 'Consulta Falhas',
                    'icon' => 'close',
                    'url'  => 'relatorio/falha',

                ],
            ],
        ],
        [
            'text'    => 'Liquidação de Faturas',
            'icon'    => 'money',
            'url'     => 'relatorio/faturas',
        ],
        [
            'text'    => 'Agenda Financeira',
            'icon'    => 'calendar',
            'url'     => '#',
        ]
    ],

    /*
    'menu2' => [
        [
            'text'    => 'Imóveis',
            'icon'    => 'building',
            'submenu' => [
                [
                    'text' => 'Buscar',
                    'icon' => 'search',
                    'url'  => 'imovel/buscar',
                ],
                [
                    'text' => 'Ver todos',
                    'icon' => 'list',
                    'url'  => 'imovel',
                ],
            ],
        ],
        [
            'text'    => 'Consulta consumo',
            'icon'    => 'tachometer',
            'url'     => 'relatorio/consumo',
        ],
        [
            'text'    => 'Liquidação de Faturas',
            'icon'    => 'money',
            'url'     => 'relatorio/faturas',
        ],
    ],
    */
    'menu2' => [
        [
            'text' => 'Painel',
            'icon' => 'dashboard',
            'url' => 'sindico/painel',
        ],
        [
            'text' => 'Unidades',
            'icon' => 'university',
            'url' => 'sindico/unidade',
        ],
        [
            'text' => 'Relatórios',
            'icon' => 'paper',
            'submenu' => [
                [
                    'text' => 'Consumo por unidades',
                    'icon' => 'paper',
                    'url' => 'sindico/relatorio/consumo-por-unidade',
                ],
                [
                    'text' => 'Lista de leituras',
                    'icon' => 'paper',
                    'url' => 'sindico/relatorio/lista-de-leitura',
                ],
                [
                    'text' => 'Comparativo de consumo',
                    'icon' => 'paper',
                    'url' => 'sindico/relatorio/comparativo-de-consumo',
                ],
            ],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
        'flot' => true,
    ],
];
