<?php
/**
 * @package Unlimited Elements
 * @author UniteCMS.net
 * @copyright (C) 2012 Unite CMS, All Rights Reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('UNLIMITED_ELEMENTS_INC') or die('Restricted access');

class UniteCreatorLayouts extends UniteCreatorLayoutsWork{
	
	
	
	
	/**
	 * save order from data
	 */
	public function updateOrdering($arrIDs){
		
		foreach($arrIDs as $order=>$postID)
			UniteFunctionsWPUC::updatePostOrdering($postID, $order);			
		
	}
	
	
	/**
	 * delete layouts
	 */
	public function deleteLayouts($arrIDs){
				
		if(empty($arrIDs))
			UniteFunctionsUC::throwError("no id's to delete");
		
		UniteFunctionsWPUC::deleteMultiplePosts($arrIDs);
		
	}
	
	
	/**
	 * duplicate layout redirect to page if needed
	 */
	public function duplicateLayoutFromData($data){
				
		$urlRedirect = parent::duplicateLayoutFromData($data);
		
		$redirectToWP = UniteFunctionsUC::getVal($data, "redirect_to_wp_page");
		$redirectToWP = UniteFunctionsUC::strToBool($redirectToWP);
		
		if($redirectToWP == true)
			$urlRedirect = UniteFunctionsWPUC::getUrlEditPost($this->lastDuplicatedID);
		
		return($urlRedirect);
	}
	
	
	/**
	 * check if layout exists by title
	 */
	public function isLayoutExistsByTitle($title, $layoutType = null){
		
		$isExists = UniteFunctionsWPUC::isPostExistsByTitle($title);
		
		return($isExists);
	}

	/**
	 * posts to layouts
	 */
	private function postsToLayouts($arrPosts){
				
		$arrLayouts = array();
		foreach($arrPosts as $post){
						
			$objLayout = new UniteCreatorLayout();
			$objLayout->initByPost($post);
			
			$arrLayouts[] = $objLayout;
		}
		
		return($arrLayouts);
	}
	
	
	/**
	 * posts to layouts
	 */
	private function postsToShort($arrPosts){
		
		$arrLayouts = array();
		foreach($arrPosts as $post){

			$postID = $post->ID;
			$postTitle = $post->post_title;
			
			if(empty($postTitle))
				$postTitle = $post->post_name;
			
			$arrShort[$postID] = $postTitle;
		}
		
		return($arrShort);
	}
	
	
	/**
	 *
	 * move layouts to some category by change category id
	 */
	protected function moveLayout($postID, $catID, $targetParentID = null){
		
		$postID = (int)$postID;
		$catID = (int)$catID;
		
		$post = get_post($postID);
		
		if(empty($post))
			return(false);

		//update post parent ID
		
		$parentID = 0;
		if(!empty($targetParentID))
			$parentID = (int)$targetParentID;
						
		$arrUpdate = array();
		$arrUpdate["post_parent"] = $parentID;
				
		UniteFunctionsWPUC::updatePost($postID, $arrUpdate);
		
		
		//update category ID
					
		update_post_meta($postID, GlobalsProviderUC::META_KEY_CATID, $catID);
		
	}
	
	
	/**
	 *
	 * get addons array
	 */
	public function getArrLayouts($order = null, $params = array(), $layoutType = null){
		
		$objLayoutType = UniteCreatorAddonType::getAddonTypeObject($layoutType, true);
		
		$arrLayouts = $this->getCatLayouts(null, $objLayoutType);

		
		return($arrLayouts);
	}
	
	
	/**
	 * get category layouts. category id can be null, all number or 0 (uncategorized)
	 */ 	 
	public function getCatLayouts($catID = null, $objLayoutType=null, $onlyRecords = false, $options = array()){
		
		
		//UniteFunctionsUC::showTrace();dmp("get layouts");dmp($options);
		
		$postType = null;
		
		$sortBY = UniteFunctionsWPUC::SORTBY_MENU_ORDER;
		
		$arrParams = array();
		
		$layoutType = null;
		if(!empty($objLayoutType)){
			
			$postType = $objLayoutType->postType;
			
			$layoutType = $objLayoutType->typeName;
			if($objLayoutType->isBasicType)
				$layoutType = null;

		}
		
		if(empty($postType))
			$postType = GlobalsProviderUC::POST_TYPE_LAYOUT;
		
		/*
		$metaQuery = array();
		$metaQuery[] = array("key"=>GlobalsProviderUC::META_KEY_LAYOUT_TYPE, "value"=>$layoutType);
		
		if($catID == "all")
			$catID = null;
		
		if($catID == "zero")
			$catID = 0;
		
		if($catID !== null)
			$metaQuery[] = array("key"=>GlobalsProviderUC::META_KEY_CATID, "value"=>$catID);
		
		$arrParams["meta_query"] = $metaQuery;
		*/
		
		//dmp($options);exit();
			
		$parentID = UniteFunctionsUC::getVal($options, "parent_id");
		if(empty($parentID))
			$parentID = 0;
		
		$arrParams = array();
		$arrParams["post_parent"] = $parentID;
				
		$arrPosts = UniteFunctionsWPUC::getPostsByType($postType, $sortBY, $arrParams, true);
		
		//add the parent post as well
		if(!empty($parentID)){
			$post = get_post($parentID);
			array_unshift($arrPosts, $post);
		}
		
		
		if($onlyRecords == true)
			return($arrPosts);
		
		$arrLayouts = $this->postsToLayouts($arrPosts);
		
		return($arrLayouts);		
	}
	
	
	/**
	 * get layouts array short version - without content
	 */
	public function getArrLayoutsShort($addEmpty = false, $params = array(), $layoutType = null){
		
		$objLayoutType = UniteCreatorAddonType::getAddonTypeObject($layoutType, true);
		
		$arrPosts = $this->getCatLayouts(null, $objLayoutType, true);
		
		
		$arrShort = $this->postsToShort($arrPosts);
				
		if($addEmpty == true){
			$arrItem = array("id"=>"empty", "title"=>"[Not Selected]");
			$arrAdd = array();
			$arrAdd["empty"] = esc_html__("[Not Selected]", "unlimited_elements");
			
			$arrShort = array_merge($arrAdd, $arrShort);
		}
		
		return($arrShort);
	}

	
	/**
	 * export layout from get data
	 */
	public function exportLayout($data = null){

		$layoutID = UniteFunctionsUC::getVal($data, "id");
		$layoutID = (int)$layoutID;
				
		$objLayout = new UniteCreatorLayout();
		$objLayout->initByID($layoutID);
		
		$layoutType = $objLayout->getLayoutType();
		
		if($layoutType != GlobalsUnlimitedElements::ADDONSTYPE_ELEMENTOR_TEMPLATE){
			parent::exportLayout($data);
			return(false);
		}
		
		$objExporter = new UniteCreatorLayoutsExporterElementor();
		$objExporter->initByLayout($objLayout);
		
		$objExporter->exportElementorLayout();
		exit();
				
	}
	
}
	