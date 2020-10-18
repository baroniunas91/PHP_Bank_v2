<?php

namespace Bankas;

class TopAndBottomController  {
    private $html;
    public function showTop() {
        $this->html = new TopAndBottomView;
        return $this->html->showTopView();
    }
    public function showBottom() {
        $this->html = new TopAndBottomView;
        return $this->html->showBottomView();
    }
}