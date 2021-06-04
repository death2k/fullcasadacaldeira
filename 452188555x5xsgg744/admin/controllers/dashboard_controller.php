<?php
class DashboardController extends AppController {
    public $uses = array();

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'dashboard',
        ));
    }

    public function index() {
        $this->set(array(
            'title_for_layout' => 'Painel de Administração',
        ));
    }
}
