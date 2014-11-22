<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

echo $view->render('MauticFormBundle:Field:text.html.php', array(
    'field'    => $field,
    'inForm'   => (isset($inForm)) ? $inForm : false,
    'type'     => 'text',
    'id'       => $id,
    'deleted'  => (!empty($deleted)) ? true : false,
    'required' => true,
    'formId'  => (isset($formId)) ? $formId : 0
));