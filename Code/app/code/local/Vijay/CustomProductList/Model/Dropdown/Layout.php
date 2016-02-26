<?php
class Vijay_CustomProductList_Model_Dropdown_Layout
{
    public function toOptionArray()
	{
        $list_layout = array();
        $list_layout[0]['value']  = "";
        $list_layout[0]['label']  = "-- Select --";
        $i = 1;
        foreach(Mage::getSingleton('page/config')->getPageLayouts() as $layout) {
            $list_layout[$i]['value']  = $layout->getCode();
            $list_layout[$i]['label']  = $layout->getLabel(); 
            /*- $layout->getTemplate(); // setTemplate value -*/
            $i++;
        }
        return $list_layout;
	} 
}