<?php

class Library_CSRF {

	private $namespace;

	function __construct($namespace_id) {
		$this->namespace = new Zend_Session_Namespace($namespace_id);
		$this->namespace->setExpirationSeconds(3600);
	}

	function setPostsId($postsId) {
		$this->namespace->postsId = serialize($postsId);
		return $this;
	}

	function getPostsId() {
		return unserialize($this->namespace->postsId);
	}

	function validateToken($id) {
		if (!isset($this->namespace->postsId)) {
			return false;
		}
		$postsId = $this->getPostsId();
		$pos = array_search($id, $postsId);

		if ($pos !== FALSE) {
			array_splice($postsId, $pos, 1);
			if (count($postsId) == 0) {
				$this->destroy();
			}
			$this->setPostsId($postsId);
			return true;
		}
		return false;
	}

	function destroy() {
		//Zend_Session::namespaceUnset($this->namespace);
	}

}
