<?php
/**
 * Базовая конфигурация WordPress.
 *
 * Данный файл содержит конфигурацию следующих параметров: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Вы можете почитать подробнее, зайдя на
 * страницу {@link http://codex.wordpress.org/Editing_wp-config.php Редактирование
 * wp-config.php} кодекса. Вы можете узнать настройки MySQL у Вашего хостера.
 *
 * Данный файл используется при создании wp-config.php во время установки.
 * Однако Вам не обязательно пользоваться Веб-интерфейсом, Вы можете просто скопировать его в
 * "wp-config.php" и самостоятельно заполнить значения.
 *
 * @package WordPress
 */

// ** Настройки MySQL - Вы можете получить эти данные у Вашего хостера ** //
/** Название базы данных WordPress */
define( 'WPCACHEHOME', '/home/r/rtibal4z/root.localhost/public_html/wp-content/plugins/_wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'rtibal4z_rtibaln');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль MySQL */
define('DB_PASSWORD', '');

/** Хост MySQL */
define('DB_HOST', 'localhost');

/** Кодировка СУБД, используемая при создании таблиц. Едва ли Вам потребуется это изменять. */
define('DB_CHARSET', 'utf8');



/** Способ сравнения строк в СУБД. Не меняйте это значение, если сомневаетесь. */
define('DB_COLLATE', '');
define('WP_HOME','http://artibaltika/');
define('WP_SITEURL','http://artibaltika');
/**#@+
 * Уникальные ключи аутентификации.
 *
 * Поменяйте эти строки на другие уникальные фразы! Если Вы этого не сделаете, безопасность Вашего блога будет под угрозой.
 * Вы можете сгенерировать их при помощи специального сервиса {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Вы можете поменять их в любой момент. Это приведет к тому, что всем пользователям нужно будет входить в систему заново.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '#:jf9+-jZO-Szp Tg3^}*yF?l.l11):e9mA-ZS$u)^_}n>d}kJ+ySIx6zQ@-Zx@c');
define('SECURE_AUTH_KEY',  'Flu[9Y?WZBD[x-RVu3<kmWP,&3ga~~[JXx1QdL7fdCMr)~zSmX6/n<^= ]|txdbi');
define('LOGGED_IN_KEY',    '++F<#^/.3ctFz8{):+3etieM%abjY>ev~HE*H;isg/9@-h,ZWRulI vZi6fE37au');
define('NONCE_KEY',        'UBpAQ,iW+dWRx},wD6`x-X,IcBG^mnJ-Ka(EY<Mg7rH|C@i-^`5gKY2jQj8#AoB]');
define('AUTH_SALT',        'O-Ue@}MSN,ZTMJCEFd2-9q2^}m.kuz#r+HRn+Q79>3.sOqpn3iNH~b9fAN)kU6:Q');
define('SECURE_AUTH_SALT', '_r C4T5UF?-.9U=9_?}[w PEh+qc.<= r;uFx,S%v@u`I?>K?I3b?`0{hWce7Y6e');
define('LOGGED_IN_SALT',   '~4:B&swt9I1[vuFjHX/7s9gry0/{rOJ9j)rM*5[h 9MCRwk+(}p-|7d{v_|F}t}U');
define('NONCE_SALT',       ':L:cl1:ke=MJ+e|Mqfv3`c1+S5b`<yJFY,(-&q#w7{ug<=--o5y/1uKz?,StDj1L');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Вы можете иметь несколько установок в одной БД, давая им различные префиксы.
 * Пожалуйста, используйте только латинские буквы, арабские цифры и знаки подчеркивания!
 */
$table_prefix  = 'wp_';

/**
 * Язык локализации WordPress.
 *
 */
define ('WPLANG', 'ru_RU');
define('WP_MEMORY_LIMIT', '64M');

/**
 * Для разработчиков: включение режима отладки WordPress.
 *
 * Поменяйте это значение на true, если хотите видеть сообщения по ходу разработки.
 * Крайне рекомендуется использовать WP_DEBUG разрабочикам тем и плагинов в своей среде разработки.
 */
define('WP_DEBUG', false);

/* Все, больше редактировать ничего не надо! Счастливых публикаций. */

/** Абсолютный путь к каталогу WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Настраивает переменные и модули WordPress. */
require_once(ABSPATH . 'wp-settings.php');
