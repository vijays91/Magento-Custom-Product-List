<?php
class Vijay_CustomProductList_Model_Dropdown_Customcategory
{
	public $categories_parent;

    public function __construct() {
        $this->categories_parent = array();     
    }
    
    public function getAllParentCategories() {
    
        /* $rootId = Mage::app()->getStore('default')->getRootCategoryId(); */
        $rootId = Mage::app()->getWebsite(true)->getDefaultStore()->getRootCategoryId();
        $categories = Mage::getModel('catalog/category')->load($rootId)->getChildrenCategories();
        foreach($categories as $category) {
        	$category->load($category->getId());
            $this->categories_parent[$category->getId()] = array(
                'value'         => $category->getId(),
                'attribute_id'  => $category->getVesAttributeSet(),
                'label'         => $category->getName(),
                'level'         => $category->getLevel(),
				'style'         => "",
            );
			
			if($category->hasChildren()) {
				$children = Mage::getModel('catalog/category')->getCategories($category->entity_id);
				$this->getAllChildCategorys($children, " --> ");
            }
        }
        return $this->categories_parent;
    }
	
	public function getAllChildCategorys($categories, $px) {
		 foreach($categories as $category) {
            $this->categories_parent[$category->getId()] = array(
                'value'         => $category->getId(),
                'attribute_id'  => $category->getVesAttributeSet(),
                'label'         => $category->getName(),
                'level'         => $category->getLevel(),
				'style'         =>  $px,
            );
			if($category->hasChildren()) {
				$children = Mage::getModel('catalog/category')->getCategories($category->entity_id);
				$this->getAllChildCategorys($children, $px." --> ");
			}
		}
	}
    public function toOptionArray()
	{
        $category = $this->getAllParentCategories();
        $list_category = array();
        $list_category[0]['value']  = "";
        $list_category[0]['label']  = "-- Select --";
        $i = 1;
        foreach($category as $key => $value) {
            $list_category[$i]['value']  = $value['value'];
            $list_category[$i]['label']  = $value['style'].$value['label'];
            $i++;
        }        
        return $list_category;
	} 
}