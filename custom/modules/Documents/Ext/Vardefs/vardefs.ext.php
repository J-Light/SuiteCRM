<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2018-05-15 09:44:39
$dictionary["Document"]["fields"]["documents_aok_knowledgebase_1"] = array (
  'name' => 'documents_aok_knowledgebase_1',
  'type' => 'link',
  'relationship' => 'documents_aok_knowledgebase_1',
  'source' => 'non-db',
  'module' => 'AOK_KnowledgeBase',
  'bean_name' => 'AOK_KnowledgeBase',
  'side' => 'right',
  'vname' => 'LBL_DOCUMENTS_AOK_KNOWLEDGEBASE_1_FROM_AOK_KNOWLEDGEBASE_TITLE',
);


// created: 2018-08-07 15:41:32
$dictionary["Document"]["fields"]["aos_invoices_documents_1"] = array (
  'name' => 'aos_invoices_documents_1',
  'type' => 'link',
  'relationship' => 'aos_invoices_documents_1',
  'source' => 'non-db',
  'module' => 'AOS_Invoices',
  'bean_name' => 'AOS_Invoices',
  'vname' => 'LBL_AOS_INVOICES_DOCUMENTS_1_FROM_AOS_INVOICES_TITLE',
  'id_name' => 'aos_invoices_documents_1aos_invoices_ida',
);
$dictionary["Document"]["fields"]["aos_invoices_documents_1_name"] = array (
  'name' => 'aos_invoices_documents_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_AOS_INVOICES_DOCUMENTS_1_FROM_AOS_INVOICES_TITLE',
  'save' => true,
  'id_name' => 'aos_invoices_documents_1aos_invoices_ida',
  'link' => 'aos_invoices_documents_1',
  'table' => 'aos_invoices',
  'module' => 'AOS_Invoices',
  'rname' => 'name',
);
$dictionary["Document"]["fields"]["aos_invoices_documents_1aos_invoices_ida"] = array (
  'name' => 'aos_invoices_documents_1aos_invoices_ida',
  'type' => 'link',
  'relationship' => 'aos_invoices_documents_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_AOS_INVOICES_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);

?>