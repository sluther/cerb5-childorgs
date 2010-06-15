<?php
class ChChildOrgsTab extends Extension_OrgTab {
	function showTab() {
		@$org = DevblocksPlatform::importGPC($_REQUEST['org_id']);
		
		$tpl = DevblocksPlatform::getTemplateService();
		$tpl_path = dirname(dirname(__FILE__)).'/templates/';
		$tpl->assign('path', $tpl_path);
		
		$contact = DAO_ContactOrg::get($org);
		$tpl->assign('contact', $contact);
		
		$defaults = new C4_AbstractViewModel();
		$defaults->class_name = 'View_ContactOrg';
		$defaults->id = View_ContactOrg::DEFAULT_ID;
		
		$view = C4_AbstractViewLoader::getView(View_ContactOrg::DEFAULT_ID, $defaults);
		
		$view->params = array(
			new DevblocksSearchCriteria(SearchFields_ContactOrg::PARENT_ORG_ID,'=',$contact->id),
		);
		$tpl->assign('view', $view);
		
		$tpl->assign('contacts_page', 'orgs');
		$tpl->assign('response_uri', 'contacts/orgs');
		$tpl->assign('view_fields', View_ContactOrg::getFields());
		$tpl->assign('view_searchable_fields', View_ContactOrg::getSearchFields());		
		$tpl->display('file:' . $tpl_path . 'childorgs.tpl');
		exit;
	}
	
	function saveTab() {
	}
};