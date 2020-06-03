/**
 * GiaPhuGroup Co., Ltd.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GiaPhuGroup.com license that is
 * available through the world-wide-web at this URL:
 * https://www.giaphugroup.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    PHPCuong
 * @package     PHPCuong_OnePay
 * @copyright   Copyright (c) 2018-2019 GiaPhuGroup Co., Ltd. All rights reserved. (http://www.giaphugroup.com/)
 * @license     https://www.giaphugroup.com/LICENSE.txt
 */
define(
    [
        'Magento_Checkout/js/view/payment/default',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Magento_Checkout/js/action/redirect-on-success',
        'mage/url',
        'jquery'
    ],
    function (Component, additionalValidators, redirectOnSuccessAction, urlBuilder, $) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'PHPCuong_OnePay/payment/onepay-international',
            },

            /**
             * Place order.
             */
            placeOrder: function (data, event) {
                var self = this;

                if (event) {
                    event.preventDefault();
                }

                if (this.validate() && additionalValidators.validate()) {
                    this.isPlaceOrderActionAllowed(false);

                    this.getPlaceOrderDeferredObject()
                        .fail(function () {
                                self.isPlaceOrderActionAllowed(true);
                            }).done(function (orderID) {
                                $.ajax({
                                    url: urlBuilder.build('onepay_payment_portal/order/international_placeOrder'),
                                    data: {'order_id': orderID},
                                    dataType: 'json',
                                    type: 'POST'
                                }).done(function (response) {
                                    if (!response.error) {
                                        window.location.replace(response.payment_url);
                                    } else {
                                        redirectOnSuccessAction.execute();
                                    }
                                }).fail(function (response) {
                                    console.log(response);
                                    redirectOnSuccessAction.execute();
                                });

                                self.afterPlaceOrder();
                            }
                        );
                    return true;
                }

                return false;
            }
        });
    }
);
