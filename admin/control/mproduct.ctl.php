<?php
needRole('admin');
class MproductControl extends Control
{
	public function addMproductFrom()
	{
		if($_REQUEST['id']) {
			$mproduct = daocall('mproduct','getMproductById',array(intval($_REQUEST['id'])));
			$this->_tpl->assign('edit','1');
			$this->_tpl->assign('mproduct',$mproduct);
		}
		$mproductgroup = daocall('mproductgroup','getMproductgroup',array());
		$this->_tpl->assign('mproductgroup',$mproductgroup);
		return $this->_tpl->display('mproduct/addfrom.html');
	}
	public function addMproduct()
	{
		$result = daocall('mproduct','add',array($_REQUEST));
		if (!$result) {
			$this->_tpl->assign('msg','增加失败');
			return $this->_tpl->fetch('msg.html');
		}
		return $this->pageListMproduct();
	}
	public function delMproduct()
	{
		$id = intval($_REQUEST['id']);
		$result = daocall('mproduct','del',array($id));
		if (!$result) {
			$this->_tpl->assign('msg','增加失败');
			return $this->_tpl->fetch('msg.html');
		}
		return $this->pageListMproduct();
	}
	public function editMproductFrom()
	{
		$id = intval($_REQUEST['id']);
		$mproduct = daocall('mproduct','getMproductById',array($id));
		$this->_tpl->assign('action','editMproduct');
		$this->_tpl->assign('mproduct',$mproduct);
		return $this->_tpl->display('mproduct/addfrom.html');
	}
	public function pageListMproduct()
	{
		$page = intval($_REQUEST['page']);
		if($page<=0){
			$page = 1;
		}
		$page_count = 20;
		$count = 0;
		$order = $_REQUEST['order'] or 'id';//排序字段
		$list = daocall('mproduct','pageList',array($page,$page_count,&$count,$order));
		$total_page = ceil($count/$page_count);
		if($page>=$total_page){
			$page = $total_page;
		}
		$this->_tpl->assign('order',$order);
		$this->_tpl->assign('count',$count);
		$this->_tpl->assign('total_page',$total_page);
		$this->_tpl->assign('page',$page);
		$this->_tpl->assign('page_count',$page_count);
		$this->_tpl->assign('list',$list);
		$this->_tpl->display('mproduct/pagelistmproduct.html');
	}

















}