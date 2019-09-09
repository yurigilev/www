<?php
include_once ROOT.'/models/common.php';
session_start();

class commonController {

    public function indexAction($page=1, $sort='ID') {
        if (isset($_SESSION['name'])) {
            $loginName=$_SESSION['name'];
        }
        if ($sort=='ID') {
            $sort='ID_ASC';
        } else {
            $_SESSION['sort']=$sort;
        }
        if (isset($_SESSION['sort'])) {
            $sort=$_SESSION['sort'];
        }
        $sort=str_replace('_',' ',$sort);
        $tasks=Common::getList($page,$sort);
        $pages=Common::pagination();
        if ($page==1) {
                $leftClass='class="disabled"';
                $leftLink=$page;
            } else {
                $leftClass='';
                $leftLink=$page-1;            
        }
        if ($pages<=$page) {
                $rightClass='class="disabled"';
                $rightLink=$page;
            } else {
                $rightClass='';
                $rightLink=$page+1;           
        }
        require_once(ROOT.'/views/index.php');

        return true;
    }
    public function addAction() {
        if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["task"])) {
            Common::add($_POST["name"],$_POST["email"],$_POST["task"]);
        }
        $this->indexAction();
        return true;
    }

    public function delAction($id='') {
        if ($id!='') {
            Common::del($id);
        }
        $this->indexAction();
        return true;
    }


    public function loginAction() {
    if (isset($_POST["login"]) && isset($_POST["pass"])) {
            $a=Common::login($_POST["login"],$_POST["pass"]);
            if ($a) {
                $_SESSION['id']=$a[0];
                $_SESSION['name']=$a[1];
            }
        }
       $this->indexAction();
    }

    public function logoutAction() {
        if (isset($_SESSION['id'])) {
            session_unset();
            }
           $this->indexAction();
        }

    public function editAction() {
        if (isset($_POST["id"])) {
            if (isset($_POST["status"]) && $_POST["status"]=='on') { $status='done';} else {$status='work';}
            $text=trim($_POST["task"]);
            Common::edit($_POST["id"], $text, $status);
        }
        $this->indexAction();    
        return true;
    }


}

?>