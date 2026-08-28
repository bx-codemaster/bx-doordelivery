<?php
/**
 * Class codchange
 *
 * @package includes\modules\payment
 */

if (isset($_SESSION['cod_change_bill']) && !empty($_SESSION['cod_change_bill']) && $_SESSION['cod_change_bill'] > 0.0) {
  $bill_value = filter_var($_SESSION['cod_change_bill'], FILTER_VALIDATE_FLOAT);
  
  $cod_change_array['cod_change_bill'] = $bill_value;
   xtc_db_perform(TABLE_ORDERS, $cod_change_array, 'update', 'orders_id = "' . (int)$_SESSION['tmp_oID'] . '"');
  
  // Session aufräumen
  unset($_SESSION['cod_change_bill']);
}

if (isset($_SESSION['cod_tip']) && !empty($_SESSION['cod_tip']) && $_SESSION['cod_tip'] > 0.0) {
  $tip_value = filter_var($_SESSION['cod_tip'], FILTER_VALIDATE_FLOAT);
  
  $cod_tip_array['cod_tip'] = $tip_value;
   xtc_db_perform(TABLE_ORDERS, $cod_tip_array, 'update', 'orders_id = "' . (int)$_SESSION['tmp_oID'] . '"');
  
  // Session aufräumen
  unset($_SESSION['cod_tip']);
}