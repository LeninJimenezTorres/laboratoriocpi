<?php
require_once "Models/modelo_TypesUser.php";
class ControladorTypePanel{
    public function ctrAbrirPanelAdmin(){
        ModelUserTypes::mdlAdmCall();
        exit();
        die();
    }
    public function ctrAbrirPanelUser($id){
        ModelUserTypes::mdlUserCall($id);
        exit();
        die();
    }
}
?> 

