<?php
$module_name = 'AOS_Products';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
        'headerTpl' => 'modules/AOS_Products/tpls/EditViewHeader.tpl',
      ),
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/AOS_Products/js/products.js',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
          1 => 
          array (
            'name' => 'part_number',
            'label' => 'LBL_PART_NUMBER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'aos_product_category_name',
            'label' => 'LBL_AOS_PRODUCT_CATEGORYS_NAME',
          ),
          1 => 
          array (
            'name' => 'type',
            'label' => 'LBL_TYPE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'cost_currency_c',
            'studio' => 'visible',
            'label' => 'LBL_COST_CURRENCY',
          ),
          1 => 
          array (
            'name' => 'currency_id',
            'studio' => 'visible',
            'label' => 'LBL_CURRENCY',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'cost_2_c',
            'label' => 'LBL_COST_2',
          ),
          1 => 
          array (
            'name' => 'price',
            'label' => 'LBL_PRICE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'supplier_margin_c',
            'label' => 'LBL_SUPPLIER_MARGIN',
          ),
          1 => 
          array (
            'name' => 'license_type_c',
            'studio' => 'visible',
            'label' => 'LBL_LICENSE_TYPE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'company_c',
            'studio' => 'visible',
            'label' => 'LBL_COMPANY',
          ),
          1 => 
          array (
            'name' => 'contact',
            'label' => 'LBL_CONTACT',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'product_image',
            'customCode' => '{$PRODUCT_IMAGE}',
          ),
          1 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'obsolete_c',
            'label' => 'LBL_OBSOLETE',
          ),
          1 => 
          array (
            'name' => 'is_service_c',
            'label' => 'LBL_IS_SERVICE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'related_maintenance_c',
            'studio' => 'visible',
            'label' => 'LBL_RELATED_MAINTENANCE',
          ),
          1 => 
          array (
            'name' => 'url',
            'label' => 'LBL_URL',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'myob_accnum_purchase_c',
            'label' => 'LBL_MYOB_ACCNUM_PURCHASE',
          ),
          1 => 
          array (
            'name' => 'myob_accnum_sales_c',
            'label' => 'LBL_MYOB_ACCNUM_SALES',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'myob_job_groupid_c',
            'label' => 'LBL_MYOB_JOB_GROUPID',
          ),
        ),
      ),
    ),
  ),
);
?>
