<?php
/*
Plugin Name: SDEK DOSTAVKA
Plugin URI: http://isite39.ru
Description: sdek
Version: 1.0.0
Author: isite39
Author URI: http://isite39.ru
*/
 

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

 
	function your_shipping_method_init() {
	
	
		if ( ! class_exists( 'WC_Your_Shipping_Method' ) ) {
			class WC_Your_Shipping_Method extends WC_Shipping_Method {
			
			
				public static $instance = null;
				/**
				 * Constructor for your shipping class
				 *
				 * @access public
				 * @return void
				 */
				public function __construct() {
					$this->id                 = 'your_shipping_method'; // Id for your shipping method. Should be uunique.
					$this->method_title       = __( 'Доставка' );  // Title shown in admin
					$this->method_description = __( 'Калькулятор доставки сдэк' ); // Description shown in admin
 
					$this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled
					$this->title              = "Доставка"; // This can be added as an setting but for this example its forced.
 
 
 
					$this->minimum_fee = 0;
					$this->min_amount  = 3000;
					$this->init();
					
					
					self::$instance = $this;
				}
 
				/**
				 * Init your settings
				 *
				 * @access public
				 * @return void
				 */
				function init() {
					// Load the settings API
					$this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
					$this->init_settings(); // This is part of the settings API. Loads settings you previously init.
 
					// Save settings in admin if you have any defined
					add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
				}
 
				/**
				 * calculate_shipping function.
				 *
				 * @access public
				 * @param mixed $package
				 * @return void
				 */
				public function calculate_shipping( $package = array() ) {
				
				
					//подключаем файл с классом CalculatePriceDeliveryCdek
					include_once(TEMPLATEPATH . "/calc_deliv_cdek_js/CalculatePriceDeliveryCdek.php");

					
					
					try {

						//создаём экземпляр объекта CalculatePriceDeliveryCdek
						$calc = new CalculatePriceDeliveryCdek();
						
						//Авторизация. Для получения логина/пароля (в т.ч. тестового) обратитесь к разработчикам СДЭК -->
						//$calc->setAuth('authLoginString', 'passwordString');
						
						
						
						
						
						if(isset($_REQUEST['calc_shipping'])) {
						
							foreach($_REQUEST as $k => $v)
								$_SESSION[$k] = $_REQUEST[$k];
						}
							
						
						
						
						
						
						//устанавливаем город-отправитель
						$calc->setSenderCityId("152");
						//устанавливаем город-получатель
						$calc->setReceiverCityId($_SESSION['receiverCityId']);
						//устанавливаем дату планируемой отправки
						$calc->setDateExecute($_SESSION['dateExecute']);
						
						//устанавливаем тариф по-умолчанию
						$calc->setTariffId('11');
						//задаём список тарифов с приоритетами
						// $calc->addTariffPriority($_REQUEST['tariffList1']);
						// $calc->addTariffPriority($_REQUEST['tariffList2']);
						
						
						
						
					
						
						//устанавливаем режим доставки
						$calc->setModeDeliveryId($_SESSION['modeId']);
						//добавляем места в отправление
						
						$total_items = isset($_SESSION['total_items']) ? $_SESSION['total_items'] : 0;
						
						
						$total_weight = (int)$total_items * (float)$_SESSION['weight1'];
						
						$calc->addGoodsItemBySize(
							$total_weight,
							$_SESSION['length1'], 
							$_SESSION['width1'], 
							$_SESSION['height1']
						);
						//$calc->addGoodsItemByVolume($_REQUEST['weight2'], $_REQUEST['volume2']);
						
						if ($calc->calculate() === true) {
							$res = $calc->getResult();
							
							
							
							//$res['result']['price'] = round( $res['result']['price'] + 0.00 * $res['result']['price'], -1 );
							
							global $woocommerce;
							
							$res['result']['price'] = $woocommerce->cart->cart_contents_total * 0.08; 
							$res['result']['price'] = max( min(1950, $res['result']['price']), 350 );
							$res['result']['price'] = round( $res['result']['price'], -1 );
							
							
							
							file_put_contents(dirname(__FILE__) . "/log.txt", json_encode( $woocommerce->cart ));
							
							$html = array(	
								"Цена доставки: {$res['result']['price']}", 
								//"Срок доставки: {$res['result']['deliveryPeriodMin']}-{$res['result']['deliveryPeriodMax']} дн.",
								//"Планируемая дата доставки: c {$res['result']['deliveryDateMin']} по {$res['result']['deliveryDateMax']} "
							);
							
							if(array_key_exists('cashOnDelivery', $res['result'])) {
								$html[] = "Ограничение оплаты наличными, от (руб): " . $res['result']['cashOnDelivery'];
							}
							
							//printf("<div class='woocommerce-message'>%s</div>", implode("<br/>", $html) );
							
							
							
						} else {
							$err = $calc->getError();
							if( isset($err['error']) && !empty($err) ) {
								print "<div class = 'woocommerce-error'>";
								//var_dump($err);
								foreach($err['error'] as $e) {
									echo 'Код ошибки: ' . $e['code'] . '.<br />';
									echo 'Текст ошибки: ' . $e['text'] . '.<br />';
								}
								
								print "</div>";
							}
						}
						
						//раскомментируйте, чтобы просмотреть исходный ответ сервера
						// var_dump($calc->getResult());
						// var_dump($calc->getError());
						
						global $delta;
						
						$rate = array(
							'id' => $this->id,
							'label' => $this->title,
							'cost' => $res['result']['price'] + $delta,
							'calc_tax' => 'per_order'
						);
						
						// Register the rate
						$this->add_rate( $rate );

					} 
					catch (Exception $e) {
						echo 'Ошибка: ' . $e->getMessage() . "<br />";
					}
				
				}
			}
		}
	}
 
	add_action( 'woocommerce_shipping_init', 'your_shipping_method_init' );
 
	function add_your_shipping_method( $methods ) {
		
		$methods[] = 'WC_Your_Shipping_Method';
		return $methods;
	}
 
	add_filter( 'woocommerce_shipping_methods', 'add_your_shipping_method' );
}