<?php
class Vijay_CustomProductList_Model_Dropdown_Direction
{
    public function toOptionArray()
	{
        return array (
            array(
                "value" => "desc",
                "label" => "Descending Order"
            ),
            array(
                "value" => "asc",
                "label" => "Ascending Order"
            )
        );
	} 
}