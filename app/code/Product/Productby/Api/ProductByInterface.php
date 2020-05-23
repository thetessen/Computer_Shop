<?php
namespace Product\Productby\Api;

use Magento\Framework\Exception\NoSuchEntityException;
interface ProductByInterface
{
 
 /**
  * GET product identified by its id
  *
  * @api
  * @param string $productId
  * @return \Magento\Catalog\Api\Data\ProductInterface
  * @throws \Magento\Framework\Exception\NoSuchEntityException
  */
 public function getProductById($productId);
}