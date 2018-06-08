<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2018-05-15 09:44:39
$dictionary["AOK_KnowledgeBase"]["fields"]["documents_aok_knowledgebase_1"] = array (
  'name' => 'documents_aok_knowledgebase_1',
  'type' => 'link',
  'relationship' => 'documents_aok_knowledgebase_1',
  'source' => 'non-db',
  'module' => 'Documents',
  'bean_name' => 'Document',
  'vname' => 'LBL_DOCUMENTS_AOK_KNOWLEDGEBASE_1_FROM_DOCUMENTS_TITLE',
  'id_name' => 'documents_aok_knowledgebase_1documents_ida',
);
$dictionary["AOK_KnowledgeBase"]["fields"]["documents_aok_knowledgebase_1_name"] = array (
  'name' => 'documents_aok_knowledgebase_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DOCUMENTS_AOK_KNOWLEDGEBASE_1_FROM_DOCUMENTS_TITLE',
  'save' => true,
  'id_name' => 'documents_aok_knowledgebase_1documents_ida',
  'link' => 'documents_aok_knowledgebase_1',
  'table' => 'documents',
  'module' => 'Documents',
  'rname' => 'document_name',
);
$dictionary["AOK_KnowledgeBase"]["fields"]["documents_aok_knowledgebase_1documents_ida"] = array (
  'name' => 'documents_aok_knowledgebase_1documents_ida',
  'type' => 'link',
  'relationship' => 'documents_aok_knowledgebase_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DOCUMENTS_AOK_KNOWLEDGEBASE_1_FROM_AOK_KNOWLEDGEBASE_TITLE',
);

?>