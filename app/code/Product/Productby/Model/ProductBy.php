<?php
namespace Product\Productby\Model;

use Product\Productby\Api\ProductByInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
class ProductBy extends \Magento\Framework\View\Element\Template implements ProductByInterface
{

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    public function __construct(
      \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
      )
    {
      $this->productRepository = $productRepository;
    }
    

    public function getProductById($productId)
    {
        return $this->productRepository->getById($productId);      
    }
}