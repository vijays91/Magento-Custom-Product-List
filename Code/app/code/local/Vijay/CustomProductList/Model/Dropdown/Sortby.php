<?php
class Vijay_CustomProductList_Model_Dropdown_Sortby
{
    public function toOptionArray()
	{
        return array (
            array(
                "value" => "position",
                "label" => "Position"
            ),
            array(
                "value" => "price",
                "label" => "Price"
            ),
            array(
                "value" => "name",
                "label" => "Name"
            )
        );
	} 
}