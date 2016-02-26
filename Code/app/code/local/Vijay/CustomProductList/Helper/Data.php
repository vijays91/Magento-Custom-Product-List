<?php
class Vijay_CustomProductList_Helper_Data extends Mage_Core_Helper_Abstract
{
	const XML_PATH_CUSTOM_PRUD_LIST_LAYOUT   = 'customproductlist_tab/customproductlist_setting/customproductlist_layouts';
	const XML_PATH_CUSTOM_PRUD_LIST_CATEGORY = 'customproductlist_tab/customproductlist_setting/customproductlist_categorys';
	const XML_PATH_CUSTOM_PRUD_LIST_TITLE    = 'customproductlist_tab/customproductlist_setting/customproductlist_title';
	const XML_PATH_CUSTOM_PRUD_LIST_SORTBY   = 'customproductlist_tab/customproductlist_setting/customproductlist_sorting';
	const XML_PATH_CUSTOM_PRUD_LIST_DIRECTION = 'customproductlist_tab/customproductlist_setting/customproductlist_direction';
	const XML_PATH_CUSTOM_PRUD_LIST_COLUMN_COUNT    = 'customproductlist_tab/customproductlist_setting/customproductlist_columncount';
	const XML_PATH_CUSTOM_PRUD_LIST_META_DESC = 'customproductlist_tab/customproductlist_setting/customproductlist_meta_desc';
	const XML_PATH_CUSTOM_PRUD_LIST_META_KEYWORD = 'customproductlist_tab/customproductlist_setting/customproductlist_meta_keyword';

    public function conf($code, $store = null) {
        return Mage::getStoreConfig($code, $store);
    }

	public function getCustomLayout() {
		return $this->conf(self::XML_PATH_CUSTOM_PRUD_LIST_LAYOUT, $store);
	}
	
	public function getCustomCategory() {
		return $this->conf(self::XML_PATH_CUSTOM_PRUD_LIST_CATEGORY, $store);
	}
    
   	public function getCustomtitle() {
		return $this->conf(self::XML_PATH_CUSTOM_PRUD_LIST_TITLE, $store);
	}
    
   	public function getCustomSortBy() {
		return $this->conf(self::XML_PATH_CUSTOM_PRUD_LIST_SORTBY, $store);
	}
    
   	public function getCustomDirection() {
		return $this->conf(self::XML_PATH_CUSTOM_PRUD_LIST_DIRECTION, $store);
	}
    
   	public function getCustomColumnCount() {
		return $this->conf(self::XML_PATH_CUSTOM_PRUD_LIST_COLUMN_COUNT, $store);
	}
    
   	public function getCustomMetaDesc() {
		return $this->conf(self::XML_PATH_CUSTOM_PRUD_LIST_META_DESC, $store);
	}
    
   	public function getCustomMetaKeyword() {
		return $this->conf(self::XML_PATH_CUSTOM_PRUD_LIST_META_KEYWORD, $store);
	}
    
    public function getSortingAvailableOrders()
    {
        return array (
            'price'     => $this->__('Price'),
            'position'  => $this->__('Position'),
            'name'      => $this->__('Name'),
        );
    }

    public function getCustomProductCollection()
    {
        $category_id = $this->getCustomCategory();
        /* $rootId = Mage::app()->getStore('default')->getRootCategoryId(); */
        /* $rootId = Mage::app()->getWebsite(true)->getDefaultStore()->getRootCategoryId(); */
        $collection = Mage::getModel('catalog/category')
            ->load($category_id)
            ->getProductCollection()
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addUrlRewrite($category_id);

        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);

        return $collection;
    }
    
    public function CustomTemplate()
    {
        $current_template = self::getCustomLayout();
        foreach(Mage::getSingleton('page/config')->getPageLayouts() as $layout) {
            if($layout->getCode() == $current_template) {
                return $layout->getTemplate();
            }
        }
        return "page/1column.phtml";
    }

}